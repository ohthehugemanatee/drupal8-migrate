<?php

/**
 * @file
 * Contains \Drupal\composer_manager\PackageManager.
 */

namespace Drupal\composer_manager;

/**
 * Manages composer packages.
 */
class PackageManager implements PackageManagerInterface {

  /**
   * The app root.
   *
   * @var string
   */
  protected $root;

  /**
   * The root package builder.
   *
   * @var \Drupal\composer_manager\RootPackageBuilderInterface
   */
  protected $rootPackageBuilder;

  /**
   * A cache of loaded packages.
   *
   * @var array
   */
  protected $packages = array();

  /**
   * Constructs a PackageManager object.
   *
   * @param string $root
   * @param \Drupal\composer_manager\RootPackageBuilderInterface $root_package_builder
   */
  public function __construct($root, RootPackageBuilderInterface $root_package_builder) {
    $this->root = $root;
    $this->rootPackageBuilder = $root_package_builder;
  }

  /**
   * {@inheritdoc}
   */
  public function getCorePackage() {
    if (!isset($this->packages['core'])) {
      $this->packages['core'] = JsonFile::read($this->root . '/core/composer.core.json');
    }

    return $this->packages['core'];
  }

  /**
   * {@inheritdoc}
   */
  public function getExtensionPackages() {
    if (!isset($this->packages['extension'])) {
      $listing = new ExtensionDiscovery($this->root);
      // Get all profiles, and modules belonging to those profiles.
      // @todo Scan themes as well?
      $profiles = $listing->scan('profile');
      $profile_directories = array_map(function ($profile) {
        return $profile->getPath();
      }, $profiles);
      $listing->setProfileDirectories($profile_directories);
      $modules = $listing->scan('module');
      $extensions = $profiles + $modules;

      $this->packages['extension'] = array();
      foreach ($extensions as $extension_name => $extension) {
        $filename = $this->root . '/' . $extension->getPath() . '/composer.json';
        if (is_readable($filename)) {
          $this->packages['extension'][$extension_name] = JsonFile::read($filename);
        }
      }
    }

    return $this->packages['extension'];
  }

  /**
   * {@inheritdoc}
   */
  public function getRequiredPackages() {
    if (!isset($this->packages['required'])) {
      // The root package on disk might not be up to date, build a new one.
      $core_package = $this->getCorePackage();
      $extension_packages = $this->getExtensionPackages();
      $root_package = $this->rootPackageBuilder->build($core_package, $extension_packages);

      $packages = array();
      foreach ($root_package['require'] as $package_name => $constraint) {
        $packages[$package_name] = array(
          'constraint' => $constraint,
        );
      }

      $installed_packages = JsonFile::read($this->root . '/core/vendor/composer/installed.json');
      foreach ($installed_packages as $package) {
        $package_name = $package['name'];
        if (!isset($packages[$package_name])) {
          // The installed package is no longer required, and will be removed
          // in the next composer update. Add it in order to inform the end-user.
          $packages[$package_name] = array(
            'constraint' => '',
          );
        }

        // Add additional information available only for installed packages.
        $packages[$package_name] += array(
          'description' => !empty($package['description']) ? $package['description'] : '',
          'homepage' => !empty($package['homepage']) ? $package['homepage'] : '',
          'require' => !empty($package['require']) ? $package['require'] : array(),
          'version' => $package['version'],
        );
        if ($package['version'] == 'dev-master') {
          $packages[$package_name]['version'] .= '#' . $package['source']['reference'];
        }
      }

      // Process and cache the package list.
      $this->packages['required'] = $this->processRequiredPackages($packages);
    }

    return $this->packages['required'];
  }

  /**
   * Formats and sorts the provided list of packages.
   *
   * @param array $packages
   *   The packages to process.
   *
   * @return array
   *   The processed packages.
   */
  protected function processRequiredPackages(array $packages) {
    foreach ($packages as $package_name => $package) {
      // Ensure the presence of all keys.
      $packages[$package_name] += array(
        'constraint' => '',
        'description' => '',
        'homepage' => '',
        'require' => array(),
        'required_by' => array(),
        'version' => '',
      );
      // Sort the keys to ensure consistent results.
      ksort($packages[$package_name]);
    }

    // Sort the packages by package name.
    ksort($packages);

    // Add information about dependent packages.
    $core_package = $this->getCorePackage();
    $extension_packages = $this->getExtensionPackages();
    foreach ($packages as $package_name => $package) {
      // Detect Drupal dependents.
      if (isset($core_package['require'][$package_name])) {
        $packages[$package_name]['required_by'] = array($core_package['name']);
      }
      else {
        foreach ($extension_packages as $extension_name => $extension_package) {
          if (isset($extension_package['require'][$package_name])) {
            $packages[$package_name]['required_by'] = array($extension_package['name']);
            break;
          }
        }
      }

      // Detect inter-package dependencies.
      foreach ($package['require'] as $dependency_name => $constraint) {
        if (isset($packages[$dependency_name])) {
          $packages[$dependency_name]['required_by'][] = $package_name;
          if (empty($packages[$dependency_name]['constraint'])) {
            $packages[$dependency_name]['constraint'] = $constraint;
          }
        }
      }
    }

    return $packages;
  }

  /**
   * {@inheritdoc}
   */
  public function needsComposerUpdate() {
    $needs_update = FALSE;
    foreach ($this->getRequiredPackages() as $package) {
      if (empty($package['version']) || empty($package['required_by'])) {
        $needs_update = TRUE;
        break;
      }
    }

    return $needs_update;
  }

  /**
   * {@inheritdoc}
   */
  public function rebuildRootPackage() {
    // See the getCorePackage() interface docblock for an explanation of why
    // we're writing the root package to core/composer.json.
    $core_package = $this->getCorePackage();
    $extension_packages = $this->getExtensionPackages();
    $root_package = $this->rootPackageBuilder->build($core_package, $extension_packages);
    JsonFile::write($this->root . '/core/composer.json', $root_package);
  }

}

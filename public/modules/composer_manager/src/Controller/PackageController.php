<?php

/**
 * @file
 * Contains \Drupal\composer_manager\Controller\Packages.
 */

namespace Drupal\composer_manager\Controller;

use Drupal\composer_manager\Form\RebuildForm;
use Drupal\composer_manager\PackageManagerInterface;
use Drupal\Component\Utility\SafeMarkup;
use Drupal\Component\Utility\String;
use Drupal\Component\Utility\Xss;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Url;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Controller for displaying the list of required packages.
 */
class PackageController extends ControllerBase {

  /**
   * The module handler.
   *
   * @var \Drupal\Core\Extension\ModuleHandlerInterface
   */
  protected $moduleHandler;

  /**
   * The package manager.
   *
   * @var \Drupal\composer_manager\PackageManagerInterface
   */
  protected $packageManager;

  /**
   * The module data from system_get_info().
   *
   * @var array
   */
  protected $moduleData;

  /**
   * Constructs a PackageController object.
   *
   * @param \Drupal\Core\Extension\ModuleHandlerInterface $module_handler
   * @param \Drupal\composer_manager\PackageManagerInterface $package_manager
   */
  public function __construct(ModuleHandlerInterface $module_handler, PackageManagerInterface $package_manager) {
    $this->moduleHandler = $module_handler;
    $this->packageManager = $package_manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('module_handler'),
      $container->get('composer_manager.package_manager')
    );
  }

  /**
   * Shows the status of all required packages.
   *
   * @return array
   *   Returns a render array as expected by drupal_render().
   */
  public function page() {
    if (!composer_manager_initialized()) {
      $message = t("Composer Manager needs to be initialized before usage. Run the module's <code>init.sh</code> script or <code>drush composer-manager-init</code> on the command line.");
      drupal_set_message($message, 'warning');
      return array();
    }

    try {
      $packages = $this->packageManager->getRequiredPackages();
    }
    catch (\RuntimeException $e) {
      drupal_set_message(Xss::filterAdmin($e->getMessage()), 'error');
      $packages = array();
    }

    $rows = array();
    foreach ($packages as $package_name => $package) {
      // Prepare the package name and description.
      if (!empty($package['homepage'])) {
        $options = array('attributes' => array('target' => '_blank'));
        $name = $this->l($package_name, Url::fromUri($package['homepage']), $options);
      }
      else {
        $name = String::checkPlain($package_name);
      }
      if (!empty($package['description'])) {
        $name .= '<div class="description">' . String::checkPlain($package['description']) . '</div>';
      }

      // Prepare the installed and required versions.
      $installed_version = $package['version'] ? $package['version'] : $this->t('Not installed');
      $required_version = $this->buildRequiredVersion($package['constraint'], $package['required_by']);

      // Prepare the row classes.
      $class = array();
      if (empty($package['version'])) {
        $class[] = 'error';
      }
      elseif (empty($package['required_by'])) {
        $class[] = 'warning';
      }

      $rows[$package_name] = array(
        'class' => $class,
        'data' => array(
          'package' => SafeMarkup::set($name),
          'installed_version' => $installed_version,
          'required_version' => SafeMarkup::set($required_version),
        ),
      );
    }

    $build = array();
    $build['packages'] = array(
      '#theme' => 'table',
      '#header' => array(
        'package' => $this->t('Package'),
        'installed_version' => $this->t('Installed Version'),
        'required_version' => $this->t('Required Version'),
      ),
      '#rows' => $rows,
      '#caption' => $this->t('Status of Packages Managed by Composer'),
      '#attributes' => array(
        'class' => array('system-status-report'),
      ),
    );

    // Display any errors returned by hook_requirements().
    $this->moduleHandler->loadInclude('composer_manager', 'install');
    $requirements = composer_manager_requirements('runtime');
    if ($requirements['composer_manager']['severity'] == REQUIREMENT_ERROR) {
      drupal_set_message($requirements['composer_manager']['description'], 'warning');
    }

    return $build;
  }

  /**
   * Builds the required version column.
   *
   * @param string $contraint
   *   The package constraint.
   * @param array $required_by
   *   The names of dependent packages.
   *
   * @return string
   *   The requirements string in HTML format.
   */
  protected function buildRequiredVersion($constraint, array $required_by) {
    // Filter out non-Drupal packages.
    $drupal_required_by = array_filter($required_by, function($package_name) {
      return strpos($package_name, 'drupal/') !== FALSE;
    });

    if (empty($required_by)) {
      $constraint = $this->t('No longer required');
      $description = $this->t('Package will be removed on the next Composer update');
    }
    elseif (empty($drupal_required_by)) {
      // The package is here as a requirement of other packages, list them.
      $constraint = $this->t('N/A');
      $description = $this->t('Required by: ') . join(', ', $required_by);
    }
    else {
      if (!isset($this->moduleData)) {
        $this->moduleData = system_get_info('module');
      }

      $modules = array();
      foreach ($drupal_required_by as $package_name) {
        $name_parts = explode('/', $package_name);
        $module_name = $name_parts[1];

        if ($module_name == 'core') {
          $modules[] = $this->t('Drupal');
        }
        elseif (isset($this->moduleData[$module_name])) {
          $modules[] = String::checkPlain($this->moduleData[$module_name]['name']);
        }
        else {
          $modules[] = String::checkPlain($module_name);
        }
      }

      $description = $this->t('Required by: ') . join(', ', $modules);
    }

    $required_version = $constraint;
    $required_version .= '<div class="description">' . $description . '</div>';

    return $required_version;
  }

}

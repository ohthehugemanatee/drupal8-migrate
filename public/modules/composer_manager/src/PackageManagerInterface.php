<?php

/**
 * @file
 * Contains \Drupal\composer_manager\PackageManagerInterface.
 */

namespace Drupal\composer_manager;

/**
 * Provides an interface for managing composer packages.
 */
interface PackageManagerInterface {

  /**
   * Returns the core package.
   *
   * Right now core/composer.json represents both the core and root package
   * because the actual root package added in #1975220 isn't functional yet.
   * As a temporary measure, the module copies core/composer.json to
   * core/composer.core.json, and then treats core/composer.json as the
   * overwritable root package.
   *
   * @todo Clean up once #2372815 is done and the root package is functional.
   *
   * @return array
   *   The core package, loaded from core/composer.core.json.
   */
  public function getCorePackage();

  /**
   * Returns the extension packages.
   *
   * The composer.json file of each extension (module, profile) under each site
   * is loaded and returned.
   *
   * @return array
   *   An array of packages, keyed by the providing Drupal extension name.
   *
   * @see \Drupal\Core\Extension\ExtensionDiscovery
   */
  public function getExtensionPackages();

  /**
   * Returns the required packages.
   *
   * This includes all requirements from a freshly built root package, as well
   * as any previously installed packages that are no longer required.
   *
   * @return array
   *   An array of packages, keyed by package name, with the following keys:
   *   - constraint: The imposed version constraint (e.g. '>=2.7').
   *   - description: Package description, if known.
   *   - homepage: Package homepage, if known.
   *   - require: Package requirements, if known.
   *   - required_by: An array of dependent package names. Empty if the package
   *     is no longer required.
   *   - version: The installed package version. Empty if the package hasn't
   *     been installed yet.
   */
  public function getRequiredPackages();

  /**
   * Returns whether a composer update is needed.
   *
   * An update is needed when there are packages that are:
   * 1. Required, but not installed.
   * 2. Installed, but no longer required.
   *
   * @return bool
   *   True if a composer update is needed, false otherwise.
   */
  public function needsComposerUpdate();

  /**
   * Rebuilds the root package.
   *
   * The root package is built by adding the requirements of each extension
   * to the core package requirements.
   *
   * @see \Drupal\composer_manager\RootPackageBuilder
   */
  public function rebuildRootPackage();

}

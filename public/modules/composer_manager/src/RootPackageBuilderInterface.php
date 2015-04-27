<?php

/**
 * @file
 * Contains \Drupal\composer_manager\RootPackageBuilderInterface.
 */

namespace Drupal\composer_manager;

/**
 * Provides an interface for root package builders.
 */
interface RootPackageBuilderInterface {

  /**
   * Builds the root package.
   *
   * The root package is built by adding the requirements of each extension
   * to the core package requirements. The merged composer.json keys are:
   * 'require', 'minimum-stability', 'prefer-stable' and 'repositories'.
   *
   * @param array $core_package
   *   The core package.
   * @param array $extension_packages
   *   The extension packages.
   *
   * @return array
   *   The built root package.
   */
  public function build(array $core_package, array $extension_packages);

}

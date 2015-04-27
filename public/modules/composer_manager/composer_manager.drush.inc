<?php

/**
 * @file
 * Drush hook implementations for the Composer Manager module.
 */

/**
 * Implements hook_drush_command().
 */
function composer_manager_drush_command() {
  $items = array();
  $items['composer-manager-init'] = array(
    'description' => 'Initializes Composer Manager.',
  );

  return $items;
}

/**
 * Initializes Composer Manager.
 */
function drush_composer_manager_init() {
  try {
    composer_manager_initialize();
    drush_log(dt('Composer Manager has been successfuly initialized.'), 'ok');
    return TRUE;
  }
  catch (\Exception $e) {
    return drush_set_error($e->getMessage());
  }
}

/**
 * Implements hook_drush_pm_post_download().
 *
 * If the downloaded module contains a composer.json file, update dependencies.
 */
function composer_manager_drush_pm_post_download($project, $release) {
  if (!composer_manager_initialized() || getenv('SKIP_COMPOSER_UPDATE')) {
    return;
  }

  $filename = $project['project_install_location'] . '/composer.json';
  if (file_exists($filename)) {
    // Peek inside the file to prevent needless rebuilds.
    $file = \Drupal\composer_manager\JsonFile::read($filename);
    if (!empty($file['require'])) {
      chdir(\Drupal::root() . '/core');
      passthru('composer drupal-update');
    }
  }
}

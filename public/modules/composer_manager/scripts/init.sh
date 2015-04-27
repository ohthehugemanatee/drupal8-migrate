#!/usr/bin/env php
<?php

if (PHP_SAPI !== 'cli') {
  return;
}

$root = find_root();
if (!$root) {
  echo 'ERROR: Drupal root not found. This command must be run fron inside a Drupal installation.' . PHP_EOL;
  exit;
}

require __DIR__ . '/../src/JsonFile.php';
require __DIR__ . '/../composer_manager.module';

composer_manager_initialize($root);

echo 'Composer Manager has been successfuly initialized.' . PHP_EOL;

/**
 * Returns the absolute path to Drupal's root directory.
 */
function find_root() {
  $currentPath = __DIR__ . '/';
  $relativePath = '../../../';
  $rootPath = '';
  $found = FALSE;
  while (!$found) {
    $rootPath = $currentPath . $relativePath;
    if (is_dir($rootPath . 'core/vendor')) {
      $found = TRUE;
      break;
    }
    else {
      $relativePath .= '../';
      if (realpath($rootPath) === '/') {
        break;
      }
    }
  }

  return $found ? realpath($rootPath) : NULL;
}

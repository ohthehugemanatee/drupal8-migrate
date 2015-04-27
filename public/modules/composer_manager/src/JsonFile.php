<?php

/**
 * @file
 * Contains \Drupal\composer_manager\JsonFile.
 */

namespace Drupal\composer_manager;

use Drupal\Component\Utility\String;

/**
 * Reads and writes json files.
 */
final class JsonFile {

  /**
   * Reads and decodes a json file into an array.
   *
   * @return array
   *   The decoded json data.
   *
   * @throws \RuntimeException
   * @throws \UnexpectedValueException
   */
  public static function read($filename) {
    if (!is_readable($filename)) {
      throw new \RuntimeException(String::format('@filename is not readable.', array('@filename' => $filename)));
    }

    $json = file_get_contents($filename);
    if ($json === FALSE) {
      throw new \RuntimeException(t('Could not read @filename', array('@filename' => $filename)));
    }

    $data = json_decode($json, TRUE);
    if (JSON_ERROR_NONE !== json_last_error()) {
      throw new \UnexpectedValueException('Could not decode JSON: ' . self::getLastErrorMessage());
    }

    return $data;
  }

  /**
   * Encodes and writes the provided json data to a file.
   *
   * @param string $filename
   *   Name of the file to write.
   * @param array $data
   *   The data to encode.
   *
   * @return int
   *   The number of bytes that were written to the file.
   *
   * @throws \RuntimeException
   * @throws \UnexpectedValueException
   */
  public static function write($filename, array $data) {
    if (!is_writable($filename)) {
      throw new \RuntimeException(String::format('@filename is not writable.', array('@filename' => $filename)));
    }

    $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    if (JSON_ERROR_NONE !== json_last_error()) {
      throw new \UnexpectedValueException('Could not encode JSON: ' . self::getLastErrorMessage());
    }

    $bytes = file_put_contents($filename, $json);
    if ($bytes === FALSE) {
      throw new \RuntimeException(String::format('Could not write to @filename', array('@filename' => $filename)));
    }

    return $bytes;
  }

  /**
   * Returns a human readable json error.
   *
   * @return string
   *   The human readable json error.
   */
  public static function getLastErrorMessage()
  {
    if (function_exists('json_last_error_msg')) {
      // PHP 5.5 and later have a built-in function for this.
      return json_last_error_msg();
    }

    switch (json_last_error()) {
      case JSON_ERROR_DEPTH:
        return 'Maximum stack depth exceeded';
      case JSON_ERROR_STATE_MISMATCH:
        return 'Underflow or the modes mismatch';
      case JSON_ERROR_CTRL_CHAR:
        return 'Unexpected control character found';
      case JSON_ERROR_SYNTAX:
        return 'Syntax error, malformed JSON';
      case JSON_ERROR_UTF8:
        return 'Malformed UTF-8 characters, possibly incorrectly encoded';
      default:
        return 'Unknown error';
    }
  }

}

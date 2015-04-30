<?php

/**
 * @file
 * Contains \Drupal\migrate\MigrationCounters.
 */

namespace Drupal\migrate;

/**
 * Defines the migration counters class.
 */
class MigrationCounters implements MigrationCountersInterface {

  /**
   * Array of counters being tracked, keyed by counter name.
   *
   * @var array
   */
  protected $counters = array();

  /**
   * {@inheritdoc}
   */
  public function get($counter_name) {
    if (isset($this->counters[$counter_name])) {
      return $this->counters[$counter_name];
    }
    else {
      return 0;
    }
  }

  /**
   * {@inheritdoc}
   */
  public function increment($counter_name) {
    if (isset($this->counters[$counter_name])) {
      $this->counters[$counter_name]++;
    }
    else {
      $this->counters[$counter_name] = 1;
    }
  }

  /**
   * {@inheritdoc}
   */
  public function reset($counter_name) {
    $this->counters[$counter_name] = 0;
  }

}

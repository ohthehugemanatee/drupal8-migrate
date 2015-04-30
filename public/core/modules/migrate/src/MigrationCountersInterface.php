<?php

/**
 * @file
 * Contains \Drupal\migrate\MigrationCountersInterface.
 */

namespace Drupal\migrate;

/**
 * Defines the migration counters interface.
 */
interface MigrationCountersInterface {

  /**
   * Returns the current counter value.
   *
   * @param string $counter_name
   *   Name of the counter (e.g., "successes").
   *
   * @return int
   *   The total number of successes, or 0 if no counter by this name exists.
   */
  public function get($counter_name);

  /**
   * Increments the specified counter.
   *
   * @param string $counter_name
   *   Name of the counter (e.g., "successes").
   */
  public function increment($counter_name);

  /**
   * Resets the specified counter to 0.
   *
   * @param string $counter_name
   *   Name of the counter (e.g., "successes").
   */
  public function reset($counter_name);

}


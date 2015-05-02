<?php
/**
 * @file
 * Contains \Drupal\migrate_plus\CSVFileObject.php
 */


namespace Drupal\migrate_plus;

use SplFileObject;

/**
 * Class CSVFileObject
 * @package Drupal\migrate_plus
 * Extends SPLFileObject to:
 * - assume CSV format
 * - skip header rows on rewind()
 * - address columns by header row name instead of index.
 */
class CSVFileObject extends SplFileObject {

  /**
   * The number of rows in the CSV file before the data starts.
   *
   * @var integer
   */
  public $headerRows = 0;

  /**
   * The human-readable column headers, keyed by column index in the CSV.
   */
  public $csvColumns = array();

  /**
   * @inheritdoc
   */
  public function rewind() {
    $this->seek($this->headerRows);
  }

  /**
   * @inheritdoc
   */
  public function current() {
    $row = parent::current();

    if ($row) {
      if (!empty($this->csvColumns)) {
        // only use rows specified in $this->csvColumns().
        $row = array_intersect_key($row, $this->csvColumns);
        // Set meaningful keys for the columns mentioned in $this->csvColumns().
        foreach ($this->csvColumns as $int => $values) {
          list($key, $description) = $values;
          // Copy value to more descriptive string based key and then unset original.
          $row[$key] = isset($row[$int]) ? $row[$int] : NULL;
          unset($row[$int]);
        }
        return $row;
      }
      else {
        return $row;
      }
    }
    else {
      // There is no next row.
      return NULL;
    }
  }

  /**
   * @inheritdoc
   */
  public function __construct ($filename) {
    parent::__construct($filename);
    $this->setFlags(SplFileObject::READ_CSV);
    // Set an initial value of the available columns to be field numbers.
    $this->csvColumns = array_keys($this->current());
  }

}
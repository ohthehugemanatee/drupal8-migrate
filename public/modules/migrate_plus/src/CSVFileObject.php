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
 * Extends SPLFileObject to assume CSV, recognize header rows and skip them on rewind().
 */
class CSVFileObject extends SplFileObject {

  /**
   * The number of rows in the CSV file before the data starts.
   *
   * @var integer
   */
  public $headerRows = 0;

  /**
   * @inheritdoc
   */
  public function rewind() {
    $this->seek($this->headerRows);
  }


  /**
   * @inheritdoc
   */
  public function __construct ($filename) {
    parent::__construct($filename);
    $this->setFlags(SplFileObject::READ_CSV);
  }

}
<?php
/**
 * @file
 * Contains \Drupal\migrate_plus\Plugin\migrate\source\csv.
 */

namespace Drupal\migrate_plus\Plugin\migrate\source;

use Drupal\migrate\Entity\MigrationInterface;
use Drupal\migrate\MigrateException;
use Drupal\migrate\Plugin\migrate\source\SourcePluginBase;
use Drupal\migrate_plus\CSVFileObject;


/**
 * Source for CSV.
 *
 * If the CSV file contains non-ASCII characters, make sure it includes a
 * UTF BOM (Byte Order Marker) so they are interpreted correctly.
 *
 * @MigrateSource(
 *   id = "csv"
 * )
 */
class CSV extends SourcePluginBase {

  public function initializeIterator() {

    // File handler using our custom header-rows-respecting extension of SPLFileObject.
    $file = new CSVFileObject($this->configuration['path']);

    // Set basics of CSV behavior based on configuration.
    $delimiter = !empty($this->configuration['delimiter']) ? $this->configuration['delimiter'] : ',';
    $enclosure = !empty($this->configuration['enclosure']) ? $this->configuration['enclosure'] : '"';
    $escape = !empty($this->configuration['escape']) ? $this->configuration['escape'] : '\\';
    $file->setCsvControl($delimiter, $enclosure, $escape);

    // Tell it if there are header rows.
    $file->headerRows = !empty($this->configuration['header_rows']) ? $this->configuration['header_rows'] : 0;

    return $file;
  }

  public function getIDs() {
    $ids = array();
    foreach ($this->configuration['keys'] as $key) {
      $ids[$key]['type'] = 'string';
    }
    return $ids;
  }


  /**
   * List of available source fields.
   *
   * @var array
   */
  protected $fields = array();

  /**
   * List of key fields, as indexes.
   *
   * @var array
   */
  protected $keys = array();

  /**
   * The number of rows in the CSV file before the data starts.
   *
   * @var integer
   */
  protected $headerRows = 0;

  /**
   * The human-readable column headers, keyed by column index in the CSV.
   */
  public $csvColumns = array();

  /**
   * {@inheritdoc}
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, MigrationInterface $migration) {
    parent::__construct($configuration, $plugin_id, $plugin_definition, $migration);

    // Path is required.
    if (empty($this->configuration['path'])) {
      return new MigrateException('You must declare the "path" to the source CSV file in your source settings.');
    }

    // Key field(s) are required
    if (empty($this->configuration['keys'])) {
      return new MigrateException('You must declare the "keys" the source CSV file in your source settings.');
    }

    // Set header rows from the migrate configuration.
    $this->getIterator()->headerRows = !empty($this->configuration['header_rows']) ? $this->configuration['header_rows'] : 0;

    // Figure out what CSV columns we have.
    // One can either pass in an explicit list of column names to use, or if we have
    // a header row we can use the names from that
    if ($this->configuration['header_rows'] && empty($this->configuration['csvColumns'])) {
      $this->csvColumns = array();

      for ($i = 0; $i < $this->configuration['header_rows'] - 1; $i++) {
        $this->getNextLine();
      }

      $row = $this->getNextLine();
      foreach ($row as $key => $header) {
        $header = trim($header);
        $this->getIterator()->csvColumns[] = array($header, $header);
      }
    }
    elseif ($this->configuration['csvColumns']) {
      $this->getIterator()->csvColumns = $this->configuration['csvColumns'];
    }
  }

  /**
   * Return a string representing the source query.
   *
   * @return string
   */
  public function __toString() {
    return $this->configuration['path'];
  }

  /**
   * Returns a list of fields available to be mapped from the source query.
   *
   * @return array
   *  Keys: machine names of the fields (to be passed to addFieldMapping)
   *  Values: Human-friendly descriptions of the fields.
   */
  public function fields() {
    $fields = array();
    foreach ($this->getIterator()->csvColumns as $values) {
      $fields[$values[0]] = $values[1];
    }

    // Any caller-specified fields with the same names as extracted fields will
    // override them; any others will be added
    if ($this->configuration['fields']) {
      $fields = $this->configuration['fields'] + $fields;
    }

    return $fields;
  }

  /**
   * Return a count of all available source records.
   */
  public function computeCount() {
    // If the data may have embedded newlines, the file line count won't reflect
    // the number of CSV records (one record will span multiple lines). We need
    // to scan with fgetcsv to get the true count.

    // If there are embedded newlines, we have to use the Iterator's count.
    if (!empty($this->configuration['embedded_newlines'])) {
      $count = iterator_count($this->getIterator());
    }
    else {
      // Shortcut to count number of lines in a file.
      $count = count(file($this->configuration['path']));
      $count -= $this->headerRows;
    }
    return $count;
  }

  /**
   * Implementation of MigrateSource::performRewind().
   *
   * @return void
   */
  public function rewind() {
    // Load up the first row, skipping the header(s) if necessary
    for ($i = 0; $i < $this->headerRows; $i++) {
      $this->getNextLine();
    }
    $this->rowNumber = 1;
  }

  /**
   * Implementation of MigrateSource::getNextRow().
   * Return the next line of the source CSV file as an object.
   *
   * @return null|object
   */
  public function getNextRow() {
    $row = $this->getNextLine();

  }

  protected function getNextLine() {
    $this->getIterator()->next();
    return $this->getIterator()->current();
  }


}

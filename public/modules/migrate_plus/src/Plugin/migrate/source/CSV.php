<?php
/**
 * @file
 * Contains \Drupal\migrate_plus\Plugin\migrate\source\csv.
 */

namespace Drupal\migrate_plus\Plugin\migrate\source;

use Drupal\migrate\Entity\MigrationInterface;
use Drupal\migrate\MigrateException;
use Drupal\migrate\Plugin\migrate\source\SourcePluginBase;
use SplFileObject;


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
    $file = new \SplFileObject($this->configuration['path']);
    $file->setFlags(SplFileObject::READ_CSV);
    $delimiter = !empty($this->configuration['delimiter']) ? $this->configuration['delimiter'] : ',';
    $enclosure = !empty($this->configuration['enclosure']) ? $this->configuration['enclosure'] : '"';
    $escape = !empty($this->configuration['escape']) ? $this->configuration['escape'] : '\\';
    $file->setCsvControl($delimiter, $enclosure, $escape);
    return $file;
  }

  public function getIDs() {
    foreach ($this->configuration['keys'] as $key) {
      $ids[$key]['type'] = 'string';
    }
    return $ids;
  }

  /**
   * The name of the key field in the CSV.
   * @var NULL
   */
  protected $IDField = NULL;

  /**
   * List of available source fields.
   *
   * @var array
   */
  protected $fields = array();

  /**
   * Parameters for the fgetcsv() call.
   *
   * @var array
   */
  protected $fgetcsv = array();

  /**
   * File handle for the CSV file being iterated.
   *
   * @var resource
   */
  protected $csvHandle = NULL;

  /**
   * The number of rows in the CSV file before the data starts.
   *
   * @var integer
   */
  protected $headerRows = 0;

  /**
   * The current row/line number in the CSV file.
   *
   * @var integer
   */
  protected $rowNumber;

  /**
   * {@inheritdoc}
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, MigrationInterface $migration) {
    parent::__construct($configuration, $plugin_id, $plugin_definition, $migration);
    /**
     * Get the variables we used to get called with out of $configuration.
     * string $path
     * The path to the source file
     *
     * array $csvcolumns
     * Keys are integers. values are array(field name, description).
     *
     * array $options
     * Options applied to this source.
     *
     * @param array $fields
     * Optional - keys are field names, values are descriptions. Use to override
     * the default descriptions, or to add additional source fields which the
     * migration will add via other means (e.g., prepareRow()).
     */
    if (empty($this->configuration['path'])) {
      return new MigrateException('You must give the path to the source CSV file.');
    }
    $path = $this->configuration['path'];
    $this->options = isset($this->configuration['options']) ? $this->configuration['options'] : array();
    $this->fields = isset($this->configuration['fields']) ? $this->configuration['fields'] : array();

    // Set header rows from the migrate configuration.
    $this->headerRows = !empty($this->configuration['header_rows']) ? $this->configuration['header_rows'] : 0;

    // Get the iterator for file operations.
    $iterator = $this->getIterator();

    // Figure out what CSV columns we have.
    // One can either pass in an explicit list of column names to use, or if we have
    // a header row we can use the names from that
    if ($this->headerRows && empty($this->configuration['csvcolumns'])) {
      $this->csvcolumns = array();

      // Skip all but the last header
      for ($i = 0; $i < $this->headerRows - 1; $i++) {
        $this->getNextLine();
      }

      $row = $this->getNextLine();
      foreach ($row as $header) {
        $header = trim($header);
        $this->csvcolumns[] = array($header, $header);
      }
    }
    else {
      $this->csvcolumns = $csvcolumns;
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
    foreach ($this->csvcolumns as $values) {
      $fields[$values[0]] = $values[1];
    }

    // Any caller-specified fields with the same names as extracted fields will
    // override them; any others will be added
    if ($this->fields) {
      $fields = $this->fields + $fields;
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
    $iterator = $this->getIterator();

    // If there are embedded newlines, we have to use the Iterator's count.
    if (!empty($this->configuration['embedded_newlines'])) {
      $iterator = $this->getIterator();
      $count = iterator_count($iterator);
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
  public function performRewind() {
    // Close any previously-opened handle
    if (!is_null($this->csvHandle)) {
      fclose($this->csvHandle);
      $this->csvHandle = NULL;
    }
    // Load up the first row, skipping the header(s) if necessary
    $this->csvHandle = fopen($this->file, 'r');
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
    if ($row) {
      // only use rows specified in $this->csvcolumns().
      $row = array_intersect_key($row, $this->csvcolumns);
      // Set meaningful keys for the columns mentioned in $this->csvcolumns().
      foreach ($this->csvcolumns as $int => $values) {
        list($key, $description) = $values;
        // Copy value to more descriptive string based key and then unset original.
        $row[$key] = isset($row[$int]) ? $row[$int] : NULL;
        unset($row[$int]);
      }
      $row['csvrownum'] = $this->rowNumber++;
      return (object)$row;
    }
    else {
      fclose($this->csvHandle);
      $this->csvHandle = NULL;
      return NULL;
    }
  }

  protected function getNextLine() {
    $iterator = $this->getIterator();
    $iterator->next();
    return $iterator->current();
  }


}

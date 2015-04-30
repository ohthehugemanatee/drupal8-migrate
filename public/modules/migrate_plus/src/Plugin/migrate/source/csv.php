<?php
/**
 * @file
 * Contains \Drupal\migrate_plus\Plugin\migrate\source\csv.
 */

namespace Drupal\migrate_plus\Plugin\migrate\source;

use Drupal\migrate\Entity\MigrationInterface;
use Drupal\migrate\Plugin\migrate\source\SourcePluginBase;


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
class CSVSource extends SourcePluginBase {

  public function initializeIterator() {
    $file = new \SplFileObject($this->configuration['path']);
    $file->setFlags(SplFileObject::READ_CSV);
    $file->setCsvControl(',');
    return $file;
  }

  public function getIDs() {
    return $this->configuration['key'];
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
    $path = $this->configuration['path'];
    $csvcolumns = isset($this->configuration['csvcolumns']) ? $this->configuration['csvcolumns'] : array();
    $options = isset($this->configuration['options']) ? $this->configuration['options'] : array();
    $fields = isset($this->configuration['fields']) ? $this->configuration['fields'] : array();

    // Also set header rows from the migrate configuration.
    $options['header_rows'] = isset($this->configuration['header_rows']) ? $this->configuration['header_rows'] : array();
    $this->file = $path;
    if (!empty($options['header_rows'])) {
      $this->headerRows = $options['header_rows'];
    }
    else {
      $this->headerRows = 0;
    }
    $this->options = $options;
    $this->fields = $fields;
    // fgetcsv specific options
    foreach (array('length' => NULL, 'delimiter' => ',', 'enclosure' => '"', 'escape' => '\\') as $key => $default) {
      $this->fgetcsv[$key] = isset($options[$key]) ? $options[$key] : $default;
    }
    // One can either pass in an explicit list of column names to use, or if we have
    // a header row we can use the names from that
    if ($this->headerRows && empty($csvcolumns)) {
      $this->csvcolumns = array();
      $this->csvHandle = fopen($this->file, 'r');
      // Skip all but the last header
      for ($i = 0; $i < $this->headerRows - 1; $i++) {
        $this->getNextLine();
      }

      $row = $this->getNextLine();
      foreach ($row as $header) {
        $header = trim($header);
        $this->csvcolumns[] = array($header, $header);
      }
      fclose($this->csvHandle);
      $this->csvHandle = NULL;
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
    return $this->file;
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
    if (!empty($this->options['embedded_newlines'])) {
      $this->csvHandle = fopen($this->file, 'r');
      // Skip all but the last header
      for ($i = 0; $i < $this->headerRows; $i++) {
        fgets($this->csvHandle);
      }
      $count = 0;
      while ($this->getNextLine()) {
        $count++;
      }
      fclose($this->csvHandle);
      $this->csvHandle = NULL;
    }
    else {
      // TODO. If this takes too much time/memory, use exec('wc -l')
      $count = count(file($this->file));
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
    // escape parameter was added in PHP 5.3.
    if (version_compare(phpversion(), '5.3', '<')) {
      $row = fgetcsv($this->csvHandle, $this->fgetcsv['length'],
        $this->fgetcsv['delimiter'], $this->fgetcsv['enclosure']);
    }
    else {
      $row = fgetcsv($this->csvHandle, $this->fgetcsv['length'],
        $this->fgetcsv['delimiter'], $this->fgetcsv['enclosure'],
        $this->fgetcsv['escape']);
    }
    return $row;
  }


}

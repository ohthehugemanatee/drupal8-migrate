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
   * The number of rows in the CSV file before the data starts.
   *
   * @var integer
   */
  protected $headerRows = 0;

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
      $this->csvcolumns = $this->configuration['csvcolumns'];
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
  public function performRewind() {
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
      // There is no next row, so close the iterator.
      $this->iterator = NULL;
      return NULL;
    }
  }

  protected function getNextLine() {
    $this->getIterator()->next();
    return $this->getIterator()->current();
  }


}

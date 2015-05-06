<?php

/**
 * @file
 * Contains \Drupal\migrate_example\Plugin\migrate\source\BeerNode.
 */

namespace Drupal\migrate_example\Plugin\migrate\source;

use Drupal\migrate\Row;

/**
 * Drupal 6 node source from database.
 *
 * @MigrateSource(
 *   id = "beer_node"
 * )
 */
class BeerNode extends MigrateExampleSqlBase {

  /**
   * {@inheritdoc}
   */
  public function query() {
    $query = $this->select('migrate_example_beer_node', 'b')
                 ->fields('b', array('bid', 'name', 'body', 'excerpt', 'aid',
                   'countries', 'image', 'image_alt', 'image_title',
                   'image_description'));
    $query->leftJoin('migrate_example_beer_topic_node', 'tb', 'b.bid = tb.bid');
    // Gives a single comma-separated list of related terms
    $query->groupBy('tb.bid');
    $query->addExpression('GROUP_CONCAT(tb.style)', 'terms');
    return $query;
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields = array(
      'bid' => $this->t('Beer ID'),
      'name' => $this->t('Name of beer'),
      'body' => $this->t('Full description of the beer'),
      'excerpt' => $this->t('Abstract for this beer'),
      'aid' => $this->t('Account ID of the author'),
      'countries' => $this->t('Countries of origin. Multiple values, delimited by pipe'),
      'image' => $this->t('Image path'),
      'image_alt' => $this->t('Image ALT'),
      'image_title' => $this->t('Image title'),
      'image_description' => $this->t('Image description'),
      'terms' => $this->t('Applicable styles'),
    );

    return $fields;
  }

  /**
   * {@inheritdoc}
   */
  public function getIds() {
    return array(
      'bid' => array(
        'type' => 'integer',
        'alias' => 'b',
      ),
    );
  }

  public function prepareRow(Row $row) {
    if ($value = $row->getSourceProperty('countries')) {
      $row->setSourceProperty('countries', explode('|', $value));
    }
    if ($value = $row->getSourceProperty('terms')) {
      $row->setSourceProperty('terms', explode(',', $value));
    }
  }

}

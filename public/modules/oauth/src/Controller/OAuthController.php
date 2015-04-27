<?php

/**
 * @file
 * Contains \Drupal\oauth\Controller\OAuthController.
 */

namespace Drupal\oauth\Controller;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\user\UserInterface;
use Drupal\oauth\Form\OAuthDeleteConsumerForm;

/**
 * Controller routines for book routes.
 */
class OAuthController implements ContainerInjectionInterface {

  /**
   * Constructs a BookController object.
   */
  public function __construct() {
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static();
  }

  /**
   * Returns the list of consumers for a user.
   *
   * @param \Drupal\user\UserInterface $user
   *   A user account object.
   *
   * @return string
   *   A HTML-formatted string with the list of OAuth consumers.
   */
  public function consumers(UserInterface $user) {
    $request = \Drupal::request();
    $list = array();

    $list['heading']['#markup'] = l(t('Add consumer'), 'oauth/consumer/add');

    // Get the list of consumers.
    $result = db_query('select *
                        from {oauth_consumer}
                        where uid = :uid', array(':uid' => $user->id()));

    // Define table headers.
    $list['table'] = array(
      '#theme' => 'table',
      '#header' => array(
        'consumer_key' => array(
          'data' => t('Consumer key'),
        ),
        'consumer_secret' => array(
          'data' => t('Consumer secret'),
        ),
        'operations' => array(
          'data' => t('Operations'),
        ),
      ),
      '#rows' => array(),
    );

    // Add existing consumers to the table.
    foreach ($result as $row) {
      $list['table']['#rows'][] = array(
        'data' => array(
          'consumer_key' => $row->consumer_key,
          'consumer_secret' => $row->consumer_secret,
          'operations' => array(
            'data' => array(
              '#type' => 'operations',
              '#links' => array(
                'delete' => array(
                  'title' => t('Delete'),
                  'href' => 'oauth/consumer/delete/' . $row->cid,
                ),
              ),
            ),
          ),
        ),
      );
    }

    $list['table']['#empty'] = t('There are no OAuth consumers.');

    return $list;
  }

}

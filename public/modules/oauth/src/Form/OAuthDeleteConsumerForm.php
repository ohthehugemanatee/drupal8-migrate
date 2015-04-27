<?php

/**
 * @file
 * Contains \Drupal\oauth\Form\OAuthDeleteConsumerForm.
 */

namespace Drupal\oauth\Form;

use Drupal\Core\Form\ConfirmFormBase;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides an oauth_consumer deletion confirmation form.
 */
class OAuthDeleteConsumerForm extends ConfirmFormBase implements ContainerInjectionInterface {

  /**
   * {@inheritdoc}
   */
  public function getFormID() {
    return 'oauth_delete_consumer_form';
  }

  /**
   * {@inheritdoc}
   */
  public function getQuestion() {
    return t('Are you sure you want to delete this OAuth consumer?');
  }

  /**
   * {@inheritdoc}
   */
  public function getConfirmText() {
    return t('Delete');
  }

 /**
   * {@inheritdoc}
   */
  public function getCancelRoute() {
    $account = \Drupal::currentUser();
    return array(
      'route_name' => 'oauth.user_consumer',
      'route_parameters' => array(
        'user' => $account->id(),
      ),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, array &$form_state, $cid = NULL) {
    $form['cid'] = array(
      '#type' => 'hidden',
      '#value' => $cid,
    );
    $form = parent::buildForm($form, $form_state);
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, array &$form_state) {
    $account = \Drupal::currentUser();
    $cid = $form_state['values'];
    db_delete('oauth_consumer')
      ->condition('cid', $cid)
      ->execute();
    drupal_set_message('OAuth consumer deleted.');
    $form_state['redirect'] = 'user/' . $account->id() . '/oauth/consumer';
  }

}

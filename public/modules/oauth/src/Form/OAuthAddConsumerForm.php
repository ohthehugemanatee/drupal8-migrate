<?php

/**
 * @file
 * Contains \Drupal\oauth\Form\OAuthAddConsumerForm.
 */

namespace Drupal\oauth\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Config\ConfigFactory;
use Drupal\Core\Config\Context\ContextInterface;
use Drupal\Core\Path\AliasManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Provides a form to add OAuth consumers.
 */
class OAuthAddConsumerForm extends FormBase {

  /**
   * The URL generator to use.
   *
   * @var \Symfony\Component\Routing\Generator\UrlGeneratorInterface
   */
  protected $urlGenerator;

  /**
   * {@inheritdoc}
   */
  public function getFormID() {
    return 'oauth_add_consumer_form';
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('url_generator')
    );
  }

  /**
   * {@inheritdoc}
   *
   * @param \Symfony\Component\Routing\Generator\UrlGeneratorInterface $url_generator
   *   The URL generator service.
   */
  public function __construct(UrlGeneratorInterface $url_generator) {
    $this->urlGenerator = $url_generator;
  }

  /**
   * Form builder.
   */
  public function buildForm(array $form, array &$form_state) {
    $form['save'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Add'),
    );

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, array &$form_state) {
    $values = $form_state['values'];
    $account = \Drupal::currentUser();

    $consumer_key = user_password(32);
    $consumer_secret  = user_password(32);
    $key_hash = sha1($consumer_key);
    db_insert('oauth_consumer')
      ->fields(array(
          'uid' => $account->id(),
          'consumer_key' => $consumer_key,
          'consumer_secret' => $consumer_secret,
          'key_hash' => $key_hash,
      ))
      ->execute();

    drupal_set_message(t('Added a new consumer.'));
    $form_state['redirect'] = $this->urlGenerator->generate('oauth.user_consumer', array('user' => $account->id()), TRUE);
  }

}

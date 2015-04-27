<?php

/**
 * @file
 * Contains \Drupal\Tests\composer_manager\Unit\ExtensionDiscoveryTest.
 */

namespace Drupal\Tests\composer_manager\Unit;

use Drupal\composer_manager\ExtensionDiscovery;
use Drupal\Tests\UnitTestCase;
use org\bovigo\vfs\vfsStream;

/**
 * @coversDefaultClass \Drupal\composer_manager\ExtensionDiscovery
 * @group composer_manager
 */
class ExtensionDiscoveryTest extends UnitTestCase {

  /**
   * @var \Drupal\composer_manager\ExtensionDiscovery
   */
  protected $discovery;

  /**
   * {@inheritdoc}
   */
  public function setUp() {
    // Simulate modules in multiple sites and multiple profiles.
    $structure = array(
      'modules' => array(
        'test1' => $this->generateModule('test1'),
      ),
      'profiles' => array(
        'commons' => array(
          'commons.info.yml' => 'type: profile',
          'commons.profile' => '<?php',
          'modules' => array(
            'test2' => $this->generateModule('test2'),
          ),
        ),
      ),
      'sites' => array(
        'all' => array(
          'modules' => array(
            'test3' => $this->generateModule('test3'),
          ),
        ),
        'default' => array(
          'modules' => array(
            'test4' => $this->generateModule('test4'),
          ),
        ),
        'test.site.com' => array(
          'profiles' => array(
            'commerce_kickstart' => array(
              'commerce_kickstart.info.yml' => 'type: profile',
              'commerce_kickstart.profile' => '<?php',
              'modules' => array(
                'test5' => $this->generateModule('test5'),
              ),
            ),
          ),
          'modules' => array(
            'test6' => $this->generateModule('test6'),
          ),
        ),
      ),
    );
    $root = vfsStream::setup('drupal', null, $structure);

    $this->discovery = new ExtensionDiscovery('vfs://drupal');
  }

  /**
   * {@inheritdoc}
   */
  public function tearDown() {
    $this->discovery->resetCache();
  }

  /**
   * @covers ::scan
   * @covers ::getSiteDirectories
   */
  public function testScan() {
    $expected_profiles = array(
      'commons', 'commerce_kickstart',
    );
    $profiles = $this->discovery->scan('profile');
    $this->assertEquals($expected_profiles, array_keys($profiles));

    $expected_extensions = array(
      'test5', 'test2', 'test3', 'test1', 'test4', 'test6',
    );
    $profile_directories = array_map(function ($profile) {
      return $profile->getPath();
    }, $profiles);
    $this->discovery->setProfileDirectories($profile_directories);
    $extensions = $this->discovery->scan('module');
    $this->assertEquals($expected_extensions, array_keys($extensions));
  }

  /**
   * Returns the file structure for a module.
   */
  protected function generateModule($name) {
    return array(
      $name . '.module' => '<?php',
      $name . '.info.yml' => 'type: module',
    );
  }

}

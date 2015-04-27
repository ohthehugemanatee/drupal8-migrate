<?php

/**
 * @file
 * Contains \Drupal\Tests\composer_manager\Unit\PackageManagerTest.
 */

namespace Drupal\Tests\composer_manager\Unit;

use Drupal\composer_manager\PackageManager;
use Drupal\Tests\UnitTestCase;
use org\bovigo\vfs\vfsStream;

/**
 * @coversDefaultClass \Drupal\composer_manager\PackageManager
 * @group composer_manager
 */
class PackageManagerTest extends UnitTestCase {

  /**
   * @var \Drupal\composer_manager\PackageManager
   */
  protected $manager;

  /**
   * Package fixtures.
   *
   * @var array
   */
  protected $packages = array(
    'root' => array(
      'name' => 'drupal/core',
      'type' => 'drupal-core',
      'require' => array(
        'symfony/css-selector' => '2.6.*',
        'symfony/config' => '2.6.*',
        'symfony/intl' => '2.6.*',
        'symfony/dependency-injection' => '2.6.*',
      ),
    ),
    'core' => array(
      'name' => 'drupal/core',
      'type' => 'drupal-core',
      'require' => array(
        'symfony/dependency-injection' => '2.6.*',
      ),
    ),
    'extension' => array(
      'commerce_kickstart' => array(
        'name' => 'drupal/commerce_kickstart',
        'require' => array(
          'symfony/css-selector' => '2.6.*',
        ),
      ),
      'test1' => array(
        'name' => 'drupal/test1',
        'require' => array(
          'symfony/intl' => '2.6.*',
        ),
      ),
      'test2' => array(
        'name' => 'drupal/test2',
        'require' => array(
          'symfony/config' => '2.6.*',
        ),
      ),
    ),
    'installed' => array(
      array(
        'name' => 'symfony/dependency-injection',
        'version' => 'v2.6.3',
        'description' => 'Symfony DependencyInjection Component',
        'homepage' => 'http://symfony.com',
      ),
      array(
        'name' => 'symfony/event-dispatcher',
        'version' => 'v2.6.3',
        'description' => 'Symfony EventDispatcher Component',
        'homepage' => 'http://symfony.com',
        'require' => array(
          // symfony/event-dispatcher doesn't really have this requirement,
          // we're lying for test purposes.
          'symfony/yaml' => 'dev-master',
        ),
      ),
      array(
        'name' => 'symfony/yaml',
        'version' => 'dev-master',
        'source' => array(
          'type' => 'git',
          'url' => 'https://github.com/symfony/Yaml.git',
          'reference' => '3346fc090a3eb6b53d408db2903b241af51dcb20',
        ),
        // description and homepage intentionally left out to make sure
        // getRequiredPackages() can cope with that.
      ),
    ),
  );

  /**
   * {@inheritdoc}
   */
  public function setUp() {
    $structure = array(
      'core' => array(
        'composer.core.json' => json_encode($this->packages['core']),
        'vendor' => array(
          'composer' => array(
            'installed.json' => json_encode($this->packages['installed']),
          ),
        ),
      ),
      'profiles' => array(
        'commerce_kickstart' => array(
          'commerce_kickstart.info.yml' => 'type: profile',
          'commerce_kickstart.profile' => '<?php',
          'composer.json' => json_encode($this->packages['extension']['commerce_kickstart']),
        ),
      ),
      'modules' => array(
        'test1' => array(
          'composer.json' => json_encode($this->packages['extension']['test1']),
          'test1.module' => '<?php',
          'test1.info.yml' => 'type: module',
        ),
      ),
      'sites' => array(
        'all' => array(
          'modules' => array(
            'test2' => array(
              'composer.json' => json_encode($this->packages['extension']['test2']),
              'test2.module' => '<?php',
              'test2.info.yml' => 'type: module',
            ),
          ),
        ),
      ),
    );
    $root = vfsStream::setup('drupal', null, $structure);
    // Mock the root package builder and make it return our prebuilt fixture.
    $root_package_builder = $this->getMockBuilder('Drupal\composer_manager\RootPackageBuilderInterface')
      ->disableOriginalConstructor()
      ->getMock();
    $root_package_builder->expects($this->any())
      ->method('build')
      ->will($this->returnValue($this->packages['root']));

    $this->manager = new PackageManager('vfs://drupal', $root_package_builder);

  }

  /**
   * @covers ::getCorePackage
   */
  public function testCorePackage() {
    $core_package = $this->manager->getCorePackage();
    $this->assertEquals($this->packages['core'], $core_package);
  }

  /**
   * @covers ::getExtensionPackages
   */
  public function testExtensionPackages() {
    $extension_packages = $this->manager->getExtensionPackages();
    $this->assertEquals($this->packages['extension'], $extension_packages);
  }

  /**
   * @covers ::getRequiredPackages
   * @covers ::processRequiredPackages
   */
  public function testRequiredPackages() {
    $expected_packages = array(
      'symfony/css-selector' => array(
        'constraint' => '2.6.*',
        'description' => '',
        'homepage' => '',
        'require' => array(),
        'required_by' => array('drupal/commerce_kickstart'),
        'version' => '',
      ),
      'symfony/config' => array(
        'constraint' => '2.6.*',
        'description' => '',
        'homepage' => '',
        'require' => array(),
        'required_by' => array('drupal/test2'),
        'version' => '',
      ),
      'symfony/intl' => array(
        'constraint' => '2.6.*',
        'description' => '',
        'homepage' => '',
        'require' => array(),
        'required_by' => array('drupal/test1'),
        'version' => '',
      ),
      'symfony/dependency-injection' => array(
        'constraint' => '2.6.*',
        'description' => 'Symfony DependencyInjection Component',
        'homepage' => 'http://symfony.com',
        'require' => array(),
        'required_by' => array('drupal/core'),
        'version' => 'v2.6.3',
      ),
      'symfony/event-dispatcher' => array(
        'constraint' => '',
        'description' => 'Symfony EventDispatcher Component',
        'homepage' => 'http://symfony.com',
        'require' => array('symfony/yaml' => 'dev-master'),
        'required_by' => array(),
        'version' => 'v2.6.3',
      ),
      'symfony/yaml' => array(
        'constraint' => 'dev-master',
        'description' => '',
        'homepage' => '',
        'require' => array(),
        'required_by' => array('symfony/event-dispatcher'),
        'version' => 'dev-master#3346fc090a3eb6b53d408db2903b241af51dcb20',
      ),
    );

    $required_packages = $this->manager->getRequiredPackages();
    $this->assertEquals($expected_packages, $required_packages);
  }

  /**
   * @covers ::needsComposerUpdate
   */
  public function testNeedsComposerUpdate() {
    $needs_update = $this->manager->needsComposerUpdate();
    $this->assertEquals(true, $needs_update);
  }

}

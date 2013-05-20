<?php

namespace VirtualPersistAPI\VirtualPersistBundle\Tests\TestCases;

/**
 * @file
 * Assign an app-level fixture for functional testing.
 * We want to set up a fixture once, run many tests, and then clean
 * up after all the tests.
 *
 * Very clearly a rip-off of Symfony\Bundle\FrameworkBundle\Test\WebTestCase
 * Other inspiration: http://blog.sznapka.pl/fully-isolated-tests-in-symfony2/
 */

use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;

interface AppFixtureTestCaseInterface {

  /**
   * Get the name of the fixture class.
   */
  public static function getFixtureClass();
}

/**
 * AppTestCase is the base class for functional tests.
 * Use it to load a fixture once per test case.
 */
abstract class AppFixtureTestCase extends \PHPUnit_Framework_TestCase implements AppFixtureTestCaseInterface {

  protected static $class;
  protected static $kernel;
  protected static $application;

  /**
   * Creates a Client.
   *
   * @param array $server  An array of server parameters
   *
   * @return Client A Client instance
   */
  protected function createClientForApp(array $server = array()) {
    $client = $this->getContainer()->get('test.client');
    $client->setServerParameters($server);

    return $client;
  }

  /**
   * Finds the directory where the phpunit.xml(.dist) is stored.
   *
   * If you run tests with the PHPUnit CLI tool, everything will work as expected.
   * If not, override this method in your test classes.
   *
   * @return string The directory where phpunit.xml(.dist) is stored
   */
  protected static function getPhpUnitXmlDir() {
    if (!isset($_SERVER['argv']) || false === strpos($_SERVER['argv'][0], 'phpunit')) {
      throw new \RuntimeException('You must override the WebTestCase::createKernel() method.');
    }

    $dir = static::getPhpUnitCliConfigArgument();
    if ($dir === null &&
      (is_file(getcwd() . DIRECTORY_SEPARATOR . 'phpunit.xml') ||
      is_file(getcwd() . DIRECTORY_SEPARATOR . 'phpunit.xml.dist'))) {
      $dir = getcwd();
    }

    // Can't continue
    if ($dir === null) {
      throw new \RuntimeException('Unable to guess the Kernel directory.');
    }

    if (!is_dir($dir)) {
      $dir = dirname($dir);
    }

    return $dir;
  }

  /**
   * Finds the value of configuration flag from cli
   *
   * PHPUnit will use the last configuration argument on the command line, so this only returns
   * the last configuration argument
   *
   * @return string The value of the phpunit cli configuration option
   */
  private static function getPhpUnitCliConfigArgument() {
    $dir = null;
    $reversedArgs = array_reverse($_SERVER['argv']);
    foreach ($reversedArgs as $argIndex => $testArg) {
      if ($testArg === '-c' || $testArg === '--configuration') {
        $dir = realpath($reversedArgs[$argIndex - 1]);
        break;
      }
      elseif (strpos($testArg, '--configuration=') === 0) {
        $argPath = substr($testArg, strlen('--configuration='));
        $dir = realpath($argPath);
        break;
      }
    }

    return $dir;
  }

  /**
   * Attempts to guess the kernel location.
   *
   * When the Kernel is located, the file is required.
   *
   * @return string The Kernel class name
   */
  protected static function getKernelClass() {
    $dir = isset($_SERVER['KERNEL_DIR']) ? $_SERVER['KERNEL_DIR'] : static::getPhpUnitXmlDir();

    $finder = new Finder();
    $finder->name('*Kernel.php')->depth(0)->in($dir);
    $results = iterator_to_array($finder);
    if (!count($results)) {
      throw new \RuntimeException('Either set KERNEL_DIR in your phpunit.xml according to http://symfony.com/doc/current/book/testing.html#your-first-functional-test or override the WebTestCase::createKernel() method.');
    }

    $file = current($results);
    $class = $file->getBasename('.php');

    require_once $file;

    return $class;
  }

  /**
   * Creates a Kernel.
   *
   * Available options:
   *
   *  * environment
   *  * debug
   *
   * @param array $options An array of options
   *
   * @return HttpKernelInterface A HttpKernelInterface instance
   */
  protected static function createKernel(array $options = array()) {
    if (null === static::$class) {
      static::$class = static::getKernelClass();
    }

    static::$kernel = new static::$class(
        isset($options['environment']) ? $options['environment'] : 'test',
        isset($options['debug']) ? $options['debug'] : true
    );
    return static::$kernel;
  }

  /**
   * Shuts the kernel down if it was used in the test.
   */
  public static function tearDownAfterClass() {
    if (null !== static::$kernel) {
      static::$kernel->shutdown();
    }
  }

  public function getContainer() {
    return static::$kernel->getContainer();
  }

  public static function setUpBeforeClass() {
    $fixtureClass = static::getFixtureClass();
    if (empty($fixtureClass)) {
      throw new \Exception('Subclass does not implement getFixtureClass().');
    }
    $kernel = static::createKernel(array('environment' => 'test'));
    $kernel->boot();
    $em = $kernel->getContainer()->get('doctrine.orm.entity_manager');
    if (!$em) throw new Exception('no em');
    $purger = new ORMPurger($em);
    if (!$purger) throw new Exception('no purger');
    $purger->setPurgeMode(ORMPurger::PURGE_MODE_DELETE);
    $executor = new ORMExecutor($em, $purger);
    if (!$executor) throw new Exception('no purger');
    $loader = new Loader();
    $loader->addFixture(new $fixtureClass());
    $executor->execute($loader->getFixtures(), FALSE);
  }

  public static function getFixtureClass() {
    return '';
  }

}

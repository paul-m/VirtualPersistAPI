<?php
namespace VirtualPersistAPI\VirtualPersistBundle\Tests\TestCases;

// Very clearly a rip-off of Symfony\Bundle\FrameworkBundle\Test\WebTestCase
// Other inspiration: http://blog.sznapka.pl/fully-isolated-tests-in-symfony2/

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpKernel\HttpKernelInterface;

/**
 * WebTestCase is the base class for functional tests.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
abstract class FixtureTestCase extends \PHPUnit_Framework_TestCase
{
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
    protected static function createClientForApp(array $server = array()) {
        $client = static::$application->getKernel()->getContainer()->get('test.client');
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
    protected static function getPhpUnitXmlDir()
    {
        if (!isset($_SERVER['argv']) || false === strpos($_SERVER['argv'][0], 'phpunit')) {
            throw new \RuntimeException('You must override the WebTestCase::createKernel() method.');
        }

        $dir = static::getPhpUnitCliConfigArgument();
        if ($dir === null &&
            (is_file(getcwd().DIRECTORY_SEPARATOR.'phpunit.xml') ||
            is_file(getcwd().DIRECTORY_SEPARATOR.'phpunit.xml.dist'))) {
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
    private static function getPhpUnitCliConfigArgument()
    {
        $dir = null;
        $reversedArgs = array_reverse($_SERVER['argv']);
        foreach ($reversedArgs as $argIndex => $testArg) {
            if ($testArg === '-c' || $testArg === '--configuration') {
                $dir = realpath($reversedArgs[$argIndex - 1]);
                break;
            } elseif (strpos($testArg, '--configuration=') === 0) {
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
    protected static function getKernelClass()
    {
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
    protected static function createKernel(array $options = array())
    {
        if (null === static::$class) {
            static::$class = static::getKernelClass();
        }

        return new static::$class(
            isset($options['environment']) ? $options['environment'] : 'test',
            isset($options['debug']) ? $options['debug'] : true
        );
    }

    /**
     * Shuts the kernel down if it was used in the test.
     */
    protected function tearDown()
    {
        if (null !== static::$kernel) {
            static::$kernel->shutdown();
        }
    }
    
  public function getContainer()
  {
    return static::$application->getKernel()->getContainer();
  }

  public function setUp()
  {
    //http://stackoverflow.com/questions/9196035/temporary-doctrine2-fixtures-for-testing-with-phpunit
    $loader = new Doctrine\Common\DataFixtures\Loader;
    $loader->loadFromDirectory('/path/to/MyDataFixtures');
    $purger = new Doctrine\Common\DataFixtures\Purger\ORMPurger($em);
    $executor = new Doctrine\Common\DataFixtures\Executor\ORMExecutor($em, $purger);
    $executor->execute($loader->getFixtures());

    static::$kernel = static::createKernel(array('environment'=>'test', 'debug'=>'true'));
    static::$kernel->boot();
    static::$application = new \Symfony\Bundle\FrameworkBundle\Console\Application(static::$kernel);
    static::$application->setAutoExit(false);
    $this->runConsole("doctrine:schema:drop", array("--force" => true));
    $this->runConsole("doctrine:schema:create");
    $this->runConsole("doctrine:fixtures:load", array("--fixtures" => __DIR__ . "/../DataFixtures"));
  }

  protected function runConsole($command, Array $options = array())
  {
    $options["-e"] = "test";
    $options["-q"] = null;
    $options = array_merge($options, array('command' => $command));
    return static::$application->run(new \Symfony\Component\Console\Input\ArrayInput($options));
  }

}

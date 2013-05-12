<?php
namespace VirtualPersistAPI\VirtualPersistBundle\Tests\TestCases;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

require_once(__DIR__ . "../../../../../../app/AppKernel.php");

abstract class ModelTestCase extends WebTestCase
{
  protected $_application;

  public function setUp()
  {
    $kernel = new \AppKernel("test", true);
    $kernel->boot();
    $this->_application = new \Symfony\Bundle\FrameworkBundle\Console\Application($kernel);
    $this->_application->setAutoExit(false);
    $this->runConsole("doctrine:schema:drop", array('--force' => TRUE));
    $this->runConsole("doctrine:schema:update", array('--force' => TRUE));
    $this->runConsole("cache:warmup");
    $this->runConsole("doctrine:fixtures:load", array('--append' => TRUE, '--fixtures' => __DIR__ . "../../DataFixtures/ORM"));
  }

  protected function runConsole($command, Array $options = array())
  {
    $options["-e"] = "test";
    $options["-q"] = null;
    $options = array_merge($options, array('command' => $command));
    return $this->_application->run(new \Symfony\Component\Console\Input\ArrayInput($options));
  }
}

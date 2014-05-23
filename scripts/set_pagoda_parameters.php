<?php
require_once __DIR__ . '/../symfony/vendor/autoload.php';

use Symfony\Component\Yaml\Dumper;

$dumper = new Dumper();

$parameters = array(
  'parameters' => array(
    'database_driver' => 'pdo_mysql',
    'database_host' => $_SERVER['DB1_HOST'],
    'database_port' => $_SERVER['DB1_PORT'],
    'database_name' => $_SERVER['DB1_NAME'],
    'database_user' => $_SERVER['DB1_USER'],
    'database_password' => $_SERVER['DB1_PASS'],
    'mailer_transport' => 'smtp',
    'mailer_host' => 'localhost',
    'mailer_user' => '~',
    'mailer_password' => '~',
    'locale' => 'en',
    'secret' => 'ThisTokenIsNotSoSecretChangeIt',
  ),
);

$yaml = $dumper->dump($parameters, 2);

echo $yaml;

file_put_contents(__DIR__ . '/../symfony/app/config/parameters.yml', $yaml);

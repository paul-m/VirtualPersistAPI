<?php
require_once __DIR__ . '/../symfony/vendor/autoload.php';

use Symfony\Component\Yaml\Dumper;

$dumper = new Dumper();

$parameters = array(
  'parameters' => array(
    'database_driver' => 'pdo_mysql',
    'database_host' => $_SERVER['SYMFONY_DB_HOST'],
    'database_port' => 3306,
    'database_name' => $_SERVER['SYMFONY_DB_NAME'],
    'database_user' => $_SERVER['SYMFONY_DB_USER'],
    'database_password' => $_SERVER['SYMFONY_DB_PASS'],
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

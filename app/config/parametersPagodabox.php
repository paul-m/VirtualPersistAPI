<?php

$container->setParameter('database_driver', 'pdo_mysql');
if(@$_SERVER['VPA_ON_PAGODABOX']) {
    $container->setParameter('database_host', $_SERVER['DATABASE1_HOST']);
    $container->setParameter('database_port', $_SERVER['DATABASE1_PORT']);
    $container->setParameter('database_name', $_SERVER['DATABASE1_NAME']);
    $container->setParameter('database_user', $_SERVER['DATABASE1_USER']);
    $container->setParameter('database_password', $_SERVER['DATABASE1_PASS']);
}

<?php

/*
    database_host:     %database.host%
    database_port:     %database.port%
    database_name:     %database.name%
    database_user:     %database.user%
    database_password: %database.password%
*/

$container->setParameter('database.host', $_SERVER['DB1_HOST']);
$container->setParameter('database.port', $_SERVER['DB1_PORT']);
$container->setParameter('database.name', $_SERVER['DB1_NAME']);
$container->setParameter('database.user', $_SERVER['DB1_USER']);
$container->setParameter('database.pass', $_SERVER['DB1_PASS']);

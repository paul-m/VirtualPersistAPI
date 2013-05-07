#!/bin/sh

cd symfony

curl -s https://getcomposer.org/installer | php

./composer.phar -v -o --dev update

./bin/phpunit -c app

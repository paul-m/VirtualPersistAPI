#!/bin/sh

php ./symfony/composer.phar -d=symfony/ install

./symfony/vendor/bin/phpunit -c ./symfony/app


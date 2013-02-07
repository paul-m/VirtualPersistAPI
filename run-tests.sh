#!/bin/sh

curl -s https://getcomposer.org/installer | php -- --install-dir="symfony"

php ./symfony/composer.phar -v -o -d=symfony/ update

./symfony/vendor/bin/phpunit -c ./symfony/app


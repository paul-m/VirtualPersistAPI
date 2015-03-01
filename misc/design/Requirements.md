VirtualPersistAPI Project Requirements
======================================

VirtualPersistAPI is meant to be a package that can be deployed with relative ease by anyone. Therefore its requirements are typical for a PHP web application.

VirtualPersistAPI is based in the Symfony 2.1 PHP framework, and uses Doctrine ORM for the database.

This means that VPA's dependencies are the same as those frameworks'.

- Symfony: http://symfony.com/doc/2.1/reference/requirements.html
- Doctrine: http://docs.doctrine-project.org/en/2.0.x/reference/introduction.html#requirements

In essence:

- PHP 5.3.3 or greater with JSON and ctype extensions.
- A database supported by PHP's PDO class.

These packages will run on a commodity web server, using LAMP stack, so:

- A Unix-flavored box, deployed in cloud hosting.
- Apache http server.
- MySQL.
- PHP.



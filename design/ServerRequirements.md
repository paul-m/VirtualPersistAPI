Server Requirements
===================

A high-level requirements document exists here: https://github.com/paul-m/VirtualPersistAPI/blob/master/design/Requirements.md

VirtualPersistAPI is developed using Symfony2 and Doctrine, so it has the requirements of those packages.

Since we're using Composer to install these components and manage their dependencies, our most basic requirements are those of Composer.

PHP
---

- v.5.3.3 or higher, we target 5.4.x.
- Extensions:
    - phar
    - json
    - PDO
- Configuration:
    - `detect_unicode = Off`
    - `allow_url_fopen = On`
    - `apc.enable_cli = Off`


Database
--------

- Compatible with PHP's PDO
- We choose MySQL v.5.5.x.

Apache
------

...is a requirement.

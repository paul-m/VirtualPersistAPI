[![Build Status](https://travis-ci.org/paul-m/VirtualPersistAPI.png)](https://travis-ci.org/paul-m/VirtualPersistAPI)

VirtualPersistAPI
=================

What is it?
-----------

VirtualPersistAPI (VPA) is a RESTful-ish http-based API for storing arbitrary data. You can POST data to VPA and then GET the data back, and then DELETE it if you want.

The data is identified in a three-tier hierarchy: The user's UUID, a category, and a key. The category and key are arbitrary.

The API includes a way to query for categories per UUID, and keys per category.

There's a more detailed API spec document here: https://github.com/paul-m/VirtualPersistAPI/blob/master/spec/VirtualPersistAPI.md

Why?
----

The main justification for writing this was to make a persistent data API for use by Second Life scripters.

Also I wanted to learn Symfony.

Also I needed a project for a PHP class I was taking. :-)

License
-------

The final licensing for this project will be an open-source license compatible with its components, and free for anyone to use however they see fit.

Components
----------

VirtualPersistAPI uses the following components:

- Symfony2
- Doctrine ORM
- PHPUnit

Roadmap
-------

VirtualPersistAPI reached its first milestone: It currently has RESTful GET, POST, DELETE and category/key discovery. It can use any database supported by Doctrine (which relies on PDO).

Future milestones:

1. Easy deployment. Currently targeting Pagodabox, but not quite there.

2. Real user authentication. Currently, the only authentication check is that a user UUID exists which matches the one in the request. This milestone will use the built-in Symfony user package.

3. User management/admin pages. Currently all admin happens by manipulating the database.

4. Refactor my Symfony-noob code.

Contribution
------------

The VirtualPersistAPI project is hosted on github. Fork, send pull requests, file issues... https://github.com/paul-m/VirtualPersistAPI

All contributions will require tests that pass travis. So write them. :-)

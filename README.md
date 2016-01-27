[![Build Status](https://travis-ci.org/paul-m/VirtualPersistAPI.png)](https://travis-ci.org/paul-m/VirtualPersistAPI)

VirtualPersistAPI
=================

What is it?
-----------

VirtualPersistAPI (VPA) is a RESTful-ish http-based API for storing arbitrary data. You can POST data to VPA and then GET the data back, and then DELETE it if you want.

The data is identified in a three-tier hierarchy: The user's UUID, a category, and a key. The category and key are arbitrary.

Restated: You can make requests like this: `http://example.com/api/[uuid]/[category]/[key]` and get back the data. Or POST data to a URL like that and set the data.

The API also includes a way to query for categories per UUID, and keys per category, and to gather all data per category.

See the more detailed API spec document here: https://github.com/paul-m/VirtualPersistAPI/blob/master/misc/spec/VirtualPersistAPI.md


Why?
----

The main justification for writing this was to make a persistent data API for use by Second Life scripters.

Also I wanted to learn Symfony.

Also I needed a project for a PHP class I was taking. :-)

How? Part 0: Just Use Pagodabox.
---

VirtualPersistAPI is designed to work out of the box with Pagodabox.

- Get an account on pagodabox.com.
- Create a site.
- Push your repo there.
- Watch as the site builds itself.

How? Part 1: Install VPA
---

If you want to build VPA locally...

This project is managed through Composer. If you want to get it running locally, you should use commands like these:

	curl -sS https://getcomposer.org/installer | php
	./composer.phar install

You should see Composer auto-magically install all the dependencies.

How? Part 2: Settings
---

Having installed everything, you can now set up VPA to use your database.

Open the file `app/config/parameters.yml`. This is a YAML file containing database credentials. You'll see settings like this:

	database_host:     localhost
	database_port:     3306
	database_name:     vpa
	database_user:     root
	database_password: root

Change these settings to reflect your database.

Since VirtualPersistAPI uses the Doctrine framework, we can now use its command line options to test those settings. Try this command:

	php app/console doctrine:database:create --env=dev

If your settings are correct, you'll see a message that the database has been created. If you have an error, make sure the database is running, and that you've set the correct credentials for it. Also, this command will generate an error if the database already exists, so read carefully.

How? Part 3: The Database
---

We're going to use Doctrine to build the database.

	php app/console doctrine:database:create --env=dev
	php app/console doctrine:schema:create --env=dev

And now we're done with Part 3.

How? Part 4: The Docroot
---

Since we're using Symfony2, we need to set the docroot of the web server to `web`. The variety of ways to do this is beyond the scope of this document, so look at the documentation for your web server.

How? Part 5: Ping The Thing
---

Point your browser at your local web server. Something like: http://localhost:8888/

You should see a page that says 'Hi, I'm your VirtualPersistAPI site.'

Yay!

You can also use a URL like http://localhost:8888/app_dev.php to see request and benchmarking data provided by Symfony and Doctrine.


Components
----------

VirtualPersistAPI uses the following components:

- Symfony2
- Doctrine ORM
- PHPUnit

Roadmap
-------

VirtualPersistAPI reached its first milestone: It currently has RESTful GET, POST, DELETE and category/key discovery. It can use any database supported by Doctrine (which relies on PDO).

Second milestone achieved: It can be easily deployed on Pagodabox.

Future milestones:

2. Real user authentication. Currently, the only authentication check is that a user UUID exists which matches the one in the request. This milestone will use the built-in Symfony user package.

3. User management/admin pages. Currently all admin happens by manipulating the database.

4. Refactor my Symfony-noob code. This is ongoing.

Contribution
------------

The VirtualPersistAPI project is hosted on github. Fork, send pull requests, file issues... https://github.com/paul-m/VirtualPersistAPI

All contributions will require tests that pass travis. So write them. :-)

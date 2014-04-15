VirtualPersistAPI Testing Notes
===

Where?
---

Unit and functional tests are located in the bundle /Tests directory. So: `symfony/src/VirtualPersistAPI/Bundle/VirtualPeristAPIBundle/Tests`.


How?
---

To run the tests manually:

	cd ./symfony

Install Composer:

	curl -s https://getcomposer.org/installer | php

Install dependencies:

	./composer.phar --dev --no-progress install

Generate the fixture and assets:

	php app/console doctrine:database:create --env=test
	php app/console doctrine:schema:create --env=test
	php app/console cache:clear --env=test
	php app/console assetic:dump --env=test

Run the test:

	./bin/phpunit -c app

Once you've run through this set of commands, you don't have to re-install Composer or pull down the dependencies every time.

This set of commands is copied from `.travis.yml`, which enables continuous integration through Travis CI and GitHub. If you decide to fork this project, you can enable Travis CI and use this feature yourself.

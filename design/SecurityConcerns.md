VirtualPersistAPI Security Concerns
===================================

There are two main modes of external access to VPA:

1. Through the API.
2. Administration through web-based pages and forms.

### API

Authentication for API-based access will be limited by the in-world capabilities of LSL. While it's theoretically possible to implement complex authentication methods, it's a bit of a practical nightmare.

However, LSL can generate a SHA1 hash, and so that's what we'll depend upon.

See the security documentation here: https://github.com/paul-m/VirtualPersistAPI/blob/master/spec/VPA_Security.md

### Web-based

We have to guard against all of the standard web-based exploits, especially SQL injection.

**SQL injection**: VPA is implemented using Symfony2 and Doctrine. Doctrine is an entity- and database-abstraction layer, which uses PDO. We'll be using Doctrine's entity abstraction layer which parameterizes input to PDO.

Where we're not using the entity abstraction layer, we'll be using the DBAL's parameterized input system, and Doctrine's own query language (DQL). This has the advantage of making our code more portable, as well.

Doctrine security documentation: http://docs.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/security.html


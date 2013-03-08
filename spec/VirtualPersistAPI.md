VirtualPersistAPI Design Document
==

The Basics
----

This API allows the user to POST, GET, and DELETE arbitrary content over http, based on their credentials.

The data stored is a simple key->value relationship.

The key and value will be sent through a POST request. This really should be a PUT for RESTful semantic accuracy but PUT is a pain to configure in many circumstances. Part of the rationale for this API is so that non-experts can use it with relative ease, so we'll use POST.

Some authentication will be through http headers. In the case of a Second Life application, for instance, the X-SecondLife-Shard header will be checked. http://wiki.secondlife.com/wiki/LlHTTPRequest

Initially, there will be few user permission levels. The assumption will be that this system is instantiated per project or some-such.

The API
-------

The URI paths for the API are defined as:

`[endpoint]/[useruuid]/[category]/[key]`

So, if you POST data to this URI, you will store that data. If you GET data from that URI you'll get the data you last PUT there. If you DELETE this URI then it will vanish.

Data POSTed will be a urlencoded form submission, in the form:

`data=[payload]`

GET will return the URI contents as text/plain. Initially.

The endpoint will be configurable per instance of the application. We'll arbitrarily say that 'vpa' is a good choice of endpoint name.

All content type restrictions will be dictated by the Second Life http request system. http://wiki.secondlife.com/wiki/LlHTTPRequest

Authentication
--------------

Second Life has very limited scripting capabilities and those capabilities shift frequently. This means it's unlikely we'll come up with something like an OAuth or even session-based security solution for SL support.

Instead we'll use a password on a per-user, per-request basis. This will be adequate for a first milestone.

The user is signified by the UUID portion of the URI.

POST requests will include a `pw=[password]` form element.

GET and DELETE requests will have to add `?pw=[password]` to the request URL.


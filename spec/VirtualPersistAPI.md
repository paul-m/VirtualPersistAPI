VirtualPersistAPI Design Document
==

The Basics
----

This API allows the user to POST, GET, and DELETE arbitrary content over http, based on their credentials.

The data stored is a simple category->key->value relationship.

The value will be sent through a POST request. This really should be a PUT for RESTful semantic accuracy but PUT is a pain to configure in many circumstances. Part of the rationale for this API is so that non-experts can use it with relative ease, so we'll use POST.

There will be minimal user authentication, to start with. We'll iterate forward as more use-cases appear.

The API
-------

#### The Chart:

| Type | Path | Action |
| --- | --- | --- |
| GET | `[endpoint]/[uuid]/[category]/[key]` | Query for data. |
| POST | `[endpoint]/[uuid]/[category]/[key]` | Add data, replacing old. |
| DELETE | `[endpoint]/[uuid]/[category]/[key]` | Remove data and key. |
| GET | `[endpoint]/[uuid]/[category]` | Query for all data for category. |
| GET | `[endpoint]/categories/[uuid]` | Query for categories |
| GET | `[endpoint]/keys/[uuid]/[category]` | Query for keys for this category |
| GET | `[endpoint]/user/[uuid]` | Query for user data. |
| POST | `[endpoint]/user/[uuid]` | Add user. |
| DELETE | `[endpoint]/user/[uuid]` | Remove user. |

#### The Description:

The URI paths for the API are defined as:

`[endpoint]/[useruuid]/[category]/[key]`

So, if you POST data to this URI, you will store that data. If you GET data from that URI you'll get the data you last POSTed there. If you DELETE this URI then it will vanish.

Data POSTed will be a urlencoded form submission, in the form:

`data=[payload]`

GET will return the URI contents as text/plain by default, but can also return JSON or LSLON in the form `data=[data]`.

The authorized consumer can query for categories and keys:

`[endpoint]/categories/[useruuid]`

`[endpoint]/keys/[useruuid]/[category]`

These can return JSON or LSLON specified by `?type=[whichever]`. (Currently only JSON is supported.)

Finally, the consumer can query for all keys and data belonging to a category:

`GET [endpoint]/[useruuid]/[category]`

This can return structured JSON or LSLON as specified by `?type=[whichever]`.

Note that the whole-category query could return a larger amount of data than can pass through the Second Life http system. In this case, category and key discovery is a better solution.

Examples
--------

Example:

	GET /api/C862D196-3972-4BA1-86FB-EEAD943A9C5E/aCategory/aKey
	
This will get whatever data exists at key `aKey` in category `aCategory` for the user with UUID `C862D196-3972-4BA1-86FB-EEAD943A9C5E`. Substitute `POST` or `DELETE` to manage the data itself.

Example:

	GET /api/keys/C862D196-3972-4BA1-86FB-EEAD943A9C5E/aCategory?type=json

This will get the list of keys for `aCategory` belonging to user `C862D196-3972-4BA1-86FB-EEAD943A9C5E` as a JSON object.

Authorized consumers can also query, add, and remove users:

GET, POST, and DELETE: 

`[endpoint]/user/[useruuid]`

GETting the user will return information about the user. At this time, only the UUID is returned. In the future, other information such as name or UUID/URL of profile pic might also be included.

POSTing a user will add it. Available attributes:

- `pw` sets the password.
- `perm` sets the permission.

Including neither of these creates a record which has no permission to add records or do anything destructive.

All content type restrictions will be dictated by the Second Life http request system. http://wiki.secondlife.com/wiki/LlHTTPRequest

Authentication
--------------

There will be an option to perform some authentication through http headers. In the case of a Second Life application, for instance, the X-SecondLife-Shard header could be checked to see if it matches the user UUID in the URI. http://wiki.secondlife.com/wiki/LlHTTPRequest

Second Life has very limited scripting capabilities and those capabilities shift frequently. This means it's unlikely we'll come up with something like an OAuth or even session-based security solution for SL support.

Instead we'll use a password on a per-user, per-request basis. This will be adequate for a first milestone.

The user is signified by the UUID portion of the URI.

POST requests will include a `pw=[password]` form element.

GET and DELETE requests will have to add `?pw=[password]` to the request URL.


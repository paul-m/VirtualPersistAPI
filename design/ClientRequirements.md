Client Requirements
===================

Definitions:

- Client: A network resource which is being used to consume or manage VirtualPersistAPI.

There are two main consumers: Clients making http requests to the API, and clients using a web browser to administer or manage the site.

API Request Client
------------------

API requests can come from any source over http. The main use case is from within the virtual world of Second Life. Another important use case is a client for testing the app.

Requirements:

- Able to perform HTTP requests.
- Optional: Capable of authenticating.

Web Browser Client
------------------

Currently, VPA has meager needs in terms of web browser useage. This might change if we allow AJAX requests and/or a sophisticated user interface.

- Able to perform HTTP requests.
- Able to store cookies for session info.
- Allows the user to fill out forms.

VirtualPersistAPI Project Overview
==================================

What Is It?
-----------

VirtualPersistAPI (VPA) is a RESTful API for storing arbitrary data.

Users can POST, GET, and DELETE data, keyed on two other pieces of data: A category and a key.

In addition, users can query for the categories which belong to them, and keys which belong to their categories.

Within the API, users are always known by a UUID.

A detailed specification document is here: https://github.com/paul-m/VirtualPersistAPI/blob/master/spec/VirtualPersistAPI.md

What Needs To Be Done?
----------------------

Since this is a continuation of last semester's project, some work is already done. Most of the data model is complete. The user model exists but only minimally. There is no authentication and only one HTML page, which gives an overall report on existing users and keys.

Forward progress will be broken up into milestones:

### Milestone 1

Milestone 1 will deal with the user model and authentication. This implementation will be very simple, to help me learn Symfony's user model.

- Basic authentication: Send a password as `?pw=[password]` in API request.
- User login and report through HTML form.
- Unit and functional tests.

### Milestone 2

Milestone 2 involves improving the authentication system.

- Research authentication systems.
- Design authentication system based on the limits imposed by the use case. Probably this: https://github.com/paul-m/VirtualPersistAPI/blob/master/spec/VPA_Security.md
- Unit and functional tests.

### Milestone 3

Milestone 3 will be the permissions system.

- Basic designs for permissions system. This might be adding an admin field to the user entity, or a separate table connecting user entities to permission entities.
- Unit and functional tests.

### Milestone 4

A back-end is needed for management of users and various reports and log analysis efforts.

- Reports and analysis.
- Unit and functional tests.

### Incidental Milestone

It might be the case that one of the following gets done while working on the other milestones:

- Deployment script(s): Pagodabox.com, AWS, etc.
- Performance testing and tweaking, specifically for the database.
- Add more here.


VirtualPersistAPI Design Document: SECURITY
===========================================

Initial security designs will be minimal, in order to facilitate getting the thing finished.

Passwords
---------

Users passwords are salted and hashed with SHA1 and then stored.

API consumers must also salt and hash the password before making a request.

The hash transmitted with the request is compared to the user password to determine access.

The salt value is set per VPA instance, and the consumer must know it.

LSL
---

LSL provides the llSHA1String() function: http://wiki.secondlife.com/wiki/LlSHA1String


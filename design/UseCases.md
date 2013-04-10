VirtualPersistAPI Use Cases
===========================

VirtualPersistAPI (VPA) is conceived as persistent data storage for use with virtual worlds like Second Life.

Main use case
-------------

The main use case will be a script in Second Life that needs to persist some data.

This script will need to be able to:

- Persist and update data (using a POST request)

- Query which data is available (using a GET request specifying category and key lookup)

- Query data (using a GET request)

- Delete data (using a DELETE request)

The amount of data to be stored per record is limited mainly by LSL's request limitations. Currently, the maximum request body size is 2048 bytes by default, but can be set to 4096 or 16384 bytes under some circumstances.

Other use cases
---------------

This system could be used by any consumer to persist arbitrary data. It could serve as a data store for non-LSL based systems.



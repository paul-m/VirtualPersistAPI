What The?
=======

This is homework 6. I'm Paul Mitchum, and my email address is paul@mile23.com or paulm77@uw.edu.

This material is also on my github:

How to:
-------

1. Fill the database with tables and test data. Load in `schema_data.sql`
2. Add the stored procedure: `cursor_procedure.sql`
3. Run the procedure: `run_cursor.sql`. Alternately, `call log_archive();`

What is it?
-----------

Pressed for time, I took a cue from the text and made a procedure that selects items from a Log table which are older than a certain time window.

These log records are then 'archived' to the LogArchive table, deleted from the Log table, and tallied.

The procedure iterates over a cursor to gather records to process.


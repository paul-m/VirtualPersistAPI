What The?
=======

This is homework 6. I'm Paul Mitchum, and my email address is paul@mile23.com or paulm77@uw.edu.

This material is also on my github: https://github.com/paul-m/VirtualPersistAPI/tree/master/symfony/src/VirtualPersistAPI/VirtualPersistBundle/Misc/homework6

Easily browse the procedure I made here: https://github.com/paul-m/VirtualPersistAPI/blob/master/symfony/src/VirtualPersistAPI/VirtualPersistBundle/Misc/homework6/cursor_procedure.sql

How to:
-------

1. Fill the database with tables and test data. Load in `schema_data.sql`
2. Add the stored procedure: `cursor_procedure.sql`
3. Run the procedure: `run_cursor.sql`. Alternately, `call log_archive();`
4. Note that the procedure reports 26 items archived.

What is it?
-----------

Pressed for time, I took a cue from the text and made a procedure that selects items from a Log table which are older than a certain time window.

Log records older than 10 months will be moved to the LogArchive table.

The procedure iterates through a cursor to gather records to process.

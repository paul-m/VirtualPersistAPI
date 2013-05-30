Homework 8
=====

Paul Mitchum paul@mile23.com paulm77@uw.edu

Here's a trigger which basically does cascading deletes, when you delete a User row.

`homework8_data.sql` will load up the db with sample data. It also includes the trigger.

Put that in the database and then saying `delete from User where id in ('4');` will cause most of the Record rows to be deleted as well.

The trigger code and a sample delete query is in `homework8_trigger.sql`

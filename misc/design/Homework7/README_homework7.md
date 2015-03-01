Homework 7
==========

Paul Mitchum, paul@mile23.com, paulm77@uw.edu

Homework 7 files exist on github here: https://github.com/paul-m/VirtualPersistAPI/tree/master/design/Homework7

This file specifically is located here: https://github.com/paul-m/VirtualPersistAPI/blob/master/design/Homework7/README_homework7.md

PDF version: https://github.com/paul-m/VirtualPersistAPI/blob/master/design/Homework7/README_homework7.pdf

What is it?
-----------

My project is a RESTful API for a data store. Thus it needs to connect user records to data records. It needs to refer to users by a UUID string property rather than record ID column, so it will need to do joins, to connect users to their data.

The view I've come up with aids in this regard by delivering a joined table with blocked users removed. Then application logic can just query on this view table for UUIDs and data categories and keys.

I won't actually use this view in the finished application, since I'm going to have to query for the user record anyway, for authentication. But this is how I'll graft the view concept onto my project for class.

The view
--------

This is the view creation code:

	create or replace view RecordForActiveUser as
		select u.uuid, u.id as 'uid', u.is_active, r.category, r.aKey, r.data
		from `User` as u
		left join `Record` as r
		on u.id = r.owner
		where u.is_active != 0;

For my data, this query will return one result:

	select * from RecordForActiveUser
	where uuid = '00000000-0000-0000-0000-000000000000'
		and category = 'extantCategory'
		and aKey = 'extantKey';	

And this query will return zero results since the user is blocked, even though the user and data exists:

	select * from RecordForActiveUser
	where uuid = 'FFFFFFFF-FFFF-FFFF-FFFF-FFFFFFFFFFFF'
		and category = 'extantCategory'
		and aKey = 'extantKey';	

Sample data and these queries are in other files.

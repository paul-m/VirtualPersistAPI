## Create the view
##
create or replace view RecordForActiveUser as
	select u.uuid, u.id as 'uid', u.is_active, r.category, r.aKey, r.data
	from `User` as u
	left join `Record` as r
	on u.id = r.owner
	where u.is_active != 0;

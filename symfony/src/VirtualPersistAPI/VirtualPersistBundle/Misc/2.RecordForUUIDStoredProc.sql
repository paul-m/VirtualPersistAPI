## The SQL we want as a stored procedure:
#
# select * from Record as r
# left join User as u
# on r.`owner_id` = u.`id`
# where u.`uuid` = 'A4CB1C9C-24BB-43D7-B6D9-8E57B8FAA5D5'
# and r.category = 'cat'
# and r.aKey = 'key'
# limit 1

## Now as a stored procedure:

delimiter //
create procedure RecordForUUID (
	in in_uuid varchar(36),
	in in_category varchar(255),
	in in_key varchar(255)
	)
sql security definer
comment 'get a Record given a UUID, category, and key'
begin
	select r.`data` from Record as r
	left join `User` as u
	on r.`owner_id` = u.`id`
	where u.`uuid` = in_uuid
	and r.`category` = in_category
	and r.`aKey` = in_key
	limit 1;
end
//
delimiter ;

delimiter //
create procedure log_archive()
begin
	declare finished integer default 0;
	declare f_id integer;
	declare f_user integer;
	declare f_type varchar(128);
	declare f_message varchar(255);
	declare f_timestamp datetime;
	declare moved_count integer default 0;

	declare log_cursor cursor for
		select l.id, l.user, l.type, l.message, l.timestamp
		from Log as l
		where l.timestamp < date_sub(now(), interval 10 month);

	declare continue handler for not found set finished = 1;

	open log_cursor;

	move_log: loop
		fetch log_cursor into f_id, f_user, f_type, f_message, f_timestamp;
		if finished then
			leave move_log;
		end if;
		insert into LogArchive set
			user = f_user,
			type = f_type,
			message = f_message,
			timestamp = f_timestamp;
		delete from Log where id = f_id;
		set moved_count = moved_count + 1;
	end loop move_log;
	close log_cursor;
	select moved_count as 'log records archived';

end
//
delimiter ;

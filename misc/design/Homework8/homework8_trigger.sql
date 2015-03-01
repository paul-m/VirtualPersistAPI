delimiter //
create trigger DeleteRecordsForDeletedUser
	before delete on `User`
for each ROW
begin
	delete from `Record`
	where `owner`= OLD.`id`;
end
//
delimiter ;

delete from User where id in ('4');

# drop trigger DeleteRecordsForDeletedUser;

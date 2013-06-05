drop trigger if exists DeleteRecordsForDeletedUser;
create trigger DeleteRecordsForDeletedUser
	before delete on `User`
for each ROW
begin
	delete from `Record`
	where `owner`= OLD.`id`;
end

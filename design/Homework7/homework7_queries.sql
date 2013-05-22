## For the test data, this should yield one result
##
select * from RecordForActiveUser
where uuid = '00000000-0000-0000-0000-000000000000'
	and category = 'extantCategory'
	and aKey = 'extantKey';	

## And since the F-man is blocked, this yields 0 results.
##
select * from RecordForActiveUser
where uuid = 'FFFFFFFF-FFFF-FFFF-FFFF-FFFFFFFFFFFF'
	and category = 'extantCategory'
	and aKey = 'extantKey';	

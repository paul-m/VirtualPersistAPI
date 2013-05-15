#
# Homework 5, Paul Mitchum, paul@mile23.com
#
# A stored function to make a decision about whether
# to cull expired records.
#
# This was going to include a stored procedure to do
# the actual culling, but I ran out of time.
#
# On the down-side, this is a pretty trivial function
# so it doesn't demonstrate much whiz-bang knowledge.
#
# On the up-side, it should be easy to grade. :-)
#

DROP FUNCTION IF EXISTS shouldCull;
GO

DELIMITER //
CREATE FUNCTION shouldCull (
  in_total INT(10),
  in_expired INT(10)
)
RETURNS INT
NO SQL
BEGIN
  DECLARE percentage DECIMAL(10,2);
  SET percentage = 100.0 / (in_total / in_expired);
  IF percentage >= 25.0 THEN
  	RETURN 1;
  END IF;
  RETURN 0;
END
//
DELIMITER ;

###############
#
# select shouldCull(10, 3);
# result: 1
# select shouldCull(10, 2);
# result: 0

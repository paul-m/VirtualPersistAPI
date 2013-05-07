## this does not work.

DROP PROCEDURE IF EXISTS cull;
GO

DELIMITER //
CREATE PROCEDURE cull (
  IN in_date DATE
)
BEGIN
  DECLARE total_count INT;
  DECLARE old_count INT;
  SELECT count(*) INTO total_count FROM `Record`;
  SELECT count(*) INTO old_count FROM `Record` WHERE
    DATE(`timestamp`) < in_date;
  IF shouldCull(total_count, old_count) > 0 THEN
    DELETE FROM `Record` WHERE `timestamp` < in_date;
  END IF;
END
//
DELIMITER ;

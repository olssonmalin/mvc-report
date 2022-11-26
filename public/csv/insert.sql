use mvc; 

DELETE FROM population_station;
DELETE FROM completed_residences;
DELETE FROM residence_station;
DELETE FROM region;
DELETE FROM year;

ALTER TABLE population_station AUTO_INCREMENT = 1;
ALTER TABLE residence_station AUTO_INCREMENT = 1;

-- population_station          |
-- | region                      |
-- | residence_station           |
-- | year  
    -- completed_residences

-- LOAD DATA LOCAL INFILE 'excel.csv'
--     INTO TABLE table1
--     CHARSET utf8
-- LINES
--     TERMINATED BY '\n'
--     IGNORE 1 LINES
-- ;

-- LOAD DATA LOCAL INFILE 'rooms.csv'
--     INTO TABLE room
--     CHARSET utf8
-- FIELDS
--     TERMINATED BY ';'
--     ENCLOSED BY ''
-- LINES
--     TERMINATED BY '\n'
--     IGNORE 1 LINES
-- ;

-- LOAD DATA LOCAL INFILE 'doors.csv'
--     INTO TABLE door
--     CHARSET utf8
-- FIELDS
--     TERMINATED BY ';'
--     ENCLOSED BY ''
-- LINES
--     TERMINATED BY '\n'
--     IGNORE 1 LINES
--     (room_id, position, is_open, to_room, @vopens_by)
--     SET
--     opens_by = NULLIF(@vopens_by, '')
-- ;
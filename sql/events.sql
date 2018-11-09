-- create the tables for our events

CREATE TABLE `events` (
 `id` int unsigned NOT NULL AUTO_INCREMENT,
 `home_id` int unsigned NOT NULL,
 `away_id` int unsigned NOT NULL,
 `date` datetime NOT NULL,
 `location` varchar(100) NOT NULL, 
 PRIMARY KEY (`id`)
);

INSERT INTO `events` VALUES
	(1, 1, 2, '2018-01-01 12:00:00', "Troy, NY"),
	(2, 2, 4, '2018-02-01 12:00:00', "Potsdam, NY"),
	(3, 4, 1, '2018-05-01 12:30:00', "Henrietta, NY"),
	(4, 1, 5, '2018-05-05 16:00:00', "Troy, NY"),
	(5, 3, 2, '2018-06-08 18:00:00', "Schenectady, NY");
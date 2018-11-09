-- create the tables for our teams

CREATE TABLE `teams` (
 `id` int unsigned NOT NULL AUTO_INCREMENT,
 `name` varchar(100) NOT NULL,
 `wins` int unsigned NOT NULL,
 `losses` int unsigned NOT NULL,
 PRIMARY KEY (`id`)
);

INSERT INTO `teams` VALUES
	(1, "Rensselaer Engineers", 7, 3),
	(2, "Clarkson Golden Knights", 0, 10),
	(3, "Union Dutchmen", 4, 6),
	(4, "RIT Tigers", 5, 5),
	(5, "Rochester Yellowjackets", 6, 4);

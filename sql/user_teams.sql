-- create the tables for our user team relationships

CREATE TABLE `user_teams` (
 `id` int unsigned NOT NULL AUTO_INCREMENT,
 `u_id` int unsigned NOT NULL,
 `t_id` int unsigned NOT NULL,
 PRIMARY KEY (`id`)
);

INSERT INTO `user_teams` VALUES
	(1, 1, 1),
	(2, 2, 1),
	(3, 3, 2),
	(4, 3, 3),
	(5, 4, 5),
	(6, 5, 1),
	(7, 5, 2),
	(8, 5, 3),
	(9, 5, 4),
	(10, 5, 5),
	(11, 6, 1);
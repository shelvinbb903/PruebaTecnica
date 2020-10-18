
CREATE DATABASE `pruebaquick` ;

USE `pruebaquick`;

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` int(11) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

insert  into `user`(`id`,`first_name`,`last_name`,`email`,`password`,`token`,`age`,`image`,`description`) values
(1,'Admin','Admin','admin@example.com','7110eda4d09e062aa5e4a390b0a572ac0d2c0220','5f8c81911bd14',42,'admin.png',NULL),
(3,'Steven','Smith','user@example.com','3c3b274d119ff5a5ec6c1e215c1cb794d9973ac1','5f8c85247ad6a',26,'IMAGE','Description text');

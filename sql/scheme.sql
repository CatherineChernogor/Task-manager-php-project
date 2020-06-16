CREATE TABLE IF NOT EXISTS `Orders` (
	`id` INT(255) NOT NULL AUTO_INCREMENT,
	`subject` varchar(255) NOT NULL,
	`type` INT(255) NOT NULL,
	`place` varchar(255) NULL DEFAULT NULL,
	`date_start` DATETIME NOT NULL,
	`date_end` DATETIME NOT NULL,
	`comment` TEXT(255) NULL DEFAULT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `Type` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`name` varchar(255) NOT NULL,
	PRIMARY KEY (`id`)
);

ALTER TABLE `Orders` ADD CONSTRAINT `Event_fk0` FOREIGN KEY (`type`) REFERENCES `Type`(`id`);

INSERT INTO `Type` (`name`) VALUES
('Дело'), 
('Встреча'), 
('Звонок'), 
('Совещание');
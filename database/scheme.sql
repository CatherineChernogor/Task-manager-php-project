CREATE TABLE `orders` (
    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `subject` VARCHAR(255) NOT NULL,
    `type` VARCHAR(255) NOT NULL,
    `place` VARCHAR(255),
    `date_start` TIMESTAMP NULL DEFAULT NULL,
    `date_end` TIMESTAMP NULL DEFAULT NULL,
    `comment` VARCHAR(255),
    PRIMARY KEY (`id`)
)
COLLATE='utf8_general_ci' ENGINE=InnoDB;
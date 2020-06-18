CREATE TABLE `orders` (
    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `subject` VARCHAR(255) NOT NULL,
    `type` VARCHAR(255) NOT NULL,
    `place` VARCHAR(255),
    `date_start` DATETIME NOT NULL,
    `date_end` DATETIME NOT NULL,
    `comment` VARCHAR(255),
    PRIMARY KEY (`id`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
;

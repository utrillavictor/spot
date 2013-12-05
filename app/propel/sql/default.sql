
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- spotlight_user
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `spotlight_user`;

CREATE TABLE `spotlight_user`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(65),
    `password` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255),
    `zip` INTEGER,
    `first_name` VARCHAR(65),
    `last_name` VARCHAR(65),
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- spotlight_role
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `spotlight_role`;

CREATE TABLE `spotlight_role`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(65),
    `description` VARCHAR(255),
    `user_id` INTEGER,
    PRIMARY KEY (`id`),
    INDEX `spotlight_role_FI_1` (`user_id`)
) ENGINE=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;

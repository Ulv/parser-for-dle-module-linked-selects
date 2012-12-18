
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- spec
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `spec`;

CREATE TABLE `spec`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- region
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `region`;

CREATE TABLE `region`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(128) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- vuz
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `vuz`;

CREATE TABLE `vuz`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(128) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- spectovuz
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `spectovuz`;

CREATE TABLE `spectovuz`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `spec_id` INTEGER NOT NULL,
    `region_id` INTEGER NOT NULL,
    `vuz_id` INTEGER NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `spectovuz_FI_1` (`spec_id`),
    INDEX `spectovuz_FI_2` (`region_id`),
    INDEX `spectovuz_FI_3` (`vuz_id`),
    CONSTRAINT `spectovuz_FK_1`
        FOREIGN KEY (`spec_id`)
        REFERENCES `spec` (`id`),
    CONSTRAINT `spectovuz_FK_2`
        FOREIGN KEY (`region_id`)
        REFERENCES `region` (`id`),
    CONSTRAINT `spectovuz_FK_3`
        FOREIGN KEY (`vuz_id`)
        REFERENCES `vuz` (`id`)
) ENGINE=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;

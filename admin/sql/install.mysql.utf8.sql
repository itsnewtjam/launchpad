CREATE TABLE IF NOT EXISTS `#__launchpad_pages` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(40) NOT NULL,
  `background_type` VARCHAR(40) NOT NULL,
  `background_css` VARCHAR(255),
  `background_image` VARCHAR(255),
  `header_image` TEXT,
  `heading_use_title` BOOLEAN NOT NULL,
  `heading` VARCHAR(255),
  `description` TEXT,
  `links` TEXT,
  `css` TEXT,
  `published` TINYINT(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

DROP TABLE IF  EXISTS `#__mod_interior_cats` ;
DROP TABLE IF  EXISTS `#__mod_interior_photos`;
DROP TABLE IF  EXISTS `#__mod_interior_colors`;

CREATE TABLE IF NOT EXISTS `#__mod_interior_cats` (
  `cat_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `object_id` int(11) NOT NULL DEFAULT '0',
  `cat_name` varchar(255),
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;


CREATE TABLE IF NOT EXISTS `#__mod_interior_photos` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL DEFAULT '0',
  `src_resource` varchar(255),
  `photo_name` varchar(255),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `#__mod_interior_colors` (
  `color_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `object_id` int(11) NOT NULL DEFAULT '0',
  `color_code` varchar(255),
  PRIMARY KEY (`color_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

INSERT INTO `#__mod_interior_cats` ( `cat_id` , `object_id` , `cat_name` ) 
VALUES ( 3, 3, "Пол" );

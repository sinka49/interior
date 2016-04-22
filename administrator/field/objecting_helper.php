<?php defined('_JEXEC');
    define( 'JPATH_BASE', realpath(dirname(__FILE__).'/../../' ));  

	class modInteriorAdminHelper
	{

		public static function getArrayValuesForObject($object){

            $db     = JFactory::getDBO();
            $query  = "SELECT `src_resource`, `photo_name`, `#__mod_interior_cats`.`cat_id`,`#__mod_interior_photos`.`id`, `cat_name` FROM `#__mod_interior_photos` INNER JOIN  `#__mod_interior_cats`  ON `#__mod_interior_photos`.`cat_id` = `#__mod_interior_cats`.`cat_id`  WHERE `object_id` = ".$object;
            $db->setQuery($query);
            $result = $db->loadAssocList();
            if (!empty($result)) {
                return $result;
            }
            else return false;

    	}

        public static function getArrayColors($object){

            $db     = JFactory::getDBO();
            $query  = "SELECT `color_id`,`color_code`FROM `#__mod_interior_colors` WHERE `object_id` = $object";
            $db->setQuery($query);
            $result = $db->loadAssocList();
            if (!empty($result)) {
                return $result;
            }
            else return false;

        }


   		public static function getlistCat($object){

            $db     = JFactory::getDBO();
            $query  = "SELECT `cat_id`, `cat_name`,`object_id` FROM  `#__mod_interior_cats`  WHERE `object_id` = ".$object;
            $db->setQuery($query);
            $result = $db->loadAssocList();
            if (!empty($result)) {
                return $result;
            }
            else return false;

    	}

        public static function getlistFullCat($object){

            $arrayCat = self::getlistCat($object);
            $arrayObject = self::getArrayValuesForObject($object);
            $arrayNewCat = array();
            if ($arrayObject&&$arrayCat) {
               foreach ($arrayCat as $key1 => $value1) {
                    foreach ($arrayObject as $key2 => $value2) {
                        if ($value1["cat_id"] == $value2["cat_id"] ) {
                            $arrayNewCat[$key1] = $arrayCat[$key1]; 
                        }
                    }
                }
                return $arrayNewCat;
            }
            else return false;
            

        }
    	public static function search($value){

            $db     = JFactory::getDBO();
            $query  = "SELECT `src_resource`, `photo_name`, `#__mod_interior_cats`.`cat_id`,`#__mod_interior_photos`.`id`, `cat_name` FROM `#__mod_interior_photos` INNER JOIN  `#__mod_interior_cats`  ON `#__mod_interior_photos`.`cat_id` = `#__mod_interior_cats`.`cat_id`  WHERE `photo_name` LIKE  '%".$value."%'";
            $db->setQuery($query);
            $result = $db->loadAssocList();
            if (!empty($result)) {
                return $result;
            }
            else return false;

    	}

	}
?>
<?php 
jimport( 'joomla.application.application' );
    defined('_JEXEC');
require_once(dirname(__FILE__).'/administrator/field/objecting_helper.php');
$input = JFactory::getApplication()->input;

$db = JFactory::getDbo();
	$query = $db->getQuery(true);
/*Post requests for admin*/

if (isset($_POST['name'])) {

	$data = array();
    $error = false;
    $files = array();
 	$uri =  JURI::root();
    $uploaddir = 'uploads/'; // . - текущая папка где находится submit.php
    // . - текущая папка где находится submit.php
 
    // Создадим папку если её нет
 
    if( ! is_dir( $uploaddir ) ) mkdir( $uploaddir, 0777 );
 	$rand = rand(1,25454);
    // переместим файлы из временной директории в указанную
    foreach( $_FILES as $file ){
        if( move_uploaded_file( $file['tmp_name'], $uploaddir . $rand . basename($file['name']) ) ){
            $files[] = $uploaddir . $rand . $file['name'] ;
        }
        else{
            $error = true;
        }
    }
 
   
	$name = $_POST['name'];
	$cat  = $_POST['cat'];
	$foto = $files[0];

	$columns= array('cat_id', 'src_resource', 'photo_name');
	$values = array($cat, $db->quote($foto), $db->quote($name));
	$query
	    ->insert($db->quoteName('#__mod_interior_photos'))
	    ->columns($db->quoteName($columns))
	    ->values(implode(',', $values));
	 
	$db->setQuery($query);
	$db->execute();
}



if (isset($_POST['cat_name'])) {
    
	$name = $_POST['cat_name'];
	$object  = $_POST['object_id'];
	$columns= array('cat_name', 'object_id');
	$values = array($db->quote($name), $object);

	$query
	    ->insert($db->quoteName('#__mod_interior_cats'))
	    ->columns($db->quoteName($columns))
	    ->values(implode(',', $values));
	$db->setQuery($query);
	$db->execute();
}


if (isset($_POST['arrayCat'])) {
	$strCat = $_POST['arrayCat'];
	$query = "DELETE FROM `#__mod_interior_cats` WHERE `cat_id` IN ($strCat)";
	$db->setQuery($query);
	$db->execute();
}

if (isset($_POST['arrayFile'])) {
	$arrayFile = $_POST['arrayFile'];
	$arr  = "SELECT `src_resource` FROM `#__mod_interior_photos` WHERE `id` IN ($arrayFile)";
    $db->setQuery($arr);
    $resultArr = $db->loadAssocList();
	foreach ($resultArr as $i) { 
		unlink ($i['src_resource']);
    }
	$query = "DELETE FROM `#__mod_interior_photos` WHERE `id` IN ($arrayFile)";
	$db->setQuery($query);
	$db->execute();
}


if (isset($_POST['arrayColors'])) {
	$arrayColors = $_POST['arrayColors'];
	$query = "DELETE FROM `#__mod_interior_colors` WHERE `color_id` IN ($arrayColors)";
	$db->setQuery($query);
	$db->execute();
}

if (isset($_POST['color'])) {
	$color = $_POST['color'];
	$object = $_POST['object'];
	$columns= array('object_id', 'color_code');
	$values = array( $object,$db->quote($color));
	$query
	    ->insert($db->quoteName('#__mod_interior_colors'))
	    ->columns($db->quoteName($columns))
	    ->values(implode(',', $values));
	$db->setQuery($query);
	$db->execute();
	
}
/* end post requests*/

/*get params*/
 	$arrayCeiling = modInteriorAdminHelper::getArrayValuesForObject(1);
    $arrayWall    = modInteriorAdminHelper::getArrayValuesForObject(2);
    $arrayFloor   = modInteriorAdminHelper::getArrayValuesForObject(3);

    $arrayCeilingColors = modInteriorAdminHelper::getArrayColors(1);
    $arrayWallColors   = modInteriorAdminHelper::getArrayColors(2);
    $arrayFloorColors   = modInteriorAdminHelper::getArrayColors(3);

    $arrayCeilingCats = modInteriorAdminHelper::getlistFullCat(1);
    $arrayWallCats    = modInteriorAdminHelper::getlistFullCat(2);
	
 require JModuleHelper::getLayoutPath('mod_interior', $params->get('layout', 'default')); ?>
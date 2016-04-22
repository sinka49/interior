<?php

defined('_JEXEC') or die('Restricted access');
 
jimport('joomla.form.formfield');
require_once(dirname(__FILE__).'/objecting_helper.php');
 
class JFormFieldObjecting extends JFormField {
 
	protected $type = 'objecting';
   
    
	public function getInput() {
  

		JHtml::stylesheet(Juri::base() . '../modules/mod_interior/css/style_admin_interior.css');
        JHtml::stylesheet(Juri::base() . '../modules/mod_interior/administrator/field/farbtastic/farbtastic.css');   
        $arrayCeiling = modInteriorAdminHelper::getArrayValuesForObject(1);
        $arrayWall    = modInteriorAdminHelper::getArrayValuesForObject(2);
        $arrayFloor   = modInteriorAdminHelper::getArrayValuesForObject(3);

        $arrayCeilingColors = modInteriorAdminHelper::getArrayColors(1);
        $arrayWallColors   = modInteriorAdminHelper::getArrayColors(2);
        $arrayFloorColors   = modInteriorAdminHelper::getArrayColors(3);

        $arrayCeilingCats = modInteriorAdminHelper::getlistCat(1);
        $arrayWallCats    = modInteriorAdminHelper::getlistCat(2);
        


        $arrayOption1  = "";
        $arrayOption2  = "";
        $arrayCatsList = "";
        $arrayTableTd1 = "";
        $arrayTableTd2 = "";
        $arrayTableTd3 = "";
        $arrayTableColor1 = "";
        $arrayTableColor2 = "";
        $arrayTableColor3 = "";
        $searchResultHtml = "";

        if (isset($_POST['value'])) {
            $ressear =  'Результаты поиска - "'.$_POST["value"].'"';
            $arraySearchResults  = modInteriorAdminHelper::search($_POST["value"]);
            if ($arraySearchResults) {
                $searchResultHtml .='<div class = "tableCont"><table><tr><th></th><th>№</th><th>Название</th><th>Фото</th></tr>';
                $counter = 1;
                foreach ($arraySearchResults as $i) { 
                $searchResultHtml .= '<tr><td><input class = "objects" type = "checkbox" value = "'.$i["id"].'"/></td><td>'.$counter.'</td><td>'.$i["cat_name"].'</td><td>'.$i["photo_name"].'</td><td><img src="'.Juri::base() . '../modules/mod_interior/'.$i["src_resource"].'" height="70" width="70"></td></tr>';
                $counter++;
                }
                $searchResultHtml .='</table></div><br><input type="button" name="enter" value="Удалить" onclick = "removeFiles(5)"/>';
            }
            else {
            $searchResultHtml = "<h3 class='searchres'>Нет совпадений</h3>";    
            }
            
            
        }

        if ($arrayCeilingCats) {
            foreach ($arrayCeilingCats as $i) { 
                $arrayOption1 .= '<option value="'.$i["cat_id"].'">'.$i["cat_name"].'</option>';
            }
        }
        if ($arrayWallCats) {
            foreach ($arrayWallCats as $i) { 
                $arrayOption2 .= '<option value="'.$i["cat_id"].'">'.$i["cat_name"].'</option>';
            } 
        } 

        
        if ($arrayWallCats && $arrayCeilingCats) {
            $counter = 1;
            $arrayCats =  array_merge($arrayWallCats,$arrayCeilingCats);
            $arrayCatsList .='<div class="pre"><h3>Удалить Категорию</h3><div class = "tableCont"><table><tr><th></th><th>№</th><th>Название</th><th>Объект</th></tr>';
            foreach ($arrayCats as $i) { 
                if ($i["object_id"] == 1) {
                    $object = "Потолки";
                }
                else {
                    $object = "Стены";
                }
                $arrayCatsList .= '<tr><td><input class = "objects" type = "checkbox" value = "'.$i["cat_id"].'"/></td><td>'.$counter.'</td><td>'.$i["cat_name"].'</td><td>'.$object.'</td></tr>';
                $counter++;
            }
            $arrayCatsList .='</table></div><br><input type="button" name="enter" onclick = "removeCat()" value="Удалить" /></div>';
        }
        else if($arrayWallCats){
            $counter = 1;
            $arrayCatsList .='<div class="pre"><h3>Удалить Категорию</h3><div class = "tableCont"><table><tr><th></th><th>№</th><th>Название</th><th>Объект</th></tr>';
            foreach ($arrayWallCats as $i) { 
                $object = "Стены";
                $arrayCatsList .= '<tr><td><input class = "objects" type = "checkbox" value = "'.$i["cat_id"].'"/></td><td>'.$counter.'</td><td>'.$i["cat_name"].'</td><td>'.$object.'</td></tr>';
                $counter++;
            }
            $arrayCatsList .='</table></div><br><input type="button" name="enter" onclick = "removeCat()" value="Удалить" /></div>';
                
        }
        else if($arrayCeilingCats){
            $counter = 1;
            $arrayCatsList .='<div class="pre"><h3>Удалить Категорию</h3><div class = "tableCont"><table><tr><th></th><th>№</th><th>Название</th><th>Объект</th></tr>';
            foreach ($arrayCeilingCats as $i) { 
                $object = "Потолки";
                $arrayCatsList .= '<tr><td><input class = "objects" type = "checkbox" value = "'.$i["cat_id"].'"/></td><td>'.$counter.'</td><td>'.$i["cat_name"].'</td><td>'.$object.'</td></tr>';
                $counter++;
            }
            $arrayCatsList .='</table></div><br><input type="button" name="enter" onclick = "removeCat()" value="Удалить" /></div>';
        }

        if ($arrayCeiling) {
            $arrayTableTd1 .= '<div class="pre"><h3>Удалить фото</h3><div class = "tableCont"><table>
                                    <tr><th></th><th>№</th><th>Категория</th><th>Название</th><th>Фото</th></tr>'; 
            $counter = 1;
            foreach ($arrayCeiling as $i) { 
                $arrayTableTd1 .= '<tr><td><input class = "objects" type = "checkbox" value = "'.$i["id"].'"/></td><td>'.$counter.'</td><td>'.$i["cat_name"].'</td><td>'.$i["photo_name"].'</td><td><img src="'.Juri::base() . '../modules/mod_interior/'.$i["src_resource"].'" height="70" width="70"></td></tr>';
                $counter++;
            }
           $arrayTableTd1 .= '</table></div><br><input type="button" name="enter" value="Удалить" onclick = "removeFiles(1)"/></div>';

        }
        

        if ($arrayWall) {
            $arrayTableTd2 .= '<div class="pre"><h3>Удалить фото</h3><div class = "tableCont"><table>
                                    <tr><th></th><th>№</th><th>Категория</th><th>Название</th><th>Фото</th></tr>'; 
            $counter = 1;
            foreach ($arrayWall as $i) { 
                $arrayTableTd2 .= '<tr><td><input class = "objects" type = "checkbox" value = "'.$i["id"].'"/></td><td>'.$counter.'</td><td>'.$i["cat_name"].'</td><td>'.$i["photo_name"].'</td><td><img src="'.Juri::base() . '../modules/mod_interior/'.$i["src_resource"].'" height="70" width="70"></td></tr>';
                $counter++;
            }
           $arrayTableTd2 .= '</table></div><br><input type="button" name="enter" value="Удалить" onclick = "removeFiles(2)"/></div>';

        }

        
        if ($arrayFloor) {
            $arrayTableTd3 .= '<div class="pre"><h3>Удалить фото</h3><div class = "tableCont"><table>
                                    <tr><th></th><th>№</th><th>Категория</th><th>Название</th><th>Фото</th></tr>'; 
            $counter = 1;
            foreach ($arrayFloor as $i) { 
                $arrayTableTd3 .= '<tr><td><input class = "objects" type = "checkbox" value = "'.$i["id"].'"/></td><td>'.$counter.'</td><td>'.$i["cat_name"].'</td><td>'.$i["photo_name"].'</td><td><img src="'.Juri::base() . '../modules/mod_interior/'.$i["src_resource"].'" height="70" width="70"></td></tr>';
                $counter++;
            }
           $arrayTableTd3 .= '</table></div><br><input type="button" name="enter" value="Удалить" onclick = "removeFiles(3)"/></div>';

        }

        if($arrayCeilingColors){
            $counter = 1;
            $arrayTableColor1 .='<div class="pre"><h3>Цвета</h3><div class = "tableCont"><table><tr><th></th><th>№</th><th>Цвет</th><th>Код цвета</th></tr>';
            foreach ($arrayCeilingColors as $i) { 
                $arrayTableColor1 .= '<tr><td><input class = "colors" type = "checkbox" value = "'.$i["color_id"].'"/></td><td>'.$counter.'</td><td style="background-color:'.$i["color_code"].'"></td><td>'.$i["color_code"].'</td></tr>';
                $counter++;
            }
            $arrayTableColor1 .='</table></div><br><input type="button" name="enter" onclick = "removeColors(1)" value="Удалить" /></div>';
        }

        if($arrayWallColors){
            $counter = 1;
            $arrayTableColor2 .='<div class="pre"><h3>Цвета</h3><div class = "tableCont"><table><tr><th></th><th>№</th><th>Цвет</th><th>Код цвета</th></tr>';
            foreach ($arrayWallColors as $i) { 
                $arrayTableColor2 .= '<tr><td><input class = "colors" type = "checkbox" value = "'.$i["color_id"].'"/></td><td>'.$counter.'</td><td style="background-color:'.$i["color_code"].'"></td><td>'.$i["color_code"].'</td></tr>';
                $counter++;
            }
            $arrayTableColor2.='</table></div><br><input type="button" name="enter" onclick = "removeColors(2)" value="Удалить" /></div>';
        }

        if($arrayFloorColors){
            $counter = 1;
            $arrayTableColor3 .='<div class="pre"><h3>Цвета</h3><div class = "tableCont"><table><tr><th></th><th>№</th><th>Цвет</th><th>Код цвета</th></tr>';
            foreach ($arrayFloorColors as $i) { 
                $arrayTableColor3 .= '<tr><td><input class = "colors" type = "checkbox" value = "'.$i["color_id"].'"/></td><td>'.$counter.'</td><td style="background-color:'.$i["color_code"].'"></td><td>'.$i["color_code"].'</td></tr>';
                $counter++;
            }
            $arrayTableColor3.='</table></div><br><input type="button" name="enter" onclick = "removeColors(3)" value="Удалить" /></div>';
        }
        
      
        $result =  '<div class="error">Заполните пустые поля!</div><div class="tabs">
                        <input id="tab1" type="radio" name="tabs" checked>
                        <label for="tab1" title="Потолок">Потолок</label>
                 
                        <input id="tab2" type="radio" name="tabs">
                        <label for="tab2" title="Стены">Стены</label>
                 
                        <input id="tab3" type="radio" name="tabs">
                        <label for="tab3" title="Пол">Пол</label>

                        <input id="tab4" type="radio" name="tabs">
                        <label for="tab4" title="Категории">Категории</label>

                        <input id="tab5" type="radio" name="tabs">
                        <label for="tab5" title="Цвет">Цвет</label>

                        <input id="tab6" type="radio" name="tabs">
                        <label for="tab6" title="Поиск">Поиск</label>
                            
                        <section id="content1">
                            <div class="pre">
                                <h3>Добавить фото</h3>
                                <form action="#"  name="addFoto1" enctype="multipart/form-data" method="POST">
                                    Введите название : <input type="text" name = "name" id="name1" />
                                    <select id = "cat1" name = "cat" size="1">'.
                                        $arrayOption1
                                    .' </select><br><br>
                                    <input type="file" id="file1" name = "file" value="Загрузить" /><br><br>
                                    <input type="button" onclick = "sendData(\'#cat1\',1,\'#name1\');" value="Добавить" />
                                </form>
                                   
                            </div>
                           

                            ' 		.
                            		$arrayTableTd1
                                    .
                                    $arrayTableColor1
                                    .

                        '</section>  
                        <section id="content2">
                            <div class="pre">
                                <h3>Добавить фото</h3>   
                                <form action="#"  name="addFoto2" enctype="multipart/form-data" method="POST">
                                    Введите название : <input type="text" name = "name" id="name2" />
                                    <select id = "cat2" name = "cat" size="1">'
                                        .
                                        $arrayOption2
                                        .
                                    ' </select><br><br>
                                    <input type="file" id="file2" name = "file" value="Загрузить" /><br><br>
                                    <input type="button"  onclick = "sendData(\'#cat2\',2,\'#name2\');" value="Добавить" />
                                </form>
                            </div>'
                            		.
                            		$arrayTableTd2
                                    .    
                                    $arrayTableColor2
                                    .
                                '
                        </section>  
                        <section id="content3">
                            <div class="pre">
                                <h3>Добавить фото</h3>
                                <form action="#"  name="addFoto3" enctype="multipart/form-data" method="POST">
                                    Введите название : <input type="text" name = "name" id="name3" />
                                    <input type="file" id="file3" name = "file" value="Загрузить" /><br><br>
                                    <input type="button"  onclick = "sendData(3,3,\'#name3\');" value="Добавить" />
                                </form>
                            </div>'
                            		.
                            		$arrayTableTd3
                                    .
                                    $arrayTableColor3
                                    .
                        '</section> 

                        <section id="content4">
                            <div class="pre">
                                <h3>Добавить категорию</h3>
                                <form action="#" method="post" name="drop_down_box">
                                        Введите название : <input type="text" id="cat_name" />
                                        <select id="object_id" size="1">
                                            <option value="1">Потолки</option>
                                            <option value="2">Обои</option>
                                        </select><br><br>
                                    <input type="button"  onclick = "senderCat();" value="Добавить" />
                                </form>
                            </div>'    
                                .
                                    $arrayCatsList
                                .
                                ' 
                        </section> 

                        <section id="content5">
                            <div class="pre">
                                <h3>Добавить цвет</h3>
                                 <form action="" style="width: 400px;">
                                      <div class="form-item">
                                      <select id="object_id_color" size="1">
                                            <option value="1">Потолки</option>
                                            <option value="2">Обои</option>
                                            <option value="3">Пол</option>
                                        </select><br/><br/>
                                      <input type="text" id="color" name="color" value="#123456" /><input type="button" onclick = "addColor();" value="Добавить" />
                                      </div><div id="picker"></div>
                                 </form> 
                            </div>
                        </section> 

                        <section id="content6">
                            <div class="pre">
                               
                                <form action="#6" method="post" name="search">
                                        <input type="text" name = "value"/>
                                    <input type="submit" id="enter5" value="Искать" />
                                </form>
                            </div>
                            <div class="pre">
                                <h3>'.
                                    $ressear
                                .'</h3>'.
                                    $searchResultHtml
                                .'
                            </div>
                        </section> 
                        <script type="text/javascript" src="../modules/mod_interior/administrator/field/farbtastic/jquery.js"></script>
                        <script src="../modules/mod_interior/administrator/field/js/administrator.js"></script>
                        <script type="text/javascript" src="../modules/mod_interior/administrator/field/farbtastic/farbtastic.js"></script>
                    </div>';

        return $result;
	}
}
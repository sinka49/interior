var files1 = 0;
var files2 = 0;
var files3 = 0;

jQuery("#file1").change(function(){
    files1 = this.files;

});
jQuery("#file2").change(function(){
    files2 = this.files;

});
jQuery("#file3").change(function(){
    files3 = this.files;

});
function reloadPage(idTab){
    if (window.location.hash.replace("#","") == "") {
     window.location = window.location.href + idTab;
     
    }
    else{
       window.location = window.location.href.split('#')[0] + idTab;
    }
    window.location.reload()
} 
function error(){
    jQuery(".error").slideDown(400).delay(1000).slideUp(400);
}
function sendData(cat_id,ind_file,name_id){
    event.stopPropagation(); // Остановка происходящего
    event.preventDefault();
    var file;
    switch(ind_file){
            case 1 :  file = files1 ;break;
            case 2 :  file = files2 ;break;
            case 3 :  file = files3 ;break;
        }
    if (file != 0){
        if (jQuery(name_id).val().length>0 && !jQuery.isEmptyObject(file[0])){
            if (cat_id != 3) {
            var cat = jQuery(cat_id).val();
            }
            else var cat = 3
            var name = jQuery(name_id).val();
            senderFoto(name_id,name,cat,file,"#"+ind_file);
        }
        else error();
    }
    else error();
    
    return false;
   
}

function senderFoto(name_id,name,cat,files,tab){
     var data = new FormData();
     data.append("name",name);  
     data.append("cat", cat);    
     data.append( "files", files[0]);

    jQuery.ajax({
        url: "../modules/mod_interior/ajax.php",
        type: "POST",
        data: data,
        cache: false,
        processData: false, // Не обрабатываем файлы (Don"t process the files)
        contentType: false, // Так jQuery скажет серверу что это строковой запрос
        success: function( respond, textStatus, jqXHR ){
            if( typeof respond.error === "undefined" ){   
              reloadPage(tab);

            }
            else{
                console.log("ОШИБКИ ОТВЕТА сервера: " + respond.error );
            }
        },
        error: function( jqXHR, textStatus, errorThrown ){
            console.log("ОШИБКИ AJAX запроса: " + textStatus );
        }
    });

    return false;
}


function senderCat(){
     var cat_name = jQuery("#cat_name").val();
     
         var object_id = jQuery("#object_id").val();
         var data = new FormData();
         data.append("cat_name",cat_name);  
         data.append("object_id", object_id);    

        jQuery.ajax({
            url: "../modules/mod_interior/ajax.php",
            type: "POST",
            data: data,
            cache: false,
            processData: false, // Не обрабатываем файлы (Don"t process the files)
            contentType: false, // Так jQuery скажет серверу что это строковой запрос
            success: function( respond, textStatus, jqXHR ){

                if( typeof respond.error === "undefined" ){
                        reloadPage("#4");
                       
                }
                else{
                    console.log("ОШИБКИ ОТВЕТА сервера: " + respond.error );
                }
            },
            error: function( jqXHR, textStatus, errorThrown ){
                console.log("ОШИБКИ AJAX запроса: " + textStatus );
            }
        });

    
  
     
}

function removeCat(){

        var cat_id=[];
        jQuery('.objects:checked').each(function(){
             cat_id.push(jQuery(this).val());
        }); 

        var str = cat_id.join(","); 
       
         var data = new FormData();
        data.append("arrayCat",str);  

        jQuery.ajax({
            url: "../modules/mod_interior/ajax.php",
            type: "POST",
            data: data,
            cache: false,
            processData: false, // Не обрабатываем файлы (Don"t process the files)
            contentType: false, // Так jQuery скажет серверу что это строковой запрос
            success: function( respond, textStatus, jqXHR ){
                if( typeof respond.error === "undefined" ){
                   reloadPage("#4");
                }
                else{
                    console.log("ОШИБКИ ОТВЕТА сервера: " + respond.error );
                }
            },
            error: function( jqXHR, textStatus, errorThrown ){
                console.log("ОШИБКИ AJAX запроса: " + textStatus );
            }
        });

    return false;
}


function removeFiles(tab){

        var ids=[];
        jQuery('.objects:checked').each(function(){
             ids.push(jQuery(this).val());
        }); 

        var str = ids.join(","); 
       
         var data = new FormData();
        data.append("arrayFile",str);  

        jQuery.ajax({
            url: "../modules/mod_interior/ajax.php",
            type: "POST",
            data: data,
            cache: false,
            processData: false, // Не обрабатываем файлы (Don"t process the files)
            contentType: false, // Так jQuery скажет серверу что это строковой запрос
            success: function( respond, textStatus, jqXHR ){
     
                if( typeof respond.error === "undefined" ){
                   reloadPage("#"+tab);     
                }
                else{
                    console.log("ОШИБКИ ОТВЕТА сервера: " + respond.error );
                }
            },
            error: function( jqXHR, textStatus, errorThrown ){
                console.log("ОШИБКИ AJAX запроса: " + textStatus );
            }
        });

    return false;
}


function removeColors(tab){

        var ids=[];
        jQuery('.colors:checked').each(function(){
             ids.push(jQuery(this).val());
        }); 

        var str = ids.join(","); 
       
         var data = new FormData();
        data.append("arrayColors",str);  

        jQuery.ajax({
            url: "../modules/mod_interior/ajax.php",
            type: "POST",
            data: data,
            cache: false,
            processData: false, // Не обрабатываем файлы (Don"t process the files)
            contentType: false, // Так jQuery скажет серверу что это строковой запрос
            success: function( respond, textStatus, jqXHR ){
     
                if( typeof respond.error === "undefined" ){
                   reloadPage("#"+tab);     
                }
                else{
                    console.log("ОШИБКИ ОТВЕТА сервера: " + respond.error );
                }
            },
            error: function( jqXHR, textStatus, errorThrown ){
                console.log("ОШИБКИ AJAX запроса: " + textStatus );
            }
        });

    return false;
}

jQuery(document).ready(function(){

var tab = window.location.hash.replace("#","");
var loc = "";
window.onload = function(){
    if (tab != ""){
        jQuery("#tab"+tab).click();
    } 
}


});



  jQuery(document).ready(function() {
    jQuery('#demo').hide();
    jQuery('#picker').farbtastic('#color');
  });


function addColor(){
    var color = document.getElementById("color").style.backgroundColor;
    var object = document.getElementById("object_id_color").value;
    var data = new FormData();
    data.append("color",color); 
    data.append("object",object);   
    jQuery.ajax({
            url: "../modules/mod_interior/ajax.php",
            type: "POST",
            data: data,
            cache: false,
            processData: false, // Не обрабатываем файлы (Don"t process the files)
            contentType: false, // Так jQuery скажет серверу что это строковой запрос
            success: function( respond, textStatus, jqXHR ){
     
                if( typeof respond.error === "undefined" ){
                   reloadPage("#"+object);     
                }
                else{
                    console.log("ОШИБКИ ОТВЕТА сервера: " + respond.error );
                }
            },
            error: function( jqXHR, textStatus, errorThrown ){
                console.log("ОШИБКИ AJAX запроса: " + textStatus );
            }
        });

}
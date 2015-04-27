<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 25.04.2015
 * Time: 0:42
 */
?>
<div class="imperaviSimple">
    <!--start toolbar for wysiwyg-->
    <div class="btns-imperaviSimple" style="width: 100%; height: 30px; border: solid 0px black; margin-bottom: 10px;">
        <div class="wrapper-imperaviSemple" style="border: solid 0px black; display: inline-block; float: left;"></div>
        <div class="btn-edit-ImperaviSimple"
             style="border: solid 0px black; display: inline-block; float: right; text-align: center; padding-top: 3px; cursor: pointer;"
             onclick="pressEditRedactor('.<?php echo $div;?>');" <?$field = '.redactor'?>
        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/edt_30px.png" class="icons">
    </div>
    <div class="btn-cancel-ImperaviSimple"
         style="width: 5%; height: 100%; border: solid 0px black; float: right; text-align: center;  padding-top: 3px; cursor: pointer; display: none;"
         onclick="pressCancelRedactor('.<?php echo $div;?>')">
        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/cls_30px.png" class="icons">
    </div>
    <div class="btn-save-ImperaviSimple"
         style="width:5%; height: 100%; border: solid 0px black; float: right; text-align: center; padding-right: 10px; padding-top: 3px; cursor: pointer; display: none;"
         onclick="pressSaveRedactor('.<?php echo $div;?>');">
        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/sv_30px.png" class="icons">
    </div>
</div>

<script type="text/javascript">
    function pressEditRedactor(className)
    {
        var selector = className;
        $(selector).redactor({
            focus: true
        });
        $('.btn-edit-ImperaviSimple').hide();
        $('.btn-save-ImperaviSimple').show();
        $('.btn-cancel-ImperaviSimple').show();
    }

    function pressCancelRedactor(className)
    {
        var selector = className;
        $(selector).redactor('core.destroy');
        $('.btn-edit-ImperaviSimple').show();
        $('.btn-save-ImperaviSimple').hide();
        $('.btn-cancel-ImperaviSimple').hide();
    }

    function pressSaveRedactor(className, teacherId, property)
    {
        var selector = className;

        // save content
        var text = $(selector).redactor('code.get');
        //alert(text);
        var url = "save.php";
        var params = "id = 1 & property = lastName & content =" + text;
        http.open("POST", url, true);
        http.onreadystatechange = function() {//Call a function when the state changes.
            if(http.readyState == 4 && http.status == 200) {
                alert(http.responseText);
            }
        }
        http.send(params);


        // destroy editor
        $(selector).redactor('core.destroy');
        $('.btn-edit-ImperaviSimple').show();
        $('.btn-save-ImperaviSimple').hide();
        $('.btn-cancel-ImperaviSimple').hide();
    }

    function loadXMLDoc(text)
    {
//        var xmlhttp;
//
//        if (window.XMLHttpRequest)
//        {// code for IE7+, Firefox, Chrome, Opera, Safari
//            xmlhttp = new XMLHttpRequest();
//        }
//        else
//        {// code for IE6, IE5
//            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
//        }
//        xmlhttp.onreadystatechange=function()
//        {
//            if (xmlhttp.readyState==4 && xmlhttp.status==200)
//            {
//                text=xmlhttp.responseText;
//            }
//        }
//        xmlhttp.open("POST",url,true);
//        xmlhttp.send();
//

        var url = "save.php";
        var params = "id = 1 & property = first_name & content = text";
        http.open("POST", url, true);
        http.onreadystatechange = function() {//Call a function when the state changes.
            if(http.readyState == 4 && http.status == 200) {
                alert(http.responseText);
            }
        }
        http.send(params);
    }
</script>
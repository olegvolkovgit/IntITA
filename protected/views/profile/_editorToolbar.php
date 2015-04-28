<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 25.04.2015
 * Time: 0:42
 */
?>
<div class="imperaviSimple" id="<?php echo $order; ?>">
    <!--start toolbar for wysiwyg-->
    <div class="btns-imperaviSimple" style="width: 100%; height: 30px; border: solid 0px black; margin-bottom: 10px;">
        <div class="wrapper-imperaviSemple" style="border: solid 0px black; display: inline-block; float: left;"></div>
        <div class="btn-edit-ImperaviSimple"
             style="border: solid 0px black; display: inline-block; float: right; text-align: center; padding-top: 3px; cursor: pointer;"
             onclick="pressEditRedactor('.<?php echo $div;?>', 2, '<?php echo $div;?>');" <?$field = '.redactor'?>
        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/edt_30px.png" class="icons">
    </div>
    <div class="btn-cancel-ImperaviSimple"
         style="width: 5%; height: 100%; border: solid 0px black; float: right; text-align: center;  padding-top: 3px; cursor: pointer; display: none;"
         onclick="pressCancelRedactor('.<?php echo $div;?>', 2, '<?php echo $div;?>')">
        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/cls_30px.png" class="icons">
    </div>
    <div class="btn-save-ImperaviSimple"
         style="width:5%; height: 100%; border: solid 0px black; float: right; text-align: center; padding-right: 10px; padding-top: 3px; cursor: pointer; display: none;"
         onclick="pressSaveRedactor('.<?php echo $div;?>', 2, '<?php echo $div;?>');">
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

    function pressSaveRedactor(className,property) {

        var selector = className;

        // save content
        var text = $(selector).redactor('code.get');
       if (property == 'txtMsgFirst'){
           textFirst = text;
       } else {
           if (property == 'txtMsgSecond'){
               textSecond = text;
           }
       }

        // destroy editor
        $(selector).redactor('core.destroy');
        $('.btn-edit-ImperaviSimple').show();
        $('.btn-save-ImperaviSimple').hide();
        $('.btn-cancel-ImperaviSimple').hide();
    }
</script>


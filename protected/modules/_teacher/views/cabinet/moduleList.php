<ol>
    <?php foreach($modules as $module)
          {?>
    <li><a href="<?php echo Yii::app()->createUrl("module/index", array("idModule" => $module->module_ID))?>">
            <?php echo $module->title_ua; ?></a></li>
    <?php }  ?>

</ol>
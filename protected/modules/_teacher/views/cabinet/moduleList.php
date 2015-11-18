<?php
/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 18.11.2015
 * Time: 15:10
 * $modules = Module list
 */
?>
<ol>
    <?php foreach($modules as $module)
          {?>
    <li><a href="<?php echo Yii::app()->createUrl("module/index", array("idModule" => $module->module_ID))?>">
            <?php echo $module->title_ua; ?></a></li>
    <?php }  ?>

</ol>
<?php
/**
 * Created by PhpStorm.
 * User: Wizlight
 * Date: 04.07.2015
 * Time: 22:05
 */
?>
<a class="modulename" href="<?php echo Yii::app()->createUrl("module/index", array("idModule" => Module::model()->findByPk($data['id_module'])->module_ID, "idCourse" => 1)); ?>">
    <?php echo Module::model()->findByPk($data['id_module'])->module_name; ?>
</a>
<p class="price">
    <?php
    echo Yii::t('profile', '0258').' ';
    echo Module::model()->findByPk($data['id_module'])->module_price;
    echo ' '.Yii::t('profile', '0259');
    ?>
</p>
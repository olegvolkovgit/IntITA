<?php
/**
 * Created by PhpStorm.
 * User: Wizlight
 * Date: 04.07.2015
 * Time: 22:05
 */
?>
<?php if(ModuleHelper::getCourseOfModule($data['id_module'])) { ?>
<a class="modulename" href="<?php
    echo Yii::app()->createUrl("module/index", array("idModule" => $data['id_module'], "idCourse" => ModuleHelper::getCourseOfModule($data['id_module']))); ?>">
    <?php
    $titleParam = ModuleHelper::getModuleTitleParam();
    echo Module::model()->findByPk($data['id_module'])->$titleParam; ?>
</a>
<?php } else {
    $titleParam = ModuleHelper::getModuleTitleParam();
    echo Module::model()->findByPk($data['id_module'])->$titleParam.' (Модуль недоступний)';
}?>

<p class="price">
    <?php
    echo Yii::t('profile', '0258').' ';
    echo Module::model()->findByPk($data['id_module'])->module_price;
    echo ' '.Yii::t('profile', '0259');
    ?>
</p>
<?php //var_dump('1');die; ?>
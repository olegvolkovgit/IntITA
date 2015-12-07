<?php
/**
 * Created by PhpStorm.
 * User: Wizlight
 * Date: 04.07.2015
 * Time: 22:05
 */
?>
<?php if(Module::getCourseOfModule($data['id_module'])) { ?>
<a class="modulename" href="<?php
    echo Yii::app()->createUrl("module/index", array("idModule" => $data['id_module'], "idCourse" => Module::getCourseOfModule($data['id_module']))); ?>">
    <?php
    $titleParam = Module::getModuleTitleParam();
    echo Module::model()->findByPk($data['id_module'])->$titleParam; ?>
</a>
<?php } else {
    $titleParam = Module::getModuleTitleParam();
    echo Module::model()->findByPk($data['id_module'])->$titleParam.' (Модуль недоступний)';
}?>

<p class="price">
    <?php
    echo Yii::t('profile', '0258').' ';
    echo Module::model()->findByPk($data['id_module'])->module_price;
    echo ' '.Yii::t('profile', '0259');
    ?>
</p>

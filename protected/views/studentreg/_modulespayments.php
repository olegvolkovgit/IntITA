<?php
/**
 * @var @module Module
 */
$module = Module::model()->findByPk($data['id_module']);
?>
<?php if($module->getCourseOfModule()) { ?>
<a class="modulename" href="<?php
    echo Yii::app()->createUrl("module/index", array("idModule" => $data['id_module'],
        "idCourse" =>$module->getCourseOfModule())); ?>">
    <?php
    $titleParam = Module::getModuleTitleParam();
    echo $module->$titleParam; ?>
</a>
<?php } else {
    $titleParam = Module::getModuleTitleParam();
    echo $module->$titleParam.' (Модуль недоступний)';
}?>

<p class="price">
    <?php
    echo Yii::t('profile', '0258').' ';
    echo $module->getBasePrice();
    echo ' '.Yii::t('profile', '0259');
    ?>
</p>

<?php
/**
 * @var @data PayModules
 */
?>
<?php if ($data->module->getCourseOfModule()) { ?>
    <a class="modulename" href="<?php
    echo Yii::app()->createUrl("module/index", array("idModule" => $data->id_module,
        "idCourse" => $data->module->getCourseOfModule())); ?>">
        <?php
        $titleParam = $data->module->titleParam();
        echo CHtml::encode($data->module->$titleParam); ?>
    </a>
<?php } else {
    $titleParam = $data->module->titleParam();
    echo CHtml::encode($data->module->$titleParam) . ' (Модуль недоступний)';
} ?>

<p class="price">
    <?php
    if (($price = $data->module->getBasePrice()) > 0)
        echo Yii::t('profile', '0258') . ' ' . $price . ' $';
    ?>
</p>

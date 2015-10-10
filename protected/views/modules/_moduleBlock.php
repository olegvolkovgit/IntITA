<?php
/**
 * @var $data Module
 */
?>
<p>
    <a href="<?php echo Yii::app()->createUrl('module/index', array('idModule' => $data->module_ID));?>">
    Модуль №<?php echo $data->module_number.'. '.ModuleHelper::getModuleName($data->module_ID)?>
    </a>
</p>
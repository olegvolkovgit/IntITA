<?php
/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 16.01.2016
 * Time: 11:38
 */
?>
<select name="attributeValue" class="form-control">
    <optgroup label="<?php echo Yii::t('payments', '0607') ?>">
        <?php
            foreach ($modules as $module) { ?>
        <option value="<?php echo $module->module_ID ?>">
        <?php echo $module->module_number ."  ".$module->title_ua ."(".$module->language.")"?></option>
        <?php } ?>

</select>

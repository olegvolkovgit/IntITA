<?php
/**
 * @var $modules array
 * @var $module Module
 */
?>
<select name="module" class="form-control" id="payModuleList" required>
    <?php foreach($modules as $module){?>
        <option value="<?=$module->module_ID;?>">
            <?=$module->title_ua." (".$module->language.") ";?>
        </option>
    <?php }?>
</select>

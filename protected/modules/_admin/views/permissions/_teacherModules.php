<?php
/**
 * @var $teacher Teacher
 * @var $rows Array
 */
$rows = $teacher->getModuleList();
?>
<select class="form-control" name="module1">
    <option value=""><?= Yii::t('payments', '0606'); ?></option>
    <optgroup label="<?= Yii::t('payments', '0607'); ?>">
        <?php
        $titleParam = Module::getModuleTitleParam();
        foreach ($rows as $numRow => $row) {
            if ($row[$titleParam] == '')
                $title = 'title_ua';
            else $title = $titleParam;
            ?>
        <option value="<?=$row['module_ID']?>"><?=$row[$title]?></option>
        <?php
        };
        ?>
</select>
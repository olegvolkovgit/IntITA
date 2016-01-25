<?php
/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 16.01.2016
 * Time: 11:20
 */?>
<select  class="form-control" name="attribute" required="required"
         onchange="selectAttribute('<?php echo Yii::app()->createUrl('/_teacher/_admin/permissions/showAttributeInput') ?>');">
    <option value="">Всі атрибути ролі</option>
    <optgroup label="Виберіть атрибут">

    <?php    if (!empty($rows)) {
        foreach ($rows as  $row) { ?>
        <option value="<?php echo $row->id?>"><?php echo $row->name_ua?></option>;
      <?php
        };
        } ?>
</select>

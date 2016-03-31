<?php
/* @var $attribute array
 * @var $user integer
 * @var $role string
 */
?>
<br>
<form>
    <input type="number" hidden="hidden" value="<?= $user; ?>" id="user">
    <input type="text" hidden="hidden" value="<?= (string)$role; ?>" id="role">
    <input type="number" class="form-control col col-md-4" name="attributeValue"
           id="<?= $role."-".$attribute["key"]; ?>"  value="<?= (int)$attribute["value"]; ?>">
    <br>
    <br>
    <input type="button" class="btn btn-primary"
            onclick="addTeacherAttr('<?php echo Yii::app()->createUrl("/_teacher/_admin/teachers/setTeacherRoleAttribute"); ?>',
                '<?= $attribute["key"] ?>', '<?= "#".$role."-".$attribute["key"]; ?>'); return false;" value="Редагувати">
    <input type="submit" class="btn btn-default"
            onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/teachers/index'); ?>', 'Викладачі');
                return false;" value="Скасувати">
</form>
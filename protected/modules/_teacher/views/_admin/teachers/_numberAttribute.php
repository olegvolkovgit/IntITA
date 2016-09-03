<?php
/* @var $attribute array
 * @var $user integer
 * @var $role string
 */
?>
<br>
<form>
    <input type="number" class="form-control col col-md-4" name="attributeValue" min="0" max="2147483647"
           id="{{data.user.role}}-{{attribute.key}}"  ng-value="attribute.value">
    <br>
    <br>
    <input type="button" class="btn btn-primary"
            ng-click="addTeacherAttr('<?php echo Yii::app()->createUrl("/_teacher/_admin/teachers/setTeacherRoleAttribute"); ?>',
                attribute.key, '#'+data.user.role+'-'+attribute.key);" value="Редагувати">
</form>
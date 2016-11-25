<?php
/* @var $attribute array
 * @var $user integer
 * @var $role string
 */
?>
<br>
<form>
    <input type="number" class="form-control col col-md-4" name="attributeValue" min="0" max="2147483647"
           ng-model="capacityValue"  ng-value="attribute.value">
    <br>
    <br>
    <button type="button" class="btn btn-success"
            ng-click="setTeacherRoleAttribute(data.user.role,attribute.key,data.user.id,capacityValue)">
        Редагувати
    </button>
    <a type="button" class="btn btn-default" ng-click='back()'>
        Назад
    </a>
</form>
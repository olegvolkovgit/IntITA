<?php
/**
 * @var $model StudentReg
 * @var $roles array
 * @var $role UserRoles
 * @var $attributes array
 */
?>
<ul class="list-inline">
    <li>
        <a type="button" class="btn btn-primary" ng-href="#/admin/teachers">Співробітники</a>
    </li>
    <li>
        <a type="button" class="btn btn-primary" ng-href="#/admin/users/user/{{data.user.id}}">Переглянути інформацію даного користувача</a>
    </li>
</ul>
<div ng-cloak class="panel panel-default">
    <div class="panel-body">
        <input type="hidden" ng-value="data.user.id" id="user">
        <input type="hidden" ng-value="data.user.role" id="role">
        <uib-tabset active="0" >
            <uib-tab  ng-if="(data.user.roles[data.user.role].length && attribute.type!='hidden')"
                      ng-repeat="attribute in data.user.roles[data.user.role] track by $index" index="$index" heading="{{attribute.title}}">
                <div class="form-group">
                    <input type="hidden" ng-value="attribute.key" id="attr">
                    <div ng-if="attribute.type=='module-list'">
                        <?php $this->renderPartial('_moduleList', array()); ?>
                    </div>
                    <div ng-if="attribute.type=='students-list'">
                        <?php $this->renderPartial('_studentsList', array()); ?>
                    </div>
                    <div ng-if="attribute.type=='hidden'"></div>
                    <div ng-if="attribute.type=='number'">
                        <?php $this->renderPartial('_numberAttribute', array()); ?>
                    </div>
                </div>
            </uib-tab>
            <div ng-if="!data.user.roles[data.user.role].length">
                Атрибутів для даної ролі не задано.
            </div>
        </uib-tabset>
    </div>
</div>


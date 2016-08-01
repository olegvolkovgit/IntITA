<?php
/**
 * @var $module Module
 */
?>
<div class="col col-md-9" ng-controller="moduleAddTeacherCtrl">
    <div class="panel panel-primary" >
        <div class="panel-body">
            <form role="form">
                <div class="form-group">
                    <label>Модуль:
                        <input type="text" class="form-control" placeholder="Модуль" size="135"
                               value="<?= $module->getTitle() . " (" . $module->language . ")"; ?>" disabled>
                    </label>
                    <input type="number" hidden="hidden" value="<?= $module->module_ID; ?>" id="module">
                    <input type="text" hidden="hidden" value="<?= UserRoles::AUTHOR; ?>" id="role">
                </div>
                <div class="form-group">
                    <input type="number" hidden="hidden" id="user" value="0"/>
                    <label>Виберіть викладача:</label>
                    <input id="typeahead" type="text" class="form-control" placeholder="Викладач"
                           size="135" required autofocus>
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-success" ng-click="setRole()"
                            onclick="addTeacherAttr('<?php echo Yii::app()->createUrl('/_teacher/_admin/teachers/setTeacherRoleAttribute'); ?>',
                                'module', '#module','','<?php echo $module->getTitle() ?>')">
                        Призначити автора
                    </button>
                </div>
            </form>
            <br>
            <div class="alert alert-info">
                Автором модуля можна призначити лише зареєтрованого співробітника.
                Якщо потрібного користувача немає в списку співробітників, то додати співробітника можна на сторінці
                <a href="#" class="alert-link"
                   onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/teachers/create'); ?>', 'Додати співробітника')">
                    Додати співробітника</a>.
            </div>
        </div>
    </div>


</div>
<?php
/**
 * @var $module Module
 */
?>
<div class="col col-md-9" ng-controller="modulemanageCtrl">
    <div class="panel panel-primary" >
        <div class="panel-body">
            <form role="form">
                <div class="form-group">
                    <label>Модуль:
                        <input type="text" class="form-control" placeholder="Модуль" size="135"
                               value="<?= $module->getTitle() . " (" . $module->language . ")"; ?>" disabled>
                    </label>
                </div>
                <div class="form-group">
                    <input type="text" size="135" ng-model="teacherSelected" placeholder="Викладач" uib-typeahead="item.email for item in getTeachers($viewValue)" typeahead-no-results="noResults"  typeahead-template-url="customTemplate.html" typeahead-on-select="onSelect($item)" class="form-control" />
                    <i ng-show="loadingTeachers" class="glyphicon glyphicon-refresh"></i>
                    <div ng-show="noResults">
                        <i class="glyphicon glyphicon-remove"></i> Викладача не знайдено
                    </div>
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-success" ng-click="addTeacher('<?= $module->module_ID; ?>','<?= UserRoles::AUTHOR; ?>',selectedTeacher.id)"
                            >
                        Призначити автора
                    </button>
                </div>
            </form>
            <br>
            <div class="alert alert-info">
                Автором модуля можна призначити лише зареєтрованого співробітника.
                Якщо потрібного користувача немає в списку співробітників, то додати співробітника можна на сторінці
                <a type="button" class="btn btn-primary" ng-href="#/admin/teacher/create">
                    Додати спвіробітника
                </a>.
            </div>
        </div>
    </div>


</div>
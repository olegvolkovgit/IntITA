<?php
/**
 * @var $module Module
 */
?>
<div class="col col-md-9" ng-controller="modulemanageCtrl">
    <div class="panel panel-primary">
        <div class="panel-body">
            <form role="form">
                <div class="form-group">
                    <label>Модуль:
                        <input type="text" class="form-control" placeholder="Модуль" size="135"
                               value="<?= $module->getTitle() . " (" . $module->language . ")"; ?>" disabled>
                    </label>
                    <input type="number" hidden="hidden" value="<?= $module->module_ID; ?>" id="module">
                    <input type="text" hidden="hidden" value="<?= UserRoles::CONSULTANT; ?>" id="role">
                </div>
                <div class="form-group">
                    <input type="text" size="135" ng-model="teacherSelected" placeholder="Викладач" uib-typeahead="item.email for item in getTeachers($viewValue)" typeahead-no-results="noResults"  typeahead-template-url="customTemplate.html" typeahead-on-select="onSelect($item)" class="form-control" />
                    <i ng-show="loadingTeachers" class="glyphicon glyphicon-refresh"></i>
                    <div ng-show="noResults">
                        <i class="glyphicon glyphicon-remove"></i> Викладача не знайдено
                    </div>
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-success" ng-click="addTeacher('<?= $module->module_ID; ?>','<?= UserRoles::CONSULTANT; ?>',selectedTeacher.id)">
                        Призначити консультанта
                    </button>
                </div>
            </form>
            <br>
            <div class="alert alert-info">
                Консультантом модуля можна призначити лише зареєтрованого співробітника.
                Якщо потрібного користувача немає в списку співробітників, то додати співробітника можна на
                сторінці
                <a href="#" class="alert-link"
                   onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/teachers/create'); ?>', 'Додати співробітника')">
                    Додати співробітника</a>.
            </div>
        </div>
    </div>
    <script type="text/ng-template" id="customTemplate.html">
        <a>

            <div class="typeahead_wrapper  tt-selectable">
                <img class="typeahead_photo" ng-src="{{match.model.url}}" width="36">
                <div class="typeahead_labels">
                    <div ng-bind="match.model.name" class="typeahead_primary"></div>
                    <div ng-bind="match.model.email" class="typeahead_secondary"></div>
                </div>
            </div>


        </a>
    </script>
</div>
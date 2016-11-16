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
                    <input type="text" size="135" ng-model="authorSelected" placeholder="Викладач" uib-typeahead="item.email for item in getAuthors($viewValue)" typeahead-no-results="noResults"  typeahead-template-url="customTemplate.html" typeahead-on-select="onSelectAuthor($item)" class="form-control" />
                    <i ng-show="loadingTeachers" class="glyphicon glyphicon-refresh"></i>
                    <div ng-show="noResults">
                        <i class="glyphicon glyphicon-remove"></i> Викладача не знайдено
                    </div>
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-success" ng-click="addTeacher('<?= $module->module_ID; ?>','<?= UserRoles::AUTHOR; ?>',selectedAuthor.id)"
                            >
                        Призначити автора
                    </button>
                    <a type="button" class="btn btn-default" ng-click='back()'>
                        Назад
                    </a>
                </div>
            </form>
            <br>
            <div class="alert alert-info">
                Автором модуля можна призначити лише співробітника з ролю 'автор'.
                Якщо потрібного користувача немає в списку авторів, то додати автора можна на сторінці
                <a class="alert-link" ng-href="#/admin/users/addrole/author">
                    додати автора
                </a>.
            </div>
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
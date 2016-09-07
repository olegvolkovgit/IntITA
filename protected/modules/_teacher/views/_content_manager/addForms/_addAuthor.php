<div class="panel panel-primary">
    <div class="panel-body">
        div class="form-group">
        <input type="text" hidden="hidden" value="author" id="role">
        <label>Викладач:</label>
        <br>

        <div class="form-group">
            <input type="text" size="135" ng-model="teacherSelected" ng-model-options="{ debounce: 1000 }" placeholder="Викладач" uib-typeahead="item.email for item in getTeachers($viewValue) | limitTo : 10" typeahead-no-results="noResultsConsultant"  typeahead-template-url="customTemplate.html" typeahead-on-select="onSelect($item)" class="form-control" />
            <i ng-show="loadingTeachers" class="glyphicon glyphicon-refresh"></i>
            <div ng-show="noResultsConsultant">
                <i class="glyphicon glyphicon-remove"></i> Викладача не знайдено
            </div>
        </div>
    </div>
    <div class="form-group">
        <label>
            <strong>Модуль:</strong>
        </label>
        <input type="text" size="135" ng-model="moduleSelected" ng-model-options="{ debounce: 1000 }" placeholder="Модуль" uib-typeahead="item.title for item in getModules($viewValue) | limitTo:10" typeahead-no-results="moduleNoResults" typeahead-on-select="selectModule($item)" class="form-control" />
        <i ng-show="loadingModules" class="glyphicon glyphicon-refresh"></i>
        <div ng-show="moduleNoResults">
            <i class="glyphicon glyphicon-remove"></i> Модуль не знайдено
        </div>
        <br>
        <div class="form-group">
            <button type="button" class="btn btn-success" ng-click="addPermission('moduleAuchtor')">Призначити автора модуля
            </button>
        </div>
    </div>
        <br>
        <div class="alert alert-info">
            <?php if (Yii::app()->user->model->isAdmin()) { ?>
                Автором модуля можна призначити лише зареєтрованого співробітника.
                Якщо потрібного користувача немає в списку авторів, то призначити роль автора можна на сторінці
                <a href="#" class="alert-link" onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/teachers/create');?>', 'Призначити автора')">
                    Призначити співробітника</a>.
            <?php } else { ?>
            Призначити автором можна тільки вже зареєстрованого співробітника. Додати нового співробітника можна
            за посиланням:
            <a href="#" class="alert-link"
               onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_content_manager/contentManager/sendCoworkerRequest'); ?>',
                   'Запит на призначення співробітника')">Надіслати запит</a>.
            <?php } ?>
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
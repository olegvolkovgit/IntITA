fff
<!--<br>-->
<!--<div class="panel panel-default col-md-7" ng-controller="roleAttributesCtrl">-->
<!--    <div class="panel-body">-->
<!---->
<!--        <div class="form-group">-->
<!--            <input type="text" hidden="hidden" value="author" id="role">-->
<!--            <label>Викладач:</label>-->
<!--            <br>-->
<!---->
<!--            <div class="form-group">-->
<!--                <input type="text" size="135" ng-model="teacherSelected" ng-model-options="{ debounce: 1000 }" placeholder="Викладач" uib-typeahead="item.email for item in getConsultants($viewValue) | limitTo : 10" typeahead-no-results="noResultsConsultant"  typeahead-template-url="customTemplate.html" typeahead-on-select="onSelect($item)" class="form-control" />-->
<!--                <i ng-show="loadingTeachers" class="glyphicon glyphicon-refresh"></i>-->
<!--                <div ng-show="noResultsConsultant">-->
<!--                    <i class="glyphicon glyphicon-remove"></i> Викладача не знайдено-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="form-group">-->
<!--            <label>-->
<!--                <strong>Модуль:</strong>-->
<!--            </label>-->
<!--            <input type="text" size="135" ng-model="moduleSelected" ng-model-options="{ debounce: 1000 }" placeholder="Модуль" uib-typeahead="item.title for item in getModules($viewValue) | limitTo:10" typeahead-no-results="moduleNoResults" typeahead-on-select="selectModule($item)" class="form-control" />-->
<!--            <i ng-show="loadingModules" class="glyphicon glyphicon-refresh"></i>-->
<!--            <div ng-show="moduleNoResults">-->
<!--                <i class="glyphicon glyphicon-remove"></i> Модуль не знайдено-->
<!--            </div>-->
<!--            <br>-->
<!--            <div class="form-group">-->
<!--                <button type="button" class="btn btn-success" ng-click="addPermission('consultant')">Призначити модуль для консультанта-->
<!--                </button>-->
<!--                <a type="button" class="btn btn-default" ng-click='back()'>-->
<!--                    Назад-->
<!--                </a>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="alert alert-info">-->
<!--            --><?php //if (Yii::app()->user->model->isAdmin()) { ?>
<!--                Консультантом модуля можна призначити лише зареєтрованого співробітника, який має права консультанта.-->
<!--                Якщо потрібного користувача немає в списку консультантів, то додати права консультанта можна на сторінці-->
<!--                <a class="alert-link" ng-href="#/admin/users/addrole/consultant">-->
<!--                    додати консультанта-->
<!--                </a>.-->
<!--            --><?php //} else { ?>
<!--                Консультантом модуля можна призначити лише зареєтрованого співробітника, який має права консультанта.-->
<!--            --><?php //} ?>
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

<?php
/**
 * @var $model RegisteredUser
 * @var $user StudentReg
 */
?>
<div class="panel panel-default">
    <div class="panel-body">
        <?php if(Yii::app()->user->model->isAdmin()){?>
        <div class="row">
            <div class="col col-md-6">
                <input type="text" size="65" ng-model="formData.moduleSelected" ng-model-options="{ debounce: 1000 }"
                       placeholder="Модуль" uib-typeahead="item.title for item in getModules($viewValue) | limitTo:10"
                       typeahead-no-results="moduleNoResults" typeahead-on-select="onSelectModule($item)"
                       ng-change="reloadModule()" class="form-control" ng-disabled="defaultModule"/>
                <i ng-show="loadingModules" class="glyphicon glyphicon-refresh"></i>
                <div ng-show="moduleNoResults">
                    <i class="glyphicon glyphicon-remove"></i> модуль не знайдено
                </div>
            </div>
            <div class="col col-md-2">
                <button type="button" class="btn btn-success"
                        ng-click="actionModule('payModule',data.user.id,selectedModule.id)">
                    Сплатити модуль
                </button>
            </div>
        </div>
        <?php } ?>
        <br>
        <div class="panel panel-default">
            <div class="panel-body">
                <h4>Проплачені модулі:</h4>
                <ul ng-if="data.modules.length!=0" class="list-group">
                    <li ng-repeat="module in data.modules track by $index" class="list-group-item">
                        <a ng-href="{{module.link}}" target="_blank">
                            {{module.title_ua}} ({{module.lang}})
                        </a>
                        <input type="number" hidden="hidden" id="moduleId" ng-value="{{module.id}}"/>
                        <?php if(Yii::app()->user->model->isAdmin()){?>
                            <a type="button" class="btn btn-outline btn-success btn-xs" ng-href="#/admin/users/user/{{data.user.id}}/agreement/module/{{module.id}}">
                                <em>договір</em>
                            </a>
                            <a href=""
                               ng-click="actionModule('cancelModule',data.user.id,module.id)">
                                <span class="warningMessage"><em> скасувати доступ</em></span>
                            </a>
                        <?php } ?>
                    </li>
                </ul>
                <em ng-if="data.modules.length==0">Модулів немає.</em>
            </div>
        </div>
    </div>
</div>
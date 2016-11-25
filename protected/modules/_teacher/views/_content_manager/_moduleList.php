<?php
/* @var $attribute array
 * @var $role string
 * @var $model StudentReg
 */
?>
<div class="col-md-12" ng-controller="editTeacherRoleCtrl">
    <uib-tabset active="0" >
        <uib-tab  ng-if="(data.user.roles[data.user.role].length && attribute.type!='hidden')"
                  ng-repeat="attribute in data.user.roles[data.user.role] track by $index" index="$index" heading="{{attribute.title}}">
            <div class="form-group">
                <div ng-if="attribute.type=='module-list'">
                    <div class="col-md-12">
                        <div class="row">
                            <form>
                                <div class="form-group">
                                    <input type="text" size="65" ng-model="formData.moduleSelected" ng-model-options="{ debounce: 1000 }"
                                           placeholder="Модуль" uib-typeahead="item.title for item in getModules($viewValue) | limitTo:10"
                                           typeahead-no-results="moduleNoResults" typeahead-on-select="onSelectModule($item)"
                                           ng-change="reloadModule()" class="form-control" ng-disabled="defaultModule"/>
                                    <i ng-show="loadingModules" class="glyphicon glyphicon-refresh"></i>
                                    <div ng-show="moduleNoResults">
                                        <i class="glyphicon glyphicon-remove"></i> модуль не знайдено
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <button type="button" class="btn btn-success"
                                            ng-click="setTeacherRoleAttribute(data.user.role,'module',data.user.id,selectedModule.id)">
                                        Призначити модуль
                                    </button>
                                    <a type="button" class="btn btn-default" ng-click='back()'>
                                        Назад
                                    </a>
                                </div>
                            </form>
                        </div>
                        <br>
                        <div>
                            <b>Викладач: {{data.user.firstName}} {{data.user.secondName}} ({{data.user.email}})</b>
                        </div>
                        <div class="dataTable_wrapper">
                            <table class="table table-striped table-bordered table-hover" id="studentsListTable" datatable="ng" dt-options="dtModulesOptions" dt-column-defs="dtColumnDefs">
                                <thead>
                                <tr>
                                    <th>Модуль</th>
                                    <th>Призначено</th>
                                    <th>Відмінено</th>
                                    <th>Видалити</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr ng-repeat="module in attribute.value">
                                    <td>
                                        <a ng-href="" ng-click="moduleLink(module.id)">
                                            {{module.title}} ({{module.lang}})
                                        </a>
                                    </td>
                                    <td>
                                        {{module.start_date}}
                                    </td>
                                    <td>
                                        {{module.end_date}}
                                    </td>
                                    <td>
                                        <a ng-if="!module.end_date" href=""
                                           ng-click="cancelTeacherRoleAttribute(data.user.role,attribute.key,data.user.id,module.id);">скасувати
                                        </a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </uib-tab>
        <div ng-if="!data.user.roles[data.user.role].length">
            Атрибутів для даної ролі не задано.
        </div>
    </uib-tabset>
</div>
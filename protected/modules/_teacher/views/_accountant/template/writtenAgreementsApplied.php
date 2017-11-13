<div class="col-lg-12" ng-controller="writtenAgreementsAppliedTableCtrl">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <div class="row col-md-12">
                    По замовчуванню використовується перший паперовий шаблон.
                    Якщо скасувати застосований шаблон для сервіса, буде використовуватися шаблон по замовчуванню.
                </div>
                <div class="row col-md-6">
                    <form name="templateForm">
                        <br>
                        <div>
                            <span class="control-label">Шаблон паперового договору*</span>
                        </div>
                        <div>
                            <select
                                    required="required"
                                    class="form-control"
                                    ng-model="formData.written_agreement_template_id"
                                    ng-options="template.id as template.name for template in templates">
                                <option style="display:none" value="">--Виберіть шаблон договору--</option>
                            </select>
                        </div>
                        <br>
                        <div class="form-group">
                            <input required="required" type="text" size="65" ng-model="serviceSelected" ng-model-options="{ debounce: 1000 }"
                                   placeholder="Сервіс" uib-typeahead="item.description for item in getServices($viewValue) | limitTo:10"
                                   typeahead-no-results="serviceNoResults" typeahead-on-select="onSelectService($item)"
                                   ng-change="reloadService()" class="form-control"/>
                            <i ng-show="loadingServices" class="glyphicon glyphicon-refresh"></i>
                            <div ng-show="serviceNoResults">
                                <i class="glyphicon glyphicon-remove"></i> сервіс не знайдено
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-success" ng-disabled="!formData.written_agreement_template_id || !formData.service_id"
                                    ng-click="setWrittenAgreementTemplateForService(formData)">
                                Призначити шаблон
                            </button>
                        </div>
                    </form>
                </div>
                <table ng-table="writtenAgreementsAppliedTableParams" class="table table-bordered table-striped table-condensed">
                    <colgroup>
                        <col/>
                        <col/>
                        <col width="5%"/>
                    </colgroup>
                    <tr ng-repeat="row in $data track by $index">
                        <td data-title="'Сервіс'" filter="{'description': 'text'}" sortable="'description'">
                            <a href="" ng-click="serviceLink(row.service_id)" target="_blank">
                                {{row.description}}
                            </a>
                        </td>
                        <td data-title="'Назва шаблону паперовго договру'" filter="{'writtenAgreementTemplate.name': 'text'}" sortable="'writtenAgreementTemplate.name'">
                            <a ng-href="#/accountant/writtenAgreementView/{{row.written_agreement_template_id}}" target="_blank">
                                {{row.writtenAgreementTemplate.name}}
                            </a>
                        </td>
                        <td data-title="">
                            <a title="переглянути" ng-href="#/accountant/writtenAgreement/id/{{row.id}}">
                                <i class="fa fa-remove" aria-hidden="true" title="скасувати" ng-click="cancelAppliedAgreement(row.service_id)"></i>
                            </a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<style>
    .danger_style,td.danger_style{
        border:2px solid red !important;
    }
</style>
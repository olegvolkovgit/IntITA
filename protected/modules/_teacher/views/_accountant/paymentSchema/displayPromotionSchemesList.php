<div class="panel panel-default" ng-controller="promotionPaymentsSchemesTableCtrl" organization="<?php echo $organization ?>">
    <div class="panel-body">
        <ul class="list-inline">
            <li>
                <a ng-href="#/accountant/paymentSchemas/schemas/template" class="btn btn-primary">
                    Шаблони схем
                </a>
            </li>
            <li>
                <a ng-href="#/accountant/paymentSchemas/schemas/createTemplate" class="btn btn-primary">
                    Додати шаблон схем
                </a>
            </li>
            <li>
                <a ng-href="#/accountant/paymentSchemas/schemas/apply" class="btn btn-primary">
                    Застосувати шаблон схем
                </a>
            </li>
            <li>
                <a ng-href="#/accountant/paymentSchemas/schemas/appliedTemplates" class="btn btn-primary">
                    Список застосованих шаблонів
                </a>
            </li>
            <li>
                <a ng-href="#/accountant/paymentSchemas/schemas/displaypromotion" class="btn btn-primary">
                    Застосування акцій до сервісів
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <table ng-table="promotionPaymentsSchemaTableParams" class="table table-bordered table-striped table-condensed">
                <colgroup>
                    <col width="20%"/>
                    <col/>
                    <col/>
                    <col width="10%"/>
                    <col/>
                    <col/>
                    <col/>
                    <col width="5%"/>
                </colgroup>
                <tr ng-repeat="row in $data track by row.id">
                    <td data-title="'Назва шаблону'" filter="{'schemesTemplate.template_name_ua': 'text'}" sortable="'schemesTemplate.template_name_ua'">
                        <a ng-href="#/accountant/paymentSchemas/schemas/template/{{row.id_template}}">{{row.schemesTemplate.template_name_ua}}</a>
                    </td>
                    <td data-title="'Застосовано до курсу'" filter="{'course.title_ua': 'text'}" sortable="'course.title_ua'">
                        <a href="" ng-click="courseLink(row.course.course_ID)" target="_blank">
                            {{row.course.title_ua}} {{row.course.language}}
                        </a>
                    </td>
                    <td data-title="'Застосовано до модуля'" filter="{'module.title_ua': 'text'}" sortable="'module.title_ua'">
                        <a href="" ng-click="moduleLink(row.module.module_ID)" target="_blank">
                            {{row.module.title_ua}} {{row.module.language}}
                        </a>
                    </td>
                    <td data-title="'Застосовано до усіх'" sortable="'serviceType'">
                        <span ng-if="row.serviceType==1">курсів</span>
                        <span ng-if="row.serviceType==2">модулів</span>
                    </td>
                    <td data-title="'відображається з'" filter="{'showDate': 'text'}" sortable="'showDate'">{{row.showDate | shortDate:'yyyy-MM-dd'}}</td>
                    <td data-title="'діє з'" filter="{'startDate': 'text'}" sortable="'startDate'">{{row.startDate}}</td>
                    <td data-title="'діє до'" filter="{'endDate': 'text'}" sortable="'endDate'">{{row.endDate}}</td>
                    <td data-title="">
                        <a title="скасувати" href="" ng-click="cancelPromotionPaymentScheme(row.id)"><i class="fa fa-trash fa-fw"></i></a>
                        <a title="редагувати" ng-href="#/accountant/paymentSchemas/schemas/promotionupdate/{{row.id}}"><i class="fa fa-pencil-square-o fa-fw"></i></a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
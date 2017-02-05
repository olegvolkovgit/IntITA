<div class="col-lg-12" ng-controller="paymentsSchemaTemplateTableCtrl">
    <ul class="list-inline">
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
    </ul>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table ng-table="schemesTemplateTableParams" class="table table-bordered table-striped table-condensed">
                    <tr ng-repeat="row in $data track by $index">
                        <td style="width: 50px" data-title="'Id'">
                           {{row.id}}
                        </td>
                        <td data-title="'Назва шаблону'">
                            <a ng-href="#/accountant/paymentSchemas/schemas/template/{{row.id}}">{{row.template_name}}</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>


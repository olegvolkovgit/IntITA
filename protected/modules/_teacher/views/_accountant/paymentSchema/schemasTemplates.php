<?php
/* @var $types array */
/* @var $model OperationType */
?>
<div class="col-lg-12" ng-controller="paymentsSchemaTemplateTableCtrl">
    <br>
    <a ng-href="#/accountant/paymentSchemas/schemas/template/create" class="btn btn-primary">
        Додати шаблон схем
    </a>
    <br>
    <br>
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


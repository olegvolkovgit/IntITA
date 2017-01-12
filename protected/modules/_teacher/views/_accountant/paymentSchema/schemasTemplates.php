<?php
/* @var $types array */
/* @var $model OperationType */
?>
<div class="col-lg-12" ng-controller="paymentsSchemaTemplateCtrl">
    <br>
    <a href="#/accountant/externalsources">Зовнішні джерела коштів</a>
    <a ng-href="#/accountant/paymentSchemas/schemas/template/create" class="btn btn-primary">
        Додати шаблон схем
    </a>
    <br>
    <br>
<!--    <div class="panel panel-default">-->
<!--        <div class="panel-body">-->
<!--            <div class="dataTable_wrapper">-->
<!--                <table class="table table-striped table-bordered table-hover" ng-table="operationTypesTable">-->
<!--                    <tr ng-repeat="row in $data">-->
<!--                        <td data-title="'Номер'">{{row.id}}</td>-->
<!--                        <td data-title="'Опис'">{{row.description}}</td>-->
<!--                        <td data-title="'Negative summa'"><span ng-if="row.negative_summa">{{row.negative_summa}}</span>-->
<!--                                                          <span ng-if="!row.negative_summa">0</span>-->
<!--                        </td>-->
<!--                        <td data-title="'Управління'"> <a href="javascript:void(0)" title="Переглянути"-->
<!--                                                          ng-click=changeView('accountant/operationType/view/'+row.id)><i class="fa  fa-eye fa-fw"></i></a>-->
<!--                            <a href="javascript:void(0)" title="Редагувати"ng-click=changeView('accountant/operationType/edit/'+row.id)><i class="fa fa-pencil fa-fw"></i></a>-->
<!--                            <a href="javascript:void(0)" title="Видалити" ng-click=deleteOperationType(row.id);>-->
<!--                                <i class="fa fa-trash-o fa-fw"></i></a></td>-->
<!--                    </tr>-->
<!--                </table>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
</div>


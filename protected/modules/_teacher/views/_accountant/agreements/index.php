<?php
/* @var $agreements array
 * @var $agreement UserAgreements
 */
?>
<div class="col-lg-12" ng-controller="agreementsCtrl">
    <div class="panel panel-default">
        <div class="panel-body">
            <table ng-table="agreementsTableParams" class="table table-bordered table-striped table-condensed">
                <tr ng-repeat="row in $data track by row.id">
                    <td data-title="'Номер'" filter="{number: 'text'}" sortable="'number'"><a
                            href="#/accountant/agreement/{{row.id}}">{{row.number}}</a></td>
                    <td data-title="'Користувач'" filter="{'user.fullName': 'text'}" sortable="'user.fullName'">
                        {{row.user_id.fullName}}
                    </td>
                    <td data-title="'Дата створення'" filter="{create_date: 'text'}" sortable="'create_date'">
                        {{row.create_date}}
                    </td>
                    <td data-title="'Дата підтвердження'" filter="{approval_date: 'text'}" sortable="'approval_date'">
                        {{row.approval_date}}
                    </td>
                    <td data-title="'Підтверджено користувачем'" filter="{'approvalUser.fullName': 'text'}"
                        sortable="'approvalUser.fullName'">{{row.approval_user.fullName}}
                    </td>
                    <td data-title="'Схема оплати'" filter="{payment_schema: 'select'}" filter-data="getSchemas"
                        sortable="'payment_schema'">{{row.payment_schema.name}}
                    </td>
                    <td data-title="'Управління'">
                        <button ng-if="!row.approval_date" class="btn btn-success"
                                ng-click="confirm(row.id)">
                            Підтвердити
                        </button>
                        <button ng-if="row.approval_date" class="btn btn-danger"
                                ng-click="cancel(row.id)">
                            Скасувати
                        </button>
                        <button ng-if="row.approval_date" class="btn btn-danger"
                                ng-click="close(row.id)">
                                Закрити
                        </button>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
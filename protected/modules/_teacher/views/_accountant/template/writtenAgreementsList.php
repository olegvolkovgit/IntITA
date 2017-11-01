<div class="tab-content" ng-controller="agreementTemplatesList">
    <div class="panel panel-default">
        <div class="panel-body">
            <ul class="list-inline">
                <li>
                    <a type="button" class="btn btn-primary" ng-href="#/accountant/writtenAgreement">
                        Створити шаблон договору
                    </a>
                </li>
            </ul>
            <div class="dataTable_wrapper">
                <table ng-table="templatesTableParams" class="table table-bordered table-striped table-condensed">
                    <colgroup>
                        <col/>
                        <col width="5%"/>
                    </colgroup>
                    <tr ng-repeat="row in $data track by $index">
                        <td data-title="'Назва'">
                            {{row.name}}
                        </td>
                        <td data-title="">
                            <a title="переглянути" ng-href="#/accountant/writtenAgreementView/{{row.id}}">
                                <i class="fa fa-eye fa-fw"></i>
                            </a>
                            <a title="редагувати" ng-href="#/accountant/writtenAgreementUpdate/{{row.id}}">
                                <i class="fa fa-edit fa-fw"></i>
                            </a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-body">
        <div ng-controller="organizationTableCtrl">
            <a type="button" class="btn btn-primary" ng-href="#/organizations/addOrganization">
                Додати організацію
            </a>
            <br>
            <br>
            <form autocomplete="off">
                <table ng-table="organizationsTableParams" class="table table-bordered table-striped table-condensed">
                    <colgroup>
                        <col/>
                        <col width="5%"/>
                    </colgroup>
                    <tr ng-repeat="row in $data track by row.id">
                        <td data-title="'Назва'" sortable="'name'" filter="{'name': 'text'}" >
                            {{row.name}}
                        </td>
                        <td data-title="''">
                            <a class="btnChat" ng-href="#/organizations/updateOrganization/{{row.id}}"  data-toggle="tooltip" data-placement="top" title="Редагувати">
                                <i class="fa fa-edit fa-fw"></i>
                            </a>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>



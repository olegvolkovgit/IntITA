<div class="col-lg-12" ng-controller="documentsCtrl" organization="<?php echo $organization ?>">
    <a type="button" class="btn btn-success" href="" ng-click="createDocumentsFolder()">
        Створити папку для документів
    </a>
    <br>
    <br>
    <div class="panel panel-default">
        <div class="panel-body">
            <table ng-table="documentsTableParams" class="table table-bordered table-striped table-condensed">
                <tr ng-repeat="row in $data track by $index">
                    <td data-title="'ПІБ'" filter="{'idUser.fullName': 'text'}" sortable="'idUser.fullName'">
                        <a ng-href="#/users/profile/{{row.id_user}}">{{row.idUser.fullName}}</a>
                    </td>
                    <td data-title="'Email'" filter="{'idUser.email': 'text'}" sortable="'idUser.email'">
                        <a ng-href="#/users/profile/{{row.id_user}}">{{row.idUser.email}}</a>
                    </td>
                    <td data-title="'Тип документа'" filter="{'documentType.title_ua': 'text'}" sortable="'documentType.title_ua'">
                        {{row.documentType.title_ua}}
                    </td>
                    <td data-title="'Документ'">
                        <span ng-repeat="file in row.documentsFiles track by $index">
                            <a ng-href="/files/documents/{{row.id_user}}/{{row.documentType.id}}/{{file.file_name}}" target="_blank">
                                {{file.file_name}}
                            </a>
                        </span>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
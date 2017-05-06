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
                    <td data-title="'ПІБ'" filter="{'user.fullName': 'text'}" sortable="'user.fullName'">
                        <a ng-href="#/users/profile/{{row.id_user}}">{{row.user.fullName}}</a>
                    </td>
                    <td data-title="'Email'" filter="{'user.email': 'text'}" sortable="'user.email'">
                        <a ng-href="#/users/profile/{{row.id_user}}">{{row.user.email}}</a>
                    </td>
                    <td data-title="'Тип документа'" filter="{'type': 'text'}" sortable="'type'">
                        {{row.type}}
                    </td>
                    <td data-title="'Документ'">
                        <a ng-href="<?php echo StaticFilesHelper::fullPathToFiles('documents') ?>/{{row.id_user}}/{{row.type}}/{{row.file_name}}" target="_blank">
                            {{row.file_name}}
                        </a>
                    </td>
                    <td data-title="'Час завантаження'" sortable="'upload_time'" filter="{'upload_time': 'text'}" >
                        {{row.upload_time}}
                    </td>
<!--                    todo-->
<!--                    <td data-title="'Статус документа'" filter="{'check': 'select'}" filter-data="docStatus">-->
<!--                        {{row.check ? "перевірені":"не перевірені"}}-->
<!--                        <button type="button" class="btn btn-outline btn-primary btn-xs" ng-click="changeDocStatus(row.id);">-->
<!--                            змінити статус-->
<!--                        </button>-->
<!--                    </td>-->
                </tr>
            </table>
        </div>
    </div>
</div>
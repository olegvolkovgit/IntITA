<div class="panel panel-default">
    <div class="panel-body" ng-controller="usersEmailCtrl">
        <label class="control-label">Виберіть .xlsx файл з базою email'ів (одна колонка з заголовком 'email')</label>
        <br>
        <div class="row" style="margin-left:0">
            <input type="file" name="file" class="file" style="display: inline-block" onchange="angular.element(this).scope().uploadFile(this.files)"/>
            <button type="submit" class="btn btn-primary" ng-disabled="!isFile" ng-click="importExcel()">
                Імпортувати файл в таблицю
            </button>
        </div>
        <button type="submit" class="btn btn-primary" style="float:right" ng-click="truncateEmailsTable()">
            Очистити базу email'ів
        </button>
        <br>
        <br>
        <table ng-table="usersEmailTableParams" class="table table-bordered table-striped table-condensed">
            <tr ng-repeat="row in $data track by $index">
                <td data-title="'Email'" sortable="'email'" filter="{'email': 'text'}" >
                    {{row.email}}
                </td>
                <td data-title="'Видалити'" style="text-align: center">
                    <a ng-click="removeEmail(row.email)"><i class="fa fa-trash fa-fw"></i></a>
                </td>
            </tr>
        </table>
        <br>
        <br>
        <br>
        <a type="button" class="btn btn-default" ng-click='back()'>
            Назад
        </a>
    </div>
</div>
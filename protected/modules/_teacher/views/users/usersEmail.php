<a type="submit" ng-href="#/admin/emailscategory" class="btn btn-primary" >
    Категорії email
</a>
<a type="submit" ng-href="#/admin/emailscategorycreate" class="btn btn-primary" >
    Додати категорію email
</a>
<br>
<br>
<div class="panel panel-default">
    <div class="panel-body" ng-controller="usersEmailCtrl">
        <label class="control-label">Виберіть .xlsx файл з базою email'ів (одна колонка з заголовком 'email')</label>
        <br>
        <div class="row" style="margin-left:0">
            <input type="file" name="file" class="file" style="display: inline-block" onchange="angular.element(this).scope().uploadFile(this.files)"/>
            <div class="clientValidationError">{{errormsg}}</div><br>
            <button type="submit" class="btn btn-primary" ng-disabled="!isFile || !selectedEmailCategory || error" ng-click="importExcel(selectedEmailCategory)">
                Імпортувати файл в таблицю
            </button>
        </div>
        <div class="form-group col-lg-4 row">
            <label>Категорія*:</label>
            <select class="form-control" ng-options="item.id as item.title for item in emailsCategory"
                    ng-model="selectedEmailCategory">
                <option name="emailCategory" value="" disabled selected>(Виберіть категорію)</option>
            </select>
        </div>
        <div class="form-group col-lg-4 row" style="clear: both">
            <div class="input-group">
                <input name="email" type="email"  class="form-control" ng-model="newEmail" maxlength="128" size="50">
                <button  ng-click="addNewEmail(newEmail,selectedEmailCategory)" ng-disabled="!newEmail || !selectedEmailCategory" class="btn btn-primary go inline" style="margin-top: 4px">Додати email</button>
            </div>
        </div>
        <button type="submit" class="btn btn-primary" style="float:right" ng-disabled="!selectedEmailCategory" ng-click="truncateEmailsTable(selectedEmailCategory)">
            Очистити базу email'ів
        </button>
        <br>
        <br>
        <table ng-table="usersEmailTableParams" class="table table-bordered table-striped table-condensed">
            <tr ng-repeat="row in $data track by $index">
                <td data-title="'Email'" sortable="'email'" filter="{'email': 'text'}" >
                    {{row.email}}
                </td>
                <td data-title="'Категорія'" sortable="'emailCategory.title'"
                    filter="{'emailCategory.id': 'select'}" filter-data="emailsCategoriesList">
                    {{row.emailCategory.title}}
                </td>
                <td data-title="'Видалити'" style="text-align: center">
                    <a href="" ng-click="removeEmail(row.email, row.category)"><i class="fa fa-trash fa-fw"></i></a>
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
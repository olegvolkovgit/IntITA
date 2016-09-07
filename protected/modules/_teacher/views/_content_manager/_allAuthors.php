<div class="col-lg-12" ng-controller="moduleAuthorsCtrl">
    <br>
    <ul class="list-inline">
        <li>
            <button class="btn btn-primary" ng-click="changeView('content_manager/addModuleAuthor')">
                Призначити модуль
            </button>
        </li>
    </ul>
    <div class="panel panel-default">
        <div class="panel-body">
            <label>
                <span>Пошук:  <input class="form-control" type="text" placeholder="" ng-model="search" ng-change="searchLectures()"></span>
            </label>
            <table ng-table="authorsTable" class="table table-striped table-bordered table-hover"  style="width:100%">
                <tr ng-repeat="row in $data">
                    <td sortable="'user.firstName'" data-title="'ПІБ'" style="width: "><a href="#/content_manager/showUser/{{row.user.id}} ">{{row.user.firstName}} {{row.user.middleName}} {{row.user.lastName}}</td>
                    <td sortable="'user.email'" data-title="'Email'" style="width: "><a href="#/content_manager/showUser/{{row.user.id}} ">{{row.user.email}}</a></td>
                </tr>
            </table>
        </div>

    </div>
</div>
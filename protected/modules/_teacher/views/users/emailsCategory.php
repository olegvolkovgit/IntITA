<div class="col-md-12" ng-controller="emailCategoryTableCtrl">
    <div class="col-lg-12">
        <a type="submit" ng-href="#/admin/emailscategorycreate" class="btn btn-primary" >
            Додати категорію email
        </a>
        <a type="submit" class="btn btn-primary" ng-href="#/admin/usersemail">База email'ів</a>
        <br>
        <br>
        <div class="panel panel-default">
            <div class="panel-body" >
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" style="table-layout: fixed">
                        <tr>
                            <th>ID</th>
                            <th>Назва</th>
                            <th>Видалити</th>
                        </tr>
                        <tr ng-repeat="row in emailsCategory">
                            <td>{{row.id}}</td>
                            <td>
                                <a ng-href="#/admin/emailscategoryupdate/{{row.id}}">{{row.title}}</a>
                            </td>
                            <td data-title="'Видалити'" style="text-align: center">
                                <a href="" ng-click="removeEmailCategory(row.id)"><i class="fa fa-trash fa-fw"></i></a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
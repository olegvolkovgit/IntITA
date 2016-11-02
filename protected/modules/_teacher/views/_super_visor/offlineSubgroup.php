<div class="panel panel-default">
    <div class="panel-body">
        <ul class="list-inline">
            <li>
                <a type="button" class="btn btn-primary" ng-href="#/supervisor/editSubgroup/{{subgroup.id}}">
                    Редагувати підгрупу
                </a>
            </li>
            <li>
                <a type="button" class="btn btn-primary" ng-href="#/supervisor/offlineGroup/{{group.id}}">
                    Група підгрупи
                </a>
            </li>
        </ul>
        <div class="panel-body" style="padding:15px 0 0 0">
            <label>Група:</label><input class="form-control" type="text" ng-model="group.name" disabled>
            <br>
            <label>Підгрупа:</label><input class="form-control" type="text" ng-model="subgroup.name" disabled>
            <br>
            <label>Куратор:</label>
            <a ng-href="#/supervisor/userProfile/{{subgroup.id_user_curator}}">{{selectedCurator.name}}</a>
            <br>
            <label>Інформація(розклад):</label><a href="{{subgroup.data}}" target="_blank">{{subgroup.data}}</a>
            <br>
            <label>Студенти:</label>
            <?php $this->renderPartial('/_super_visor/tables/_offlineStudents', array());?>
        </div>
    </div>
</div>


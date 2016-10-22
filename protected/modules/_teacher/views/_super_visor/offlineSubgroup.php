<div class="row">
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
</div>

<div class="panel panel-default">
    <div class="panel-body">
        <label>Група:</label><input class="form-control" type="text" ng-model="group.name" disabled>
        <br>
        <label>Підгрупа:</label><input class="form-control" type="text" ng-model="subgroup.name" disabled>
        <br>
        <label>Інформація(розклад):</label><a href="{{subgroup.data}}" target="_blank">{{subgroup.data}}</a>
        <br>
        <label>Студенти:</label>
        <?php $this->renderPartial('/_super_visor/_offlineStudents', array());?>
    </div>
</div>


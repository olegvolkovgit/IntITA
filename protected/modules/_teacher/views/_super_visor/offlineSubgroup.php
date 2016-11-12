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
            <ul class="list-group" >
                <li class="list-group-item">
                    <label>Група:</label> {{group.name}}
                </li>
                <li class="list-group-item">
                    <label>Підрупа:</label> {{subgroup.name}}
                </li>
                <li class="list-group-item">
                    <label>Куратор:</label> <a ng-href="#/supervisor/userProfile/{{subgroup.id_user_curator}}">{{selectedCurator.name}}</a>
                </li>
                <li class="list-group-item">
                    <label>Інформація(розклад):</label> <span ng-bind-html="subgroup.data | linky:'_blank'">
                </li>
                <li class="list-group-item">
                    <label>Студенти:</label>
                    <?php $this->renderPartial('/_super_visor/tables/_offlineStudents', array());?>
                </li>
            </ul>
        </div>
    </div>
</div>


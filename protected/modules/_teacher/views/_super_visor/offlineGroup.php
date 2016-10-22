<div class="row">
    <ul class="list-inline">
        <li>
            <a type="button" class="btn btn-primary" ng-href="#/supervisor/editOfflineGroup/{{groupId}}">
                Редагувати групу
            </a>
        </li>
    </ul>
</div>

<div class="panel panel-default">
    <div class="panel-body">
        <uib-tabset active="0" >
            <uib-tab index="0" heading="Підгрупи">
                <?php $this->renderPartial('/_super_visor/_offlineGroupSubgroups', array());?>
            </uib-tab>
            <uib-tab  index="1" heading="Студенти">
                <?php $this->renderPartial('/_super_visor/_offlineStudents', array());?>
            </uib-tab>
        </uib-tabset>
    </div>
</div>


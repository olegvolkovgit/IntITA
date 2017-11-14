<div class="panel panel-default" ng-controller="offlineGroupCtrl">
    <div class="panel-body">
        <ul class="list-inline">
            <li>
                <a type="button" class="btn btn-primary" ng-href="#/offlineGroups">
                    Всі групи
                </a>
            </li>
        </ul>
        <div class="panel-body" style="padding:15px 0 0 0">
            <uib-tabset active="0" >
                <uib-tab index="0" heading="Підгрупи">
                    <?php $this->renderPartial('/users/offlineGroups/tables/_offlineGroupSubgroups', array());?>
                </uib-tab>
                <uib-tab  index="1" heading="Студенти">
                    <?php $this->renderPartial('/users/offlineGroups/tables/_offlineStudents', array());?>
                </uib-tab>
            </uib-tabset>
        </div>
    </div>
</div>


<div class="panel panel-default" ng-controller="offlineGroupCtrl">
    <div class="panel-body">
        <ul class="list-inline">
            <li>
                <a type="button" class="btn btn-primary" ng-href="#/supervisor/editOfflineGroup/{{groupId}}">
                    Редагувати групу
                </a>
            </li>
            <li>
                <a type="button" class="btn btn-primary" ng-href="#/supervisor/offlineGroups">
                    Всі групи
                </a>
            </li>
            <li>
                <a type="button" class="btn btn-success" ng-href="" ng-click="updateGroupChat(groupId)">
                    Оновити чат групи
                </a>
            </li>
        </ul>
        <div class="panel-body" style="padding:15px 0 0 0">
            <uib-tabset active="0" >
                <uib-tab index="0" heading="Підгрупи">
                    <?php $this->renderPartial('/_supervisor/tables/_offlineGroupSubgroups', array());?>
                </uib-tab>
                <uib-tab  index="1" heading="Студенти">
                    <?php $this->renderPartial('/_supervisor/tables/_offlineStudents', array());?>
                </uib-tab>
                <uib-tab  index="2" heading="Доступ до курсів">
                    <?php $this->renderPartial('/_supervisor/tables/_coursesAccess', array());?>
                </uib-tab>
                <uib-tab  index="3" heading="Доступ до модулів">
                    <?php $this->renderPartial('/_supervisor/tables/_modulesAccess', array());?>
                </uib-tab>
                <uib-tab  index="4" heading="Викладачі">
                    <?php $this->renderPartial('/_supervisor/tables/_modulesTeachers', array());?>
                </uib-tab>
            </uib-tabset>
        </div>
    </div>
</div>


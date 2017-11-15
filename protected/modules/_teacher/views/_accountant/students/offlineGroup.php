<div class="panel panel-default" ng-controller="offlineGroupCtrl">
    <div class="panel-body">
        <ul class="list-inline">
            <li>
                <a type="button" class="btn btn-primary" ng-href="#/accountant/offlineGroups">
                    Всі групи
                </a>
            </li>
        </ul>
        <div class="panel-body" style="padding:15px 0 0 0">
            <uib-tabset active="0" >
                <uib-tab  index="0" heading="Студенти">
                    <?php $this->renderPartial('/_accountant/students/_offlineStudents', array());?>
                </uib-tab>
                <uib-tab  index="1" heading="Доступ до курсів">
                    <?php $this->renderPartial('/_accountant/students/_coursesAccess', array());?>
                </uib-tab>
                <uib-tab  index="2" heading="Доступ до модулів">
                    <?php $this->renderPartial('/_accountant/students/_modulesAccess', array());?>
                </uib-tab>
            </uib-tabset>
        </div>
    </div>
</div>


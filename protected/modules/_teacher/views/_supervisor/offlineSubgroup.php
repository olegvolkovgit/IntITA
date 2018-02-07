<div class="panel panel-default" ng-controller="offlineSubgroupCtrl">
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
            <uib-tabset active="0" >
                <uib-tab index="0" heading="Головне">
                    <ul class="list-group" >
                        <li class="list-group-item">
                            <label>Група: </label> {{group.name}}
                        </li>
                        <li class="list-group-item">
                            <label>Підрупа: </label> {{subgroup.name}}
                        </li>
                        <li class="list-group-item">
                            <label>Тренер в підгрупі: </label>
                            <a ng-href="#/users/profile/{{subgroupTrainer.id}}">{{subgroupTrainer.fullName}}</a>
                        </li>
                        <li class="list-group-item">
                            <label>Інформація(розклад):</label> <span ng-bind-html="subgroup.data | linky:'_blank'"></span>
                        </li>
                        <li class="list-group-item">
                            <label>Журнал:</label> <span ng-bind-html="subgroup.journal | linky:'_blank'"></span>
                        </li>
                        <li class="list-group-item">
                            <label>Корисні посилання:</label>
                            <ul>
                                <li ng-repeat="link in subgroup.links track by $index">
                                    <span ng-bind-html="link.description"></span>
                                    <br>
                                    <span ng-bind-html="link.link | linky:'_blank'"></span>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </uib-tab>
                <uib-tab index="1" heading="Студенти">
                    <?php $this->renderPartial('/_supervisor/tables/_offlineStudents', array());?>
                </uib-tab>
                <uib-tab index="2" heading="Виключені студенти">
                    <?php $this->renderPartial('/_supervisor/tables/_canceledStudents',array());?>
                </uib-tab>

            </uib-tabset>
        </div>
    </div>
</div>


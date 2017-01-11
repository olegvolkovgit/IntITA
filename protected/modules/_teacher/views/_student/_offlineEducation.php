<div class="panel-body">
    <div class="row">
        <div class="formMargin">
            <div class="col-lg-8">
                <ul class="list-group studentInformation" ng-repeat="subgroup in subgroups track by $index">
                    <li class="list-group-item">
                        <label>Група:</label> {{subgroup.group}}<br>
                        <label>Керівник чату групи:</label> {{subgroup.groupCurator}}<br>
                        <label>Написати повідомлення:</label>
                        <a ng-href="<?= Yii::app()->createUrl('/cabinet/#/newmessages/receiver/'); ?>{{subgroup.groupCuratorId}}">
                            {{subgroup.groupCuratorEmail}}
                            <i class="fa fa-envelope fa-fw"></i>
                        </a>
                        <br>
                        <label>Приватний чат:</label>
                        <a ng-href="<?= Config::getChatPath()?>{{subgroup.groupCuratorId}}" target="_blank">почати чат <i class="fa fa-wechat fa-fw"></i></a>
                    </li>
                    <li class="list-group-item">
                        <label>Підгрупа:</label> {{subgroup.subgroup}}<br>
                        <label>Куратор підгрупи:</label> {{subgroup.subgroupCurator}}<br>
                        <label>Написати повідомлення:</label>
                        <a ng-href="<?= Yii::app()->createUrl('/cabinet/#/newmessages/receiver/'); ?>{{subgroup.subgroupCuratorId}}">
                            {{subgroup.subgroupCuratorEmail}}
                            <i class="fa fa-envelope fa-fw"></i>
                        </a>
                        <br>
                        <label>Приватний чат:</label>
                        <a ng-href="<?= Config::getChatPath()?>{{subgroup.subgroupCuratorId}}" target="_blank">почати чат <i class="fa fa-wechat fa-fw"></i></a>
                    </li>
                    <li class="list-group-item">
                        <label>Інформація(розклад): </label><span ng-bind-html="subgroup.info | linky:'_blank'"></span>
                    </li>
                    <li ng-if="subgroup.trainer" class="list-group-item">
                        <label>Тренер:</label> <a ng-href="{{subgroup.trainerLink}}" target="_blank">{{subgroup.trainer}}</a>
                        <br>
                        <label>Написати повідомлення:</label>
                        <a ng-href="<?= Yii::app()->createUrl('/cabinet/#/newmessages/receiver/'); ?>{{subgroup.trainerId}}">
                            {{subgroup.trainerEmail}}
                            <i class="fa fa-envelope fa-fw"></i>
                        </a>
                        <br>
                        <label>Приватний чат:</label> 
                        <a ng-href="<?= Config::getChatPath()?>{{subgroup.trainerId}}" target="_blank">почати чат <i class="fa fa-wechat fa-fw"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
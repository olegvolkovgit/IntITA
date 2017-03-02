<?php
/**
 * @var $model RegisteredUser
 * @var $user StudentReg
 */
?>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="panel panel-default">
            <div class="panel-body">
                <h4>Проплачені модулі:</h4>
                <ul ng-if="data.modules.length!=0" class="list-group">
                    <li ng-repeat="module in data.modules track by $index" class="list-group-item">
                        <a ng-href="{{module.link}}" target="_blank">
                            {{module.title_ua}} ({{module.lang}})
                        </a>
                        <input type="number" hidden="hidden" id="moduleId" ng-value="{{module.id}}"/>
                        <?php if(Yii::app()->user->model->isAdmin()){?>
                            <a type="button" class="btn btn-outline btn-success btn-xs" ng-href="#/admin/users/user/{{data.user.id}}/agreement/module/{{module.id}}">
                                <em>договір</em>
                            </a>
                        <?php } ?>
                    </li>
                </ul>
                <em ng-if="data.modules.length==0">Модулів немає.</em>
            </div>
        </div>
    </div>
</div>
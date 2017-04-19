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
                <ul ng-if="studentAttributes.modules.length!=0" class="list-group">
                    <li ng-repeat="module in studentAttributes.modules track by $index" class="list-group-item">
                        <a ng-href="{{module.link}}" target="_blank">
                            {{module.title_ua}} ({{module.lang}}, {{module.name}})
                        </a>
                        <input type="number" hidden="hidden" id="moduleId" ng-value="{{module.id}}"/>
                    </li>
                </ul>
                <em ng-if="studentAttributes.modules.length==0">Модулів немає.</em>
            </div>
        </div>
    </div>
</div>
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
                    <li ng-repeat="service in studentAttributes.modules track by $index" class="list-group-item">
                        <a ng-href="{{service.link}}" target="_blank">
                            {{service.title_ua}} ({{service.lang}}, {{service.name}})
                        </a>
                        <input type="number" hidden="hidden" id="moduleId" ng-value="{{service.id}}"/>
                        <?php if (Yii::app()->user->model->isAccountant()) { ?>
                            <?php $this->renderPartial('_agreementBlock', array('model' =>$model,'service' =>'module'));?>
                        <?php } ?>
                    </li>
                </ul>
                <em ng-if="studentAttributes.modules.length==0">Модулів немає.</em>
            </div>
        </div>
    </div>
</div>
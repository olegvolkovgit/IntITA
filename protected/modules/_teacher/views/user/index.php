<?php
/**
 * @var $model RegisteredUser
 * @var $trainer StudentReg
 */
?>
<?php if (Yii::app()->user->model->isAdmin()) { ?>
    <ul class="list-inline">
        <li>
            <a type="button" class="btn btn-primary" ng-href="#/admin/users">
                Користувачі
            </a>
        </li>
    </ul>
<?php } ?>
<div class="panel panel-default" ng-controller="userProfileCtrl">
    <div class="panel-body">
        <uib-tabset>
            <uib-tab index="0" heading="Головне">
                <?php $this->renderPartial('_mainTab', array('model' =>$model, 'trainer' => $trainer));?>
            </uib-tab>
            <?php if (Yii::app()->user->model->isAdmin()){?>
            <uib-tab index="1" heading="Ролі користувача">
                <?php $this->renderPartial('_rolesTab', array('model' =>$model));?>
            </uib-tab>
            <?php }?>
            <?php if (Yii::app()->user->model->isAdmin() && $model->isStudent()){?>
                <uib-tab index="2" heading="Доступні курси">
                    <?php $this->renderPartial('_coursesTab');?>
                </uib-tab>
                <uib-tab index="3" heading="Доступні модулі">
                    <?php $this->renderPartial('_modulesTab');?>
                </uib-tab>
            <?php }?>
        </uib-tabset>
    </div>
</div>








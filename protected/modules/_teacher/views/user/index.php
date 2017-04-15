<div class="panel panel-default" ng-controller="userProfileCtrl">
    <div class="panel-body">
        <uib-tabset>
            <uib-tab index="0" heading="Головне">
                <?php $this->renderPartial('_mainTab', array('model' =>$model));?>
            </uib-tab>
<!--            --><?php //if (Yii::app()->user->model->isAdmin() || Yii::app()->user->model->isContentManager() && $model->isOrganizationTeacher()){?>
<!--            <uib-tab index="1" heading="Ролі користувача">-->
<!--                --><?php //$this->renderPartial('_rolesTab', array('model' =>$model));?>
<!--            </uib-tab>-->
<!--            --><?php //}?>
<!--            --><?php //if ($model->isStudent()){?>
<!--                <uib-tab index="2" heading="Доступні курси">-->
<!--                    --><?php //$this->renderPartial('_coursesTab');?>
<!--                </uib-tab>-->
<!--                <uib-tab index="3" heading="Доступні модулі">-->
<!--                    --><?php //$this->renderPartial('_modulesTab');?>
<!--                </uib-tab>-->
<!--            --><?php //}?>
        </uib-tabset>
    </div>
</div>








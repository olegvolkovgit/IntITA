<?php
/**
 * @var $model RegisteredUser
 * @var $trainer StudentReg
 */
?>
<div class="panel panel-default">
    <div class="panel-body">
        <uib-tabset>
            <uib-tab index="0" heading="Головне">
                <?php $this->renderPartial('_mainTab', array('model' =>$model, 'trainer' => $trainer));?>
            </uib-tab>
            <uib-tab index="1" heading="Ролі користувача">
                <?php $this->renderPartial('_rolesTab', array('model' =>$model));?>
            </uib-tab>
            <?php if ($model->isStudent()){?>
            <uib-tab index="2" heading="Курси">
                <?php $this->renderPartial('_coursesTab', array('model' =>$model));?>
            </uib-tab>
            <uib-tab index="3" heading="Модулі">
                <?php $this->renderPartial('_modulesTab', array('model' =>$model));?>
            </uib-tab>
            <?php }?>
        </uib-tabset>
    </div>
</div>








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
                <uib-tab index="2" heading="Проплачені курси">
                    <?php $this->renderPartial('_coursesTab');?>
                </uib-tab>
                <uib-tab index="3" heading="Проплачені модулі">
                    <?php $this->renderPartial('_modulesTab');?>
                </uib-tab>
            <?php }?>
        </uib-tabset>
    </div>
</div>








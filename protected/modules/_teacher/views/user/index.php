<?php
/**
 * @var $model RegisteredUser
 * @var $trainer StudentReg
 */
?>
<div class="panel panel-default">
    <div class="panel-body">
        <!-- Nav tabs -->
        <ul id="userTabs" class="nav nav-tabs">
            <li class="active">
                <a href="#mainTab" data-toggle="tab">Головне</a>
            </li>
            <li>
                <a href="#rolesTab" data-toggle="tab">Ролі користувача</a>
            </li>
            <?php if ($model->isStudent()){?>
            <li>
                <a href="#coursesTab" data-toggle="tab">Курси</a>
            </li>
            <li>
                <a href="#modulesTab" data-toggle="tab">Модулі</a>
            </li>
            <?php }?>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane fade in active" id="mainTab">
                <?php $this->renderPartial('_mainTab', array('model' =>$model, 'trainer' => $trainer));?>
            </div>
            <div class="tab-pane fade" id="rolesTab">
                <?php $this->renderPartial('_rolesTab', array('model' =>$model));?>
            </div>
            <?php if ($model->isStudent()){?>
            <div class="tab-pane fade" id="coursesTab">
                <?php $this->renderPartial('_coursesTab', array('model' =>$model));?>
            </div>
            <div class="tab-pane fade" id="modulesTab">
                <?php $this->renderPartial('_modulesTab', array('model' =>$model));?>
            </div>
            <?php }?>
        </div>
    </div>
</div>







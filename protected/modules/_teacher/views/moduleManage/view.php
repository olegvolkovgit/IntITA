<?php
/* @var $this ModuleManageController
 * @var $model Module
 * @var $courses array
 * @var $authors array
 * @var $teacherConsultants array
 */
?>
<div ng-controller="moduleManageCtrl">
    <ul class="list-inline">
        <li>
            <a type="button" class="btn btn-default" ng-click='back()'>
                Назад
            </a>
        </li>
        <?php if(Yii::app()->user->model->isContentManager()) { ?>
        <li>
            <a type="button" class="btn btn-primary" ng-href="#/module/edit/<?=$model->module_ID?>">
                Редагувати модуль
            </a>
        </li>
        <li>
            <a type="button" class="btn btn-success" ng-href="#/module/addAuthor/<?= $model->module_ID ?>">
                Призначити автора контента
            </a>
        </li>
        <li>
            <a type="button" class="btn btn-success" ng-href="#/module/addTeacherConsultant/<?= $model->module_ID ?>">
                Призначити викладача
            </a>
        </li>
        <?php } ?>
    </ul>

    <div class="panel panel-default">
        <div class="panel-body">
            <uib-tabset active="0" >
                <uib-tab  index="0" heading="Головне">
                    <?php $this->renderPartial('_mainTab', array('model' => $model));?>
                </uib-tab>
                <uib-tab  index="1" heading="Лекції">
                    <?php $this->renderPartial('_lecturesTab', array('model' => $model, 'scenario' => 'view'));?>
                </uib-tab>
                <uib-tab  index="2" heading="Автори">
                    <?php $this->renderPartial('_authorsTab', array('model' => $model, 'scenario' => 'view',
                        'teachers' => $authors));?>
                </uib-tab>
                <uib-tab  index="3" heading="Викладачі">
                    <?php $this->renderPartial('_consultantsTab', array('model' => $model, 'scenario' => 'view',
                        'teachers' => $teacherConsultants)); ?>
                </uib-tab>
                <uib-tab  index="4" heading="У курсах">
                    <?php $this->renderPartial('_inCoursesTab', array(
                        'model' => $model,
                        'scenario' => 'view',
                        'courses' => $courses
                    ));?>
                </uib-tab>
            </uib-tabset>
        </div>
    </div>
</div>
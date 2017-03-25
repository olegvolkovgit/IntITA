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
            <button type="button" class="btn btn-primary" ui-sref="modules">
                Список модулів
            </button>
        </li>
        <?php if(Yii::app()->user->model->isContentManager()) { ?>
        <li>
            <button type="button" class="btn btn-primary" ng-click="changeView('module/edit/<?=$model->module_ID?>')">
                Редагувати модуль
            </button>
        </li>
        <li>
            <button type="button" class="btn btn-success" ng-click="changeView('module/addAuthor/<?= $model->module_ID ?>')">
                Призначити автора контента
            </button>
        </li>
        <li>
            <button type="button" class="btn btn-success" ng-click="changeView('module/addTeacherConsultant/<?= $model->module_ID ?>')">
                Призначити викладача
            </button>
        </li>
        <?php } ?>
    </ul>

    <div class="panel panel-default">
        <div class="panel-body">
            <uib-tabset active="0" >
                <uib-tab  index="0" heading="Головне">
                    <?php $this->renderPartial('_mainTab', array('model' => $model));?>
                </uib-tab>
                <uib-tab index="1" heading="Українською">
                    <?php $this->renderPartial('_uaTab', array('model' => $model));?>
                </uib-tab>
                <uib-tab  index="2" heading="Російською">
                    <?php $this->renderPartial('_ruTab', array('model' => $model));?>
                </uib-tab>
                <uib-tab  index="3" heading="Англійською">
                    <?php $this->renderPartial('_enTab', array('model' => $model));?>
                </uib-tab>
                <uib-tab  index="4" heading="Лекції">
                    <?php $this->renderPartial('_lecturesTab', array('model' => $model, 'scenario' => 'view'));?>
                </uib-tab>
                <uib-tab  index="5" heading="Автори">
                    <?php $this->renderPartial('_authorsTab', array('model' => $model, 'scenario' => 'view',
                        'teachers' => $authors));?>
                </uib-tab>
                <uib-tab  index="6" heading="Викладачі">
                    <?php $this->renderPartial('_consultantsTab', array('model' => $model, 'scenario' => 'view',
                        'teachers' => $teacherConsultants)); ?>
                </uib-tab>
                <uib-tab  index="7" heading="У курсах">
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
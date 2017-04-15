<?php
/**
 * @var $levels array
 * @var $model Module
 * @var $courses array
 * @var $teachers array
 * @var $teacherConsultants array
 */
?>
<div ng-controller="moduleManageCtrl">
    <ul class="list-inline">
        <li>
            <a type="button" class="btn btn-primary"  ng-href="#/organization/modules">
                Список модулів
            </a>
        </li>
        <li>
            <a type="button" class="btn btn-primary" ng-href="#/module/id/<?= $model->module_ID ?>">
                Переглянути модуль
            </a>
        </li>
        <li>
            <button type="button" class="btn btn-primary" ng-click="changeStatus('<?= $model->module_ID ?>','<?= ($model->isCancelled()) ? "restore" : "delete"; ?>')">
                <?= ($model->isCancelled()) ? 'Відновити' : 'Видалити'; ?>
            </button>
        </li>
        <li>
            <a type="button" class="btn btn-success" ng-href="#/module/addAuthor/<?= $model->module_ID ?>">
                Призначити автора
            </a>
        </li>
        <li>
            <a type="button" class="btn btn-success" ng-href="#/module/addTeacherConsultant/<?= $model->module_ID ?>">
                Призначити викладача
            </a>
        </li>
        <?php if(Yii::app()->user->model->isContentManager()) { ?>
            <li>
                <a href="<?php echo Yii::app()->createUrl('/moduleRevision/moduleRevisions', array('idModule' => $model->module_ID)); ?>" class="btn btn-primary">Ревізії модуля</a>
            </li>
        <?php } ?>
    </ul>
    <div class="panel panel-default">
        <div class="panel-body">

            <div class="form">
                <?php $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'module-form',
                    'action' => Yii::app()->createUrl('/_teacher/moduleManage/update', array('id' => $model->module_ID)),
                    'htmlOptions' => array(
                        'class' => 'formatted-form',
                        'enctype' => 'multipart/form-data',
                        'ng-submit'=>"checkTags()",
                        'moduleid'=>$model->module_ID
                    ),
                    'enableAjaxValidation' => true,
                    'enableClientValidation' => false,
                    'clientOptions' => array(
                        'validateOnSubmit' => true,
                        'validateOnChange' => true,
                        'afterValidate' => 'js:function(form,data,hasError){
                     if(moduleValidation(data,hasError)){
                        moduleUpdate(form[0].action,form[0].getAttribute("moduleid"));
                    };
                    return false;
            }'),
                )); ?>
                <uib-tabset active="0" >
                    <uib-tab  index="0" heading="Головне" id="mainTab">
                        <?php $this->renderPartial('_mainEditTab', array('model' => $model, 'form' => $form)); ?>
                    </uib-tab>
                    <uib-tab  index="1" heading="Лекції">
                        <?php $this->renderPartial('_lecturesTab', array('model' => $model, 'scenario' => 'update'));?>
                    </uib-tab>
                    <uib-tab  index="2" heading="Автори">
                        <?php $this->renderPartial('_authorsTab', array('model' => $model, 'scenario' => 'update',
                            'teachers' => $authors));?>
                    </uib-tab>
                    <uib-tab  index="3" heading="Викладачі">
                        <?php $this->renderPartial('_consultantsTab', array('model' => $model, 'scenario' => 'update',
                            'teachers' => $teacherConsultants)); ?>
                    </uib-tab>
                    <uib-tab  index="4" heading="У курсах">
                        <?php $this->renderPartial('_inCoursesTab', array(
                            'model' => $model,
                            'scenario' => 'update',
                            'courses' => $courses
                        ));?>
                    </uib-tab>
                </uib-tabset>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>
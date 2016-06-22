<?php
/**
 * @var $levels array
 * @var $model Module
 * @var $courses array
 * @var $teachers array
 * @var $consultants array
 */
?>
<ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/module/index'); ?>',
                    'Модулі')">
            Список модулів
        </button>
    </li>
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/module/view',
                    array('id' => $model->module_ID)); ?>', '<?= "Модуль " . $model->getTitle(); ?>')">Переглянути
            модуль
        </button>
    </li>
    <li>
        <button type="button" class="btn btn-primary"
                <?php  if($model->isCancelled()){?>
                onclick="performOperationWithConfirm('<?php echo Yii::app()->createUrl("/_teacher/_admin/module/restore",
                    array("id" => $model->module_ID)); ?>', 'Відновити модуль?')"
                <?php } else {?>
                onclick="performOperationWithConfirm('<?php echo Yii::app()->createUrl("/_teacher/_admin/module/delete",
                        array("id" => $model->module_ID)); ?>', 'Видалити модуль?')"
                <?php }?>>
            <?= ($model->isCancelled()) ? 'Відновити' : 'Видалити'; ?></button>
    </li>
    <li>
        <button type="button" class="btn btn-success"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/module/addTeacher', array('id' => $model->module_ID)); ?>',
                    'Призначити автора модуля')">
            Призначити автора
        </button>
    </li>
    <li>
        <button type="button" class="btn btn-success"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/module/addConsultant', array('id' => $model->module_ID)); ?>',
                    'Призначити консультанта для модуля')">
            Призначити консультанта
        </button>
    </li>
    <li>
        <a href="<?php echo Yii::app()->createUrl('/moduleRevision/moduleRevisions', array('idModule' => $model->module_ID)); ?>" class="btn btn-primary">Ревізії модуля</a>
    </li>
</ul>
<div class="panel panel-default">
    <div class="panel-body">
        <!-- Nav tabs -->
        <ul id="editModuleTabs" class="nav nav-tabs moduleTabs">
            <li class="active"><a href="#main" data-toggle="tab">Головне</a>
            </li>
            <li><a href="#ua" data-toggle="tab">Українською</a>
            </li>
            <li><a href="#ru" data-toggle="tab">Російською</a>
            </li>
            <li><a href="#en" data-toggle="tab">Англійською</a>
            </li>
            <li><a href="#lectures" data-toggle="tab">Лекції</a>
            </li>
            <li><a href="#authors" data-toggle="tab">Автори</a>
            </li>
            <li><a href="#consultants" data-toggle="tab">Консультанти</a>
            </li>
            <li><a href="#inCourses" data-toggle="tab">У курсах</a>
            </li>
        </ul>
        <!-- Tab panes -->
        <div class="form">
            <?php $form = $this->beginWidget('CActiveForm', array(
                'id' => 'module-form',
                'action' => Yii::app()->createUrl('/_teacher/_admin/module/update', array('id' => $model->module_ID)),
                'htmlOptions' => array(
                    'class' => 'formatted-form',
                    'enctype' => 'multipart/form-data'
                ),
                'enableAjaxValidation' => true,
                'enableClientValidation' => false,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                    'validateOnChange' => true,
                    'afterValidate' => 'js:function(form,data,hasError){
                        if(moduleValidation(data,hasError)){
                            moduleUpdate(form[0].action);
                        };
                        return false;
                }'),
            )); ?>
            <div class="tab-content">
                <div class="tab-pane fade in active" id="main">
                    <?php $this->renderPartial('_mainEditTab', array('model' => $model, 'form' => $form)); ?>
                </div>
                <div class="tab-pane fade" id="ua">
                    <?php $this->renderPartial('_uaEditTab', array('model' => $model, 'form' => $form)); ?>
                </div>
                <div class="tab-pane fade" id="ru">
                    <?php $this->renderPartial('_ruEditTab', array('model' => $model, 'form' => $form)); ?>
                </div>
                <div class="tab-pane fade" id="en">
                    <?php $this->renderPartial('_enEditTab', array('model' => $model, 'form' => $form)); ?>
                </div>
                <div class="tab-pane fade" id="lectures">
                    <?php $this->renderPartial('_lecturesTab', array('model' => $model, 'scenario' => 'update')); ?>
                </div>
                <div class="tab-pane fade" id="authors">
                    <?php $this->renderPartial('_authorsTab', array('model' => $model, 'scenario' => 'update',
                        'teachers' => $teachers)); ?>
                </div>
                <div class="tab-pane fade" id="consultants">
                    <?php $this->renderPartial('_consultantsTab', array('model' => $model, 'scenario' => 'update',
                        'teachers' => $consultants)); ?>
                </div>
                <div class="tab-pane fade" id="inCourses">
                    <?php $this->renderPartial('_inCoursesTab', array(
                        'model' => $model,
                        'scenario' => 'update',
                        'courses' => $courses
                    )); ?>
                </div>
            </div>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>
<script>
    $jq(document).ready(function () {
        if(history.state!=null)
            openTab('#editModuleTabs', history.state.tab);
    });
</script>



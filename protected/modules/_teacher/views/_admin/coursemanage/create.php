<?php
/* @var $this CoursemanageController */
/* @var $model Course */
?>
<ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl("/_teacher/_admin/coursemanage/index"); ?>',
                    'Курси')">
            <?php echo Yii::t("coursemanage", "0392"); ?></button>
    </li>
</ul>

<div class="panel panel-default">
    <?php if(Yii::app()->user->hasFlash('success')):?>
        <div class="alert alert-success">
            <?php echo Yii::app()->user->getFlash('success'); ?>
        </div>
    <?php endif; ?>
    <?php if(Yii::app()->user->hasFlash('error')):?>
        <div class="alert alert-danger">
        <?php echo Yii::app()->user->getFlash('error'); ?>
        </div>
    <?php endif; ?>
    <div class="panel-body">
        <!-- Nav tabs -->
        <ul id="createCourseTabs" class="nav nav-tabs">
            <li class="active"><a href="#main" data-toggle="tab">Головне</a>
            </li>
            <li><a href="#ua" data-toggle="tab">Українською</a>
            </li>
            <li><a href="#ru" data-toggle="tab">Російською</a>
            </li>
            <li><a href="#en" data-toggle="tab">Англійською</a>
            </li>
        </ul>
        <!-- Tab panes -->
        <div class="form">
            <?php $form = $this->beginWidget('CActiveForm', array(
                'id' => 'course-form',
                'action'=>Yii::app()->createUrl('/_teacher/_admin/coursemanage/create'),
                'htmlOptions' => array(
                    'class' => 'formatted-form',
                    'enctype' => 'multipart/form-data',
                ),
                'enableAjaxValidation' => false,
                'enableClientValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                    'validateOnChange' => true,
                    'afterValidate' => 'js:function(form,data,hasError){
                        if(courseValidation(data,hasError)){
                            courseCreate(form[0].action);
                        };
                        return false;
                }'),
            )); ?>
            <div class="tab-content">
                <div class="tab-pane fade in active" id="main">
                    <?php $this->renderPartial('_mainEditTab', array('model' => $model, 'form' => $form,
                        'scenario' => 'create')); ?>
                </div>
                <div class="tab-pane fade" id="ua">
                    <?php $this->renderPartial('_uaEditTab', array('model' => $model, 'scenario' => 'create',
                        'form' => $form)); ?>
                </div>
                <div class="tab-pane fade" id="ru">
                    <?php $this->renderPartial('_ruEditTab', array('model' => $model, 'scenario' => 'create',
                        'form' => $form)); ?>
                </div>
                <div class="tab-pane fade" id="en">
                    <?php $this->renderPartial('_enEditTab', array('model' => $model, 'scenario' => 'create',
                        'form' => $form)); ?>
                </div>
            </div>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>
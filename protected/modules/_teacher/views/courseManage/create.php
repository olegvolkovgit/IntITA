<?php
/* @var $this CoursemanageController */
/* @var $model Course */
?>
<ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary"
                ng-click="changeView('admin/coursemanage')">
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
                         courseActions(form[0].action);
                    }
                    return false;
                }'),
            )); ?>
            <uib-tabset active="0" >
                <uib-tab  index="0" heading="Головне" id="mainTab">
                    <?php $this->renderPartial('_mainEditTab', array('model' => $model,
                        'scenario' => 'create', 'form' => $form)); ?>
                </uib-tab>
                <uib-tab index="1" heading="Українською" id="uaTab">
                    <?php $this->renderPartial('_uaEditTab', array('model' => $model, 'scenario' => 'create',
                        'form' => $form)); ?>
                </uib-tab>
                <uib-tab  index="2" heading="Російською" id="ruTab">
                    <?php $this->renderPartial('_ruEditTab', array('model' => $model, 'scenario' => 'create'
                    , 'form' => $form)); ?>
                </uib-tab>
                <uib-tab  index="3" heading="Англійською" id="enTab">
                    <?php $this->renderPartial('_enEditTab', array('model' => $model, 'scenario' => 'create'
                    , 'form' => $form)); ?>
                </uib-tab>
            </uib-tabset>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>
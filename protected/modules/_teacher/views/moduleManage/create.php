<?php
/* @var $this ModuleManageController
 * @var $model Module
 */
?>
<ul class="list-inline">
    <li>
        <a type="button" class="btn btn-primary" ng-href="#/organization/modules">
            Всі модулі
        </a>
    </li>
</ul>
<div class="panel panel-default" ng-controller="moduleManageCtrl">
    <div class="panel-body">
        <div class="form">
            <?php $form = $this->beginWidget('CActiveForm', array(
                'id' => 'module-form',
                'action' => Yii::app()->createUrl('/_teacher/moduleManage/create'),
                'htmlOptions' => array(
                    'class' => 'formatted-form',
                    'enctype' => 'multipart/form-data',
                    'ng-submit'=>"checkTags()"
                ),
                'enableAjaxValidation' => true,
                'enableClientValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                    'validateOnChange' => true,
                    'afterValidate' => 'js:function(form,data,hasError){
                       if(moduleValidation(data,hasError)){
                            moduleCreate(form[0].action);
                        };
                        return false;
                }'),
            )); ?>
            <uib-tabset active="0" >
                <uib-tab  index="0" heading="Головне" id="mainTab">
                    <?php $this->renderPartial('_mainEditTab', array('model' => $model, 'form' => $form)); ?>
                </uib-tab>
            </uib-tabset>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>

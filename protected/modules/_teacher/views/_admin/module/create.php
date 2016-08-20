<?php
/* @var $this ModuleController
 * @var $model Module
 */
?>
<ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary" ng-click="changeView('modulemanage')">
            Всі модулі
        </button>
    </li>
</ul>
<div class="panel panel-default" ng-controller="modulemanageCtrl">
    <div class="panel-body">
        <div class="form">
            <?php $form = $this->beginWidget('CActiveForm', array(
                'id' => 'module-form',
                'action' => Yii::app()->createUrl('/_teacher/_admin/module/create'),
                'htmlOptions' => array(
                    'class' => 'formatted-form',
                    'enctype' => 'multipart/form-data',
                    'ng-submit'=>"checkTags()"
                ),
                'enableAjaxValidation' => false,
                'enableClientValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                    'validateOnChange' => true,
                    'afterValidate' => 'js:function(form,data,hasError){
                        if(!hasError){
                            moduleCreate(form[0].action);
                        }
                        else{
                        bootbox.alert("Модуль не вдалося створити. Перевірте вхідні дані або зверніться до адміністратора.");
                        }
                        return false;
                }'),
            )); ?>
            <uib-tabset active="0" >
                <uib-tab  index="0" heading="Головне" id="main">
                    <?php $this->renderPartial('_mainEditTab', array('model' => $model, 'form' => $form)); ?>
                </uib-tab>
                <uib-tab index="1" heading="Українською">
                    <?php $this->renderPartial('_uaEditTab', array('model' => $model, 'form' => $form)); ?>
                </uib-tab>
                <uib-tab  index="2" heading="Російською">
                    <?php $this->renderPartial('_ruEditTab', array('model' => $model, 'form' => $form)); ?>
                </uib-tab>
                <uib-tab  index="3" heading="Англійською">
                    <?php $this->renderPartial('_enEditTab', array('model' => $model, 'form' => $form)); ?>
                </uib-tab>
            </uib-tabset>

            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>

<?php
/* @var $this CoursemanageController *
 * @var $model Course
 * @var $modules array
 * @var $linkedCourses array
 */
?>
<div ng-controller="coursemanageCtrl">
    <ul class="list-inline">
        <li>
            <a type="button" class="btn btn-primary" ng-href="#/admin/coursemanage">
                <?php echo Yii::t("coursemanage", "0510"); ?>
            </a>
        </li>
        <li>
            <a type="button" class="btn btn-primary" ng-href="#/course/id/<?= $model->course_ID ?>">
                Переглянути курс
            </a>
        </li>
        <li>
            <button type="button" class="btn btn-primary" ng-click="changeCourse('<?php echo $model->course_ID ?>')">
                <?= ($model->isActive()) ? 'Видалити' : 'Відновити'; ?>
            </button>
        </li>
        <li>
            <a type="button" class="btn btn-success" ng-href="#/course/schema/<?php echo $model->course_ID ?>">
                Згенерувати схему курсу
            </a>
        </li>
    </ul>

    <div class="panel panel-default">
        <div class="panel-body">
            <div class="form">
                <?php $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'course-form',
                    'action'=>Yii::app()->createUrl('/_teacher/courseManage/update', array('id' => $model->course_ID)),
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
                }')
                )); ?>
                <uib-tabset active="tab" >
                    <uib-tab  index="0" heading="Головне" id="mainTab">
                        <?php $this->renderPartial('_mainEditTab', array('model' => $model,
                            'scenario' => 'update', 'form' => $form)); ?>
                    </uib-tab>
                    <uib-tab index="1" heading="Українською" id="uaTab">
                        <?php $this->renderPartial('_uaEditTab', array('model' => $model, 'scenario' => 'update',
                            'form' => $form)); ?>
                    </uib-tab>
                    <uib-tab  index="2" heading="Російською" id="ruTab">
                        <?php $this->renderPartial('_ruEditTab', array('model' => $model, 'scenario' => 'update'
                        , 'form' => $form)); ?>
                    </uib-tab>
                    <uib-tab  index="3" heading="Англійською" id="enTab">
                        <?php $this->renderPartial('_enEditTab', array('model' => $model, 'scenario' => 'update'
                        , 'form' => $form)); ?>
                    </uib-tab>
                    <uib-tab  index="4" heading="Модулі">
                        <?php $this->renderPartial('_modulesTab', array(
                            'model' => $model,
                            'modules' => $modules,
                            'scenario' => 'update'
                        )); ?>
                    </uib-tab>
                    <uib-tab  index="5" heading="На інших мовах" id="other">
                        <?php $this->renderPartial('_otherTab', array(
                            'model' => $model,
                            'scenario' => 'update',
                            'linkedCourses' => $linkedCourses
                        )); ?>
                    </uib-tab>
                </uib-tabset>
                <?php $this->endWidget(); ?>
            </div>
        </div>
</div>
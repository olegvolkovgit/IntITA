<?php
/* @var $this CoursemanageController *
 * @var $model Course
 * @var $modules array
 * @var $linkedCourses array
 */
?>

<ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary" ng-click="changeView('admin/coursemanage')">
            <?php echo Yii::t("coursemanage", "0510"); ?></button>
    </li>
    <li>
        <button type="button" class="btn btn-primary" ng-click="changeView('course/detail/<?= $model->course_ID ?>')">
            Переглянути курс
        </button>
    </li>
    <li>
        <button type="button" class="btn btn-primary" ng-click="changeCourse('<?php echo $model->course_ID ?>')">
            <?= ($model->isActive()) ? 'Видалити' : 'Відновити'; ?></button>
    </li>
    <li>
        <button type="button" class="btn btn-success" ng-click="changeView('course/schema/<?php echo $model->course_ID ?>')"
                >
            Згенерувати схему курса
        </button>
    </li>
</ul>

<div class="panel panel-default">
    <div class="panel-body">
        <div class="form"  ng-controller="coursemanageCtrl">
            <?php $form = $this->beginWidget('CActiveForm', array(
                'id' => 'course-form',
                'action'=>Yii::app()->createUrl('/_teacher/_admin/coursemanage/update', array('id' => $model->course_ID)),
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
                    if(!hasError){
                         courseActions(form[0].action);
                    }
                    else{
                    bootbox.alert("Інформацію про курс не вдалося оновити. Перевірте вхідні дані або зверніться до адміністратора.");
                    }
                        return false;
                }')
            )); ?>
            <uib-tabset active="0" >
                <uib-tab  index="0" heading="Головне" id="main">
                    <?php $this->renderPartial('_mainEditTab', array('model' => $model,
                        'scenario' => 'update', 'form' => $form)); ?>
                </uib-tab>
                <uib-tab index="1" heading="Українською">
                    <?php $this->renderPartial('_uaEditTab', array('model' => $model, 'scenario' => 'update',
                        'form' => $form)); ?>
                </uib-tab>
                <uib-tab  index="2" heading="Російською">
                    <?php $this->renderPartial('_ruEditTab', array('model' => $model, 'scenario' => 'update'
                    , 'form' => $form)); ?>
                </uib-tab>
                <uib-tab  index="3" heading="Англійською">
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



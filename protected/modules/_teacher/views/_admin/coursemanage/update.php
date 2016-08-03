<?php
/* @var $this CoursemanageController *
 * @var $model Course
 * @var $modules array
 * @var $linkedCourses array
 */
?>
<ul class="list-inline" ng-controller="coursemanageCtrl">
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
        <!-- Nav tabs -->
        <ul id="editCourseTabs" class="nav nav-tabs courseTabs">
            <li class="active"><a href="#main" data-toggle="tab">Головне</a>
            </li>
            <li><a href="#ua" data-toggle="tab">Українською</a>
            </li>
            <li><a href="#ru" data-toggle="tab">Російською</a>
            </li>
            <li><a href="#en" data-toggle="tab">Англійською</a>
            </li>
            <li><a href="#modules" data-toggle="tab">Модулі</a>
            </li>
            <li><a href="#other" data-toggle="tab">На інших мовах</a>
            </li>
        </ul>
        <div class="form">
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
                        if(courseValidation(data,hasError)){
                            courseUpdate(form[0].action);
                        };
                        return false;
                }'),
            )); ?>
            <div class="tab-content">
                <div class="tab-pane fade in active" id="main">
                    <?php $this->renderPartial('_mainEditTab', array('model' => $model,
                        'scenario' => 'update', 'form' => $form)); ?>
                </div>
                <div class="tab-pane fade" id="ua">
                    <?php $this->renderPartial('_uaEditTab', array('model' => $model, 'scenario' => 'update',
                        'form' => $form)); ?>
                </div>
                <div class="tab-pane fade" id="ru">
                    <?php $this->renderPartial('_ruEditTab', array('model' => $model, 'scenario' => 'update'
                    , 'form' => $form)); ?>
                </div>
                <div class="tab-pane fade" id="en">
                    <?php $this->renderPartial('_enEditTab', array('model' => $model, 'scenario' => 'update'
                    , 'form' => $form)); ?>
                </div>
                <div class="tab-pane fade" id="modules">
                    <?php $this->renderPartial('_modulesTab', array(
                        'model' => $model,
                        'modules' => $modules,
                        'scenario' => 'update'
                    )); ?>
                </div>
                <div class="tab-pane fade" id="other" style="width: 100%">
                    <?php $this->renderPartial('_otherTab', array(
                        'model' => $model,
                        'scenario' => 'update',
                        'linkedCourses' => $linkedCourses
                    )); ?>
                </div>
            </div>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>
<script>
    if(history.state!=null)
        openTab('#editCourseTabs', history.state.tab);
</script>



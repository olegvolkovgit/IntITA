<?php
/* @var $this CoursemanageController
 * @var $model Course
 * @var $modules array
 * @var $linkedCourses array
 */
?>
<div class="col-md-12">
    <div class="row">
        <ul class="list-inline">
            <li>
                <button type="button" class="btn btn-primary" ng-click="changeView('admin/coursemanage')">
                    <?php echo Yii::t("coursemanage", "0510"); ?></button>
            </li>
            <li>

                <button type="button" class="btn btn-primary" ng-click="changeView('course/edit/<?php echo $model->course_ID; ?>')"
                        >
                    Редагувати курс
                </button>
            </li>
            <li>
                <button type="button" class="btn btn-success" ng-click="changeView('course/schema/<?php echo $model->course_ID; ?>')"
>
                    Згенерувати схему курса
                </button>
            </li>
        </ul>
        <div class="panel panel-default">
            <div class="panel-body">
                <!-- Nav tabs -->
                <ul id="courseView" class="nav nav-tabs">
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
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="main">
                        <?php $this->renderPartial('_mainTab', array('model' => $model)); ?>
                    </div>
                    <div class="tab-pane fade" id="ua">
                        <?php $this->renderPartial('_uaTab', array('model' => $model)); ?>
                    </div>
                    <div class="tab-pane fade" id="ru">
                        <?php $this->renderPartial('_ruTab', array('model' => $model)); ?>
                    </div>
                    <div class="tab-pane fade" id="en">
                        <?php $this->renderPartial('_enTab', array('model' => $model)); ?>
                    </div>
                    <div class="tab-pane fade" id="modules">
                        <?php $this->renderPartial('_modulesTab', array(
                            'model' => $model,
                            'modules' => $modules,
                            'scenario' => 'view'
                        )); ?>
                    </div>
                    <div class="tab-pane fade" id="other">
                        <?php $this->renderPartial('_otherTab', array(
                            'model' => $model,
                            'linkedCourses' => $linkedCourses,
                            'scenario' => 'view'
                        )); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

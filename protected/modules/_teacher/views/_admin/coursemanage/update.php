<?php
/* @var $this CoursemanageController *
 * @var $model Course
 * @var $levels array
 */
?>
<ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/coursemanage/index'); ?>')">
            <?php echo Yii::t("coursemanage", "0510"); ?></button>
    </li>
    <li>
        <button type="button" class="btn btn-success"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/coursemanage/schema',
                    array('idCourse' => $model->course_ID)); ?>')">
            Згенерувати схему курса
        </button>
    </li>
</ul>

<div class="panel panel-default">
    <div class="panel-body">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs">
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
        <div class="tab-content">
            <div class="tab-pane fade in active" id="main">
                <?php $this->renderPartial('_mainEditTab', array('model' => $model, 'levels' => $levels, 'scenario' => 'update')); ?>
            </div>
            <div class="tab-pane fade" id="ua">
                <?php $this->renderPartial('_uaEditTab', array('model' => $model, 'scenario' => 'update')); ?>
            </div>
            <div class="tab-pane fade" id="ru">
                <?php $this->renderPartial('_ruEditTab', array('model' => $model, 'scenario' => 'update')); ?>
            </div>
            <div class="tab-pane fade" id="en">
                <?php $this->renderPartial('_enEditTab', array('model' => $model, 'scenario' => 'update')); ?>
            </div>
        </div>
    </div>
</div>

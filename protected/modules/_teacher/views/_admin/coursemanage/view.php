<?php
/* @var $this CoursemanageController */
/* @var $model Course */
?>
<div class="col-md-12">
    <div class="row">
        <ul class="list-inline">
            <li>
                <button type="button" class="btn btn-primary"
                        onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/coursemanage/index'); ?>')">
                    <?php echo Yii::t("coursemanage", "0510"); ?></button>
            </li>
            <li>
                <button type="button" class="btn btn-primary"
                        onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/coursemanage/update',
                            array('id' => $model->course_ID)); ?>')">
                    Редагувати курс
                </button>
            </li>
            <li>
                <button type="button" class="btn btn-primary"
                        onclick="setCourseStatus('<?php echo Yii::app()->createUrl("/_teacher/_admin/coursemanage/changeStatus",
                            array("id" => $model->course_ID)); ?>', '<?= ($model->isActive()) ? 'Видалити курс?' : 'Відновити курс?'; ?>')">
                    <?= ($model->isActive()) ? 'Видалити' : 'Відновити'; ?></button>
            </li>
            <li>
                <button type="button" class="btn btn-primary"
                        onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/coursemanage/addExistModule', array(
                            'id' => $model->course_ID
                        )); ?>',
                            'Додати існуючий модуль до курса')">
                    Додати існуючий модуль до курса</button>
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
                </div>
            </div>
        </div>
    </div>
</div>
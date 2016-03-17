<?php
/**
 * @var $levels array
 * @var $model Module
 * @var $courses array
 */
?>
<ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/module/index'); ?>',
                    'Модулі')">
            Список модулів
        </button>
    </li>
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/module/view',
                    array('id' => $model->module_ID)); ?>', '<?= "Модуль " . $model->getTitle(); ?>')">Переглянути
            модуль
        </button>
    </li>
    <li>
        <button type="button" class="btn btn-success"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/module/addTeacher', array('id' => $model->module_ID)); ?>',
                    'Призначити автора модуля')">
            Призначити автора
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
            <li><a href="#lectures" data-toggle="tab">Лекції</a>
            </li>
            <li><a href="#authors" data-toggle="tab">Автори</a>
            </li>
            <li><a href="#inCourses" data-toggle="tab">У курсах</a>
            </li>
        </ul>
        <!-- Tab panes -->
        <form class="form-horizontal" role="form" name="moduleForm" id="moduleForm" method="post"
              action="<?= Yii::app()->createUrl("/_teacher/_admin/module/newModule") ?>">
            <div class="tab-content">
                <div class="tab-pane fade in active" id="main">
                    <?php $this->renderPartial('_mainEditTab', array('model' => $model, 'levels' => $levels)); ?>
                </div>
                <div class="tab-pane fade" id="ua">
                    <?php $this->renderPartial('_uaEditTab', array('model' => $model)); ?>
                </div>
                <div class="tab-pane fade" id="ru">
                    <?php $this->renderPartial('_ruEditTab', array('model' => $model)); ?>
                </div>
                <div class="tab-pane fade" id="en">
                    <?php $this->renderPartial('_enEditTab', array('model' => $model)); ?>
                </div>
                <div class="tab-pane fade" id="lectures">
                    <?php $this->renderPartial('_lecturesTab', array('model' => $model, 'scenario' => 'update')); ?>
                </div>
                <div class="tab-pane fade" id="authors">
                    <?php $this->renderPartial('_authorsTab', array('model' => $model, 'scenario' => 'update')); ?>
                </div>
                <div class="tab-pane fade" id="inCourses">
                    <?php $this->renderPartial('_inCoursesTab', array(
                        'model' => $model,
                        'scenario' => 'update',
                        'courses' => $courses
                    )); ?>
                </div>
            </div>
        </form>
    </div>
</div>


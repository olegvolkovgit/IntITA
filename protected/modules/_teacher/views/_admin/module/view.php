<?php
/* @var $this ModuleController
 * @var $model Module
 * @var $courses array
 * @var $teachers array
 * @var $consultants array
 */
?>
    <div class="row">
        <ul class="list-inline">
            <li>
                <button type="button" class="btn btn-primary"
                        onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/module/index'); ?>', 'Модулі')">
                    Список модулів
                </button>
            </li>
            <li>
                <button type="button" class="btn btn-primary"
                        onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/module/update',
                            array('id' => $model->module_ID)); ?>', '<?='Модуль '.addslashes($model->title_ua);?>')">Редагувати модуль
                </button>
            </li>
            <li>
                <button type="button" class="btn btn-success"
                        onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/module/addTeacher', array('id' => $model->module_ID)); ?>',
                            'Призначити автора модуля')">
                    Призначити автора
                </button>
            </li>
            <li>
                <button type="button" class="btn btn-success"
                        onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/module/addConsultant', array('id' => $model->module_ID)); ?>',
                            'Призначити консультанта для модуля')">
                    Призначити консультанта
                </button>
            </li>
        </ul>
    </div>

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
            <li><a href="#consultants" data-toggle="tab">Консультанти</a>
            </li>
            <li><a href="#inCourses" data-toggle="tab">У курсах</a>
            </li>
         </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane fade in active" id="main">
                <?php $this->renderPartial('_mainTab', array('model' => $model));?>
            </div>
            <div class="tab-pane fade" id="ua">
                <?php $this->renderPartial('_uaTab', array('model' => $model));?>
            </div>
            <div class="tab-pane fade" id="ru">
                <?php $this->renderPartial('_ruTab', array('model' => $model));?>
            </div>
            <div class="tab-pane fade" id="en">
                <?php $this->renderPartial('_enTab', array('model' => $model));?>
            </div>
            <div class="tab-pane fade" id="lectures">
                <?php $this->renderPartial('_lecturesTab', array('model' => $model, 'scenario' => 'view'));?>
            </div>
            <div class="tab-pane fade" id="authors">
                <?php $this->renderPartial('_authorsTab', array('model' => $model, 'scenario' => 'view',
                    'teachers' => $teachers));?>
            </div>
            <div class="tab-pane fade" id="consultants">
                <?php $this->renderPartial('_consultantsTab', array('model' => $model, 'scenario' => 'view',
                    'teachers' => $consultants)); ?>
            </div>
            <div class="tab-pane fade" id="inCourses">
                <?php $this->renderPartial('_inCoursesTab', array(
                    'model' => $model,
                    'scenario' => 'view',
                    'courses' => $courses
                ));?>
            </div>
        </div>
    </div>
</div>


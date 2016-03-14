<?php
/**
 * @var $levels array
 * @var $model Module
 */
?>
<ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/module/index'); ?>',
                    'Модулі')">
            Список модулів</button>
    </li>
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/module/mandatory', array('id' => $model->module_ID)); ?>',
                    'Додати попередній модуль у курсі')">Додати попередній модуль у курсі</button>
    </li>
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/module/coursePrice',
                    array('id' => $model->module_ID)); ?>',
                    'Додати/змінити ціну модуля у курсі')">Додати/змінити ціну модуля у курсі</button>
    </li>
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/module/view',
                    array('id' => $model->module_ID)); ?>',
                    'Модуль #<?php echo $model->module_number . " " . $model->title_ua; ?>')">
            Переглянути модуль</button>
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
                <?php $this->renderPartial('_mainEditTab', array('model' => $model, 'levels' => $levels));?>
            </div>
            <div class="tab-pane fade" id="ua">
                <?php $this->renderPartial('_uaEditTab', array('model' => $model));?>
            </div>
            <div class="tab-pane fade" id="ru">
                <?php $this->renderPartial('_ruEditTab', array('model' => $model));?>
            </div>
            <div class="tab-pane fade" id="en">
                <?php $this->renderPartial('_enEditTab', array('model' => $model));?>
            </div>
        </div>
    </div>
</div>


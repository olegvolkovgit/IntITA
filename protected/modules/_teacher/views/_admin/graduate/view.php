<?php
/* @var $this GraduateController */
/* @var $model Graduate */
?>
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'adminGraduate.css'); ?>"/>

<ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/graduate/index'); ?>',
                    'Список випускників')">
            Список випускників</button>
    </li>
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/graduate/update', array('id' => $model->id)); ?>',
                    '<?="Випускник ".addslashes($model->first_name." ".$model->last_name) ?>')">
            Редагувати</button>
    </li>
    <li>
        <button type="button" class="btn btn-primary"
                onclick="deleteGraduate('<?php echo Yii::app()->createUrl('/_teacher/_admin/graduate/delete')?>','<?=$model->id?>');">
            Видалити</button>
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


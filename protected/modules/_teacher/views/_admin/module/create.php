<?php
/* @var $this ModuleController */
/* @var $model Module */
?>
<ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/module/index'); ?>',
                    'Модулі')">
            Всі модулі
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
        <form class="form-horizontal" role="form" name="moduleForm" id="moduleForm"
              action="<?= Yii::app()->createUrl("/_teacher/_admin/coursemanage/newCourse") ?>">
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
            </div>
        </form>
    </div>
</div>

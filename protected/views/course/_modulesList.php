<?php
$editMode = ($canEdit) ? 'true' : '';
?>
<div class="courseModules" ng-cloak ng-controller="moduleListCtrl">
    <?php
    if ($canEdit) {
        ?>
        <div onclick="enableEdit();">
            <a href="#">
                <img src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'edt_30px.png'); ?>"
                     id="editIco" title="<?php echo Yii::t('course', '0329') ?>"/>
            </a>
        </div>
    <?php
    } ?>
    <a name="list">
    </a>

    <div onclick="showForm();">
        <?php $form = $this->beginWidget('CActiveForm', array(
            'id' => 'ajaxaddmodule-form',
        )); ?>
        <a href="#moduleForm">
            <?php echo CHtml::hiddenField('idcourse', $model->course_ID); ?>
            <?php
            echo CHtml::ajaxSubmitButton('', CController::createUrl('course/modulesupdate'),
                array('update' => '#moduleForm'),
                array('id' => 'addModule', 'title' => Yii::t('course', '0336')));
            ?>
        </a>
        <?php $this->endWidget(); ?>
    </div>

    <h2><?php echo Yii::t('course', '0330'); ?></h2>
    <?php $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'modules-grid',
        'dataProvider' => $dataProvider->activeModules($model->course_ID),
        'emptyText' => Yii::t('course', '0331'),
        'columns' => array(
            array(
                'class' => 'CButtonColumn',
                'template' => '{up}{down}{customDelete}',
                'headerHtmlOptions' => array('style' => 'display:none'),
                'buttons' => array
                (
                    'htmlOptions' => array('display' => 'none'),
                    'customDelete' => array(
                        'imageUrl' => StaticFilesHelper::createPath('image', 'editor', 'delete.png'),
                        'url' => '$data->id_module',
                        'click'=>'js: function(){ deleteModule($(this).attr("href")); return false; }',
                        'label' => Yii::t('course', '0333'),
                        'visible' => $editMode,
                    ),
                    'up' => array
                    (
                        'label' => Yii::t('course', '0334'),
                        'imageUrl' => StaticFilesHelper::createPath('image', 'editor', 'up.png'),
                        'options' => array(
                            'class' => 'controlButtons;',
                            'ajax' => array(
                                'type' => 'get',
                                'url' => 'js:$(this).attr("href")',
                                'success' => 'js:function(response) {
                            $.fn.yiiGridView.update("modules-grid");
                            }'
                            )
                        ),
                        'url' => 'Yii::app()->createUrl("course/upModule", array("idModule"=>$data->id_module,
                        "idCourse"=>$data->id_course))',
                        'visible' => $editMode,
                    ),
                    'down' => array
                    (
                        'label' => Yii::t('course', '0335'),
                        'url' => 'Yii::app()->createUrl("course/downModule", array("idModule"=>$data->id_module,
                        "idCourse"=>$data->id_course))',
                        'imageUrl' => StaticFilesHelper::createPath('image', 'editor', 'down.png'),
                        'options' => array(
                            'class' => 'controlButtons;',
                            'ajax' => array(
                                'type' => 'get',
                                'url' => 'js:$(this).attr("href")',
                                'success' => 'js:function(response) {
                            $.fn.yiiGridView.update("modules-grid");
                            }'
                            )
                        ),
                        'visible' => $editMode,
                    ),
                ),
            ),
            array(
                'name' => 'title_ua',
                'type' => 'raw',
                'header' => false,
                'htmlOptions' => array('class' => 'titleColumn'),
                'cssClassExpression' => 'Module::moduleAccessStyle($data)',
                'headerHtmlOptions' => array('style' => 'width:0%; display:none'),
                'value' => function ($data) {
                    return
                        '<a ng-class="{disableModule: !modulesProgress.userId}" href="'.Yii::app()->createUrl("module/index", array("idModule" => $data->moduleInCourse->module_ID, "idCourse" => $data->id_course)).'">
                        <span class="moduleOrder">'.Yii::t('course', '0364').' '.$data->order.'.</span>
                        <span class="moduleLink">{{modulesProgress.modules['.$data->moduleInCourse->module_ID.'].title}}</span>
                        <div class="moduleProgress">'.Yii::t('module', '0647').': '.'{{modulesProgress.modules['.$data->moduleInCourse->module_ID.'].time}}
                        <img ng-hide="modulesProgress.isAdmin" src="{{basePath}}/images/module/{{modulesProgress.ico}}" alt="" />
                        </div>
                        </a>';
                    return CHtml::link($value . '<div class="moduleProgress">' . Yii::t('module', '0647') . ': ' . $time . ' ' .
                        CommonHelper::getDaysTermination($time) . '</div>', Yii::app()->createUrl("module/index",
                        array("idModule" => $data->moduleInCourse->module_ID, "idCourse" => $data->id_course)));
                }
            ),
        ),
        'summaryText' => '',
    ));
    ?>
    <div id="moduleForm">
        <?php $this->renderPartial('_addLessonForm', array('model' => $model)); ?>
    </div>
</div>
<script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('js', 'modulesList.js'); ?>"></script>

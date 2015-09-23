<?php
$editMode = ($canEdit) ? 'true' : '';
?>
<div class="courseModules">
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
        'dataProvider' => $dataProvider->search($model->course_ID),
        'emptyText' => Yii::t('course', '0331'),
        'columns' => array(
            array(
                'class' => 'CButtonColumn',
                'template' => '{up}{down}{delete}',
                'headerHtmlOptions' => array('style' => 'display:none'),
                'deleteConfirmation' => Yii::t('course', '0332'),
                'buttons' => array
                (
                    'htmlOptions' => array('display' => 'none'),
                    'delete' => array(
                        'imageUrl' => StaticFilesHelper::createPath('image', 'editor', 'delete.png'),
                        'url' => 'Yii::app()->createUrl("course/unableModule", array("idModule"=>$data->id_module, "idCourse"=>$data->id_course))',
                        'label' => Yii::t('course', '0333'),
                        'visible' => $editMode,
                    ),
                    'up' => array
                    (

                        'label' => Yii::t('course', '0334'),   //Text label of the button.
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
                        ), //HTML options for the button tag.
                        'url' => 'Yii::app()->createUrl("course/upModule", array("idModule"=>$data->id_module, "idCourse"=>$data->id_course))',
                        'visible' => $editMode,   //A PHP expression for determining whether the button is visible.
                    ),

                    'down' => array
                    (

                        'label' => Yii::t('course', '0335'),    //Text label of the button.
                        'url' => 'Yii::app()->createUrl("course/downModule", array("idModule"=>$data->id_module, "idCourse"=>$data->id_course))',
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
                        ), //HTML options for the button tag.
                        'visible' => $editMode,
                    ),
                ),
            ),
            array(
                'class' => 'DataColumn',
                'name' => 'order',
                'type' => 'raw',
                'value' => function ($data) {
                    if (AccessHelper::accesModule($data->moduleInCourse->module_ID))
                        $img = CHtml::image(StaticFilesHelper::createPath('image', 'module', 'enabled.png'));
                    else $img = CHtml::image(StaticFilesHelper::createPath('image', 'module', 'disabled.png'));
                        $value = $img . Yii::t('course', '0364') . ' ' . $data->order . '.';
                    return $value;
                },
                'header' => false,
                'htmlOptions' => array('class' => 'aliasColumn'),
                'headerHtmlOptions' => array('style' => 'width:0%; display:none'),
            ),
            array(
                'name' => 'title_ua',
                'type' => 'raw',
                'header' => false,
                'htmlOptions' => array('class' => 'titleColumn'),
                'headerHtmlOptions' => array('style' => 'width:0%; display:none'),
                'value' => function ($data) {
                    $title = ModuleHelper::getModuleTitleParam();
                    $moduleTitle = ModuleHelper::getDefaultModuleName($data->moduleInCourse->$title);
                    if (AccessHelper::accesModule($data->moduleInCourse->module_ID))
                        return CHtml::link(CHtml::encode($data->moduleInCourse->$moduleTitle), Yii::app()->createUrl("module/index", array("idModule" => $data->moduleInCourse->module_ID, "idCourse" => $data->id_course)));
                    else
                        return CHtml::link(CHtml::encode($data->moduleInCourse->$moduleTitle), Yii::app()->createUrl("module/index", array("idModule" => $data->moduleInCourse->module_ID, "idCourse" => $data->id_course)), array('class' => 'disableModule'));
                }
            ),
        ),
        'summaryText' => '',
    ));
    ?>
    <div id="moduleForm">
        <?php $this->renderPartial('_addLessonForm', array('newmodel' => $model)); ?>
    </div>
</div>
    <script type="text/javascript" src="<?php echo Config::getBaseUrl(); ?>/scripts/modulesList.js"></script>

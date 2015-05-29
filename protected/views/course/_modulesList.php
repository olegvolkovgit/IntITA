<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 08.05.2015
 * Time: 17:50
 */
$editMode = ($canEdit)?'true':'';
?>
<div class="courseModules">
    <?php
    if ($canEdit){
        ?>
        <div onclick="enableEdit();">
            <a href="#">
                <img src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'edt_30px.png'); ?>"
                     id="editIco" title="Редагувати список модулів"/>
            </a>
        </div>
    <?php
    }?>
    <a name="list">
    </a>

    <div onclick="showForm();">
        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'ajaxaddmodule-form',
        )); ?>
        <a href="#moduleForm">
            <?php echo CHtml::hiddenField('idcourse', $model->course_ID); ?>
            <?php
            echo CHtml::ajaxSubmitButton('', CController::createUrl('course/modulesupdate'), array('update' => '#moduleForm'), array('id' => 'addModule','title'=>'Додати модуль'));
            ?>
        </a>
        <?php $this->endWidget(); ?>
    </div>
<h2>Модулі</h2>
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'modules-grid',
    'dataProvider' => $dataProvider,
    'emptyText' => 'У даному курсі модулів немає.',
    'columns' => array(
        array(
            'class'=>'CButtonColumn',
            'template'=>'{up}{down}{delete}',
            'headerHtmlOptions'=>array('style'=>'display:none'),
            'deleteConfirmation'=>'Вы уверены что хотите удалить модуль?',
            'buttons'=>array
            (
                'htmlOptions'=>array('display' => 'none'),
                'delete' => array(
                    'imageUrl'=>  StaticFilesHelper::createPath('image', 'editor', 'delete.png'),
                    'url' => 'Yii::app()->createUrl("course/unableModule", array("idModule"=>$data->primaryKey))',
                    'label' => 'Дезактивировать модуль',
                    'visible'=> $editMode,
                ),
                'up' => array
                (

                    'label'=>'Поднять модуль вверх на 1 позицию',   //Text label of the button.
                    'imageUrl'=>StaticFilesHelper::createPath('image', 'editor', 'up.png'),
                    'options'=>array(
                        'class'=>'controlButtons;',
                        'ajax'=>array(
                            'type'=>'get',
                            'url'=>'js:$(this).attr("href")',
                            'success'=>'js:function(response) {
                            $.fn.yiiGridView.update("modules-grid");
                            }'
                        )
                    ), //HTML options for the button tag.
                    'url' => 'Yii::app()->createUrl("course/upModule", array("idModule"=>$data->primaryKey))',
                    'visible'=>$editMode,   //A PHP expression for determining whether the button is visible.
                ),

                'down' => array
                (

                    'label'=>'Опустить модуль вниз на 1 позицию',    //Text label of the button.
                    'url' => 'Yii::app()->createUrl("course/downModule", array("idModule"=>$data->primaryKey))',
                    'imageUrl'=>StaticFilesHelper::createPath('image', 'editor', 'down.png'),
                    'options'=>array(
                        'class'=>'controlButtons;',
                        'ajax'=>array(
                            'type'=>'get',
                            'url'=>'js:$(this).attr("href")',
                            'success'=>'js:function(response) {
                            $.fn.yiiGridView.update("modules-grid");
                            }'
                        )
                    ), //HTML options for the button tag.
                    'visible'=>$editMode,
                ),
            ),
        ),
        array(
            'class'=>'DataColumn',
            'name' => 'alias',
            'type' => 'raw',
            'value' =>'$data->order == 0 ? "Виключено":"Модуль {$data->order}."',
            'header'=>false,
            'htmlOptions'=>array('class'=>'aliasColumn'),
            'headerHtmlOptions'=>array('style'=>'width:0%; display:none'),
        ),
        array(
            'name' => 'module_name',
            'type' => 'raw',
            'header'=>false,
            'htmlOptions'=>array('class'=>'titleColumn'),
            'headerHtmlOptions'=>array('style'=>'width:0%; display:none'),
            'value' => 'CHtml::link(CHtml::encode($data->module_name), Yii::app()->createUrl("module/index", array("idModule" => $data->module_ID)))',
        ),
    ),
    'summaryText' => '',
));
?>
    <div id="moduleForm">
        <?php $this->renderPartial('_addLessonForm', array('newmodel'=>$model)); ?>
    </div>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/modulesList.js"></script>

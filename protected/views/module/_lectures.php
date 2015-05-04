<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 02.05.2015
 * Time: 17:28
 */
$model = Lecture::model();
$editMode = 'true';
?>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/lecturesList.js"></script>

<div class="lessonModule" id="lectures">
    <?php
    if ($canEdit){
        ?>
        <div onclick="enableEdit();">
            <a href="#">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/edt_30px.png"
                     id="editIco" title="Редагувати список занять"/>
            </a>
        </div>
    <?php
    }?>
                <a name="list">
                </a>

                        <div onclick="javascript:showForm();">
                            <a href="#lessonForm">
                                <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/add_lesson.png"
                                     id="addLessonButton" title="Додати заняття"/>
                            </a>
                        </div>


<h2><?php echo Yii::t('module', '0225'); ?></h2>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $dataProvider,
    'columns' => array(
        array(
            'class'=>'CButtonColumn',
            'template'=>'{up}{down}{delete}',
            'headerHtmlOptions'=>array('style'=>'width:0%; display:none'),
            'buttons'=>array
            (

                'delete' => array(
                    'imageUrl'=> Yii::app()->request->baseUrl."/images/delete.png",
                    //'url' => '',
                    'deleteConfirmation' => 'Вы уверены, что хотите удалить это занятие?',
                    'click'=>'js:unableLecture(23, 1)',
                    'label' => 'Дезактивировать занятие',
                    'visible'=> $editMode,
                ),
                'up' => array
            (

                'label'=>'Поднять занятие вверх на 1 позицию',   //Text label of the button.
                'url'=> '',       //A PHP expression for generating the URL of the button.
                'imageUrl'=>Yii::app()->request->baseUrl."/images/up.png",  //Image URL of the button.
                'options'=>array('class'=>'controlButtons;'), //HTML options for the button tag.
                //'click'=>'...',     //A JS function to be invoked when the button is clicked.
                'visible'=>$editMode,   //A PHP expression for determining whether the button is visible.
            ),

            'down' => array
            (

                'label'=>'Опустить занятие вниз на 1 позицию',    //Text label of the button.
                //'url'=>'...',       //A PHP expression for generating the URL of the button.
                'imageUrl'=>Yii::app()->request->baseUrl."/images/down.png",  //Image URL of the button.
                'options'=>array('class'=>'controlButtons;'), //HTML options for the button tag.
                'url'=>'"#"',
                'visible'=>$editMode,
                'click'=>'function(){alert("Going down!");}',
            ),
            ),
        ),
        array(
            'class'=>'DataColumn',
            'name' => 'alias',
            'type' => 'raw',
            'value' => '"Заняття {$data->order}"',
            'header'=>false,
            'htmlOptions'=>array('class'=>'aliasColumn'),
            'headerHtmlOptions'=>array('style'=>'width:0%; display:none'),
        ),
        array(
            'name' => 'title',
            'type' => 'raw',
            'header'=>false,
            'htmlOptions'=>array('class'=>'titleColumn'),
            'headerHtmlOptions'=>array('style'=>'width:0%; display:none'),
            'value' => 'CHtml::link(CHtml::encode($data->title), Yii::app()->createUrl("lesson/index", array("id" => $data->id)))',
        ),
    ),
    'summaryText' => '',
));
?>

    <div id="lessonForm">
    <form id="addLessonForm" action="<?php echo Yii::app()->createUrl('module/saveLesson');?>" method="post">
        <br>
        <span id="formLabel">Нове заняття:</span>
        <br>
        <span><?php echo Yii::t('module', '0226')." ".($module->lesson_count + 1)."."; ?></span>
        <input name="idModule" value="<?php echo $module->module_ID;?>" hidden="hidden">
        <input name="order" value="<?php echo ($module->lesson_count + 1);?>" hidden="hidden">
        <input name="lang" value="<?php echo $module->language;?>" hidden="hidden">
        <input type="text" name="newLectureName" id="newLectureName" required pattern="^[=а-яА-ЯёЁa-zA-Z0-9ЄєІі ()/+-]+$">
        <br><br>
        <input type="submit"  value="Додати" id="submitButton">
    </form>
</div>
</div>


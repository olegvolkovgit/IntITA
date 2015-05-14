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
        <a href="#moduleForm">
            <img src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'add_lesson.png');?>"
                 id="addModuleButton" title="Додати модуль"/>
        </a>
    </div>
<h2>Модулі</h2>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'modules-grid',
    'dataProvider' => $dataProvider,
    'emptyText' => 'У даному курсі модулів немає.',
    'columns' => array(
        array(
            'class'=>'CButtonColumn',
            'template'=>'{up}{down}{delete}',
            'headerHtmlOptions'=>array('style'=>'display:none'),
            'buttons'=>array
            (
                'htmlOptions'=>array('display' => 'none'),
                'delete' => array(
                    'imageUrl'=>  StaticFilesHelper::createPath('image', 'editor', 'delete.png'),
                    'url' => 'Yii::app()->createUrl("course/unableModule", array("idModule"=>$data->primaryKey))',
                    'deleteConfirmation' => 'Вы уверены, что хотите удалить этот модуль?',
                    'click'=>"function(){
                        $.fn.yiiGridView.update('modules-grid', {
                            type:'POST',
                            url:$(this).attr('href'),
                            success:function(data) {
                            $.fn.yiiGridView.update('modules-grid');
                            }
                        })
                        return false;
                    }
                    ",
                    'label' => 'Дезактивировать модуль',
                    'visible'=> $editMode,
                ),
                'up' => array
                (

                    'label'=>'Поднять модуль вверх на 1 позицию',   //Text label of the button.
                    'url' => 'Yii::app()->createUrl("course/upModule", array("idModule"=>$data->primaryKey))',
                    'imageUrl'=>StaticFilesHelper::createPath('image', 'editor', 'up.png'),
                    'options'=>array('class'=>'controlButtons;'), //HTML options for the button tag.
                    'click'=>"function(){
                        $.fn.yiiGridView.update('modules-grid', {
                            type:'POST',
                            url:$(this).attr('href'),
                            success:function(data) {
                            $.fn.yiiGridView.update('modules-grid');
                            }
                        })
                        return false;
                    }
                    ",
                    'visible'=>$editMode,   //A PHP expression for determining whether the button is visible.
                ),

                'down' => array
                (

                    'label'=>'Опустить модуль вниз на 1 позицию',    //Text label of the button.
                    'url' => 'Yii::app()->createUrl("course/downModule", array("idModule"=>$data->primaryKey))',
                    'imageUrl'=>StaticFilesHelper::createPath('image', 'editor', 'down.png'),
                    'options'=>array('class'=>'controlButtons;'), //HTML options for the button tag.
                    'visible'=>$editMode,
                    'click'=>"function(){
                        $.fn.yiiGridView.update('modules-grid', {
                            type:'POST',
                            url:$(this).attr('href'),
                            success:function(data) {
                            $.fn.yiiGridView.update('modules-grid');
                            }
                        })
                        return false;
                    }
                    ",
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
        <form id="addLessonForm" action="<?php echo Yii::app()->createUrl('module/saveModule');?>" method="post">
            <br>
            <span id="formLabel">Новий модуль:</span>
            <br>
            <span><?php echo "Модуль ".($model->modules_count + 1)."."; ?></span>
            <input name="idCourse" value="<?php echo $model->course_ID;?>" hidden="hidden">
            <input name="order" value="<?php echo ($model->modules_count + 1);?>" hidden="hidden">
            <input name="lang" value="<?php echo $model->language;?>" hidden="hidden">
            <input type="text" name="newModuleName" id="newModuleName" required pattern="^[=а-яА-ЯёЁa-zA-Z0-9ЄєІі. ()/+-]+$">
            <br><br>
            <input type="submit"  value="Додати" id="submitButton">
        </form>
        <button id="cancelButton" onclick="hideForm('moduleForm', 'newModuleName')">Скасувати</button>
    </div>
<!---->
<!--    <script type="text/javascript">-->
<!--        function hideForm(id, title){-->
<!--            $form = document.getElementById(id);-->
<!--            $form.style.display = 'none';-->
<!--            document.getElementById(title).innerText = '';-->
<!--        }-->
<!--    </script>-->
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/modulesList.js"></script>
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'module.css'); ?>" />
<h2 id="modulesHeader">Всі модулі</h2>
<div class="lessonModule" id="lectures">
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'lectures-grid',
    'dataProvider' => $dataProvider,
    'emptyText' => Yii::t('module', '0375'),
    'columns' => array(
        array(
            'name' => 'title',
            'type' => 'raw',
            'header'=>false,
            'htmlOptions'=>array('class'=>'titleColumn'),
            'headerHtmlOptions'=>array('style'=>'width:0%; display:none'),
            'value' => function($data) {
                $titleParam = LectureHelper::getTypeTitleParam();
                if($data->$titleParam == ''){
                    $titleParam = 'title_ua';
                }
                    return CHtml::link(CHtml::encode($data->$titleParam), Yii::app()->createUrl("module/index", array("idModule" => $data->module_ID)));
            }
        ),
    ),
    'summaryText' => '',
));
?>
<br>
    <br>
    <br>
    <br>
    <br>


<?php
/* @var $this TmanageController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Управління вчителями',
);

$this->menu=array(
	array('label'=>'Додати вчителя', 'url'=>array('create')),
	array('label'=>'Управління', 'url'=>array('admin')),
);
?>

<h1>Вчителі</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
    'cssFile'=>Yii::app()->baseUrl . '/css/customCGridView.css',
    'htmlOptions'=>array('class'=>'grid-view custom'),
    'summaryText' => 'Показано вчителів {start} - {end} з {count}',
	'columns'=>array(
        array(
            'header'=>'Фото',
            'value'=>'CHtml::image(StaticFilesHelper::createPath("image", "teachers",$data->foto_url),$data->first_name)',
            'type'=>'raw'
        ),
        array(
            'name'=>'first_name',
            'header'=>'Ім&#8217;я'
        ),
        array(
            'name'=>'middle_name',
            'header'=>'По батькові'
        ),
        array(
            'name'=>'last_name',
            'header'=>'Прізвище'
        ),
        array(
            'name'=>'subjects',
            'header'=>'Предмети'
        ),
        array(
            'name'=>'profile_text_short',
            'header'=>'Характеристика',
            'type'=>'raw'
        ),
        array(
            'name'=>'email',
            'header'=>'Email'
        ),
        array(
            'name'=>'tel',
            'header'=>'Телефон'
        ),
        array(
            'name'=>'skype',
            'header'=>'Skype'
        ),
    ),
)); ?>

<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 16.06.2015
 * Time: 15:45
 */
//$atts = AttributeValue::model()->findAllByAttributes(array('attribute'=>2));
//for ($i = 0; $i < count($atts);$i++){
//    echo $atts[$i]->teacher." - ".Roles::model()->findByPk($atts[$i]->attribute)->title." - ".StudentReg::model()->findByPk($atts[$i]->value)->firstName.'<br>';
//}
/* @var $dataProvider CActiveDataProvider */
$this->breadcrumbs=array(
    'Викладачі','Ролі викладачів'
);
$this->menu=array(
    array('label'=>'Додати роль', 'url'=>array('createRole')),
    array('label'=>'Показати ролі викладача', 'url'=>array('viewRoles')),
);
?>
    <h2>Ролі викладачів</h2>
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dataProvider,
    'htmlOptions'=>array('class'=>'grid-view custom'),
    'summaryText' => '',
    'columns'=>array(
        array(
            'header'=>'Викладач',
            'value'=>'TeacherHelper::getTeacherName($data->teacher)',
        ),
        array(
            'header'=>'Роль',
            'value'=>'TeacherHelper::getRoleTitle($data->role)',
        ),
        array(
            'header'=>'Початок',
            'value'=>'$data->start_date',
        ),
        array(
            'header'=>'Кінець',
            'value'=>'$data->end_date',
        ),
    ),
)); ?>
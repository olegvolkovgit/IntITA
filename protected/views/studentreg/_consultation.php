<p class="tabHeader"><?php echo Yii::t('profile', '0110'); ?></p>
<?php
$alert = 'Ви впевнені, що хочите відмінити консультацію?';
?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'consultation-grid',
    'dataProvider'=>$dataProvider,
    'emptyText' => 'Запланованих консультацій немає.',
    'summaryText' => '',
    'columns'=>array(
        array(
            'header'=>Yii::t('profile', '0126'),
            'value'=>'Yii::t(\'profile\', \'0132\')',
        ),
        array(
            'name'=>'date_cons',
            'header'=>Yii::t('profile', '0127'),
        ),
        array(
            'name'=>'start_cons',
            'header'=>Yii::t('profile', '0128'),
            'value'=>'date("H:i", strtotime($data->start_cons))."-".date("H:i", strtotime($data->end_cons))',
        ),
        array(
            'header'=>Yii::t('profile', '0129'),
            'value'=>'Teacher::model()->findByPk($data->teacher_id)->first_name." ".Teacher::model()->findByPk($data->teacher_id)->last_name',
        ),
        array(
            'header'=>Yii::t('profile', '0130'),
            'value'=>'Lecture::model()->findByPk($data->lecture_id)->title',
        ),
        array(
            'class'=>'CButtonColumn',
            'headerHtmlOptions'=>array('style'=>'width:20px;'),
            'htmlOptions' => array('style'=>'width:20px'),
            'buttons'=>array
            (
                'htmlOptions'=>array('display' => 'none'),
                'delete' => array(
                    'url' => 'Yii::app()->createUrl("studentreg/deleteconsultation", array("id"=>$data->id))',
                    'imageUrl'=>  StaticFilesHelper::createPath('image', 'editor', 'delete.png'),
                    'label' => 'Відмінити консультацію',
                ),
            ),
            'updateButtonOptions'=> array('style'=>'display:none'),
            'viewButtonOptions'=> array('style'=>'display:none'),
            'deleteConfirmation'=>$alert,
        ),
    ),
)); ?>
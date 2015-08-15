<?php
$alert = Yii::t('profile', '0546');

$this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'consultation-grid',
    'dataProvider'=>$dataProvider,
    'emptyText' => Yii::t('profile', '0545'),
    'summaryText' => '',
    'columns'=>array(
        array(
            'header'=>Yii::t('profile', '0126'),
            'value'=>'Yii::t(\'profile\', \'0132\')',
        ),
        array(
            'name'=>'date_cons',
            'header'=>Yii::t('profile', '0127'),
            'type' => 'raw',
            'htmlOptions'=>array('class'=>'dateColumn'),
        ),
        array(
            'name'=>'start_cons',
            'header'=>Yii::t('profile', '0128'),
            'value'=>'date("H:i", strtotime($data->start_cons))."-".date("H:i", strtotime($data->end_cons))',
            'type' => 'raw',
            'htmlOptions'=>array('class'=>'timeColumn'),
        ),
        array(
            'header'=>ConsultationsHelper::getUserTitle($userId),
            'value'=>'ConsultationsHelper::getUserName(' . $userId . ',$data)',
            'type' => 'raw',
            'htmlOptions'=>array('class'=>'nameColumn'),
        ),
        array(
            'header'=>Yii::t('profile', '0130'),
            'value'=>'ConsultationsHelper::getTheme($data)',
            'type' => 'raw',
            'htmlOptions'=>array('class'=>'themeColumn'),
        ),
        array(
            'class'=>'CButtonColumn',
            'headerHtmlOptions'=>array('style'=>'width:20px;'),
            'htmlOptions' => array('style'=>'width:20px'),
            'buttons'=>array
            (
                'htmlOptions'=>array('display' => 'none'),
                'delete' => array(
                    'url' => 'Yii::app()->createUrl("consultationscalendar/deleteconsultation", array("id"=>$data->id))',
                    'imageUrl'=>  StaticFilesHelper::createPath('image', 'editor', 'delete.png'),
                    'label' => Yii::t('profile', '0547'),
                ),
            ),
            'updateButtonOptions'=> array('style'=>'display:none'),
            'viewButtonOptions'=> array('style'=>'display:none'),
            'deleteConfirmation'=>$alert,
        ),
    ),
)); ?>
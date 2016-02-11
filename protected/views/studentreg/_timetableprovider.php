<?php
if($owner=='false') $visible='display:none';
else $visible='';
$alert = Yii::t('profile', '0546');
$this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'consultation-grid',
    'dataProvider'=>$dataProvider,
    'emptyText' => Yii::t('profile', '0545'),
    'summaryText' => '',
    'pager' => array(
        'firstPageLabel'=>'&#171;&#171;',
        'lastPageLabel'=>'&#187;&#187;',
        'prevPageLabel'=>'&#171;',
        'nextPageLabel'=>'&#187;',
        'header'=>'',
        'cssFile'=>Config::getBaseUrl().'/css/pager.css'
    ),
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
            'header'=>StudentReg::getUserTitle($userId),
            'value'=>'StudentReg::getProfileLinkByRole('.$userId.',$data)',
            'type' => 'raw',
            'htmlOptions'=>array('class'=>'nameColumn'),
        ),
        array(
            'header'=>Yii::t('profile', '0130'),
            'value'=>'Lecture::getThemeLink($data)',
            'type' => 'raw',
            'htmlOptions'=>array('class'=>'themeColumn'),
        ),
        array(
            'class'=>'CButtonColumn',
            'template'=>'{customDelete}',
            'headerHtmlOptions'=>array('style'=>'width:20px;'.$visible.''),
            'htmlOptions' => array('style'=>'width:20px;'.$visible.''),
            'buttons'=>array
            (
                'htmlOptions'=>array('display' => 'none'),
                'customDelete' => array(
                    'url' => 'Yii::app()->createUrl("consultationscalendar/deleteconsultation", array("id"=>$data->idё))',
                    'click'=>'js: function(){ deleteConsultation($(this).attr("href")); return false; }',
                    'imageUrl'=>  StaticFilesHelper::createPath('image', 'editor', 'delete.png'),
                    'label' => Yii::t('profile', '0547'),
                    'visible'=> $owner,
                ),
            ),
        ),
    ),
)); ?>
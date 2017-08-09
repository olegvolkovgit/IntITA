<?php

$this->widget('application.components.ColumnListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_teacherBlock',
    'emptyText' => Yii::t('coursemanage', '0517'),
    'viewData'=>array('teacherletter'=>$teacherletter, 'page'=>$dataProvider->pagination->currentPage),
    'summaryText' => '',
    'columns' => array("one", "two"),
    'pager' => array(
        'firstPageLabel' => '&#171;&#171;',
        'lastPageLabel' => '&#187;&#187;',
        'prevPageLabel' => '&#171;',
        'nextPageLabel' => '&#187;',
        'header' => '',
        'maxButtonCount' => 6,
        'cssFile' => Config::getBaseUrl() . '/css/pager.css'
    ),
    'id' => 'ajaxListTeacher'
));
?>
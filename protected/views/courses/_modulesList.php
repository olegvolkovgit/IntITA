<?php
$this->widget('application.components.ColumnListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_moduleBlock',
    'viewData'=>array( 'lang' => $lang ),
    'summaryText' => '',
    'columns' => array("one", "two"),
    'pager' => array(
        'firstPageLabel' => '&#171;&#171;',
        'lastPageLabel' => '&#187;&#187;',
        'prevPageLabel' => '&#171;',
        'nextPageLabel' => '&#187;',
        'header' => '',
        'cssFile' => Config::getBaseUrl() . '/css/pager.css'
    ),
));
?>
<?php
/**
 * Created by PhpStorm.
 * User: Wizlight
 * Date: 08.09.2015
 * Time: 23:25
 */

$this->widget('application.components.ColumnListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_graduateBlock',
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
<script src="<?php echo Config::getBaseUrl(); ?>/scripts/SpoilerContent.js"></script>

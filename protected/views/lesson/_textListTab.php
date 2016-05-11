<?php
if (isset($message)){
    $emptyText = $message;
} else {
    $emptyText = Yii::t('lecture', '0422');
}

$this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'/lesson/_textTab',
    'summaryText' => '',
    'emptyText' => $emptyText.'<br><br><br><br><br>',
    'pagerCssClass'=>'YiiPager',
    'ajaxUpdate' => true,
    'id'=>"blocks_list",
));
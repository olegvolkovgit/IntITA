<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 02.07.2015
 * Time: 17:27
 */
?>

<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'_content',
    'summaryText' => '',
    'viewData' => array('editMode' => $editMode),
    'emptyText' => Yii::t('lecture', '0422').'<br><br><br><br><br>',
    'pagerCssClass'=>'YiiPager',
    'ajaxUpdate' => true,
    'id'=>"blocks_list",
));
?>
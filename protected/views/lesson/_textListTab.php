<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 05.08.2015
 * Time: 18:42
 */
$this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'_textTab',
    'summaryText' => '',
    'viewData' => array('editMode' => $editMode, 'user' => $user),
    'emptyText' => Yii::t('lecture', '0422').'<br><br><br><br><br>',
    'pagerCssClass'=>'YiiPager',
    'ajaxUpdate' => true,
    'id'=>"blocks_list",
));
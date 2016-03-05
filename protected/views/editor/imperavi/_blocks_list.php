<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 03.07.2015
 * Time: 18:01
 */

$this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'/editor/imperavi/_content',
    'summaryText' => '',
    'viewData' => array('editMode' => $editMode, 'user' => $user),
    'emptyText' => Yii::t('lecture', '0422').'<br><br><br><br><br>',
    'pagerCssClass'=>'YiiPager',
    'ajaxUpdate' => true,
    'id'=>"blocks_list",
));
?>
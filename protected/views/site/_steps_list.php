<?php
/**
 * @var $stepsDataProvider CActiveDataProvider
 */
?>
<div class="steps" >
    <div class="stepHeaderCont">
        <div class="stepHeader">
            <h1><?php echo $mainpage->getHeader2(); ?></h1>
            <h3><?php echo $mainpage->getSubheader2(); ?></h3>
        </div>
    </div>
<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$stepsDataProvider,
    'itemView'=>'_step',
    'summaryText' => '',
    'id'=>"steps_list",
));
?>
</div>

<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 13.05.2015
 * Time: 16:22
 */
?>
<div class="steps" >
    <div class="stepHeaderCont" style="width:958px">
        <div class="stepHeader">
            <h1><?php echo MainpageHelper::getHeader2(); ?></h1>
            <h3><?php echo MainpageHelper::getSubheader2(); ?></h3>
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

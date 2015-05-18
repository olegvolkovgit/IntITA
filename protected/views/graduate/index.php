<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/GraduatesStyle.css" />
<script src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/SpoilerContent.js"></script>

<div class="subNavBlockGraduates">
<?php
$this->pageTitle = 'INTITA';
$this->breadcrumbs=array(
    Yii::t('breadcrumbs', '0296'),
    );
?>
</div>

<div>
<h1 class="graduates"><?php echo Yii::t('graduates', '0297')?></h1>
</div>


<?php
//
//$this->widget('zii.widgets.CListView', array(
//    'dataProvider'=>$dataProvider,
//    'itemView'=>'_graduateBlock',
//    'summaryText' => '',
//    'emptyText' => '',
//    'pagerCssClass'=>'YiiPager',
//));
?>

<div class="GBlock">
    <?php echo $this->renderPartial('_graduateBlock');?>
    <?php echo $this->renderPartial('_graduateBlock');?>
</div>

<div class="GBlock">
    <?php echo $this->renderPartial('_graduateBlock');?>
    <?php echo $this->renderPartial('_graduateBlock');?>
</div>

<div class="GBlock">
    <?php echo $this->renderPartial('_graduateBlock');?>
    <?php echo $this->renderPartial('_graduateBlock');?>
</div>

<div class="GBlock">
    <?php echo $this->renderPartial('_graduateBlock');?>
    <?php echo $this->renderPartial('_graduateBlock');?>
</div>

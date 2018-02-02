<? $css_version = 1; ?>
<?php
/* @var $user StudentReg
 * @var $total int
 * @var $blocks array
 * @var $counters array
 * @var $selector string
 */
?>
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'courses.css'); ?>" />
<?php
$this->breadcrumbs = array(
    Yii::t('breadcrumbs', '0050'),
); ?>
<div id='coursesMainBox'>
    <?php $this->renderPartial('_menuLine', array('counters'=>$counters));?>   <!--  -->
    <?php if($selector=='modules'){ ?>
        <div id="coursesTable">
            <?php echo $this->renderPartial('_modulesList', array('dataProvider'=>$dataProvider,'lang'=>$lang)); ?>
        </div>
    <?php } else { ?>
        <div id="coursesTable">
            <div class="leftColumn">
                <?php $this->renderPartial('_coursesPart1', array('blocks' => $blocks));?>
            </div>
            <div class="rightColumn">
                <?php $this->renderPartial('_coursesPart2', array('blocks' => $blocks));?>
            </div>
        </div>
       
    <?php } ?>
</div>

<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'spoilerBlock.js'); ?>"></script>
<?php $this->renderPartial('/site/_shareMetaTag', array(
    'url'=>Yii::app()->createAbsoluteUrl(Yii::app()->request->url),
    'title'=>Yii::t('courses', '0066').'. '.Yii::t('sharing','0643'),
    'description'=>Yii::t('sharing','0644'),
));
?>



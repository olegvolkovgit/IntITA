<? $css_version = 1; ?>
<?php
/* @var $user StudentReg
 * @var $total int
 * @var $blocks array
 * @var $counters array
 */
?>
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'courses.css'); ?>" />
<?php
$this->breadcrumbs = array(
    Yii::t('breadcrumbs', '0050'),
); ?>

<div id='coursesMainBox'>
    <?php $this->renderPartial('_menuLine', array('counters'=>$counters));?>
    <table>
        <tr>
            <td>
            <?php $this->renderPartial('_coursesPart1', array('blocks' => $blocks));?>
            <?php $this->renderPartial('_coursesPart2', array('blocks' => $blocks));?>
            </td>
        </tr>
    </table>
</div>

<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'spoilerBlock.js'); ?>"></script>
<?php $this->renderPartial('/site/_shareMetaTag', array(
    'url'=>Yii::app()->createAbsoluteUrl(Yii::app()->request->url),
    'title'=>Yii::t('courses', '0066').'. '.Yii::t('sharing','0643'),
    'description'=>Yii::t('sharing','0644'),
));
?>



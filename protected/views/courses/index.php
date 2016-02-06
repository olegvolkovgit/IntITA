<? $css_version = 1; ?>
<?php
/* @var $user StudentReg
 * @var $total int
 * @var $coursesLangs array
 */
?>
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'courses.css'); ?>" />
<?php
$this->breadcrumbs = array(
    Yii::t('breadcrumbs', '0050'),
);

$courseList = $dataProvider->getData();
?>

<div id='coursesMainBox'>
    <?php $this->renderPartial('_menuLine', array('total'=>$total));?>
    <table>
        <tr>
            <td>
            <?php $this->renderPartial('_coursesPart1', array('courseList' => $courseList, 'coursesLangs' => $coursesLangs));?>
            <?php $this->renderPartial('_coursesPart2', array('courseList' => $courseList, 'coursesLangs' => $coursesLangs));?>
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



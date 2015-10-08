<?php $this->renderPartial('/site/_shareMetaTag', array(
    'url'=>Yii::app()->createAbsoluteUrl(Yii::app()->request->url),
    'title'=>Yii::t('courses', '0066').'. '.Yii::t('sharing','0643'),
    'description'=>Yii::t('sharing','0644'),
));
?>
<!-- courses style -->
<link type="text/css" rel="stylesheet" href="<?php echo Config::getBaseUrl(); ?>/css/courses.css" />
<script src="<?php echo Config::getBaseUrl(); ?>/scripts/spoilerBlock.js"></script>

<?php
$this->pageTitle = 'INTITA';
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



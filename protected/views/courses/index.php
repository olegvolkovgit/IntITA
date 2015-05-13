<!-- courses style -->
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/courses.css" />
<script src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/spoilerBlock.js"></script>

<?php
$this->pageTitle = 'INTITA';
$this->breadcrumbs = array(
    Yii::t('breadcrumbs', '0050'),
);
$courseList = $dataProvider->getData();
?>

<div id='coursesMainBox'>
    <?php $this->renderPartial('_menuLine');?>
    <table>
        <tr>
            <?php $this->renderPartial('_coursesPart1', array('count1' => $count1, 'courseList' => $courseList));?>
            <?php $this->renderPartial('_coursesPart2', array('count1' => $count1, 'courseList' => $courseList, 'count2' => $count2));?>
        </tr>
    </table>
</div>



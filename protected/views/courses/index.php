<?php $this->renderPartial('/site/_shareMetaTag', array(
    'url'=>Yii::app()->createAbsoluteUrl(Yii::app()->request->url),
    'title'=>Yii::t('courses', '0066'),
    'description'=>'Бажаєте стати висококласним програмістом і гарантовано отримати престижну, високооплачувану роботу? INTITA - те, що ви шукали',
));
?>
<!--data-url="--><?php //echo Yii::app()->createAbsoluteUrl(Yii::app()->request->url) ?><!--"-->
<!--data-title="--><?php //echo Yii::t('courses', '0066'); ?><!--"-->
<!--data-image="--><?php //echo StaticFilesHelper::createPath('image', 'mainpage', 'intitaLogo.jpg'); ?><!--"-->
<!--data-description="Бажаєте стати висококласним програмістом і гарантовано отримати престижну, високооплачувану роботу? INTITA - те, що ви шукали"-->
<div id="sharing">
    <div class="share42init" data-top1="75" data-top2="110" data-margin="15"
         data-path="<?php echo Config::getBaseUrl(); ?>/scripts/share42/"
         data-zero-counter="1">
    </div>
</div>
<script type="text/javascript" src="<?php echo Config::getBaseUrl(); ?>/scripts/share42/share42.js"></script>
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



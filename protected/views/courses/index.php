<?php
Yii::app()->clientScript->registerMetaTag(Yii::app()->createAbsoluteUrl(Yii::app()->request->url), null, null, array('property' => "og:url"));
Yii::app()->clientScript->registerMetaTag(Yii::t('courses', '0066'), null, null, array('property' => "og:title"));
Yii::app()->clientScript->registerMetaTag("Бажаєте стати висококласним програмістом і гарантовано отримати престижну, високооплачувану роботу? INTITA - те, що ви шукали", 'description');
Yii::app()->clientScript->registerMetaTag("http://intita.itatests.com/images/mainpage/intitaLogo.jpg", null, null, array('property' => "og:image"));
?>
<div id="sharing">
    <div class="share42init" data-top1="75" data-top2="110" data-margin="15"
         data-url="<?php echo Yii::app()->createAbsoluteUrl(Yii::app()->request->url) ?>"
         data-title="<?php echo Yii::t('courses', '0066'); ?>"
         data-image="http://intita.itatests.com/images/mainpage/intitaLogo.jpg"
         data-description="Бажаєте стати висококласним програмістом і гарантовано отримати престижну, високооплачувану роботу? INTITA - те, що ви шукали"
         data-path="<?php echo Yii::app()->request->baseUrl; ?>/scripts/share42/"
         data-zero-counter="1">
    </div>
</div>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/share42/share42.js"></script>
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



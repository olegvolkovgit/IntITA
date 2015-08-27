<?php
Yii::app()->clientScript->registerMetaTag(Yii::app()->createAbsoluteUrl(Yii::app()->request->url), null, null, array('property' => "og:url"));
Yii::app()->clientScript->registerMetaTag(CourseHelper::getCourseName($model->course_ID), null, null, array('property' => "og:title"));
Yii::app()->clientScript->registerMetaTag("Бажаєте стати висококласним програмістом і гарантовано отримати престижну, високооплачувану роботу? INTITA - те, що ви шукали", null, null, array('property' => "og:description"));
Yii::app()->clientScript->registerMetaTag(StaticFilesHelper::createPath('image', 'course/share', ImageHelper::setOpenGraphImage(Yii::getPathOfAlias('webroot')."/images/course/share/",'shareCourseImg_',$model->course_ID,'defaultCourseImg.png')), null, null, array('property' => "og:image"));
?>
<div id="sharing">
    <div class="share42init" data-top1="75" data-top2="110" data-margin="15"
         data-url="<?php echo Yii::app()->createAbsoluteUrl(Yii::app()->request->url) ?>"
         data-title="<?php echo CourseHelper::getCourseName($model->course_ID); ?>"
         data-image="<?php echo StaticFilesHelper::createPath('image', 'course/share', ImageHelper::setOpenGraphImage(Yii::getPathOfAlias('webroot')."/images/course/share/",'shareCourseImg_',$model->course_ID,'defaultCourseImg.png')); ?>"
         data-description="Бажаєте стати висококласним програмістом і гарантовано отримати престижну, високооплачувану роботу? INTITA - те, що ви шукали"
         data-path="<?php echo Yii::app()->request->baseUrl; ?>/scripts/share42/"
         data-zero-counter="1">
    </div>
</div>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/share42/share42.js"></script>
<!-- course style -->
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/course.css"/>
<!-- course style -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/spoilerPay.js"></script>
<!-- BD -))) -->
<?php
$this->pageTitle = 'INTITA';
$this->breadcrumbs = array(
    Yii::t('breadcrumbs', '0050') => Yii::app()->request->baseUrl . "/courses", CourseHelper::getCourseName($model->course_ID),
);

?>

<div class="courseBlock">
    <div class="courseTitle">
        <h1>
            <?php echo CourseHelper::getCourseName($model->course_ID); ?>
        </h1>
    </div>
    <div class="courseShortInfo">
        <?php $this->renderPartial('_courseShortInfo', array('model' => $model)); ?>
        <br>

        <div class="courseTeachers">
            <?php $this->renderPartial('_courseInfo', array('model' => $model)); ?>
        </div>
        <?php echo $this->renderPartial('_modulesList', array('dataProvider' => $dataProvider, 'canEdit' => $canEdit, 'model' => $model)); ?>
    </div>
</div>


<? $css_version = 1; ?>
<?php
/* @var $model Course */
?>
    <link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'course.css'); ?>"/>
    <script
        src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/main_app/controllers/moduleListCtrl.js'); ?>"></script>
    <script type="text/javascript">
        idCourse = <?php echo $model->course_ID;?>;
        lang = '<?php if (CommonHelper::getLanguage() == 'ua') echo 'uk'; else echo CommonHelper::getLanguage();?>';
    </script>
    <div class="main">
        <div class="courseTitle">
            <h1>
                <?php echo $model->getTitle(); ?>
            </h1>
        </div>
    </div>

    <div class="courseBlock">
        <div class="courseShortInfo" ng-controller="moduleListCtrl">
            <?php $this->renderPartial('_courseShortInfo', array('model' => $model)); ?>
            <br>

            <div class="courseTeachers">
                <?php $this->renderPartial('_courseInfo', array('model' => $model)); ?>
            </div>
            <?php echo $this->renderPartial('_modulesList', array(
                'canEdit' => $canEdit,
                'model' => $model,
                'isAuthor' => $isAuthor
            )); ?>
        </div>
    </div>
<?php if ($canEdit) { ?>
    <script
        src="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/bootbox.min.js'); ?>"></script>
    <link
        href="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css"
          href="<?php echo StaticFilesHelper::fullPathTo('css', 'bootstrapRewrite.css') ?>"/>
<?php } ?>
    <script src="<?php echo StaticFilesHelper::fullPathTo('js', 'spoilerPay.js'); ?>"></script>
<?php
$this->renderPartial('/site/_shareMetaTag', array(
    'url' => Yii::app()->createAbsoluteUrl(Yii::app()->request->url),
    'title' => $model->getTitle() . '. ' . Yii::t('sharing', '0643'),
    'description' => Yii::t('sharing', '0644'),
));
?>
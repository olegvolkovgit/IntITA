<?php
$this->breadcrumbs = array(
    'Модуль' => Yii::app()->createUrl("module/index", array("idModule" => $lectureRevision->id_module)),
    'Ревізії занять модуля' => Yii::app()->createUrl('/revision/moduleLecturesRevisions', array('idModule'=>$lectureRevision->id_module)),
    'Ревізії заняття' => Yii::app()->createUrl('/revision/revisionsBranch', array('idRevision'=>$lectureRevision->id_revision)),
    'Попередній перегляд заняття',
);
?>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lecture_revision_app/controllers/preview/lecturePreviewRevisionCtrl.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lecture_revision_app/services/revisionsActions.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lecture_revision_app/controllers/preview/testPreviewCtrl.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lecture_revision_app/controllers/preview/skipTaskPreviewCtrl.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lecture_revision_app/controllers/preview/taskPreviewCtrl.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lecture_revision_app/config.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lecture_revision_app/directives/hoverSpot.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lecture_revision_app/directives/startVideo.js'); ?>"></script>
<script>
    idRevision = '<?php echo $idRevision;?>';
    basePath='<?php echo  Config::getBaseUrl(); ?>';
</script>
<div ng-controller="lecturePreviewRevisionCtrl">
    <div ng-cloak id="revisionMainBox">
        <div class="lessonText">
            <?php
            $this->renderPartial('lecturePreview/_lecturePageTabs', array('lectureRevision' => $lectureRevision));
            ?>
        </div>
        <div class="lectureInfo">
            <?php
            $this->renderPartial('lecturePreview/_lectureInfo', array('lectureRevision' => $lectureRevision));
            ?>
        </div>
    </div>
</div>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/MathJax/MathJax.js?config=TeX-AMS-MML_HTMLorMML'); ?>"></script>
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'lectureStyles.css'); ?>"/>

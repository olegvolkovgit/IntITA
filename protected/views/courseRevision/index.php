<?php
$this->breadcrumbs = array(
    'Усі ревізії курсів',
);
?>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/course_revision_app/app.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/course_revision_app/controllers/courseRevisionsTreeCtrl.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/course_revision_app/controllers/allCoursesRevisionsCtrl.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/course_revision_app/services/buildCourseRevisionsTree.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/course_revision_app/services/courseRevisionsActions.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/course_revision_app/services/getCourseData.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/course_revision_app/services/sendCourseRevisionMessage.js'); ?>"></script>
<script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('js', 'bootstrap-treeview.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/bootbox.min.js'); ?>"></script>
<link rel='stylesheet' href="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/loading-bar.min.css'); ?>" type='text/css' media='all' />
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/loading-bar.min.js'); ?>"></script>
<script type="text/javascript">
    basePath='<?php echo  Config::getBaseUrl(); ?>';
    isApprover = '<?php echo $isApprover;?>';
    userId = '<?php echo $userId;?>';
</script>
<div id="revisionMainBox" ng-app="courseRevisionsApp">
    <div class="form-group" ng-controller="courseRevisionsTreeCtrl" ng-cloak>
        <div ng-controller="allCoursesRevisionsCtrl">
            <?php
            $this->renderPartial('_courseRevisionsTree');
            ?>
        </div>
    </div>
</div>

<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'revision.css'); ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>" >
<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'bootstrap-treeview.css'); ?>" />
<?php
$this->breadcrumbs = array(
    'Усі ревізії курсів',
);
?>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/course_revision_app/controllers/courseRevisionsTreeCtrl.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/course_revision_app/controllers/allCoursesRevisionsCtrl.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/course_revision_app/services/buildCourseRevisionsTree.js'); ?>"></script>
<script type="text/javascript">
    basePath='<?php echo  Config::getBaseUrl(); ?>';
    isApprover = '<?php echo $isApprover;?>';
    userId = '<?php echo $userId;?>';
</script>
<div id="revisionMainBox">
    <div class="form-group" ng-controller="courseRevisionsTreeCtrl" ng-cloak>
        <div ng-controller="allCoursesRevisionsCtrl">
            <?php
            $this->renderPartial('_courseRevisionsTree');
            ?>
        </div>
    </div>
</div>
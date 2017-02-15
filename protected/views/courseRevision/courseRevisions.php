<?php
$this->breadcrumbs = array(
    'Курс' => Yii::app()->createUrl("course/index", array("id" => $course->course_ID)),
    'Ревізії курсу',
);
?>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/course_revision_app/controllers/courseRevisionsTreeCtrl.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/course_revision_app/controllers/courseRevisionsCtrl.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/course_revision_app/services/buildCourseRevisionsTree.js'); ?>"></script>
<script type="text/javascript">
    basePath='<?php echo  Config::getBaseUrl(); ?>';
    idCourse ='<?php echo $course->course_ID;?>';
    isApprover = '<?php echo $isApprover;?>';
    userId = '<?php echo $userId;?>';
</script>
<div id="revisionMainBox">
    <div class="form-group" ng-controller="courseRevisionsTreeCtrl" ng-cloak>
        <div ng-controller="courseRevisionsCtrl">
            <?php
            $this->renderPartial('_courseInfo', array('course'=>$course));
            ?>
            <?php
            $this->renderPartial('_courseRevisionsTree');
            ?>
            <div>
                <?php if(!$revisionExists){ ?>
                    <a href="" ng-click="createCourseRevision(idCourse)">Створити ревізію даного курсу</a>
                <?php } ?>
            </div>
        </div>
    </div>
</div>


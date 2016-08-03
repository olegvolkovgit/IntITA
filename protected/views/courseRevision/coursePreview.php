<?php
$this->breadcrumbs = array(
    'Курс' => Yii::app()->createUrl("course/index", array("id" => $courseRevision->id_course)),
    'Ревізії курса' => Yii::app()->createUrl('/courseRevision/courseRevisions', array('idCourse'=>$courseRevision->id_course)),
    'Попередній перегляд курса',
);
?>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/course_revision_app/app.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/course_revision_app/controllers/courseRevisionCtrl.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/course_revision_app/services/getCourseData.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/course_revision_app/services/courseRevisionsActions.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/course_revision_app/services/sendCourseRevisionMessage.js'); ?>"></script>
<script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
<link rel='stylesheet' href="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/loading-bar.min.css'); ?>" type='text/css' media='all' />
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/loading-bar.min.js'); ?>"></script>
<script>
    idRevision = '<?php echo $courseRevision->id_course_revision;?>';
    idCourse = '<?php echo $courseRevision->id_course;?>';
    basePath='<?php echo  Config::getBaseUrl(); ?>';
</script>
<div ng-app="courseRevisionsApp">
    <div ng-controller="courseRevisionCtrl">
        <div ng-cloak id="revisionMainBox">
            <?php
            $this->renderPartial('_courseRevisionPreviewInfo', array('courseRevision' => $courseRevision));
            ?>
            <br>
            <label>Перелік модулів: </label>
            <table id="pages" class="table">
                <tr>
                    <td>Id модуля</td>
                    <td class="titleCell" >Назва</td>
                    <td>Порядок</td>
                </tr>
                <tr ng-repeat="module in moduleInCourse track by $index">
                    <td>{{module.id}}</td>
                    <td><a ng-href="<?php echo Yii::app()->createUrl("module/index", array("idModule" => "")) ?>{{module.id}}" >{{module.title}} <span ng-if="module.cancelled"  class="cancelled">(скасований)</span></a></td>
                    <td>{{$index+1}}</td>
                </tr>
            </table>
            <br>
        </div>
    </div>
</div>
<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'revision.css'); ?>"
<script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('js', 'bootstrap-treeview.js'); ?>"></script>
<script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('js', 'revision.js'); ?>"></script>

<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>" >
<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'bootstrap-treeview.css'); ?>" />
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/bootbox.min.js'); ?>"></script>

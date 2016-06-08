<?php
$this->breadcrumbs = array(
    'Ревізії курса' => Yii::app()->createUrl('/moduleRevision/courseModulesRevisions', array('idCourse'=>0)),
    'Ревізія даного модуля',
);
?>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/module_revision_app/app.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/module_revision_app/controllers/moduleRevisionCtrl.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/module_revision_app/services/getModuleData.js'); ?>"></script>
<script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/module_revision_app/directives/ajaxLoader.js'); ?>"></script>
<script>
    idRevision = '<?php echo $moduleRevision->id_module_revision;?>';
    basePath='<?php echo  Config::getBaseUrl(); ?>';
</script>
<div ng-app="moduleRevisionsApp">
    <div ng-controller="moduleRevisionCtrl">
        <div ng-cloak id="revisionMainBox">
            <?php
                $this->renderPartial('_moduleRevisionInfo', array('moduleRevision' => $moduleRevision));
            ?>
            <br>
            <label>Доступні ревізії занять: </label>
            <div ng-repeat="lectureRevision in readyLectureRevisions track by $index">
                Ревізія №{{lectureRevision.id_revision}} {{lectureRevision.title}} <span class='ico' ng-click="addRevisionToModule(lectureRevision.id_revision, $index)">&plus;</span>
            </div>
            <br>
            <label>Перелік ревізій занять: </label>

            <table id="pages" class="table">
                <tr>
                    <td>Номер ревізії</td>
                    <td class="titleCell" >Назва</td>
                    <td>Порядок</td>
                    <td>Навігація</td>
                </tr>
                <tr ng-repeat="lecture in moduleData.lectures track by $index">
                    <td ng-click="editPageRevision(lecture.id)">{{lecture.id}}</td>
                    <td ng-click="editPageRevision(lecture.id)">{{lecture.id}}</td>
                    <td ng-click="editPageRevision(lecture.id)">{{$index+1}}</td>
                    <td>
                        <div style="display: inline-block" ng-if="lectureData.lecture.canEdit">
                            <img src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'up.png');?>" class="editIco" ng-click="up(page.id);">
                            <img src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'down.png');?>" class="editIco" ng-click="down(page.id);">
                            <img src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'delete.png');?>" class="editIco" ng-click="delete(page.id);">
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div data-loading id="loaderContainer">
        <img id="ajaxLoader" src="<?php echo StaticFilesHelper::createPath('image', 'lecture', 'ajax.gif'); ?>" />
    </div>
</div>
<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'revision.css'); ?>"
<script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('js', 'bootstrap-treeview.js'); ?>"></script>
<script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('js', 'revision.js'); ?>"></script>

<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>" >
<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'bootstrap-treeview.css'); ?>" />
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/bootbox.min.js'); ?>"></script>

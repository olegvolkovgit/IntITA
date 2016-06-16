<?php
$this->breadcrumbs = array(
//    'Ревізії курса' => Yii::app()->createUrl('/moduleRevision/courseModulesRevisions', array('idCourse'=>0)),
    'Ревізії модуля' => Yii::app()->createUrl('/moduleRevision/moduleRevisions', array('idModule'=>$moduleRevision->id_module)),
    'Ревізія даного модуля',
);
?>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/module_revision_app/app.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/module_revision_app/controllers/moduleRevisionCtrl.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/module_revision_app/services/getModuleData.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/module_revision_app/services/moduleRevisionsActions.js'); ?>"></script>
<script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/module_revision_app/directives/ajaxLoader.js'); ?>"></script>
<script>
    idRevision = '<?php echo $moduleRevision->id_module_revision;?>';
    idModule = '<?php echo $moduleRevision->id_module;?>';
    basePath='<?php echo  Config::getBaseUrl(); ?>';
</script>
<div ng-app="moduleRevisionsApp">
    <div ng-controller="moduleRevisionCtrl">
        <div ng-cloak id="revisionMainBox">
            <?php
                $this->renderPartial('_moduleRevisionInfo', array('moduleRevision' => $moduleRevision));
            ?>
            <h3>Доступні ревізії занять:</h3>
            <div class="revisionTable">
                <label>Доступні ревізії занять данного модуля:</label>
                <div class="revisionsList">
                    <div ng-repeat="revision in approvedLecture.current track by $index">
                        <a ng-href="{{revision.link}}" target="_blank">
                            Ревізія №{{revision.id_lecture_revision}} {{revision.title}}
                        </a>
                        <span class='ico' ng-click="addRevisionToModuleFromCurrentList(revision.id_revision, $index)">&#10003;</span>
                    </div>
                </div>
            </div>
            <div class="revisionTable">
                <label>Доступні ревізії занять інших модулів:</label>
                <div class="revisionsList">
                    <div ng-repeat="revision in approvedLecture.foreign track by $index">
                        <a ng-href="{{revision.link}}" target="_blank">
                            Ревізія №{{revision.id_lecture_revision}} {{revision.title}}
                        </a>
                        <span class='ico' ng-click="addRevisionToModuleFromForeignList(revision.id_revision, $index)">&#10003;</span>
                    </div>
                </div>
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
                <tr ng-repeat="lecture in lectureInModule track by $index">
                    <td><span ng-if="lecture.list!='foreign'">{{lecture.id_lecture_revision}}</span></td>
                    <td>{{lecture.title}}</td>
                    <td>{{$index+1}}</td>
                    <td>
                        <div style="display: inline-block" >
                            <img src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'up.png');?>" class="editIco" ng-click="upRevisionInModule(lecture.id_lecture_revision, $index);">
                            <img src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'down.png');?>" class="editIco" ng-click="downRevisionInModule(lecture.id_lecture_revision, $index);">
                            <img src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'delete.png');?>" class="editIco" ng-click="removeRevisionFromModule(lecture.id_lecture_revision, $index);">
                        </div>
                    </td>
                </tr>
            </table>
            <button class="btn btn-primary" ng-click="editModuleRevision(lectureInModule)">Зберегти зміни</button>
            <br>
        </div>
        <br>
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

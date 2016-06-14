<?php
$this->breadcrumbs = array(
    'Модуль' => Yii::app()->createUrl("module/index", array("idModule" => $moduleRevision->id_module)),
    'Ревізії модуля' => Yii::app()->createUrl('/moduleRevision/moduleRevisions', array('idModule'=>$moduleRevision->id_module)),
    'Попередній перегляд модуля',
);
?>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/module_revision_app/app.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/module_revision_app/controllers/moduleRevisionCtrl.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/module_revision_app/services/getModuleData.js'); ?>"></script>
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
            $this->renderPartial('_moduleRevisionPreviewInfo', array('moduleRevision' => $moduleRevision));
            ?>
            <br>
            <label>Перелік ревізій занять: </label>
            <table id="pages" class="table">
                <tr>
                    <td>Номер ревізії</td>
                    <td class="titleCell" >Назва</td>
                    <td>Порядок</td>
                </tr>
                <tr ng-repeat="lecture in lectureInModule track by $index">
                    <td><span ng-if="lecture.list!='foreign'">{{lecture.id_lecture_revision}}</span></td>
                    <td>{{lecture.title}}</td>
                    <td>{{$index+1}}</td>
                </tr>
            </table>
            <br>
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

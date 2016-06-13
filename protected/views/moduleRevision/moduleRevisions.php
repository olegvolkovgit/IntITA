<?php
if($idCourse != 0) {
    $this->breadcrumbs = array(
        'Курс' => Yii::app()->createUrl('course/index', array('id' => $idCourse)),
        'Модуль' => Yii::app()->createUrl("module/index", array("idModule" => $module->module_ID, "idCourse" => $idCourse)),
        'Ревізії модуля',
    );
}else{
    $this->breadcrumbs = array(
        'Модуль' => Yii::app()->createUrl("module/index", array("idModule" => $module->module_ID)),
        'Ревізії модуля',
    );
}
?>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/module_revision_app/app.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/module_revision_app/controllers/moduleRevisionsTreeCtrl.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/module_revision_app/controllers/moduleRevisionsCtrl.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/module_revision_app/services/buildModulesRevisionsTree.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/module_revision_app/services/moduleRevisionsActions.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/module_revision_app/services/getModuleData.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/module_revision_app/directives/ajaxLoader.js'); ?>"></script>
<!--<script src="--><?php //echo StaticFilesHelper::fullPathTo('angular', 'js/lecture_revision_app/services/sendRevisionMessage.js'); ?><!--"></script>-->
<script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('js', 'bootstrap-treeview.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/bootbox.min.js'); ?>"></script>
<script type="text/javascript">
    basePath='<?php echo  Config::getBaseUrl(); ?>';
    idModule ='<?php echo $module->module_ID;?>';
    isApprover = '<?php echo $isApprover;?>';
    userId = '<?php echo $userId;?>';
</script>
<div id="revisionMainBox" ng-app="moduleRevisionsApp">
    <div class="form-group" ng-controller="moduleRevisionsTreeCtrl" ng-cloak>
        <div ng-controller="moduleRevisionsCtrl">
            <?php 
            $this->renderPartial('_moduleInfo', array('module'=>$module));
            ?>
            <?php
            $this->renderPartial('_moduleRevisionsTree');
            ?>
            <div>
                <a ng-if='!module.revision' href="" ng-click="createModuleRevision(idModule)">Створити ревізію модуля</a>
            </div>
            <div data-loading id="loaderContainer">
                <img id="ajaxLoader" src="<?php echo StaticFilesHelper::createPath('image', 'lecture', 'ajax.gif'); ?>" />
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'revision.css'); ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>" >
<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'bootstrap-treeview.css'); ?>" />
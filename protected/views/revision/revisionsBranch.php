<?php
    $this->breadcrumbs = array(
        'Модуль' => Yii::app()->createUrl("module/index", array("idModule" => $idModule)),
        'Ревізії занять модуля' => Yii::app()->createUrl("revision/moduleLecturesRevisions", array("idModule" => $idModule)),
        'Ревізії заняття',
    );
?>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lecture_revision_app/services/buildRevisionsTree.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lecture_revision_app/controllers/revisionsTree/revisionTreesCtrl.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lecture_revision_app/controllers/revisionsTree/revisionsBranchCtrl.js'); ?>"></script>
<script type="text/javascript">
    basePath='<?php echo  Config::getBaseUrl(); ?>';
    idRevision = <?php echo $idRevision;?>;
    isApprover = '<?php echo $isApprover;?>';
    userId = '<?php echo $userId;?>';
</script>
<div id="revisionMainBox">
    <div class="form-group" ng-controller="revisionTreesCtrl" ng-cloak>
        <div ng-controller="revisionsBranchCtrl">
            <?php
            $this->renderPartial('_revisionsTree');
            ?>
        </div>
    </div>
</div>


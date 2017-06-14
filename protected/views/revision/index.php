<?php
/* @var $organization */
?>
<?php
    $this->breadcrumbs = array(
        'Усі ревізії занять',
    );
?>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lecture_revision_app/services/buildRevisionsTree.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lecture_revision_app/controllers/revisionsTree/revisionTreesCtrl.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lecture_revision_app/controllers/revisionsTree/allRevisionsCtrl.js'); ?>"></script>
<script type="text/javascript">
    basePath='<?php echo  Config::getBaseUrl(); ?>';
    isApprover = '<?php echo $isApprover;?>';
    userId = '<?php echo $userId;?>';
</script>
<div id="revisionMainBox">
    <div class="form-group" ng-controller="revisionTreesCtrl" ng-cloak>
        <div ng-controller="allRevisionsCtrl" organization="<?php echo $organization ?>">
            <?php
            $this->renderPartial('_revisionsTree');
            ?>
        </div>
    </div>
</div>


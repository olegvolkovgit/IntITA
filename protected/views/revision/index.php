<?php
//todo
    $this->breadcrumbs = array("dd"=>"dd");
?>

<script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('js', 'bootstrap-treeview.js'); ?>"></script>
<script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('js', 'revision.js'); ?>"></script>

<div id="revisionMainBox">
    <?php
    if ($json) {
        $this->renderPartial('_revisionsTree', array('json'=>$json));
    }
    ?>
</div>


<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>" >
<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'bootstrap-treeview.css'); ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'revision.css'); ?>" />



<?php
//todo
    $this->breadcrumbs = array("dd"=>"dd");
?>


<div id="revisionMainBox">
    <div id="tree"></div>
</div>

<script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('js', 'bootstrap-treeview.js'); ?>"></script>
<script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('js', 'revision.js'); ?>"></script>

<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>" >
<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'bootstrap-treeview.css'); ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'revision.css'); ?>" />

<script>

    function getTree() {
        "use strict";
        // Some logic to retrieve, or generate tree structure
        var treeData = <?=$json?>;
        addButtons(treeData);
        return treeData;
    }

    $('#tree').treeview({
        data: getTree(),
        levels: 0
    });

    function newRevision(idRevision){
        $.ajax({
            method: "POST",
            url: "<?=Yii::app()->createUrl('/revision/newlecturerevision');?>",
            data: {idLecture:idRevision}
        })
    }

    function editRevision(idRevision) {
        location.href = "<?=Yii::app()->createUrl('/revision/EditLectureRevision');?>" + '?idRevision=' + idRevision;
    }

    function sendRevision(idRevision) {
        $.ajax({
            method: "POST",
            url: "<?=Yii::app()->createUrl('/revision/SendForApproveLecture');?>",
            data: {idLecture:idRevision}
        })
    }

    function reject(idRevision) {
        $.ajax({
            method: "POST",
            url: "<?=Yii::app()->createUrl('/revision/rejectLectureRevision');?>",
            data: {idLecture:idRevision}
        })
    }

    function approve(idRevision) {
        $.ajax({
            method: "POST",
            url: "<?=Yii::app()->createUrl('/revision/approveLectureRevision');?>",
            data: {idLecture:idRevision}
        })
    }

    function cancel(idRevision) {
        $.ajax({
            method: "POST",
            url: "<?=Yii::app()->createUrl('/revision/cancelLectureRevision');?>",
            data: {idLecture:idRevision}
        })
    }

</script>
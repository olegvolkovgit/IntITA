<div id="tree">
</div>

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

    function editRevision(idRevision) {
        location.href = "<?=Yii::app()->createUrl('/revision/EditLectureRevision');?>" + '?idRevision=' + idRevision;
    }

    function sendRevision(idRevision) {
        $.ajax({
            method: "POST",
            url: "<?=Yii::app()->createUrl('/revision/SendForApproveLecture');?>",
            data: {idRevision:idRevision}
        })
    }
    function cancelSendRevision(idRevision) {
        $.ajax({
            method: "GET",
            url: "<?=Yii::app()->createUrl('/revision/cancelSendForApproveLecture');?>",
            data: {idRevision:idRevision}
        })
    }

    function reject(idRevision) {
        $.ajax({
            method: "POST",
            url: "<?=Yii::app()->createUrl('/revision/rejectLectureRevision');?>",
            data: {idRevision:idRevision}
        })
    }

    function approve(idRevision) {
        $.ajax({
            method: "POST",
            url: "<?=Yii::app()->createUrl('/revision/approveLectureRevision');?>",
            data: {idRevision:idRevision}
        })
    }

    function cancel(idRevision) {
        $.ajax({
            method: "POST",
            url: "<?=Yii::app()->createUrl('/revision/cancelLectureRevision');?>",
            data: {idRevision:idRevision}
        })
    }

    function previewRevision(idRevision) {
        location.href = "<?=Yii::app()->createUrl('/revision/previewLectureRevision');?>" + '?idRevision=' + idRevision;
    }

    function createRevision(idRevision) {
        location.href = "<?=Yii::app()->createUrl('/revision/createLectureRevision');?>" + '?idRevision=' + idRevision;
    }

</script>
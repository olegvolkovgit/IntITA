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
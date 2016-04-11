<?php
    //todo
    $this->breadcrumbs = array("dd"=>"dd");
?>

<script>
    function addPageRow($table, id, title, order, status){
        var $row = $('<tr></tr>');
        var $name = $('<td></td>').html(id).appendTo($row);
        var $title = $('<td></td>').html(title).appendTo($row);
        var $order = $('<td></td>').html(order).appendTo($row);
        var $status = $('<td></td>').html(status).attr('id', 'status'+id).appendTo($row);

        var $buttons = $('<td></td>').append(
            '<div class="btn-group"> \
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> \
                    Дії <span class="caret"></span> \
                </button> \
                <ul class="dropdown-menu"> \
                    <li><a href="#" onclick="viewPage('+ id +')">Переглянути</a></li> \
                <li><a href="#" onclick="editPageRevision('+ id +')">Редагувати</a></li> \
                <li><a href="#" onclick="sendRevision('+ id +')">Надіслати на затвердження</a></li> \
                <li><a href="#" onclick="approvePageRevision('+ id +')">Затвердити</a></li> \
                <li><a href="#" onclick="rejectPageRevision('+ id +')">Відхилити</a></li> \
                <li><a href="#" onclick="cancelPageRevision('+ id +')">Скасувати</a></li> \
            </ul> \
        </div>'
        );
        $buttons.appendTo($row);
        $row.appendTo($table);
    }
</script>

<div id="revisionMainBox">
    <label>Властивоті лекції: </label>

    <table class="table">
        <tr>
            <td>Модуль</td>
            <td><?=$lectureRevision->id_module?></td>
        </tr>
        <tr>
            <td>Номер ревізії</td>
            <td><?=$lectureRevision->id_revision?></td>
        </tr>
        <tr>
            <td>Назва (укр)</td>
            <td><?=$lectureRevision->properties->title_ua?></td>
        </tr>
        <tr>
            <td>Назва (рос)</td>
            <td><?=$lectureRevision->properties->title_ru?></td>
        </tr>
        <tr>
            <td>Назва (англ)</td>
            <td><?=$lectureRevision->properties->title_en?></td>
        </tr>
        <tr>
            <td>Автор</td>
            <td><?=$lectureRevision->properties->id_user_created?></td>
        </tr>
        <tr>
            <td>Поточний статус</td>
            <td><?=$lectureRevision->getStatus()?></td>
        </tr>
    </table>
    <button onclick="addPage(<?=$lectureRevision->id_revision?>);">Додати сторінку</button>
    <button onclick="checkLecture(<?=$lectureRevision->id_revision?>);">Перевірити лекцію на наявність конфліктів</button>
    <button onclick="approveLecture(<?=$lectureRevision->id_revision?>);">Відправити лекцію на затвердження</button>
    <br>

    <label>Перелік ревізій сторінок лекції: </label>

    <table id="pages" class="table">
        <tr>
            <td>
                Номер ревізії
            </td>
            <td>
                Назва
            </td>
            <td>
                Порядковий номер
            </td>
            <td>
                Статус
            </td>
            <td>
            </td>
        </tr>
        <?php foreach ($pages as $page) {?>
        <tr>
            <script>
                addPageRow($('#pages'), <?=$page->id?>, '<?=$page->page_title?>', <?=$page->page_order?>, '<?=$page->getStatus()?>');
            </script>
        </tr>
        <?php } ?>
    </table>

    <div id="ajax_content">
    </div>

</div>

<div id='modal' class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <p></p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('js', 'bootstrap-treeview.js'); ?>"></script>
<script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('js', 'revision.js'); ?>"></script>

<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>" >
<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'bootstrap-treeview.css'); ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'revision.css'); ?>"

<br>

<script>
    function viewPage(pageId) {
        alert ('dummy '+pageId);
    }

    function addPage(lectureRevision) {
        $.ajax({
            method: "POST",
            url: "<?=Yii::app()->createUrl('/revision/addpage');?>",
            data: {idRevision:lectureRevision},
            dataType: 'json',
            success: function (data) {
                addPageRow($('#pages'), data.id, data.title, data.order, data.status);
            }
        })
    }

    function editPageRevision(pageId, statusField) {

        $.ajax({
            method: "POST",
            url: "<?=Yii::app()->createUrl('/revision/editpagerevision');?>",
            data: {idPage:pageId},
            success: function(data) {
                        $('#ajax_content').html(data);
                $.scrollTo()
            }
        })
    }

    function sendRevision(pageId) {

        $.ajax({
            method: "POST",
            url: "<?=Yii::app()->createUrl("/revision/sendpagerevision");?>",
            data: {idPage:pageId},
            dataType: "json",
            success: function(json) {
                $('#status'+pageId).html(json.status);
            }
        })
    }

    function approvePageRevision(pageId) {
        $.ajax({
            method: "POST",
            url: "<?=Yii::app()->createUrl("/revision/approvepagerevision");?>",
            data: {idPage:pageId},
            dataType: 'json',
            success: function (json) {
                $('#status'+pageId).html(json.status);
            }
        })
    }

    function rejectPageRevision(pageId) {
        $.ajax({
            method: "POST",
            url: "<?=Yii::app()->createUrl("/revision/rejectpagerevision");?>",
            data: {idPage:pageId},
            dataType: 'json',
            success: function (json) {
                $('#status'+pageId).html(json.status);
            }
        })
    }

    function cancelPageRevision(pageId) {
        $.ajax({
            method: "POST",
            url: "<?=Yii::app()->createUrl("/revision/cancelpagerevision");?>",
            data: {idPage:pageId},
            dataType: "json",
            success: function(json) {
                $('#status' + pageId).html(json.status);
            }
        })
    }

    function newRevision(pageId){
        $.ajax({
            method: "POST",
            url: "<?=Yii::app()->createUrl("/revision/newpagerevision");?>",
            data: {idPage:pageId}
        })
    }

    function up(pageId) {

        $.ajax({
            method: "POST",
            url: "/revision/uppage",
            data: {idPage:pageId}
        })
    }

    function down(pageId) {

        $.ajax({
            method: "POST",
            url: "/revision/downpage",
            data: {idPage:pageId}
        })
    }

    function checkLecture(pageId) {
        $.ajax({
            method: "POST",
            url: "/revision/checkLecture",
            data: {idLecture:pageId},
            success: function(data) {
                $('#check').html(data);
            }
        })
    }

    function approveLecture() {
        $.ajax({
            method: "POST",
            url: "/revision/SendForApproveLecture",
            data: {idLecture:<?=$lectureRevision->id_revision?>}
        })
    }

    function upElement(idEl, idPage) {
        $.ajax({
            method: "POST",
            url: "/revision/upLectureElement",
            data: {idElement:idEl, idPage:idPage}
        })
    }

    function downElement(idEl, idPage) {
        $.ajax({
            method: "POST",
            url: "/revision/downLectureElement",
            data: {idElement:idEl, idPage:idPage}
        })
    }

    function deleteElement(idEl, idPage) {
        $.ajax({
            method: "POST",
            url: "/revision/deleteLectureElement",
            data: {idElement:idEl, idPage:idPage}
        })
    }

</script>

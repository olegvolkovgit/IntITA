<?php
    //todo
$this->breadcrumbs = array(
    'Модуль' => Yii::app()->createUrl("module/index", array("idModule" => $lectureRevision->id_module)),
    'Ревізії занять модуля' => Yii::app()->createUrl('/revision/ModuleLecturesRevisions', array('idModule'=>$lectureRevision->id_module)),
    'Ревізія даного заняття',
);
?>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lesson_edit/app.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lesson_edit/controllers/lectureRevisionCtrl.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/bootbox.min.js'); ?>"></script>
<script>
    idRevision = '<?php echo $idRevision;?>';
    basePath='<?php echo  Config::getBaseUrl(); ?>';
</script>
<style>
    .editIco{
        cursor: pointer;
    }
</style>
<div ng-app="lectureRevision">
    <div ng-controller="lectureRevisionCtrl">
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
            <button ng-click="addPage();">Додати сторінку</button>
            <button ng-click="checkLecture();">Перевірити лекцію на наявність конфліктів</button>
            <button onclick="approveLecture(<?=$lectureRevision->id_revision?>);">Відправити лекцію на затвердження</button>
            <br>

            <label>Перелік ревізій сторінок лекції: </label>

            <table id="pages" class="table">
                <tr>
                    <td>Номер ревізії</td>
                    <td>Назва</td>
                    <td>Порядковий номер</td>
                    <td>Статус</td>
                    <td></td>
                </tr>
                <tr ng-repeat="page in dataPages track by $index">
                    <td>{{page.id}}</td>
                    <td>{{page.page_title}}</td>
                    <td>{{page.page_order}}</td>
                    <td>{{page.status}}</td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Дії <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a ng-click="viewPage(page.id)">Переглянути</a></li>
                                <li><a ng-click="editPageRevision(page.id)">Редагувати</a></li>
                                <li><a ng-click="sendRevision(page.id)">Надіслати на затвердження</a></li>
                                <li><a ng-click="approvePageRevision(page.id)">Затвердити</a></li>
                                <li><a ng-click="rejectPageRevision(page.id)">Відхилити</a></li>
                                <li><a ng-click="cancelPageRevision(page.id)">Скасувати</a></li>
                            </ul>
                        </div>
                        <div style="display: inline-block">
                            <img src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'up.png');?>" class="editIco" ng-click="up(page.id);">
                            <img src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'down.png');?>" class="editIco" ng-click="down(page.id);">
                            <img src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'delete.png');?>" class="editIco" ng-click="delete(page.id);">
                        </div>
                    </td>
                </tr>
            </table>
        </div>
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

    function editPageRevision(pageId) {
        location.href='<?php echo Yii::app()->createUrl("/revision/editPageRevision") ?>'+'?idPage='+pageId;
//        $.ajax({
//            method: "POST",
//            url: "<?//=Yii::app()->createUrl('/revision/editpagerevision');?>//",
//            data: {idPage:pageId},
//            success: function(data) {
//                        $('#ajax_content').html(data);
//                $.scrollTo()
//            }
//        })
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
            url: "<?=Yii::app()->createUrl("/revision/uppage");?>",
            data: {idPage:pageId}
        })
    }

    function down(pageId) {

        $.ajax({
            method: "POST",
            url: "<?=Yii::app()->createUrl("/revision/downpage");?>",
            data: {idPage:pageId}
        })
    }

    function checkLecture(pageId) {
        $.ajax({
            method: "POST",
            url: "<?=Yii::app()->createUrl("/revision/checkLecture");?>",
            data: {idLecture:pageId},
            success: function(data) {
                $('#check').html(data);
            }
        })
    }

    function approveLecture() {
        $.ajax({
            method: "POST",
            url: "<?=Yii::app()->createUrl("/revision/SendForApproveLecture");?>",
            data: {idLecture:<?=$lectureRevision->id_revision?>}
        })
    }

    function upElement(idEl, idPage) {
        $.ajax({
            method: "POST",
            url: "<?=Yii::app()->createUrl("/revision/SendForApproveLecture");?>",
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
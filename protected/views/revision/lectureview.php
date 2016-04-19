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

<script type="text/javascript">
    lang = '<?php if(CommonHelper::getLanguage()=='ua') echo 'uk'; else echo CommonHelper::getLanguage();?>';
    basePath='<?php echo  Config::getBaseUrl(); ?>';
    idLecture = 117;
    idModule = 1;
</script>
<!--<script src="--><?php //echo StaticFilesHelper::fullPathTo('angular', 'js/angular.min.js'); ?><!--"></script>-->
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.1.0/highlight.min.js"></script>
<script src='http://yastatic.net/highlightjs/8.2/highlight.min.js'></script>
<script src="http://pc035860.github.io/angular-highlightjs/angular-highlightjs.min.js"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/js/bootstrap.min.js');?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'ckeditor/ckeditor.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/ng-ckeditor.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/ngBootbox.min.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/bootbox.min.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lesson_edit/app.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lesson_edit/config.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lesson_edit/controllers.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lesson_edit/directives/lectureBlocks.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lesson_edit/directives/styleDirectives.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lesson_edit/services/sendTaskJsonService.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lesson_edit/services/getTaskJson.js'); ?>"></script>
<link href="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'bootstrapRewrite.css') ?>"/>
<div ng-app="lessonEdit" id="addTest">
    <br>
    <div ng-controller="CKEditorCtrl">
        <form onSubmit="return checkAnswersCKE($('#optionsList input:checkbox:checked'));" name="addTestForm" method="post" action="<?php echo Yii::app()->createUrl('tests/addTest');?>" novalidate>
            <fieldset>
                <?php echo Yii::t('lecture', '0713'); ?>
                <br>
                <textarea ng-cloak ckeditor="editorOptionsTask" name="condition" id="conditionTest" size="80" placeholder="<?php echo Yii::t('lecture', '0714'); ?>" required ng-model="testCondition"></textarea>
                <fieldset>
                    <legend id="label1"><?php echo Yii::t('lecture', '0701'); ?></legend>
                    <legend style="margin-left: 920px" id="label2"><?php echo Yii::t('lecture', '0704'); ?></legend>
                    <ol  class='answerList' id="optionsList" class="inputs">
                        <li ng-repeat="answer in answers track by $index">
                            <textarea ng-cloak class="testVariant" type="text" ckeditor="editorOptionsAnswer" name="option{{$index+1}}" id="option{{$index+1}}" size="80" required ng-model="option" ></textarea>
                            <div class="answerCheck">
                                <div id="answersList" class="answersCheckbox">
                                    <div><input type="checkbox" name="answer{{$index+1}}" value="{{$index+1}}"></div>
                                </div>
                            </div>
                        </li>
                    </ol>
                    <div class="answerAddRemove" ng-click="addAnswer();" id="addOption"><?php echo Yii::t('lecture', '0702'); ?></div>
                    <div class="answerAddRemove" ng-click="deleteAnswer();" ><?php echo Yii::t('lecture', '0703'); ?></div>
                </fieldset>
                <br>
                <input name="optionsNum" id="optionsNum" type="hidden" value="1"/>
                <input name="pageId" id="pageId" type="hidden" value="<?php echo '742';?>"/>
                <input name="lectureId" id="lectureId" type="hidden" value="<?php echo '117';?>"/>
                <input name="testType" id="testType" type="hidden" value="plain"/>
                <input name="author" id="author" type="hidden" value="<?php echo Teacher::getTeacherId(Yii::app()->user->getId());?>"/>
            </fieldset>
            <br>
            <input type="submit" value="<?php echo Yii::t('lecture', '0697'); ?>" id='addtests' ng-disabled=addTestForm.$invalid>
        </form>
        <button onclick='cancelTest()'><?php echo Yii::t('lecture', '0707'); ?></button>
    </div>
</div>
<script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('js', 'bootstrap-treeview.js'); ?>"></script>
<script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('js', 'revision.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'tests.js'); ?>"></script>
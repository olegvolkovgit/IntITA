<label xmlns="http://www.w3.org/1999/html">Властивоті лекції: </label>
<table class="table">
    <tr>
        <td>Cтатус:</td>
        <td>
            <div>{{lectureData.lecture.status}}</div>
            <div class="editButtons">
                <img ng-if=lectureData.lecture.canApprove ng-click=approveRevision('<?php echo $lectureRevision->id_revision; ?>')
                     src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'approve.png'); ?>"
                     title="Затвердити"/>
                <img ng-if=lectureData.lecture.canEdit ng-click=editRevision('<?=Yii::app()->createUrl("revision/editLectureRevision", array("idRevision" => $lectureRevision->id_revision)); ?>')
                     src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'edit_revision.png'); ?>"
                     title="Редагувати заняття"/>
                <img ng-if=lectureData.lecture.canSendForApproval ng-click=sendRevision('<?php echo $lectureRevision->id_revision; ?>')
                     src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'send_approve.png'); ?>"
                     title="Відправити на затвердження"/>
                <img ng-if=lectureData.lecture.canCancelSendForApproval ng-click=cancelSendRevision('<?php echo $lectureRevision->id_revision; ?>')
                     src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'cancel_send.png'); ?>"
                     title="Скасувати відправку на затвердження"/>
                <img ng-if=lectureData.lecture.canCancelRevision ng-click=cancelRevision('<?php echo $lectureRevision->id_revision; ?>')
                     src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'cancel_revision.png'); ?>"
                     title="Скасувати ревізію"/>
                <img ng-if=lectureData.lecture.canRejectRevision ng-click=rejectRevision('<?php echo $lectureRevision->id_revision; ?>')
                     src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'reject_revision.png'); ?>"
                     title="Відхилити ревізію"/>
                <a ng-href="{{lectureData.lecture.link}}" >
                    <img style="width: 48px" ng-if=lectureData.lecture.canCancelRevision
                         src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'view.png'); ?>"
                         title="Переглянути заняття"/>
                </a>
            </div>
        </td>
    </tr>
    <tr>
        <td>Модуль:</td>
        <td><?= Module::getModuleName($lectureRevision->id_module).' (id='.$lectureRevision->id_module.')'?></td>
    </tr>
    <tr>
        <td>Номер ревізії:</td>
        <td><?=$lectureRevision->id_revision?></td>
    </tr>
    <tr>
        <td>Назва (укр):</td>
        <td><?=$lectureRevision->properties->title_ua?></td>
    </tr>
    <tr>
        <td>Назва (рос):</td>
        <td><?=$lectureRevision->properties->title_ru?></td>
    </tr>
    <tr>
        <td>Назва (англ):</td>
        <td><?=$lectureRevision->properties->title_en?></td>
    </tr>
    <tr>
        <td>Автор:</td>
        <td><?=StudentReg::getUserNamePayment($lectureRevision->properties->id_user_created).' (id='.$lectureRevision->properties->id_user_created.')'?></td>
    </tr>
</table>

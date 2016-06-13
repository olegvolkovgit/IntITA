<label>Властивості ревізії модуля: </label>
<table class="table">
    <tr>
        <td>Cтатус:</td>
        <td>
            <div>{{moduleData.module.status}}</div>
            <div class="editButtons">
                <img ng-if=lectureData ng-click=previewRevision('<?=Yii::app()->createUrl("revision/previewLectureRevision", array("idRevision" => $moduleRevision->id_module_revision)); ?>')
                     src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'preview.png'); ?>"
                     title="Попередній перегляд"/>
                <img ng-if=lectureData.lecture.canSendForApproval ng-click=sendRevision('<?php echo $moduleRevision->id_module_revision; ?>')
                     src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'send_approve.png'); ?>"
                     title="Відправити на затвердження"/>
                <img ng-if=lectureData.lecture.canCancelEdit ng-click=cancelEditByEditor('<?php echo $moduleRevision->id_module_revision; ?>')
                     src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'cancelled_author.png'); ?>"
                     title="Відміна автором"/>
            </div>
        </td>
    </tr>
    <tr>
        <td>Номер ревізії:</td>
        <td><?=$moduleRevision->id_module_revision ?></td>
    </tr>
    <tr>
        <td>Назва (укр):</td>
        <td>
            <?=$moduleRevision->properties->title_ua ?>
        </td>
    </tr>
    <tr>
        <td>Назва (рос):</td>
        <td>
            <?=$moduleRevision->properties->title_ru ?>
        </td>
    </tr>
    <tr>
        <td>Назва (англ):</td>
        <td>
            <?=$moduleRevision->properties->title_en ?>
        </td>
    </tr>
    <tr>
        <td>Автор:</td>
        <td><?=StudentReg::getUserNamePayment($moduleRevision->properties->id_user_created).' (id='.$moduleRevision->properties->id_user_created.')'?></td>
    </tr>
</table>

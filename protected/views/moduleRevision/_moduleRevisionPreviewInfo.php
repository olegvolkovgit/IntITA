<label class="showMore" ng-click="isOpenMore = !isOpenMore">Властивості ревізії модуля: <span>&#9660;</span></label>
<table class="table" ng-show="isOpenMore">
    <tr>
        <td><label>Cтатус:</label></td>
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
        <td><label>UID модуля ревізії:</label></td>
        <td><?=$moduleRevision->id_module ?></td>

        <td><label>Номер ревізії:</label></td>
        <td><?=$moduleRevision->id_module_revision ?></td>
    </tr>
    <tr>
        <td><label>Назва (укр):</label></td>
        <td><?=$moduleRevision->properties->title_ua ?></td>

        <td><label>Назва (рос):</label></td>
        <td><?=$moduleRevision->properties->title_ru ?></td>
    </tr>
    <tr>
        <td><label>Назва (англ):</label></td>
        <td><?=$moduleRevision->properties->title_en ?></td>

        <td><label>Псевдонім:</label></td>
        <td><?=$moduleRevision->properties->alias ?></td>
    </tr>
    <tr>
        <td><label>Мова:</label></td>
        <td><?=$moduleRevision->properties->language ?></td>

        <td><label>Для кого:</label></td>
        <td><?=$moduleRevision->properties->for_whom ?></td>
    </tr>
    <tr>
        <td><label>Чого ви навчитеся:</label></td>
        <td>
            <?=$moduleRevision->properties->what_you_learn ?>
        </td>

        <td><label>Що ви отримаєте:</label></td>
        <td><?=$moduleRevision->properties->what_you_get ?></td>
    </tr>
    <tr>
        <td><label>Годин в день:</label></td>
        <td><?=$moduleRevision->properties->hours_in_day ?></td>

        <td><label>Днів в тиждень:</label></td>
        <td><?=$moduleRevision->properties->days_in_week ?></td>
    </tr>
    <tr>
        <td><label>Доступність модуля:</label></td>
        <td><?=$moduleRevision->properties->cancelled?'Скасований':'Доступний' ?></td>

        <td><label>Готовність модуля:</label></td>
        <td><?=$moduleRevision->properties->status?'Готовий':'В розробці' ?></td>
    </tr>
    <tr>
        <td><label>Ціна:</label></td>
        <td><?=$moduleRevision->properties->module_price ?></td>

        <td><label>Ціна оффлайн:</label></td>
        <td><?=$moduleRevision->properties->price_offline ?></td>
    </tr>
    <tr>
        <td><label>Рівень:</label></td>
        <td><?=$moduleRevision->properties->level0->title_ua ?></td>

        <td><label>Автор ревізії:</label></td>
        <td><?=StudentReg::getUserNamePayment($moduleRevision->properties->id_user_created).' (id='.$moduleRevision->properties->id_user_created.')'?></td>
    </tr>
</table>

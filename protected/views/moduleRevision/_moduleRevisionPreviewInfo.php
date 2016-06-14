<label class="showMore" ng-click="isOpenMore = !isOpenMore">Властивості ревізії модуля: <span>&#9660;</span></label>
<table class="table" ng-show="isOpenMore">
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
        <td>UID модуля ревізії:</td>
        <td><?=$moduleRevision->id_module ?></td>
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
        <td>Псевдонім:</td>
        <td>
            <?=$moduleRevision->properties->alias ?>
        </td>
    </tr>
    <tr>
        <td>Мова:</td>
        <td>
            <?=$moduleRevision->properties->language ?>
        </td>
    </tr>
    <tr>
        <td>Для кого:</td>
        <td>
            <?=$moduleRevision->properties->for_whom ?>
        </td>
    </tr>
    <tr>
        <td>Чого ви навчитеся:</td>
        <td>
            <?=$moduleRevision->properties->what_you_learn ?>
        </td>
    </tr>
    <tr>
        <td>Що ви отримаєте:</td>
        <td>
            <?=$moduleRevision->properties->what_you_get ?>
        </td>
    </tr>
    <tr>
        <td>Рівень:</td>
        <td>
            <?=$moduleRevision->properties->level0->title_ua ?>
        </td>
    </tr>
    <tr>
        <td>Годин в день:</td>
        <td>
            <?=$moduleRevision->properties->hours_in_day ?>
        </td>
    </tr>
    <tr>
        <td>Днів в тиждень:</td>
        <td>
            <?=$moduleRevision->properties->days_in_week ?>
        </td>
    </tr>
    <tr>
        <td>Днів в тиждень:</td>
        <td>
            <?=$moduleRevision->properties->days_in_week ?>
        </td>
    </tr>
    <tr>
        <td>Доступність модуля:</td>
        <td>
            <?=$moduleRevision->properties->cancelled?'Скасований':'Доступний' ?>
        </td>
    </tr>
    <tr>
        <td>Готовність модуля:</td>
        <td>
            <?=$moduleRevision->properties->status?'Готовий':'В розробці' ?>
        </td>
    </tr>
    <tr>
        <td>Ціна оффлайн:</td>
        <td>
            <?=$moduleRevision->properties->price_offline ?>
        </td>
    </tr>
    <tr>
        <td>Автор ревізії:</td>
        <td><?=StudentReg::getUserNamePayment($moduleRevision->properties->id_user_created).' (id='.$moduleRevision->properties->id_user_created.')'?></td>
    </tr>
</table>

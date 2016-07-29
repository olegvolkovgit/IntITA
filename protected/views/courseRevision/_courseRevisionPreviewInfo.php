<label class="showMore" ng-click="isOpenMore = !isOpenMore">Властивості ревізії курса: <span>&#9660;</span></label>
<table class="table" style="margin-bottom: 0">
    <tr>
        <td><label>Cтатус:</label></td>
        <td>
            <div>{{courseData.course.status}}</div>
            <div class="editButtons">
                <img ng-if=courseData.course.canApprove ng-click=approveCourseRevision('<?php echo $courseRevision->id_course_revision; ?>')
                     src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'approve.png'); ?>"
                     title="Затвердити"/>
                <img ng-if=courseData.course.canEdit ng-click=editCourseRevisionPage('<?=Yii::app()->createUrl("courseRevision/editCourseRevisionPage", array("idRevision" => $courseRevision->id_course_revision)); ?>')
                     src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'edit_revision.png'); ?>"
                     title="Редагувати ревізію модуля"/>
                <img ng-if=courseData.course.canSend ng-click=sendCourseRevision('<?php echo $courseRevision->id_course_revision; ?>',false)
                     src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'send_approve.png'); ?>"
                     title="Відправити на затвердження"/>
                <img ng-if=courseData.course.canCancelSend ng-click=cancelSendCourseRevision('<?php echo $courseRevision->id_course_revision; ?>')
                     src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'cancel_send.png'); ?>"
                     title="Скасувати відправку на затвердження"/>
                <img ng-if=courseData.course.canCancel ng-click=cancelCourseRevision('<?php echo $courseRevision->id_course_revision;  ?>')
                     src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'cancel_revision.png'); ?>"
                     title="Скасувати ревізію"/>
                <img ng-if=courseData.course.canReject ng-click=rejectCourseRevision('<?php echo $courseRevision->id_course_revision; ?>')
                     src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'reject_revision.png'); ?>"
                     title="Відхилити ревізію"/>
                <img ng-if=courseData.course.canRelease ng-click=releaseCourseRevision('<?php echo $courseRevision->id_course_revision; ?>')
                     src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'release.png'); ?>"
                     title="Реліз ревізії"/>
                <img ng-if=courseData.course.canCancelEdit ng-click=cancelCourseEditByEditor('<?php echo $courseRevision->id_course_revision; ?>',false)
                     src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'cancelled_author.png'); ?>"
                     title="Відміна автором"/>
                <img ng-if=courseData.course.canRestoreEdit ng-click=restoreCourseEditByEditor('<?php echo $courseRevision->id_course_revision; ?>')
                     src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'restored.png'); ?>"
                     title="Відновити редагування"/>
                <a ng-if=courseData.course.view ng-href="{{courseData.course.view}}" >
                    <img style="width: 48px" src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'view.png'); ?>"
                         title="Переглянути курс"/>
                </a>
            </div>
        </td>
        <td>Логотип:</td>
        <td>
            <img class="moduleImg"
                 src="<?php echo StaticFilesHelper::createPath('image', 'course', $courseRevision->properties->course_img); ?>"/>
        </td>
    </tr>
</table>
<table class="table" ng-show="isOpenMore">
    <tr>
        <td><label>UID модуля ревізії:</label></td>
        <td><?=$courseRevision->id_course ?></td>

        <td><label>Номер ревізії:</label></td>
        <td><?=$courseRevision->id_course_revision ?></td>
    </tr>
    <tr>
        <td><label>Назва (укр):</label></td>
        <td><?=$courseRevision->properties->title_ua ?></td>

        <td><label>Для кого(UA):</label></td>
        <td><?=$courseRevision->properties->for_whom_ua ?></td>
    </tr>
    <tr>
        <td><label>Назва (рос):</label></td>
        <td><?=$courseRevision->properties->title_ru ?></td>

        <td><label>Чого ви навчитеся(UA):</label></td>
        <td><?=$courseRevision->properties->what_you_learn_ua ?></td>
    </tr>
    <tr>
        <td><label>Назва (англ):</label></td>
        <td><?=$courseRevision->properties->title_en ?></td>

        <td><label>Що ви отримаєте(UA):</label></td>
        <td><?=$courseRevision->properties->what_you_get_ua ?></td>
    </tr>
    <tr>
        <td><label>Псевдонім:</label></td>
        <td><?=$courseRevision->properties->alias ?></td>

        <td><label>Рівень:</label></td>
        <td><?=$courseRevision->properties->level0->title_ua ?></td>
    </tr>
    <tr>
        <td><label>Для кого(RU):</label></td>
        <td><?=$courseRevision->properties->for_whom_ru ?></td>

        <td><label>Для кого(EN):</label></td>
        <td><?=$courseRevision->properties->for_whom_en ?></td>
    </tr>
    <tr>
        <td><label>Чого ви навчитеся(RU):</label></td>
        <td><?=$courseRevision->properties->what_you_learn_ua ?></td>

        <td><label>Чого ви навчитеся(EN):</label></td>
        <td><?=$courseRevision->properties->what_you_learn_en ?></td>
    </tr>
    <tr>
        <td><label>Що ви отримаєте(RU):</label></td>
        <td><?=$courseRevision->properties->what_you_get_ru ?></td>

        <td><label>Що ви отримаєте(EN):</label></td>
        <td><?=$courseRevision->properties->what_you_get_en ?></td>
    </tr>
    <tr>
        <td><label>Доступність модуля:</label></td>
        <td><?=$courseRevision->properties->cancelled?'Скасований':'Доступний' ?></td>

        <td><label>Готовність модуля:</label></td>
        <td><?=$courseRevision->properties->status?'Готовий':'В розробці' ?></td>
    </tr>
    <tr>
        <td><label>Ціна:</label></td>
        <td><?=$courseRevision->properties->course_price ?></td>

        <td><label>Мова:</label></td>
        <td><?=$courseRevision->properties->language ?></td>
    </tr>
    <tr>
        <td><label>Автор ревізії:</label></td>
        <td><?=StudentReg::getUserNamePayment($courseRevision->properties->id_user_created).' (id='.$courseRevision->properties->id_user_created.')'?></td>
    </tr>
</table>

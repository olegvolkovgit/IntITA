<h3 class="showMore" ng-click="isOpenMore = !isOpenMore">Курс: <?=$course->title_ua?> <span>&#9660;</span></h3>
<table class="table" ng-show="isOpenMore">
    <tr>
        <td><label>Курс:</label></td>
        <td><?= Course::getCourseName($course->course_ID).' (id='.$course->course_ID.')'?></td>

        <td><label>Актуальна ревізія:</label></td>
        <td><a>Ревізія №<??></a></td>
    </tr>
    <tr>
        <td><label>Назва (укр):</label></td>
        <td><?=$course->title_ua ?></td>

        <td><label>Чого ви навчитеся:</label></td>
        <td><?=$course->what_you_learn_ua ?></td>
    </tr>
    <tr>
        <td><label>Назва (рос):</label></td>
        <td><?=$course->title_ru ?></td>

        <td><label>Що ви отримаєте:</label></td>
        <td><?=$course->what_you_get_ua ?></td>
    </tr>
    <tr>
        <td><label>Назва (англ):</label></td>
        <td><?=$course->title_en ?></td>

        <td><label>Для кого:</label></td>
        <td><?=$course->for_whom_ua ?></td>
    </tr>
    <tr>
        <td><label>Псевдонім:</label></td>
        <td><?=$course->alias ?></td>

        <td><label>Рівень:</label></td>
        <td><?=$course->level0->title_ua ?></td>
    </tr>
    <tr>
        <td><label>Ціна:</label></td>
        <td><?=$course->course_price ?></td>

        <td><label>Доступність модуля:</label></td>
        <td><?=$course->cancelled?'Скасований':'Доступний' ?></td>
    </tr>
    <tr>
        <td><label>Номер курса:</label></td>
        <td><?=$course->course_number ?></td>

        <td><label>Готовність модуля:</label></td>
        <td><?=$course->status?'Готовий':'В розробці' ?></td>
    </tr>
    <tr>
        <td><label>Мова:</label></td>
        <td><?=$course->language ?></td>

        <td><label>Логотип:</label></td>
        <td><img class="moduleImg" src="<?php echo StaticFilesHelper::createPath('image', 'course', $course->course_img); ?>"/></td>
    </tr>
</table>
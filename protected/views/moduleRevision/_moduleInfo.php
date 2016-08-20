<h3 class="showMore" ng-click="isOpenMore = !isOpenMore">Модуль: <?=$module->title_ua?> <span>&#9660;</span></h3>
<table class="table" ng-show="isOpenMore">
    <tr>
        <td><label>Модуль:</label></td>
        <td><?= Module::getModuleName($module->module_ID).' (id='.$module->module_ID.')'?></td>

        <td><label>Актуальна ревізія:</label></td>
        <td><a href="<?=Yii::app()->createUrl('/moduleRevision/previewModuleRevision',array('idRevision'=>$module->id_module_revision));?>">Ревізія №<?=$module->id_module_revision?></a></td>
    </tr>
    <tr>
        <td><label>Назва (укр):</label></td>
        <td><?=$module->title_ua ?></td>

        <td><label>Чого ви навчитеся:</label></td>
        <td><?=$module->what_you_learn ?></td>
    </tr>
    <tr>
        <td><label>Назва (рос):</label></td>
        <td><?=$module->title_ru ?></td>

        <td><label>Що ви отримаєте:</label></td>
        <td><?=$module->what_you_get ?></td>
    </tr>
    <tr>
        <td><label>Назва (англ):</label></td>
        <td><?=$module->title_en ?></td>

        <td><label>Для кого:</label></td>
        <td><?=$module->for_whom ?></td>
    </tr>
    <tr>
        <td><label>Псевдонім:</label></td>
        <td><?=$module->alias ?></td>

        <td><label>Рівень:</label></td>
        <td><?=$module->level0->title_ua ?></td>
    </tr>
    <tr>
        <td><label>Годин в день:</label></td>
        <td><?=$module->hours_in_day ?></td>

        <td><label>Доступність модуля:</label></td>
        <td><?=$module->cancelled?'Скасований':'Доступний' ?></td>
    </tr>
    <tr>
        <td><label>Днів в тиждень:</label></td>
        <td><?=$module->days_in_week ?></td>

        <td><label>Готовність модуля:</label></td>
        <td><?=$module->status?'Готовий':'В розробці' ?></td>
    </tr>
    <tr>
        <td><label>Ціна:</label></td>
        <td><?=$module->module_price ?></td>

        <td><label>Ціна оффлайн:</label></td>
        <td><?=$module->price_offline ?></td>
    </tr>
    <tr>
        <td><label>Мова:</label></td>
        <td><?=$module->language ?></td>

        <td><label>Категорії:</label></td>
        <td>
            <div class="tags tagCloud">
                <ul class="select-search-list">
                    <?php foreach($module->moduleTags as $tag){ ?>
                        <li>
                <span class="select-search-list-item_selection-remove">
                <?php echo $tag->tag['tag_ua'] ?>
                </span>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </td>
    </tr>
    <tr>
        <td><label>Логотип:</label></td>
        <td><img class="moduleImg" src="<?php echo StaticFilesHelper::createPath('image', 'module', $module->module_img); ?>"/></td>
    </tr>
</table>
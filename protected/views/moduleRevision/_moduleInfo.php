<h3 class="showMore" ng-click="isOpenMore = !isOpenMore">Модуль: <?=$module->title_ua?> <span>&#9660;</span></h3>
<table class="table" ng-show="isOpenMore">
    <tr>
        <td>Модуль:</td>
        <td><?= Module::getModuleName($module->module_ID).' (id='.$module->module_ID.')'?></td>
    </tr>
    <tr>
        <td>Актуальна ревізія:</td>
        <td><?=$module->id_module_revision?></td>
    </tr>
    <tr>
        <td>Назва (укр):</td>
        <td><?=$module->title_ua?></td>
    </tr>
    <tr>
        <td>Назва (рос):</td>
        <td><?=$module->title_ru?></td>
    </tr>
    <tr>
        <td>Назва (англ):</td>
        <td><?=$module->title_en?></td>
    </tr>
    <tr>
        <td>Псевдонім:</td>
        <td><?=$module->alias?></td>
    </tr>
    <tr>
        <td>Мова:</td>
        <td><?=$module->language?></td>
    </tr>
    <tr>
        <td>Ціна модуля:</td>
        <td><?=$module->module_price?></td>
    </tr>
</table>
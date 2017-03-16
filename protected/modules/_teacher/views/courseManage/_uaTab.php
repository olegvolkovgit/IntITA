<?php
/**
 * @var $model Course
 */
?>
<table class="table table-hover">
    <tbody>
    <tr>
        <td width="30%">Назва (укр.) *: </td>
        <td class="recall"><?=CHtml::encode($model->title_ua);?></td>
    </tr>
    <tr>
        <td>Для кого (укр.): </td>
        <td class="recall"><?=CHtml::encode($model->for_whom_ua);?></td>
    </tr>
    <tr>
        <td>Що ти вивчиш (укр.): </td>
        <td class="recall"><?=CHtml::encode($model->what_you_learn_ua);?></td>
    </tr>
    <tr>
        <td>Що ти отримаєш (укр.): </td>
        <td class="recall"><?=CHtml::encode($model->what_you_get_ua);?></td>
    </tr>
    </tbody>
</table>

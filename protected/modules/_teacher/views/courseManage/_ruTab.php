<?php
/**
 * @var $model Course
 */
?>
<table class="table table-hover">
    <tbody>
    <tr>
        <td width="30%">Назва (рос.) *: </td>
        <td><?=CHtml::encode($model->title_ru);?></td>
    </tr>
    <tr>
        <td>Для кого (рос.): </td>
        <td class="recall"><?=CHtml::encode($model->for_whom_ru);?></td>
    </tr>
    <tr>
        <td>Що ти вивчиш (рос.): </td>
        <td class="recall"><?=CHtml::encode($model->what_you_learn_ru);?></td>
    </tr>
    <tr>
        <td>Що ти отримаєш (рос.): </td>
        <td class="recall"><?=CHtml::encode($model->what_you_get_ru);?></td>
    </tr>
    </tbody>
</table>
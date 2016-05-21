<?php
/**
 * @var $model Course
 */
?>
<table class="table table-hover">
    <tbody>
    <tr>
        <td width="30%">Назва (рус.) *: </td>
        <td><?=CHtml::encode($model->title_ru);?></td>
    </tr>
    <tr>
        <td>Для кого (рус.): </td>
        <td class="recall"><?=CHtml::encode($model->for_whom_ru);?></td>
    </tr>
    <tr>
        <td>Що ти вивчиш (рус.): </td>
        <td class="recall"><?=CHtml::encode($model->what_you_learn_ru);?></td>
    </tr>
    <tr>
        <td>Що ти отримаєш (рус.): </td>
        <td class="recall"><?=CHtml::encode($model->what_you_get_ru);?></td>
    </tr>
    </tbody>
</table>
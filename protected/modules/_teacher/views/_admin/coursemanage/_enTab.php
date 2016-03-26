<?php
/**
 * @var $model Course
 */
?>
<table class="table table-hover">
    <tbody>
    <tr>
        <td width="30%">Назва (англ.) *: </td>
        <td><?=$model->title_en;?></td>
    </tr>
    <tr>
        <td>Для кого (англ.): </td>
        <td class="recall"><?=$model->for_whom_en;?></td>
    </tr>
    <tr>
        <td>Що ти вивчиш (англ.): </td>
        <td class="recall"><?=$model->what_you_learn_en;?></td>
    </tr>
    <tr>
        <td>Що ти отримаєш (англ.): </td>
        <td class="recall"><?=$model->what_you_get_en;?></td>
    </tr>
    </tbody>
</table>

<?php
/* @var $user StudentReg*/
?>
<br>
<div class="col-md-8">
    <ul class="list-inline">
        <li>
            <button type="button" class="btn btn-primary"
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/trainerAdmin/userWithTrainerList'); ?>')">
                Список користувачів з консультантом</button>
        </li>
    </ul>
    <br>
    <h4>Список користувачів без консультанта</h4>

    <?php

    if (!empty($users)) { ?>
    <table class="table table-striped">
        <tr>
            <td><b>email</b></td>
            <td>Ім'я</td>
            <td>Тренер</td>
            <td>Додати консультанта</td>
        </tr>
        <?php
        foreach ($users as $user) {
            ?>
            <tr>
                <td><?php echo $user->email ?></td>
                <td><?php echo $user->userName(); ?>
                </td>
                <td><?php echo 'Немає' ?></td>
                <td>
                    <a href="#"
                       onclick="loadUserWithoutTrainer('<?php echo Yii::app()->createUrl("/_teacher/_admin/trainerAdmin/addTrainer",
                           array("id" => $user->id))?>')">
                        <img src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'plus.jpg')?>"
                             align="bottom">
                    </a>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>
<?php
} else {
    echo "Всі користувачі з тренерами";
}
?>
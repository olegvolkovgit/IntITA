<br>
<div class="col-md-8">
    <button type="button" class="btn btn-link">
        <a href="<?php echo Yii::app()->createUrl('/_admin/trainer/userWithTrainerList'); ?>">Список користувачів з
            тренером</a>
    </button>

    <h2>Список користувачів без тренера</h2>
    <?php

    if (!empty($users)) { ?>
    <table class="table table-striped">
        <tr>
            <td><b>email</b></td>
            <td>Ім'я</td>
            <td>Тренер</td>
            <td>Додати тренера</td>
        </tr>
        <?php
        foreach ($users as $user) {
            ?>
            <tr>
                <td><?php echo $user->email ?></td>
                <td><?php echo $user->lastName . " " . $user->firstName; ?>
                </td>
                <td><?php echo 'Немає' ?></td>
                <td>
                    <a href="<?php echo Yii::app()->createUrl("/_admin/trainer/addTrainer", array("id" => $user->id))?>">
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
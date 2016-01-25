<?php
/* @var $user StudentReg */
?>
    <br>
    <div class="col-md-8">
        <a href="<?php echo Yii::app()->createUrl('/_admin/trainer/index'); ?>">Список користувачів без тренера</a>

    <h2>Список користувачів з тренером</h2>
<?php

if (!empty($users)) { ?>
    <table class="table table-striped">
        <tr>
            <td><b>email</b></td>
            <td>Ім'я</td>
            <td>Тренер</td>
            <td>Змінити тренера</td>
        </tr>
        <?php
        foreach ($users as $user) {
            ?>
            <tr>
                <td><?php echo $user->email ?></td>
                <td><?php echo $user->userName(); ?></td>
                <td><?php $name = $user->getTrainer();
                    $name = Teacher::getTeacherName($name);
                    echo $name;?></td>
                <td>
                    <a href="<?php echo Yii::app()->createUrl("/_admin/trainer/changeTrainer",
                        array("id" => $user->id, 'oldTrainerId' => $user->getTrainer()))?>">
                        <img src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'restore.png')?>"
                             align="bottom">
                    </a>
                    <a href="<?php echo Yii::app()->createUrl("/_admin/trainer/removeUserTrainer",
                        array("id" => $user->id))?>"
                       onclick="return confirm('Ви впевнені що хочете видалити тренера?');">
                        <img src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'delete.png')?>"
                             align="bottom">
                    </a>
                </td>
            </tr>
        <?php } ?>
    </table>
    </div>
<?php
} else {
    echo "Користувачів з тренерами на данний час немає";
}
?>
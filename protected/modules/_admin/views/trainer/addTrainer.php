<?php
/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 03.12.2015
 * Time: 18:16
 *
 * @var $trainer Teacher
 * @var $user StudentReg
 */
?>
<div class="col-md-6">
    <button type="button" class="btn btn-link">
        <a href="<?php echo Yii::app()->createUrl('/_admin/trainer/index'); ?>">Список користувачів без тренера</a>
    </button>
    <br>
    <button type="button" class="btn btn-link">
        <a href="<?php echo Yii::app()->createUrl('/_admin/trainer/userWithTrainerList'); ?>">Список користувачів з
            тренером</a>
    </button>
    <h2>Призначення тренера для користувача:</h2>

    <h3><?php $name = $user->firstName . " " . $user->secondName;
        if (!$name) $name = $user->email;
        echo $name ?></h3>

    <div class="form-group">
        <form method="post" action="<?php echo Yii::app()->createUrl('/_admin/trainer/setTrainer'); ?>">
            <input class="form-control" name="userId" id="disabledInput" type="hidden" value="<?php echo $user->id ?>">
            <select required name="trainerId" class="form-control">
                <option disabled>Виберіть тренера</option>
                <?php foreach ($trainers as $trainer) { ?>
                    <option value="<?php echo $trainer->teacher_id ?>">
                        <?php echo $trainer->lastName() . " " . $trainer->firstName()?>
                    </option>
                <?php } ?>
            </select>
            <br>
            <br>
            <input type="submit" class="btn btn-default" value="Призначити тренера">
        </form>
    </div>
</div>

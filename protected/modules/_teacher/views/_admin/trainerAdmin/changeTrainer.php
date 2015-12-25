<?php
/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 04.12.2015
 * Time: 15:06
 * @var $trainer Teacher
 * @var $user StudentReg
 */
?>
<div class="col-md-6">
        <a href="#" onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/trainerAdmin/index'); ?>')">
            Список користувачів без тренера</a>
    <br>
        <a href="#" onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/trainerAdmin/userWithTrainerList'); ?>')">
            Список користувачів з тренером</a>
    <h2>Призначення тренера для користувача:</h2>

    <h3><?php $name = $user->firstName . " " . $user->secondName;
        if (!$name) $name = $user->email;
        echo $name ?></h3>
    <br>
    <?php if (isset($oldTrainer)) { ?>
        <h2>Колишній тренер :
            <br>
            <?php echo $oldTrainer->getTeacherName($oldTrainer->teacher_id) ?></h2><br>
    <?php } ?>
    <div class="form-group">
        <form method="post"
              onsubmit="addTrainer('<?php echo Yii::app()->createUrl('/_admin/trainer/editTrainer'); ?>');return false;">

            <input class="form-control" name="userId" id="user" type="hidden" value="<?php echo $user->id ?>">
            <select required name="trainerId" class="form-control">
                <option disabled>Виберіть тренера</option>
                <?php foreach ($trainers as $trainer) { ?>
                    <option
                        value="<?php echo $trainer->teacher_id ?>">
                        <?php echo $trainer->getName()?></option>
                <?php } ?>
            </select>
            <br>
            <br>
            <input type="submit" class="btn btn-default" value="Призначити тренера">
        </form>
    </div>
</div>


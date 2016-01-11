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
<div class="col-md-9">

    <ul class="list-inline">
        <li>
            <button type="button" class="btn btn-primary"
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/trainerAdmin/index'); ?>')">
                Список користувачів без консультанта</button>
        </li>
        <li>
            <button type="button" class="btn btn-primary"
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/trainerAdmin/index'); ?>')">
                Список користувачів з консультантом</button>
        </li>
    </ul>
    <br>
    <h4>Призначення консультанта для користувача:</h4>

    <h3><?php $name = $user->firstName . " " . $user->secondName;
        if (!$name) $name = $user->email;
        echo $name ?></h3>

    <div class="form-group">
        <form method="post"
              onsubmit="addTrainer('<?php echo Yii::app()->createUrl('/_teacher/_admin/trainerAdmin/setTrainer');?>');return false;">
            <input class="form-control" name="userId" id="user" type="hidden" value="<?php echo $user->id ?>">
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

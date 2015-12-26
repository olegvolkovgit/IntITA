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
<div class="col-md-8">

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

    <h5><?php echo $user->getNameOrEmail() ?></h5>
    <br>
    <?php if (isset($oldTrainer)) { ?>
        <h4>Колишній консультант :
            <br>
            <?php echo $oldTrainer->getTeacherName($oldTrainer->teacher_id) ?></h4><br>
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


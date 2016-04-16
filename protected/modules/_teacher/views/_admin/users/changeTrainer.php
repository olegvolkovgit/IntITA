<?php
/**
 * @var $trainer Teacher
 * @var $oldTrainer Teacher
 * @var $user StudentReg
 * @var $trainers array
 */
?>
<div class="col-md-8">
    <h4><em>Користувач:</em></h4>
    <div id="userInfo">
        <?php echo $user->firstName . " " . $user->secondName . " &lt;" . $user->email . "&gt;"; ?>
    </div>
    <br>
    <?php if ($oldTrainer) { ?>
        <h4><em>Тренер:</em></h4>
        <form method="post"
              onsubmit="addTrainer('<?php echo Yii::app()->createUrl("/_teacher/_admin/users/removeTrainer"); ?>', 'remove');return false;">
            <input class="form-control" id="user" type="hidden" value="<?php echo $user->id ?>">
            <input class="form-control" id="oldTrainerId" type="hidden" value="<?php echo $oldTrainer->user_id ?>">
            <div id="userInfo">
                <?php echo $oldTrainer->getName() . " &lt;" . $oldTrainer->email() . "&gt;"; ?>
            </div>
            <input type="submit" class="btn btn-success" value="Скасувати">
        </form>
    <?php } ?>
    <br>
    <h4><em>Новий тренер:</em></h4>
    <div class="form-group">
        <form method="post"
              onsubmit="addTrainer('<?php echo Yii::app()->createUrl("/_teacher/_admin/users/editTrainer"); ?>', 'edit');return false;">
            <input class="form-control" id="user" type="hidden" value="<?php echo $user->id ?>">
            <?php $this->renderPartial('_selectTrainer'); ?>
            <br>
            <br>
            <input type="submit" class="btn btn-success" value="Призначити тренера">
        </form>
    </div>
</div>


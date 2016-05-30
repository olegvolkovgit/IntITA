<?php
/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 03.12.2015
 * Time: 18:16
 *
 * @var $trainers array
 * @var $trainer Teacher
 * @var $user StudentReg
 */
?>
<div class="col-md-9">
    <h4><em>Користувач:</em></h4>
    <div id="userInfo">
        <?php echo $user->firstName . " " . $user->secondName . " &lt;" . $user->email . "&gt;"; ?>
    </div>
    <br>
    <h4><em>Тренер:</em></h4>
    <div class="form-group">
        <form method="post"
              onsubmit="addTrainer('<?php echo Yii::app()->createUrl("/_teacher/_admin/users/setTrainer"); ?>', 'new','<?php echo addslashes($user->firstName . " " . $user->secondName . " &lt;" . $user->email . "&gt;"); ?>');return false;">
            <input class="form-control" id="user" type="hidden" value="<?php echo $user->id ?>">
            <?php $this->renderPartial('_selectTrainer');?>
            <br>
            <br>
            <input type="submit" class="btn btn-success" value="Призначити тренера">
        </form>
    </div>
</div>

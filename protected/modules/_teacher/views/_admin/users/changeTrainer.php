<?php
/**
 * @var $trainer Teacher
 * @var $oldTrainer Teacher
 * @var $user StudentReg
 * @var $trainers array
 */
?>
<div class="col-md-8">
    <a type="button" class="btn btn-primary" ng-href="#/admin/users/user/{{data.user.id}}">
        Переглянути інформацію про користувача
    </a>
    <h4><em>Користувач:</em></h4>
    <div id="userInfo">
        {{data.user.firstName}} {{data.user.secondName}} &lt;{{data.user.email}}&gt;
    </div>
    <br>
    <div ng-if="data.trainer">
        <h4><em>Тренер:</em></h4>
        <form method="post"
              ng-submit="addTrainer('<?php echo Yii::app()->createUrl("/_teacher/_admin/users/removeTrainer"); ?>', 'remove');">
            <input class="form-control" id="user" type="hidden" ng-value="data.user.id">
            <input class="form-control" id="oldTrainerId" type="hidden" ng-value="data.trainer.user_id">
            <div id="userInfo">
                {{data.trainer.firstName}} {{data.trainer.secondName}} {{data.trainer.middleName}} &lt;{{data.trainer.email}}&gt;
            </div>
            <input type="submit" class="btn btn-success" value="Скасувати">
        </form>
    </div>
    <br>
    <h4><em>Новий тренер:</em></h4>
    <div class="form-group">
        <form method="post"
              ng-submit="addTrainer('<?php echo Yii::app()->createUrl("/_teacher/_admin/users/editTrainer"); ?>', 'edit');">
            <input class="form-control" id="user" type="hidden" ng-value="data.user.id">
            <?php $this->renderPartial('_selectTrainer'); ?>
            <br>
            <br>
            <input type="submit" class="btn btn-success" value="Призначити тренера">
        </form>
    </div>
</div>


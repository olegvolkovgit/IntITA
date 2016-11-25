<div class="col-md-8">
    <a type="button" class="btn btn-primary" ng-href="#/supervisor/userProfile/{{user.id}}">
        Переглянути інформацію про студента
    </a>
    <h4><em>Користувач:</em></h4>
    <div id="userInfo">
        {{user.fullName}}
    </div>
    <br>
    <div ng-if="user.trainer">
        <h4><em>Тренер:</em></h4>
        <form method="post"
              ng-submit="addTrainer('<?php echo Yii::app()->createUrl("/_teacher/_supervisor/superVisor/removeTrainer"); ?>', 'remove');">
            <input class="form-control" id="user" type="hidden" ng-value="user.id">
            <input class="form-control" id="oldTrainerId" type="hidden" ng-value="user.trainer.user_id">
            <div id="userInfo">
                {{user.trainer.fullName}} {{user.trainer.secondName}} {{user.trainer.middleName}} {{user.trainer.email}}
            </div>
            <input type="submit" class="btn btn-success" value="Скасувати">
        </form>
    </div>
    <br>
    <h4><em>Новий тренер:</em></h4>
    <div class="form-group">
        <form method="post"
              ng-submit="addTrainer('<?php echo Yii::app()->createUrl("/_teacher/_supervisor/superVisor/editTrainer"); ?>', 'edit');">
            <input class="form-control" id="user" type="hidden" ng-value="user.id">
            <?php $this->renderPartial('/_supervisor/forms/_selectTrainer'); ?>
            <br>
            <br>
            <input type="submit" class="btn btn-success" value="Призначити тренера">
        </form>
    </div>
</div>


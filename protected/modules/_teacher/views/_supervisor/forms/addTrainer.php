<div class="col-md-9">
    <a type="button" class="btn btn-primary" ng-href="#/supervisor/userProfile/{{user.id}}">
        Переглянути інформацію про студента
    </a>
    <h4><em>Користувач:</em></h4>
    <div id="userInfo">
        {{user.fullName}}
    </div>
    <br>
    <h4><em>Тренер:</em></h4>
    <div class="form-group">
        <form method="post"
              ng-submit="addTrainer('<?php echo Yii::app()->createUrl("/_teacher/_supervisor/superVisor/setTrainer"); ?>', 'new');">
            <input class="form-control" id="user" type="hidden" ng-value="user.id">
            <?php $this->renderPartial('/_supervisor/forms/_selectTrainer');?>
            <br>
            <br>
            <input type="submit" class="btn btn-success" value="Призначити тренера">
        </form>
    </div>
</div>

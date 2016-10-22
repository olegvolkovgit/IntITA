<div class="col-md-8">
    <a type="button" class="btn btn-primary" ng-href="#/supervisor/studentProfile/{{student.id}}">
        Переглянути інформацію про студента
    </a>
    <h4><em>Користувач:</em></h4>
    <div id="userInfo">
        {{student.firstName}} {{student.secondName}} &lt;{{student.email}}&gt;
    </div>
    <br>
    <div ng-if="student.trainer">
        <h4><em>Тренер:</em></h4>
        <form method="post"
              ng-submit="addTrainer('<?php echo Yii::app()->createUrl("/_teacher/_super_visor/superVisor/removeTrainer"); ?>', 'remove');">
            <input class="form-control" id="user" type="hidden" ng-value="student.id">
            <input class="form-control" id="oldTrainerId" type="hidden" ng-value="student.trainer.user_id">
            <div id="userInfo">
                {{student.trainer.firstName}} {{student.trainer.secondName}} {{student.trainer.middleName}} &lt;{{student.trainer.email}}&gt;
            </div>
            <input type="submit" class="btn btn-success" value="Скасувати">
        </form>
    </div>
    <br>
    <h4><em>Новий тренер:</em></h4>
    <div class="form-group">
        <form method="post"
              ng-submit="addTrainer('<?php echo Yii::app()->createUrl("/_teacher/_super_visor/superVisor/editTrainer"); ?>', 'edit');">
            <input class="form-control" id="user" type="hidden" ng-value="student.id">
            <?php $this->renderPartial('/_super_visor/_selectTrainer'); ?>
            <br>
            <br>
            <input type="submit" class="btn btn-success" value="Призначити тренера">
        </form>
    </div>
</div>


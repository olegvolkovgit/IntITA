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
    <a type="button" class="btn btn-primary" ng-href="#/admin/users/user/{{data.user.id}}">
        Переглянути інформацію про користувача
    </a>
    <h4><em>Користувач:</em></h4>
    <div id="userInfo">
        {{data.user.firstName}} {{data.user.secondName}} &lt;{{data.user.email}}&gt;
    </div>
    <br>
    <h4><em>Тренер:</em></h4>
    <div class="form-group">
        <form method="post"
              ng-submit="addTrainer('<?php echo Yii::app()->createUrl("/_teacher/_admin/users/setTrainer"); ?>', 'new');">
            <input class="form-control" id="user" type="hidden" ng-value="data.user.id">
            <?php $this->renderPartial('_selectTrainer');?>
            <br>
            <br>
            <input type="submit" class="btn btn-success" value="Призначити тренера">
        </form>
    </div>
</div>

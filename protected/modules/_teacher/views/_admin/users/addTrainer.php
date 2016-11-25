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
              ng-submit="addTrainer('<?php echo Yii::app()->createUrl("/_teacher/_admin/users/setTrainer"); ?>', 'new', selectedTrainer.id, data.user.id);">
            <div class="form-group">
                <label>
                    <strong>Тренер:</strong>
                </label>
                <input type="text" size="135" ng-model="trainerSelected"  ng-model-options="{ debounce: 1000 }"
                       placeholder="Тренер" uib-typeahead="item.email for item in getTrainers($viewValue) | limitTo : 10"
                       typeahead-no-results="noResults"  typeahead-template-url="customTemplate.html"
                       typeahead-on-select="onSelectTrainer($item)" ng-change="reloadTrainer()" class="form-control" />
                <div ng-show="noResults">
                    <i class="glyphicon glyphicon-remove"></i> тренера не знайдено
                </div>
            </div>
            <br>
            <br>
            <input type="submit" class="btn btn-success" value="Призначити тренера">
            <a type="button" class="btn btn-default" ng-click='back()'>
                Назад
            </a>
        </form>
    </div>
</div>

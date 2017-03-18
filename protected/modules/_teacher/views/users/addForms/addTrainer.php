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
        {{data.user.firstName}} {{data.user.secondName}}
        <br>
        {{data.user.email}}
    </div>
    <div ng-if="data.trainer">
        <h4><em>Тренер:</em></h4>
        <form method="post" ng-submit="cancelTrainer(data.user.id)">
            <div id="userInfo">
                {{data.trainer.firstName}} {{data.trainer.secondName}} {{data.trainer.middleName}} &lt;{{data.trainer.email}}&gt;
            </div>
            <input type="submit" class="btn btn-success" value="Скасувати">
        </form>
    </div>
    <br>
    <h4><em>Новий тренер:</em></h4>
    <div class="form-group">
        <form method="post" ng-submit="addTrainer(selectedTrainer.id, data.user.id);">
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
            <input type="submit" class="btn btn-success" value="Призначити тренера">
            <a type="button" class="btn btn-default" ng-click='back()'>
                Назад
            </a>
        </form>
    </div>
</div>


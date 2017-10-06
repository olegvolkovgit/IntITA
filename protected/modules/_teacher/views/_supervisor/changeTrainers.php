<div ng-controller="changeTrainersCtrl">
    <div ng-init="getTrainers()">
        <h4>Заміна тренера призведе до переходу всіх студентів від старого тренера до нового.</h4>
        <br>
        <label>Виберіть тренера, якого замінюємо:</label><br>
        <select id="selectOldTrainer"  name="objectSelector" ng-model="id_oldTrainer"
                 ng-options="trainer.id as trainer.fullName for trainer in trainers" >
            <option value="" ng-if="!id_oldTrainer">--Виберіть тренера, якого треба замінити--</option>
        </select>
        <br>
        <br>
        <label>Виберіть тренера, на якого замінюємо:</label><br>
        <select id="selectNewTrainer" name="objectSelector" ng-model="id_newTrainer"
                 ng-options="trainer.id as trainer.fullName for trainer in trainers" >
            <option value="" ng-if="!id_newTrainer">--Виберіть нового тренера--</option>
        </select>
        <br>
        <br>
        <button id="apply-btn" class="btn btn-primary"
                ng-click="exchangeTrainers(id_oldTrainer, id_newTrainer)">Замінити</button>
    </div>
</div>
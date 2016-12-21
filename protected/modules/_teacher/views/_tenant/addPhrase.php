
<div class="panel panel-primary" ng-controller="phraseCtrl">
    <div class="panel-body">
        <form name="form" novalidate>
            <div class="form-group" id="receiver">

                <label>Фраза</label>
                <br>
                <br>
                <input id="phrase" type="text" class="form-control" name="user" placeholder="Введіть фразу"
                       size="90" required ng-model="phrase.text">
                <div class="error" ng-show="errors.ChatPhrases_text && form.user.$touched">{{errors.ChatPhrases_text[0]}}</div>
                <br>
                <br>

            </div>

            <button class="btn btn-primary" ng-click="addPhrase()">
            <span ng-if="!phrase.id">Створити фразу</span>
            <span ng-if="phrase.id">Змінити фразу</span>
            </button>
                        <button type="reset" class="btn btn-default" ng-click="changeView('tenant/phrases')">
            Скасувати
            </button>
        </form>
        <br>

    </div>
</div>

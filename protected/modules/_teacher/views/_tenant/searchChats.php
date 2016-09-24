<div class="panel panel-primary" ng-controller="tenantCtrl">
    <div class="panel-body">
        <form>
            <div class="form-group" id="receiver">

                <label>Пошук розмов</label>
                <br>
                <br>

                <div class="form-group">
                    <label>
                        <strong>Перший користувач(автор кімнати):</strong>
                    </label>
                    <input type="text" size="135" ng-model="authorSelected" ng-model-options="{ debounce: 1000 }"
                           placeholder="Введіть ім'я автора кімнати"
                           uib-typeahead="item.nick_name for item in getUser($viewValue) | limitTo:10"
                           typeahead-no-results="authorNoResults" typeahead-on-select="selectAuthor($item)"
                           class="form-control"/>
                    <i ng-show="loadingAuthors" class="glyphicon glyphicon-refresh"></i>

                    <div ng-show="authorNoResults">
                        <i class="glyphicon glyphicon-remove"></i> Користувача не знайдено
                    </div>
                </div>
                <br>
                <br>

                <label>
                    <strong>Другий користувач:</strong>
                </label>
                <input type="text" size="135" ng-model="userSelected" ng-model-options="{ debounce: 1000 }"
                       placeholder="Введіть ім'я користувача"
                       uib-typeahead="item.nick_name for item in getUser($viewValue) | limitTo:10"
                       typeahead-no-results="userNoResults" typeahead-on-select="selectUser($item)"
                       class="form-control"/>
                <i ng-show="loadingUsers" class="glyphicon glyphicon-refresh"></i>

                <div ng-show="userNoResults">
                    <i class="glyphicon glyphicon-remove"></i> Користувача не знайдено
                </div>
                <br>
                <br>
            </div>
            <button class="btn btn-primary" ng-click="searchChat()">
                Знайти чат
            </button>

            <button type="reset" class="btn btn-default" ng-click="reset()">
                Скасувати
            </button>
        </form>
        <br>

    </div>
</div>


</div>
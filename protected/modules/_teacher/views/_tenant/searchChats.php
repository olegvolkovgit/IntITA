
<div class="panel panel-primary" ng-controller="searchChatCtrl">
    <div class="panel-body">
        <form >
            <div class="form-group" id="receiver">

                <label>Пошук розмов</label>
                <br>
                <br>
                    <div>Перший користувач(автор кімнати)</div>
                    <br>
                    <input id="author" type="text" class="form-control"  placeholder="Введіть ім'я автора кімнати">

                    <br><br>
                <div>Другий користувач</div>
                    <br>

                <input  id="chat_user" type="text" class="form-control" placeholder="Введіть ім'я користувача"
                                                                    size="90">

                <br>
                <br>

            </div>

            <button class="btn btn-primary" ng-click="searchUsers()">
                Знайти чат
            </button>

            <button type="reset" class="btn btn-default"
                    ng-click="changeView('tenant/chats')">
                Скасувати
            </button>
        </form>
        <br>

    </div>
</div>
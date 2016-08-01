
<div class="panel panel-primary" ng-controller="searchChatCtrl">
    <div class="panel-body">
        <form >
            <div class="form-group" id="receiver">

                <label>Пошук розмов</label>
                <br>
                <br>
                    <div>Перший користувач</div>
                    <br>
                    <input id="chat_user1" type="text" class="form-control"  placeholder="Введіть ім'я першого користувача"
                           required >

                    <br><br>
                <div>Другий користувач</div>
                    <br>

                <input  id="chat_user2" type="text" class="form-control" placeholder="Введіть ім'я другого користувача"
                                                                    size="90" required >

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
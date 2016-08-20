
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

            <button class="btn btn-primary"
                    onclick="searchUsers();return false;">
                Знайти чат
            </button>

            <button type="reset" class="btn btn-default"
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_tenant/tenant/searchChats'); ?>')">
                Скасувати
            </button>
        </form>
        <br>

    </div>
</div>
<script>
    function searchUsers(){
        var author_name = document.getElementById('author').value;
        var user_name = document.getElementById('chat_user').value;

                load(basePath+'/_teacher/_tenant/tenant/ShowChats?author='+author_name+'&user='+user_name);
         }

</script>

</div>
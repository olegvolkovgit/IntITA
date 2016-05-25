
<div class="panel panel-primary">
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
        var user_name1 = document.getElementById('chat_user1').value;
        var user_name2 = document.getElementById('chat_user2').value;

        $jq.ajax({
            url: basePath + "/_teacher/_tenant/tenant/FindChats?user1="+user_name1+"&user2="+user_name2,
            success: function (response) {
                console.log(response);
                load('/_teacher/_tenant/tenant/ShowChats');
            }

        });}

</script>

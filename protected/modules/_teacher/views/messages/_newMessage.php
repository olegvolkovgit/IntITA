<?php
/* @var $user integer */
?>

<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', '_teacher/messages.css'); ?>"/>


<div class="panel panel-primary">
    <div class="panel-heading">
        Написати листа
    </div>
    <div class="panel-body">
        <form role="form">
            <input class="form-control" name="id" id="hidden" value="<?=$user?>">
            <input class="form-control" name="scenario" id="hidden" value="new">

            <div class="form-group" id="receiver">
                <label>Кому</label>
                <br>
                <input id="typeahead" type="text" class="form-control" name="receiver" placeholder="Отримувач" size="135"
                required>
            </div>

            <div class="form-group">
                <label>Тема</label>
                <input class="form-control" name="subject" placeholder="Тема листа">
            </div>

            <div class="form-group">
                <label>Лист</label>
                <textarea class="form-control" rows="6" name="text" placeholder="Лист" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary"
                    onclick="sendMessage('<?php echo Yii::app()->createUrl('/_teacher/messages/sendUserMessage'); ?>'); return false;">
                Написати
            </button>

            <button type="reset" class="btn btn-default"
                    onclick="load('<?=Yii::app()->createUrl("/_teacher/messages/index")?>')">
                Скасувати
            </button>
        </form>
    </div>
</div>

<script src="<?= StaticFilesHelper::fullPathTo('js', 'typeahead.js'); ?>"></script>

<script>
    var users = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: basePath + '/_teacher/messages/usersByQuery?query=%QUERY',
            wildcard: '%QUERY'
        }
    });

    users.initialize();

    $('#typeahead').typeahead(null, {
        name: 'users',
        display: 'value',
        source: users
    });

    function sendMessage(url) {
        receiver = $("#typeahead").val();
        if (user === "") {
            showDialog('Виберіть отримувача повідомлення.');
        } else{
//            var jsonData = {
//                "id" : $("input[name=id]").val(),
//                "receiver" : receiver,
//                "subject" : $("input[name=subject]").val(),
//                "text": $("input[name=text]").val(),
//                "scenario": "new"
//            };
            var posting = $.post(url,
                {
                    "id" : $("input[name=id]").val(),
                    "receiver" : receiver,
                    "subject" : $("input[name=subject]").val(),
                    "text": $("input[name=text]").val(),
                    "scenario": "new"
                }
            );

            posting.done(function (response) {
                    if (response == 1)
                        showDialog("Користувач " + user + " призначений адміністратором.");
                    else {
                        showDialog("Користувача " + user + " не вдалося призначити адміністратором. Спробуйте повторити " +
                            "операцію пізніше або напишіть на адресу antongriadchenko@gmail.com.");
                    }
                })
                .fail(function () {
                    showDialog("Користувача " + user + " не вдалося призначити адміністратором. Спробуйте повторити " +
                        "операцію пізніше або напишіть на адресу antongriadchenko@gmail.com.");
                })
                .always(function () {
                    location.href = window.location.pathname;
                });
        }
    }
</script>
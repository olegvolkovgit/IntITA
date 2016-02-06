<div class="panel panel-primary">
    <div class="panel-body">
        <form role="form">
            <div class="form-group" id="receiver">
                <label>Користувач</label>
                <br>
                <input id="typeahead" type="text" class="typeahead form-control" name="user"
                       placeholder="Виберіть користувача"
                       size="90" required>
                <br>
                <br>
                <em>Зверніть увагу, що деяких користувачів може не бути в списку. В списку немає користувачів, в
                    яких вже є права адміністратора.</em>
                <br>
            </div>

            <button class="btn btn-primary"
                    onclick="sendNewAdminData('<?php echo Yii::app()->createUrl("/_teacher/_admin/users/addAdmin"); ?>'); return false;">
                Призначити адміністратором
            </button>

            <button type="reset" class="btn btn-default"
                    onclick="load('<?= Yii::app()->createUrl("/_teacher/_admin/users/index") ?>')">
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
            url: basePath + '/_teacher/_admin/users/usersWithoutAdmins?query=%QUERY',
            wildcard: '%QUERY'
        }
    });

    users.initialize();

    $('#typeahead').typeahead(null, {
        name: 'users',
        display: 'value',
        source: users
    });
    $('div.tt-menu.tt-open').css('background-color', '#fff');

    function sendNewAdminData(url) {
        user = $("#typeahead").val();
        if (user === "") {
            bootbox.alert('Виберіть користувача, якого потрібно призначити адміністратором.');
        } else {
            var posting = $.post(url, {user: user});

            posting.done(function (response) {
                    if (response == 1) {
                        bootbox.alert("Користувач " + user + " призначений адміністратором.", function () {
                            location.href = window.location.pathname;
                        });
                    }
                    else {
                        bootbox.alert("Користувача " + user + " не вдалося призначити адміністратором. Спробуйте повторити " +
                            "операцію пізніше або напишіть на адресу antongriadchenko@gmail.com.", function () {
                            location.href = window.location.pathname;
                        });
                    }
                })
                .fail(function () {
                    bootbox.alert("Користувача " + user + " не вдалося призначити адміністратором. Спробуйте повторити " +
                        "операцію пізніше або напишіть на адресу antongriadchenko@gmail.com.", function () {
                        location.href = window.location.pathname;
                    });
                });
        }
    }
</script>
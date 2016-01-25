<div class="panel panel-primary">
    <div class="panel-body">
        <form role="form">
            <div class="form-group" id="receiver">
                <label>Користувач</label>
                <br>
                <input id="typeahead" type="text" class="form-control" name="user" placeholder="Виберіть користувача"
                       size="90" required>
                <br>
                <br>
                <em>* Зверніть увагу, що деяких користувачів може не бути в списку. В списку немає користувачів, в
                    яких вже є права бухгалтера.</em>
                <br>
            </div>

            <button class="btn btn-primary"
                    onclick="sendNewAccountantData('<?php echo Yii::app()->createUrl("/_teacher/_admin/users/createAccountant"); ?>')">
                Призначити бухгалтера
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
            url: basePath + '/_teacher/_admin/users/usersWithoutAccountants?query=%QUERY',
            wildcard: '%QUERY'
        }
    });

    users.initialize();

    $('#typeahead').typeahead(null, {
        name: 'users',
        display: 'value',
        source: users
    });

    function sendNewAccountantData(url) {
        user = $("#typeahead").val();
        if (user === "") {
            showDialog('Виберіть користувача, якого потрібно призначити адміністратором.');
        } else {
            var posting = $.post(url, {user: user});

            posting.done(function (response) {
                    if (response == 1)
                        showDialog("Користувач " + user + " призначений бухгалтером.");
                    else {
                        showDialog("Користувача " + user + " не вдалося призначити бухгалтером. Спробуйте повторити " +
                            "операцію пізніше або напишіть на адресу antongriadchenko@gmail.com.");
                    }
                })
                .fail(function () {
                    showDialog("Користувача " + user + " не вдалося призначити бухгалтером. Спробуйте повторити " +
                        "операцію пізніше або напишіть на адресу antongriadchenko@gmail.com.");
                })
                .always(function () {
                    location.href = window.location.pathname;
                });
        }
    }
</script>
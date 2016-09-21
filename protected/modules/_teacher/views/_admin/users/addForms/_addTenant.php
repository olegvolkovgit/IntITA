<div class="panel panel-primary">
    <div class="panel-body">
        <form role="form">
            <div class="form-group" id="receiver">
                <input type="number" hidden="hidden" id="userId" value="0"/>
                <label>Користувач</label>
                <br>
                <input id="typeahead" type="text" class="form-control" name="user" placeholder="Виберіть користувача"
                       size="90" required>
                <br>
                <br>
                <em>* Зверніть увагу, що деяких користувачів може не бути в списку. В списку немає користувачів, в
                    яких вже є права tenant'а.</em>
                <br>
            </div>
            
            <button class="btn btn-primary"
                    ng-click="assignRole('<?php echo Yii::app()->createUrl("/_teacher/_admin/users/assignRole"); ?>','tenant');">
                Призначити tenant'а
            </button>

            <a type="button" class="btn btn-default" ng-href="#/admin/users">
                Скасувати
            </a>
        </form>
        <br>
        <div class="alert alert-info">
            Призначити tenant'ом можна тільки вже зареєстрованого співробітника. Додати нового співробітника можна
            за посиланням:
            <a type="button" class="alert-link" ng-href="#/admin/teacher/create">
                Додати співробітника
            </a>.
            <br>
            Список усіх співробітників:
            <a type="button" class="alert-link" ng-href="#/admin/teachers">Співробітники</a>.
        </div>
    </div>
</div>
<script>
    var users = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: basePath + '/_teacher/_admin/users/usersAddForm?role=tenant&query=%QUERY',
            wildcard: '%QUERY',
            filter: function (users) {
                return $jq.map(users.results, function (user) {
                    return {
                        id: user.id,
                        name: user.name,
                        email: user.email,
                        url: user.url
                    };
                });
            }
        }
    });

    users.initialize();

    $jq('#typeahead').on('typeahead:selected', function (e, item) {
        $jq("#userId").val(item.id);
    });

    $jq('#typeahead').typeahead(null, {
        name: 'users',
        display: 'email',
        limit: 10,
        source: users,
        templates: {
            empty: [
                '<div class="empty-message">',
                'немає користувачів з таким іменем або email\`ом',
                '</div>'
            ].join('\n'),
            suggestion: Handlebars.compile("<div class='typeahead_wrapper'><img class='typeahead_photo' src='{{url}}'/> <div class='typeahead_labels'><div class='typeahead_primary'>{{name}}&nbsp;</div><div class='typeahead_secondary'>{{email}}</div></div></div>")
        }
    });
</script>
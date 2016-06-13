<br>
<div class="panel panel-default col-md-7">
    <div class="panel-body">
        <form role="form">
            <div class="form-group">
                <input type="text" hidden="hidden" value="author" id="role">
                <label>Викладач:</label>
                <br>
                <input id="typeahead" type="text" class="form-control" placeholder="Викладач"
                       size="135" required autofocus>
                <input type="number" hidden="hidden" id="user" value="0"/>
            </div>
            <div class="form-group">
                <label>
                    <strong>Модуль:</strong>
                </label>
                <input type="number" hidden="hidden" id="moduleId" value="0"/>
                <input id="typeaheadModule" type="text" class="form-control" placeholder="Назва модуля"
                       size="135">
            </div>
            <br>
            <div class="form-group">
                <button type="button" class="btn btn-success"
                        onclick="addTeacherAttrCM('<?php echo Yii::app()->createUrl('/_teacher/_content_manager/contentManager/setTeacherRoleAttribute'); ?>',
                            'module', '#moduleId')">Призначити автора модуля</button>
            </div>
        </form>
        <div class="alert alert-info">
            <?php if (Yii::app()->user->model->isAdmin()) { ?>
                Автором модуля можна призначити лише зареєтрованого співробітника.
                Якщо потрібного користувача немає в списку авторів, то призначити роль автора можна на сторінці
                <a href="#" class="alert-link" onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/teachers/create');?>', 'Призначити автора')">
                    Призначити співробітника</a>.
            <?php } else { ?>
                Призначити автором можна тільки вже зареєстрованого співробітника. Додати нового співробітника можна
                за посиланням:
                <a href="#" class="alert-link"
                   onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_content_manager/contentManager/sendCoworkerRequest'); ?>',
                       'Запит на призначення співробітника')">Надіслати запит</a>.
            <?php } ?>
        </div>
    </div>
</div>

<script>
    var users = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: basePath + '/_teacher/_admin/permissions/teachersByQuery?query=%QUERY',
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

    var modules = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: basePath + '/_teacher/_admin/permissions/modulesByQuery?query=%QUERY',
            wildcard: '%QUERY',
            filter: function (modules) {
                return $jq.map(modules.results, function (module) {
                    return {
                        id: module.id,
                        title: module.title
                    };
                });
            }
        }
    });

    users.initialize();
    modules.initialize();

    $jq('#typeahead').typeahead(null, {
        name: 'users',
        display: 'email',
        limit: 10,
        source: users,
        templates: {
            empty: [
                '<div class="empty-message">',
                'немає викладачів з таким іменем або email\`ом',
                '</div>'
            ].join('\n'),
            suggestion: Handlebars.compile("<div class='typeahead_wrapper'><img class='typeahead_photo' src='{{url}}'/> <div class='typeahead_labels'><div class='typeahead_primary'>{{name}}&nbsp;</div><div class='typeahead_secondary'>{{email}}</div></div></div>")
        }
    });

    $jq('#typeaheadModule').typeahead(null, {
        name: 'modules',
        display: 'title',
        limit: 10,
        source: modules,
        templates: {
            empty: [
                '<div class="empty-message">',
                'модулів з такою назвою немає',
                '</div>'
            ].join('\n'),
            suggestion: Handlebars.compile("<div class='typeahead_wrapper'>{{title}}&nbsp;</div>")
        }
    });

    $jq('#typeaheadModule').on('typeahead:selected', function (e, item) {
        $jq("#moduleId").val(item.id);
    });

    $jq('#typeahead').on('typeahead:selected', function (e, item) {
        $jq("#user").val(item.id);
    });
</script>
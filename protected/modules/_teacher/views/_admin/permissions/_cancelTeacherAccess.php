<br>
<div class="panel panel-default col-md-7">
    <div class="panel-body">
        <form role="form">
            <div class="form-group">
                <input type="text" hidden="hidden" value="author" id="role">
                <label>Викладач:</label>
                <br>
                <input id="typeahead2" type="text" class="form-control" placeholder="Викладач"
                       size="135" required autofocus>
                <input type="number" hidden="hidden" id="user" value="0"/>
            </div>
            <div class="form-group">
                <br>
                <div name="teacherModules" class="form-group"></div>
                <br>
                <input type="submit" class="btn btn-outline btn-warning" value="Скасувати"
                       onclick="cancelTeacherAccess('<?php echo Yii::app()->createUrl('/_teacher/_admin/permissions/cancelTeacherPermission'); ?>',
                           'Права доступа','teacherAccess','author');
                           return false;">
            </div>
        </form>
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

    users.initialize();

    $jq('#typeahead2').typeahead(null, {
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

    $jq('#typeahead2').on('typeahead:selected', function (e, item) {
        $jq("#user").val(item.id);
        selectTeacherModules('<?=Yii::app()->createUrl("/_teacher/_admin/permissions/showTeacherModules");?>', item.id);
    });
</script>

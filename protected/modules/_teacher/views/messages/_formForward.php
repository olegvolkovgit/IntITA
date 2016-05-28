<?php
/** @var $user integer
 * @var $message int
 * @var $receiver int
 * @var $subject string
 */
?>
<div id="messageForm<?= $message; ?>">
    <form role="form" id="messageForm<?= $message; ?>">
        <input class="form-control" name="receiver" id="hidden" value="<?= $receiver; ?>">
        <input class="form-control" name="parent" id="hidden" value="<?= $message; ?>">
        <input class="form-control" type="number" id="hidden" name="forwardToId" value="0"/>
        <div class="form-group">
            <input id="typeahead" type="text" class="form-control" name="forwardTo" placeholder="Отримувач" size="135"
                   required autofocus>
        </div>
        <input class="form-control" name="subject" placeholder="Тема"
               value="<?=(substr($subject, 0, strlen("Fwd: ")) === "Fwd: ")?$subject:"Fwd: ".$subject;?>"/>
        <br>
        <div class="form-group">
            <textarea class="form-control" rows="6" name="text" id="text" placeholder="Лист" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary"
                onclick="forward('<?php echo Yii::app()->createUrl('/_teacher/messages/forward'); ?>'); return false;">
            Написати
        </button>
    </form>

    <button type="button" class="btn btn-default" onclick="reset(<?= $message; ?>);"
            style="margin-top: -56px; margin-left: 100px">
        Скасувати
    </button>
</div>
<script>
    var users = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: basePath + '/_teacher/messages/usersByQuery?query=%QUERY&id=' + user,
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


    $jq('#typeahead').on('typeahead:selected', function (e, item) {
        $jq('input[name = forwardToId]').val(item.id);
    });
</script>




<?php
/* @var $user integer
 * @var $receiver StudentReg
 * @var $scenario string
 */
?>
<script>
    scenario = '<?=$scenario;?>';
</script>

<div class="panel panel-primary">
    <div class="panel-heading">
        Написати листа
    </div>
    <div class="panel-body">
        <div class="row">
        <form role="form" name="message" ng-controller="messagesCtrl">
            <input type="number" hidden="hidden" id="receiverId" value="0"/>

            <div class="form-group col-md-8" id="receiver">
                <label>Кому</label>
                <br>
                <input id="typeahead" type="text" class="form-control" name="receiver" placeholder="Отримувач" size="135" required autofocus>
            </div>

            <div class="form-group col-md-8">
                <label>Тема</label>
                <input class="form-control" name="subject" placeholder="Тема листа">
            </div>

            <div class="form-group col-md-8">
                <label>Лист</label>
                <textarea class="form-control" rows="6" id="text" placeholder="Лист" required></textarea>
            </div>
            <div class="col-md-8">
                <button type="submit" class="btn btn-primary"
                        ng-click="sendMessage('<?php echo Yii::app()->createUrl('/_teacher/messages/sendUserMessage'); ?>');">
                    Написати
                </button>
                <button type="reset" class="btn btn-default"
                        ng-click="back()">
                    Назад
                </button>
            </div>
        </form>
    </div>
    </div>
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

    if (scenario == "mailTo") {
        $jq('#typeahead').val('<?=($receiver)?addslashes(CHtml::decode($receiver->userNameWithEmail())):"";?>');
        $jq("#receiverId").val('<?=($receiver)?$receiver->id:0;?>');
    }

    $jq('#typeahead').on('typeahead:selected', function (e, item) {
        $jq("#receiverId").val(item.id);
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
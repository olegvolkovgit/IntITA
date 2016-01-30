<?php
/**
 * @var $message UserMessages
 * @var $dialog Dialog
 */
$url = Yii::app()->createUrl('/_teacher/messages/form');
?>

<div class="col-lg-12">
    <h3><?= $dialog->header; ?></h3>

    <div class="panel-group" id="accordion">
        <?php foreach ($dialog->messages as $message) {
            if (!$message->isDeleted($dialog->receiver)) {
                ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a data-toggle="collapse" href="#collapse<?= $message->id_message ?>" id="messageBlock">
                            <img src="<?= $message->message0->sender0->avatarPath(); ?>" id="avatar"
                                 style="height:24px"/>
                            <strong><?= $message->message0->sender0->userName(); ?></strong>
                            <em><?= substr($message->subject, 0, 50) . "..."; ?></em>
                        </a>
                        <div class="pull-right">
                            <em><?= CommonHelper::formatMessageDate($message->message0->create_date);?></em>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-xs dropdown-toggle"
                                        data-toggle="dropdown">
                                    Відповісти
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu pull-right" role="menu">
                                    <li><a href="#"
                                           onclick="loadForm('<?= $url; ?>', '<?= $message->message0->sender0->id; ?>',
                                               'reply', '<?= $message->id_message ?>')">
                                            Відповісти</a>
                                    </li>
                                    <li><a href="#"
                                           onclick="loadForm('<?= $url; ?>', '<?= $message->message0->sender0->id; ?>',
                                               'forward', '<?= $message->id_message ?>')">
                                            Переслати</a>
                                    </li>
                                    <li><a href="#" data-toggle="modal" data-target="#deleteModal">Видалити це
                                            повідомлення</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li><a href="#" data-toggle="modal" data-target="#deleteDialog">Видалити діалог</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div id="collapse<?= $message->id_message ?>" class="panel-collapse collapse">
                        <div class="panel-body">
                            <p>
                                <?= $message->text; ?>
                            </p>
                            <div id="form<?= $message->id_message; ?>"></div>
                        </div>
                    </div>
                </div>
            <?php }
        } ?>
    </div>
</div>

<?php $this->renderPartial('_deleteModal', array('message' => $message->id_message, 'user' => $dialog->receiver->id)); ?>
<?php $this->renderPartial('_deleteModalDialog', array('message' => $message->id_message, 'user' => $dialog->receiver->id)); ?>
<link href="<?php echo StaticFilesHelper::fullPathTo('css', '_teacher/messages.css'); ?>" rel="stylesheet">
<script>
    function loadForm(url, receiver, scenario, message) {
        idBlock = "#collapse" + message;
        $jq(idBlock).collapse('show');

        id = "#form" + message;
        var command = {
            "user": user,
            "message": message,
            "receiver": receiver,
            "scenario": scenario
        };

        $.post(url, {form: JSON.stringify(command)}, function () {
            })
            .done(function (data) {
                $(id).empty();
                $(id).append(data);
                //bootbox.alert('Ваше повідомлення успішно відправлено.');
            })
            .fail(function () {
                showDialog();
            })
            .always(function () {
                },
                "json"
            );
    }
</script>

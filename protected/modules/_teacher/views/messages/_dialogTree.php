<?php
/**
 * @var $message UserMessages
 * @var $dialog array
 * @var $receiver StudentReg
 */
$url = Yii::app()->createUrl('/_teacher/messages/form');
$last = $dialog[count($dialog) - 1]->id_message;
?>
<link href="<?php echo StaticFilesHelper::fullPathTo('css', '_teacher/messages.css'); ?>" rel="stylesheet">

<div class="col-lg-12">
    <h3><?= $dialog[0]->subject; ?></h3>

    <div class="panel-group" id="accordion">
        <?php foreach ($dialog as $message) {
            if (!$message->isDeleted($receiver)) {
                ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a data-toggle="collapse" href="#collapse<?= $message->id_message ?>" id="messageBlock">
                            <img src="<?= $message->message0->sender0->avatarPath(); ?>" id="avatar"
                                 style="height:24px"/>
                            <strong><?= $message->message0->sender0->userName(); ?></strong>
                            <em><?= substr($message->text, 0, 50) . "..."; ?></em>
                        </a>
                        <div class="pull-right">
                            <em><?= date("h:m, d F", strtotime($message->message0->create_date)); ?></em>
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
                                               'replyAll', '<?= $message->id_message ?>')">
                                            Відповісти всім</a>
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
                    <div id="collapse<?= $message->id_message ?>" class="panel-collapse collapse <?php
                    if ($message->id_message == $last) echo ' in'; ?>">
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

<?php $this->renderPartial('_deleteModal', array('message' => $message->id_message, 'user' => $receiver->id)); ?>
<?php $this->renderPartial('_deleteModalDialog', array('message' => $message->id_message, 'user' => $receiver->id)); ?>

<link href="<?php echo StaticFilesHelper::fullPathTo('css', '_teacher/messages.css'); ?>" rel="stylesheet">
<script src="<?= StaticFilesHelper::fullPathTo('js', 'cabinet/messages.js') ?>"></script>
<script>
    function loadForm(url, receiver, scenario, message) {
        idBlock = "#collapse" + message;
        $(idBlock).collapse('show');

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
            })
            .fail(function () {
                alert("На сайті виникла помилка.\n" +
                    "Спробуйте перезавантажити сторінку або напишіть нам на адресу Wizlightdragon@gmail.com.");
            })
            .always(function () {
                },
                "json"
            );
    }
</script>

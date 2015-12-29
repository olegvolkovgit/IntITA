<?php
/**
 * @var $message UserMessages
 * @var $dialog array
 */
$url = Yii::app()->createUrl('/_teacher/messages/form');
?>
<h4 xmlns="http://www.w3.org/1999/html"><? //= $message->subject; ?></h4>
<link href="<?php echo StaticFilesHelper::fullPathTo('css', '_teacher/messages.css'); ?>" rel="stylesheet">

<div class="col-lg-12">
    <div class="panel-group" id="accordion">
        <?php foreach ($dialog as $message) { ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" id="messageBlock">
                        <img src="<?= $message->message0->sender0->avatarPath(); ?>" id="avatar" style="height:24px"/>
                        <strong><?= $message->message0->sender0->userName(); ?></strong> -
                        <em><?= $message->subject; ?></em>
                    </a>
                    <div class="pull-right">
                        <em><?= date("h:m, d F", strtotime($message->message0->create_date)); ?></em>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                Відповісти
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu pull-right" role="menu">
                                <li><a href="#" onclick="loadForm('<?=$url;?>', '<?= $message->id_message; ?>','reply')">
                                        Відповісти</a>
                                </li>
                                <li><a href="#" onclick="loadForm('<?=$url;?>', '<?= $message->id_message; ?>','replyAll')">
                                        Відповісти всім</a>
                                </li>
                                <li><a href="#" onclick="loadForm('<?=$url;?>', '<?= $message->id_message; ?>','forward')">
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
                <div id="collapseOne" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <p>
                            <?= $message->text; ?>
                        </p>
                        <div id="form<?= $message->id_message; ?>"></div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<?php $this->renderPartial('_deleteModal'); ?>
<?php $this->renderPartial('_deleteModalDialog'); ?>

<link href="<?php echo StaticFilesHelper::fullPathTo('css', '_teacher/messages.css'); ?>" rel="stylesheet">
<script src="<?= StaticFilesHelper::fullPathTo('js', 'cabinet/messages.js') ?>"></script>
<script>
    function loadForm(url, message, scenario) {

        id = "#form" + message;

        var command = {
            "user": user,
            "message": message,
            "scenario": scenario
        };

        $.post(url, JSON.stringify(command), function () {
            })
            .done(function (data) {
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

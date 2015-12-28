<?php
/**
 * @var $message UserMessages
 */
?>
<h4><?= $message->subject; ?></h4>

<div class="col-lg-12">
    <div class="panel-group" id="accordion">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" id="messageBlock">
                    <img src="<?= $message->message0->sender0->avatarPath(); ?>">
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
                            <li><a href="#" onclick="reply()">Відповісти</a>
                            </li>
                            <li><a href="<?= Yii::app()->createUrl('/_teacher/messages/replyAll'); ?>">Відповісти
                                    всім</a>
                            </li>
                            <li><a href="<?= Yii::app()->createUrl('/_teacher/messages/forward'); ?>">Переслати</a>
                            </li>
                            <li><a href="#" data-toggle="modal" data-target="#myModal">Видалити це
                                    повідомлення</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="<?= Yii::app()->createUrl('/_teacher/messages/deleteDialog'); ?>">Видалити
                                    діалог</a>
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
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="Видалити повідомлення" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Видалити повідомлення</h4>
            </div>
            <div class="modal-body">
                on proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="<?= Yii::app()->createUrl('/_teacher/messages/delete'); ?>">Save changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<link href="<?php echo StaticFilesHelper::fullPathTo('css', '_teacher/messages.css'); ?>" rel="stylesheet">
<script src="<?=StaticFilesHelper::fullPathTo('js', 'cabinet/messages.js')?>"></script>

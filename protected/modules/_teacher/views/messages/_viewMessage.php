<?php
/* @var $message UserMessages*/
$url = Yii::app()->createUrl('/_teacher/messages/form');
?>
<div class="panel panel-default" ng-controller="messagesCtrl">
    <div class="panel-heading">
        <a data-toggle="collapse" href="javascript:void(0)" ng-click="collapse('#collapse<?= $message->id_message; ?>')" id="messageBlock">
            <img src="<?= $message->message0->sender0->avatarPath(); ?>" id="avatar"
                 style="height:24px"/>
            <strong><?= $message->message0->sender0->userName(); ?></strong>
            <em><?= CHtml::encode($message->subject()); ?></em>
        </a>
        <div class="pull-right">
            <em><?= CommonHelper::formatMessageDate($message->message0->create_date);?></em>
            <?php if (!$deleted) { ?>
            <div class="btn-group">
                <button type="button" class="btn btn-default btn-xs dropdown-toggle"
                        data-toggle="dropdown">
                    Дії
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu pull-right" role="menu">
                    <li><a href=""
                           ng-click="changeView('dialog/<?= $message->message0->sender0->id;?>/<?=Yii::app()->user->model->id ?>')">
                            Показати діалог</a>
                    </li>
                    <?php if ($message->type() == MessagesType::USER) {?>
                    <li><a href=""
                           ng-click="loadForm('<?= $url; ?>', '<?= $message->message0->sender0->id; ?>',
                                                   'Reply', '<?= $message->id_message ?>',
                                                   '<?=addslashes($message->subject())?>')">
                            Відповісти</a>
                    </li>
                    <li><a href=""
                           ng-click="loadForm('<?= $url; ?>', '<?= $message->message0->sender0->id; ?>',
                                                   'Forward', '<?= $message->id_message ?>',
                                                   '<?=addslashes($message->subject())?>')">
                            Переслати</a>
                    </li>
                    <?php }?>
                        <li>
                            <a href="" ng-click="deleteMessage('<?= $message->id_message; ?>',
                                            '<?=Yii::app()->createUrl("/_teacher/messages/delete");?>','<?=Yii::app()->user->model->id;?>')">
                                Видалити це повідомлення
                            </a>
                        </li>

                    <!--                                    <li class="divider"></li>-->
                    <!--                                    <li><a href="#" data-toggle="modal" data-target="#deleteDialog">Видалити діалог</a>-->
                    <!--                                    </li>-->
                </ul>
            </div>

            <?php }?>
        </div>

    </div>
    <div id="collapse<?= $message->id_message ?>" class="panel-collapse collapse in">
        <div class="panel-body">
            <p>
                <?php if ($message->type() == MessagesType::USER) {?>
                <?=preg_replace_callback('~'.Config::getBaseUrl().'/(module|)(r|R)evision/preview(Lecture|Module|Course)Revision/\?idRevision=\d+~',function ($matches){
                        return '<a href="'.$matches[0].'">'.$matches[0].'</a>';
                    },CHtml::encode($message->text()));?>
                <?php }else {?>
                    <?=$message->text();?>
                <?php }?>
                <br>
                <?php
                $forwarded = $message->message0->forwarded();
                if(!is_null($forwarded)){
                    $this->renderPartial('_forwardedMessage', array(
                        'message' => $message,
                        'forwarded' => $forwarded));
                }?>
            </p>
            <div id="form<?= $message->id_message; ?>"></div>
        </div>
    </div>
</div>
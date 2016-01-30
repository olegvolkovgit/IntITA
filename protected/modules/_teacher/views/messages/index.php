<?php
/**
 * @var $model StudentReg
 * @var $message UserMessages
 * @var $receivedMessages array
 * @var $sentMessages CActiveDataProvider
 * @var $receivedDialogs array
 * @var $sentDialogs array
 * @var $deletedMessages array
 */
?>
<script>
    user = '<?=$model->id?>';
</script>

<button class="btn btn-primary" onclick="load('<?php echo Yii::app()->createUrl('/_teacher/messages/write', array(
    'id' => $model->id
)); ?>')">
    Написати
</button>
<br>
<br>

<div id="mylettersSend">
    <div class="panel panel-default">
        <div class="panel-body">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" id="nav">
                <li><a href="#received" data-toggle="tab"><?php echo Yii::t("letter", "0532") ?></a></li>
                <li><a href="#sent" data-toggle="tab">Надіслані</a></li>
                <li><a href="#deleted" data-toggle="tab">Видалені</a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane fade in active" id="received">
                    <?php $this->renderPartial('_receivedMessages', array(
                        'receivedMessages' => $receivedMessages,
                        'user' => $model
                    )); ?>
                </div>
                <div class="tab-pane fade" id="sent">
                    <?php $this->renderPartial('_sentMessages', array(
                        'sentMessages' => $sentMessages,
                        'user' => $model
                    )); ?>
                </div>
                <div class="tab-pane fade" id="deleted">
                    <?php $this->renderPartial('_deletedMessages', array(
                        'deletedMessages' => $deletedMessages,
                        'user' => $model
                    )); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<link href="<?php echo StaticFilesHelper::fullPathTo('css', '_teacher/messages.css'); ?>" rel="stylesheet">
<!-- DataTables JavaScript -->
<script
    src="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/datatables/media/js/jquery.dataTables.min.js'); ?>"></script>
<script
    src="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js'); ?>"></script>
<script>
    $jq(document).ready(function () {
        $jq('#sentMessages, #receivedMessages, #deletedMessages').DataTable({
                language: {
                    "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
                },
            "autoWidth": false
            }
        );
    });
</script>

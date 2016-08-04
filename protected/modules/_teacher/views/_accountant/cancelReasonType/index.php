<?php
/* @var $types array */
/* @var $model CancelReasonType */
?>
<div class="col-lg-12" ng-controller="cancelReasonTypeCtrl">
    <br>
    <button class="btn btn-primary"
            onclick="load('<?php echo Yii::app()->createUrl("/_teacher/_accountant/cancelReasonType/create"); ?>',
                'Додати причину відміни проплат')">Додати
    </button>
    <br>
    <br>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover" id="cancelReasonTypes">
                    <thead>
                    <tr>
                        <th>Номер</th>
                        <th>Опис</th>
                        <th>Управління</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($types as $model) {
                        ?>
                        <tr class="odd gradeX">
                            <td><?= $model->id; ?></td>
                            <td><?= $model->description; ?></td>
                            <td class="center">
                                <a href="#" title="Переглянути"
                                   onclick="load('<?php echo Yii::app()->createUrl("/_teacher/_accountant/cancelReasonType/view", array("id" => $model->id)); ?>',
                                       'Переглянути причину відміни проплат №<?= $model->id; ?>');"><i class="fa  fa-eye fa-fw"></i></a>
                                <a href="#" title="Редагувати"
                                   onclick="load('<?php echo Yii::app()->createUrl("/_teacher/_accountant/cancelReasonType/update", array("id" => $model->id)); ?>',
                                       'Редагувати причину відміни проплат №<?= $model->id; ?>');"><i class="fa fa-pencil fa-fw"></i></a>
                                <a href="#" title="Видалити" onclick="deleteCancelReasonTypes('<?php echo Yii::app()->createUrl("/_teacher/_accountancy/cancelReasonType/delete", array("id" => $model->id)); ?>', ' <?=$model->id;?>');">
                                    <i class="fa fa-trash-o fa-fw"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>

</script>



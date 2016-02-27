<?php
/* @var $types array */
/* @var $model OperationType */
?>
<div class="col-lg-12">
    <br>
    <button class="btn btn-primary"
            onclick="load('<?php echo Yii::app()->createUrl("/_teacher/_accountancy/operationType/create"); ?>',
                'Додати тип проплат')">Додати тип проплат
    </button>
    <br>
    <br>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover" id="operationsTypes">
                    <thead>
                    <tr>
                        <th>Номер</th>
                        <th>Опис</th>
                        <th>Negative summa</th>
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
                            <td><?= $model->negative_summa; ?></td>
                            <td class="center">
                                <a href="#" title="Переглянути"
                                   onclick="load('<?php echo Yii::app()->createUrl("/_teacher/_accountancy/operationType/view", array("id" => $model->id)); ?>',
                                       'Тип проплат №<?= $model->id; ?>');"><i class="fa  fa-eye fa-fw"></i></a>
                                <a href="#" title="Редагувати"
                                   onclick="load('<?php echo Yii::app()->createUrl("/_teacher/_accountancy/operationType/update", array("id" => $model->id)); ?>',
                                       'Редагувати тип проплат №<?= $model->id; ?>');"><i class="fa fa-pencil fa-fw"></i></a>
                                <a href="#" title="Видалити" onclick="deleteOperationType('<?php echo Yii::app()->createUrl("/_teacher/_accountancy/operationType/delete", array("id" => $model->id)); ?>', ' <?=$model->id;?>');">
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
    $jq(document).ready(function () {
        $jq('#operationTypes').DataTable({
                language: {
                    "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
                },
                dom: "<'row'<'col-sm-6'f><'col-sm-6'l>>"
            }
        );
    });
</script>


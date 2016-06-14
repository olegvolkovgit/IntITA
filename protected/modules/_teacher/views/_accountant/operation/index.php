<?php
/* @var $operations array
 * @var $model Operation
 */
?>
<div class="col-lg-12">
    <br>
    <button class="btn btn-primary"
            onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_accountant/operation/create'); ?>',
                'Додати проплату')">Нова проплата
    </button>
    <br>
    <br>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover" id="operationsTable">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Дата</th>
                        <th>Користувач</th>
                        <th>Тип</th>
                        <th>Сума</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($operations as $model) {
                        ?>
                        <tr class="odd gradeX">
                            <td><?=$model->id;?></td>
                            <td><?=$model->date_create;?></td>
                            <td><?=StudentReg::getUserNamePayment($model->user_create);?></td>
                            <td><?=OperationType::getDescription($model->type_id);?></td>
                            <td><?=$model->summa;?></td>
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
        $jq('#operationsTable').DataTable({
                "autoWidth": false,
                language: {
                    "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
                }
            }
        );
    });
</script>


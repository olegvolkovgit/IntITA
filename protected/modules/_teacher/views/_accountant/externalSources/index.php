<?php
/* @var $sources array */
/* @var $model ExternalSources */
?>
<div class="col-lg-12">
    <br>
    <button class="btn btn-primary"
            onclick="load('<?php echo Yii::app()->createUrl("/_teacher/_accountant/externalSources/create"); ?>',
                'Додати зовнішнє джерело коштів')">Додати
    </button>
    <br>
    <br>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover" id="externalSources">
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
                    foreach ($sources as $model) {
                        ?>
                        <tr class="odd gradeX">
                            <td><?= $model->id; ?></td>
                            <td><?= $model->name; ?></td>
                            <td><?= $model->cash; ?></td>
                            <td class="center">
                                <a href="#" title="Переглянути"
                                   onclick="load('<?php echo Yii::app()->createUrl("/_teacher/_accountant/externalSources/view", array("id" => $model->id)); ?>',
                                       'Джерело зовнішніх коштів №<?= $model->id; ?>');"><i class="fa  fa-eye fa-fw"></i></a>
                                <a href="#" title="Редагувати"
                                   onclick="load('<?php echo Yii::app()->createUrl("/_teacher/_accountant/externalSources/update", array("id" => $model->id)); ?>',
                                       'Редагувати джерело зовнішніх коштів №<?= $model->id; ?>');"><i class="fa fa-pencil fa-fw"></i></a>
                                <a href="#" title="Видалити" onclick="deleteExternalSources('<?php echo Yii::app()->createUrl("/_teacher/_accountancy/externalSources/delete", array("id" => $model->id)); ?>', ' <?=$model->id;?>');"><i
                                        class="fa fa-trash-o fa-fw"></i></a>
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
        $jq('#externalSources').DataTable({
                "autoWidth": false,
                language: {
                    "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
                }
            }
        );
    });

    function deleteExternalSources(url, id){
        bootbox.confirm('Ви впевнені що хочете видалити зовнішнє джерело коштів ' + id + '?', function(result) {
            if (result != null) {
                $jq.ajax({
                    url: url,
                    type: "POST",
                    data : {id: id},
                    success: function () {
                        bootbox.confirm("Джерело зовнішніх коштів видалено.", function () {
                            load(basePath + "/_teacher/_accountant/externalSources/index");
                        });
                    }
                });
            } else {
                showDialog("Операцію не вдалося виконати.");
            }
        });
    }
</script>


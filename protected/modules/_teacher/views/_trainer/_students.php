<?php
/**
 * @var $attribute array
 * @var $item array
 */
?>
<div class="col-md-12">
    <div class="dataTable_wrapper">
        <table class="table table-striped table-bordered table-hover" id="trainerStudentsTable">
            <thead>
            <tr>
                <th>Студент</th>
                <th width="20%">Призначено</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($attribute["value"] as $item) {
                if (!$item["end_date"]) {
                    ?>
                    <tr>
                        <td>
                            <a href="#"
                               onclick='load("<?= Yii::app()->createUrl("/_teacher/_trainer/trainer/viewStudent", array("id" => $item["id"])); ?>",
                                   "<?= CHtml::encode($item['title']); ?>");'>
                                <?= $item["title"]." (".$item["email"].")"; ?>
                            </a>
                        </td>
                        <td>
                            <?= date("d.m.Y", strtotime($item["start_date"])); ?>
                        </td>
                    </tr>
                <?php }
            } ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    $jq('#trainerStudentsTable').DataTable( {
        language: {
            "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
        },
        "columns": [
            null,
            {
                "type": "de_date", targets: 1,
            }
        ]
    } );
</script>

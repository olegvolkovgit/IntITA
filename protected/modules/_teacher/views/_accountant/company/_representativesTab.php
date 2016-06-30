<?php
/**
 * @var $model CorporateEntity
 * @var $corporateRepresentative CorporateRepresentative
 */
$representatives = $model->representativesList();
?>
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-body">
            <!--            --><?php //if ($scenario == "update") { ?>
            <ul class="list-inline">
                <li>
                    <a href="#" class="btn btn-outline btn-primary">
                        Редагувати список представників</a>
                </li>
                <li>
                    <button type="button" class="btn btn-outline btn-primary"
                            onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_accountant/representative/renderAddForm'); ?>',
                                'Додати представника')">
                        Додати представника
                    </button>
                </li>
            </ul>
            <!--            --><?php //} ?>

            <div class="col-md-12">
                <div class="row">
                    <?php if (!empty($representatives)) {
                        foreach ($representatives as $representative) {
                            $corporateRepresentative = CorporateRepresentative::model()->findByPk($representative["corporate_representative"]); ?>
                            <div class="dataTable_wrapper">
                            <table class="table table-striped table-bordered table-hover" id="representativesTable">
                            <thead>
                            <tr>
                                <th width="65%">ПІБ</th>
                                <th width="20%">Посада</th>
                                <th width="10%">Порядок</th>
                                <th width="10%">Скасувати</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                            <td>
                                <a href="#"
                                   onclick="load('<?= Yii::app()->createUrl("/_teacher/_accountant/representative/viewRepresentative", array("id" => $corporateRepresentative->id)); ?>',
                                       'Компанія');">
                                    <?= $corporateRepresentative->full_name; ?>
                                </a>
                            </td>
                            <td>
                                <?= $representative["position"]; ?>
                            </td>
                            <td>
                                <?= $representative["representative_order"]; ?>
                            </td>
                            <td>
                                скасувати
                            </td>
                            <?php
                        } ?>
                    </tr>
                        </tbody>
                        </table>
                        </div>
                    <?php } else {
                        echo "Представників у даному курсі ще немає.";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $jq('#representativesTable').DataTable({
        "order": [[2, "asc"]],
        language: {
            "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
        },
    });
</script>


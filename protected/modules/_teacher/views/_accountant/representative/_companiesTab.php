<?php
/**
 * @var $companies array
 * @var $company CorporateEntity
 */
?>
<div class="col-md-12">
    <br>
    <div class="dataTable_wrapper">
        <table class="table table-striped table-bordered table-hover" id="companiesListTable">
            <thead>
            <tr>
                <th width="45%">Компанія</th>
                <th width="30%">Посада</th>
                <th width="10%">Порядок</th>
<!--                <th width="15%">Скасувати</th>-->
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($companies as $company) {
            $corporateEntity = CorporateEntity::model()->findByPk($company["corporate_entity"]); ?>
            <tr>
                <td>
                    <a href="#/accountant/viewCompany/<?php echo $corporateEntity->id ?>">
                        <?= $corporateEntity->title.", ЄДРПОУ: ".$corporateEntity->EDPNOU; ?>
                    </a>
                </td>
                <td>
                    <?= $company["position"]; ?>
                </td>
                <td>
                    <?= $company["representative_order"]; ?>
                </td>
<!--                <td>-->
<!--                    скасувати-->
<!--                </td>-->
                <?php
                } ?>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<script>
    $jq('#companiesListTable').DataTable({
        "order": [[2, "asc"]],
        language: {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
        },
    });
</script>
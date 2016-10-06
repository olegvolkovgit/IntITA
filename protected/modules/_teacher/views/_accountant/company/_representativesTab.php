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
            <ul class="list-inline">
<!--                <li>-->
<!--                    <a href="#" class="btn btn-outline btn-primary">-->
<!--                        Редагувати список представників</a>-->
<!--                </li>-->
                <li>
                    <a type="button" class="btn btn-primary" ng-href="#/accountant/addRepresentative">Додати представника</a>
                </li>
            </ul>

            <div class="col-md-12">
                <div class="row">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="representativesTable">
                            <thead>
                            <tr>
                                <th width="65%">ПІБ</th>
                                <th width="20%">Посада</th>
                                <th width="10%">Порядок</th>
                                <!--                                <th width="10%">Скасувати</th>-->
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($representatives)) {
                                foreach ($representatives as $representative) {
                                    $corporateRepresentative = CorporateRepresentative::model()->findByPk($representative["corporate_representative"]); ?>
                                    <tr>
                                    <td>
                                        <a ng-href="#/accountant/viewRepresentative/<?php echo $corporateRepresentative->id?>">
                                            <?= $corporateRepresentative->full_name; ?>
                                        </a>
                                    </td>
                                    <td>
                                        <?= $representative["position"]; ?>
                                    </td>
                                    <td>
                                        <?= $representative["representative_order"]; ?>
                                    </td>
        <!--                            <td>-->
        <!--                                скасувати-->
        <!--                            </td>-->
                                    <?php
                                } ?>
                            </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $jq('#representativesTable').DataTable({
        "order": [[2, "asc"]],
        language: {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
        },
    });
</script>


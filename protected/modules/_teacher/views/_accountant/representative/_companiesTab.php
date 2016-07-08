<?php
/**
 * @var $companies array
 * @var $company CorporateEntity
 */
?>
<div class="col-md-12">
    <div class="row">
        <form>
            <input type="number" hidden="hidden" value="" id="user">
            <input type="text" hidden="hidden" value="" id="role">
            <div class="col col-md-6">
                <input type="number" hidden="hidden" id="value" value="0"/>
                <input id="typeahead" type="text" class="form-control" name="module" placeholder="Назва модуля"
                       size="65" required autofocus>
            </div>
            <div class="col col-md-2">
                <button type="button" class="btn btn-success">
                    Додати
                </button>
            </div>
        </form>
    </div>
    <br>
    <div class="dataTable_wrapper">
        <table class="table table-striped table-bordered table-hover" id="companiesListTable">
            <thead>
            <tr>
                <th width="45%">Компанія</th>
                <th width="30%">Посада</th>
                <th width="10%">Порядок</th>
                <th width="15%">Скасувати</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($companies as $company) {
            $corporateEntity = CorporateEntity::model()->findByPk($company["corporate_entity"]); ?>
            <tr>
                <td>
                    <a href="#" onclick="load('<?=Yii::app()->createUrl("/_teacher/_accountant/company/viewCompany", array("id" => $corporateEntity->id));?>',
                        'Компанія');">
                        <?= $corporateEntity->title.", ЄДРПОУ: ".$corporateEntity->EDPNOU; ?>
                    </a>
                </td>
                <td>
                    <?= $company["position"]; ?>
                </td>
                <td>
                    <?= $company["representative_order"]; ?>
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
</div>
<script>
    var modules = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: basePath + '/_teacher/_admin/teachers/modulesByQuery?query=%QUERY',
            wildcard: '%QUERY',
            filter: function (modules) {
                return $jq.map(modules.results, function (module) {
                    return {
                        id: module.id,
                        title: module.title
                    };
                });
            }
        }
    });

    modules.initialize();

    $jq('#typeahead').typeahead(null, {
        name: 'modules',
        display: 'title',
        limit: 10,
        source: modules,
        templates: {
            empty: [
                '<div class="empty-message">',
                'модулів з такою назвою немає',
                '</div>'
            ].join('\n'),
            suggestion: Handlebars.compile("<div class='typeahead_wrapper'>{{title}}&nbsp;</div>")
        }
    });

    $jq('#typeahead').on('typeahead:selected', function (e, item) {
        $jq("#value").val(item.id);
    });

    $jq('#companiesListTable').DataTable({
        "order": [[2, "asc"]],
        language: {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
        },
    });
</script>
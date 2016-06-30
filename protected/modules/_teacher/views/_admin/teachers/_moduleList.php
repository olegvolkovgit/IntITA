<?php
/* @var $attribute array
 * @var $role string
 * @var $model StudentReg
 */
?>
<div class="col-md-12">
    <div class="row">
        <form>
            <input type="number" hidden="hidden" value="<?= $model->id; ?>" id="user">
            <input type="text" hidden="hidden" value="<?= (string)$role; ?>" id="role">
            <div class="col col-md-6">
                <input type="number" hidden="hidden" id="value" value="0"/>
                <input id="typeahead" type="text" class="form-control" name="module" placeholder="Назва модуля"
                       size="65" required autofocus>
            </div>
            <div class="col col-md-2">
                <button type="button" class="btn btn-success"
                        onclick="addTeacherAttr('<?php echo Yii::app()->createUrl('/_teacher/_admin/teachers/setTeacherRoleAttribute'); ?>',
                            '<?= $attribute["key"] ?>', '#value')">
                    Додати модуль
                </button>
            </div>
        </form>
    </div>
    <br>
    <div>
        <b><?php echo 'Викладач: '.$model->firstName.' '.$model->secondName.' '.'('.$model->email.')'?></b>
    </div>
    <div class="dataTable_wrapper">
        <table class="table table-striped table-bordered table-hover" id="modulesListTable">
            <thead>
            <tr>
                <th>Модуль</th>
                <th width="20%">Призначено</th>
                <th width="20%">Відмінено</th>
                <th width="15%">Видалити</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($attribute["value"] as $item) { ?>
            <tr>
                <td>
                    <a href="<?= Yii::app()->createUrl('module/index', array('idModule' => $item["id"])); ?>">
                        <?= CHtml::encode($item["title"]) . " (" . $item["lang"] . ")"; ?>
                    </a>
                </td>
                <td>
                    <?= date("d.m.Y",strtotime($item["start_date"])); ?>
                </td>
                <td>
                    <?= ($item["end_date"] != "")?date("d.m.Y",strtotime($item["end_date"])):""; ?>
                </td>
                <td>
                    <?php if ($item["end_date"] == '') { ?>
                        <a href="#"
                           onclick="cancelModuleAttr('<?= Yii::app()->createUrl("/_teacher/_admin/teachers/unsetTeacherRoleAttribute"); ?>',
                               '<?= $item["id"] ?>', '<?= $attribute["key"] ?>'); return false;">
                            скасувати
                        </a>
                    <?php } ?>
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

    $jq('#modulesListTable').DataTable( {
        "order": [[ 2, "desc" ]],
        language: {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
        },
        "columns": [
            null,
            {
                "type": "de_date", targets: 1,
            },
            {
                "type": "de_date", targets: 1,
            },
            null
        ]
    } );
</script>
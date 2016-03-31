<?php
/* @var $attribute array
 * @var $user integer
 * @var $role string
 */
?>
<div class="col-md-12">
    <div class="row">
        <form>
            <input type="number" hidden="hidden" value="<?= $user; ?>" id="user">
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
    <div class="dataTable_wrapper">
        <table class="table table-striped table-bordered table-hover" id="modulesListTable">
            <thead>
            <tr>
                <th>Модуль</th>
                <th>Призначено</th>
                <th>Відмінено</th>
                <th>Видалити</th>
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
                    <?= $item["start_date"]; ?>
                </td>
                <td>
                    <?= $item["end_date"]; ?>
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
</script>
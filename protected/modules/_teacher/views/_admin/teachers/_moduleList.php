<?php
/* @var $attribute array
 * @var $role string
 * @var $model StudentReg
 */
?>
<div class="col-md-12">
    <div class="row">
        <form>
            <div class="col col-md-6">
                <input type="number" hidden="hidden" id="value" value="0"/>
                <input id="typeahead" type="text" class="form-control" name="module" placeholder="Назва модуля"
                       size="65" required autofocus>
            </div>
            <div class="col col-md-2">
                <button type="button" class="btn btn-success"
                        ng-click="addTeacherAttr('<?php echo Yii::app()->createUrl('/_teacher/_admin/teachers/setTeacherRoleAttribute'); ?>',
                            attribute.key, '#value')">
                    Додати модуль
                </button>
            </div>
        </form>
    </div>
    <br>
    <div>
        <b>Викладач: {{data.user.firstName}} {{data.user.secondName}} ({{data.user.email}})</b>
    </div>
    <div class="dataTable_wrapper">
        <table class="table table-striped table-bordered table-hover" id="studentsListTable" datatable="ng" dt-options="dtModulesOptions" dt-column-defs="dtColumnDefs">
            <thead>
            <tr>
                <th>Модуль</th>
                <th>Призначено</th>
                <th>Відмінено</th>
                <th>Видалити</th>
            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="module in attribute.value">
                <td>
                    <a ng-href="" ng-click="moduleLink(module.id)">
                        {{module.title}} ({{module.lang}})
                    </a>
                </td>
                <td>
                    {{module.start_date}}
                </td>
                <td>
                    {{module.end_date}}
                </td>
                <td>
                    <a ng-if="!module.end_date" href=""
                       ng-click="cancelModuleAttr('<?= Yii::app()->createUrl("/_teacher/_admin/teachers/unsetTeacherRoleAttribute"); ?>',
                           module.id, attribute.key);">скасувати
                    </a>
                </td>
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
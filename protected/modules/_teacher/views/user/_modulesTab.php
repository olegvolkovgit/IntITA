<?php
/**
 * @var $model RegisteredUser
 * @var $user StudentReg
 */
?>
<div class="panel panel-default">
    <div class="panel-body">
        <?php if(Yii::app()->user->model->isAdmin()){?>
        <div class="row">
            <form>
                <div class="col col-md-6">
                    <input type="number" hidden="hidden" id="value" value="0"/>
                    <input id="typeaheadModule" type="text" class="form-control" name="module" placeholder="Назва модуля"
                           size="65" required autofocus>
                </div>
                <div class="col col-md-2">
                    <button type="button" class="btn btn-success"
                            ng-click="addStudentAttr('<?php echo Yii::app()->createUrl('/_teacher/_admin/pay/payModule'); ?>',
                                data.user.id,
                                'module')">
                        Сплатити модуль
                    </button>
                </div>
            </form>
        </div>
        <?php } ?>
        <br>
        <div class="panel panel-default">
            <div class="panel-body">
                <h4>Проплачені модулі:</h4>
                <ul ng-if="data.modules.length" class="list-group">
                    <li ng-repeat="module in data.modules track by $index" class="list-group-item">
                        <a ng-href="{{module.link}}" target="_blank">
                            {{module.title}} ({{module.lang}})
                        </a>
                        <input type="number" hidden="hidden" id="moduleId" ng-value="{{module.id}}"/>
                        <?php if(Yii::app()->user->model->isAdmin()){?>
                            <a type="button" class="btn btn-outline btn-success btn-xs" ng-href="#/admin/users/user/{{data.user.id}}/agreement/module/{{module.id}}">
                                <em>договір</em>
                            </a>
                            <a href=""
                               ng-click="cancelModule('<?php echo Yii::app()->createUrl('/_teacher/_admin/pay/cancelModule'); ?>',module.id,data.user.id)">
                                <span class="warningMessage"><em> скасувати доступ</em></span>
                            </a>
                        <?php } ?>
                    </li>
                </ul>
                <em ng-if="!data.modules.length">Модулів немає.</em>
            </div>
        </div>
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

    $jq('#typeaheadModule').typeahead(null, {
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

    $jq('#typeaheadModule').on('typeahead:selected', function (e, item) {
        $jq("#value").val(item.id);
    });
</script>


<?php
/**
 * @var $model RegisteredUser
 * @var $user StudentReg
 */
$user = $model->registrationData;
$modules = $model->getAttributesByRole(UserRoles::STUDENT)[0]["value"];
?>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="row">
            <form>
                <div class="col col-md-6">
                    <input type="number" hidden="hidden" id="value" value="0"/>
                    <input id="typeaheadModule" type="text" class="form-control" name="module" placeholder="Назва модуля"
                           size="65" required autofocus>
                </div>
                <div class="col col-md-2">
                    <button type="button" class="btn btn-success"
                            onclick="addStudentAttr('<?php echo Yii::app()->createUrl('/_teacher/_admin/pay/payModule'); ?>',
                                '<?= $user->id; ?>',
                                '<?=addslashes($user->userName())." <".$user->email.">";?>',
                                'module')">
                        Сплатити модуль
                    </button>
                </div>
            </form>
        </div>
        <br>
        <div class="panel panel-default">
            <div class="panel-body">
                <h4>Проплачені модулі:</h4>
                <?php if (!empty($modules)) { ?>
                    <ul class="list-group">
                        <?php foreach ($modules as $module) {
                            ?>
                            <li class="list-group-item">
                                <a href="<?= Yii::app()->createUrl("module/index", array("idModule" => $module["id"])); ?>"
                                   target="_blank">
                                    <?= $module["title"] . " (" . $module["lang"] . ")  "; ?>
                                </a>
                                <input type="number" hidden="hidden" id="moduleId" value="<?=$module["id"];?>"/>
                                <button type="button" class="btn btn-outline btn-success btn-xs"
                                        onclick="load('<?= Yii::app()->createUrl("/_teacher/user/agreement",
                                            array("user" => $user->id, "param" => $module["id"], "type" => "module")) ?>')">
                                    <em>договір</em>
                                </button>
                                <a href="#" onclick="cancelModule('<?php echo Yii::app()->createUrl('/_teacher/_admin/pay/cancelModule'); ?>',
                                    '<?=$module["id"];?>',
                                    '<?=$user->id?>'); return false;">
                                    <span class="warningMessage"><em> скасувати доступ</em></span>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                <?php } else { ?>
                    <em>Модулів немає.</em>
                <?php } ?>
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


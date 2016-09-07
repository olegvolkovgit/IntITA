<?php
/* @var $attribute array
 * @var $role string
 * @var $model StudentReg
 */
?>
<div class="col-md-12" ng-controller="usersCtrl">
    <div class="row" ng-controller="permissionsCtrl">
        <form>
            <div class="col col-md-6">
                <input type="text" size="135" ng-model="moduleSelected" ng-model-options="{ debounce: 1000 }" placeholder="Назва модуля" uib-typeahead="item.title for item in getModules($viewValue) | limitTo:10" typeahead-no-results="moduleNoResults" typeahead-on-select="selectModule($item)" class="form-control" />
                <i ng-show="loadingModules" class="glyphicon glyphicon-refresh"></i>
                <div ng-show="moduleNoResults">
                    <i class="glyphicon glyphicon-remove"></i> Модуль не знайдено
                </div>
            </div>
            <div class="col col-md-2">
                <button type="button" class="btn btn-success" ng-click="addCMPermission('<?= (string)$role; ?>',data.user.id)">
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
        <table class="table table-striped table-bordered table-hover" id="modulesTable_<?= $role; ?>">
            <thead>
            <tr>
                <th width="45%">Модуль</th>
                <th width="20%">Призначено</th>
                <th width="20%">Відмінено</th>
                <th width="15%">Видалити</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($attribute["value"] as $item) {
                if($item["cancelled"] == Module::ACTIVE){
            ?>
            <tr>
                <td>
                    <a href="<?= Yii::app()->createUrl('module/index', array('idModule' => $item["id"])); ?>">
                        <?= CHtml::encode($item["title"]) . " (" . $item["lang"] . ")"; ?>
                    </a>
                </td>
                <td>
                    <?= date("d.m.Y", strtotime($item["start_date"])); ?>
                </td>
                <td>
                    <?= ($item["end_date"] != "") ? date("d.m.Y", strtotime($item["end_date"])) : ""; ?>
                </td>
                <td>
                    <?php if ($item["end_date"] == '') { ?>
                        <a href="javascript:void(0)" ng-click="cancelModuleAttr('/_teacher/_admin/permissions/unsetTeacherRoleAttribute','<?=$item["id"]?>','<?= $attribute["key"] ?>','<?= (string)$role; ?>',data.user.id)"
                           >
                            скасувати
                        </a>
                    <?php } ?>
                </td>
                <?php
                }
                } ?>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<script>
    $jq('#modulesTable_'+'<?= $role; ?>').DataTable({
        language: {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
        },
        order: [[ 2, "asc" ]]
    } );
</script>

<?php
/**
 * @var $module Module
 */
?>
<script>
    module = '<?=$module->module_ID;?>';
</script>
<div class="panel panel-default col-md-7" ng-controller="teacherConsultantCtrl">
    <div class="panel-body">
        <form role="form">
            <div class="form-group">
                <label>Модуль:</label>
                <br>
                <input type="text" class="form-control" size="135" value="<?=$module->getTitle()?>" disabled>
                <input type="number" hidden="hidden" id="module" value="<?=$module->module_ID?>"/>
            </div>
            <div class="form-group">
                <label>
                    <strong>Викладач-консультант:</strong>
                </label>

            <input type="text" size="135" ng-model="consultantSelected" ng-model-options="{ debounce: 1000 }" placeholder="виберіть викладача" uib-typeahead="item.email for item in getTeachers($viewValue,'<?= $module->module_ID; ?>') | limitTo : 10" typeahead-no-results="noResultsConsultant"  typeahead-template-url="customTemplate.html" typeahead-on-select="onConsultantSelect($item)" class="form-control" />
            <i ng-show="loadingTeachers" class="glyphicon glyphicon-refresh"></i>
            <div ng-show="noResultsConsultant">
                <i class="glyphicon glyphicon-remove"></i> Викладача не знайдено
            </div>
            <br>

                <button type="button" class="btn btn-success" ng-click="assignConsultantModule('<?=$module->module_ID?>')">Призначити викладача-консультанта</button>

            </div>
        </form>
    </div>
</div>
<?php
/* @var $scenario */
?>
<div class="panel-body" ng-controller="offlineSubgroupCtrl">
    <div class="row">
        <div class="formMargin">
            <div class="col-lg-8">
                <form autocomplete="off" ng-submit="sendFormSubgroup('<?php echo $scenario ?>',subgroup.name,
                groupId,subgroup.data, selectedTrainer.id, subgroupId, subgroup.journal, subgroup.link);" name="subgroupForm"  novalidate>
                    <div class="form-group">
                        <label>Група:</label>
                        <input class="form-control" ng-model="group.name" required maxlength="128" size="50" disabled>
                    </div>
                    <div class="form-group">
                        <label>Назва*</label>
                        <input class="form-control" ng-model="subgroup.name" required maxlength="128" size="50">
                        <div ng-cloak  class="clientValidationError" ng-show="subgroupForm['name'].$dirty && subgroupForm['name'].$invalid">
                            <span ng-show="subgroupForm['name'].$error.required"><?php echo Yii::t('error','0268') ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Інформація(розклад)</label>
                        <input name="data" class="form-control" ng-model="subgroup.data">
                    </div>
                    <div class="form-group">
                        <label>Журнал</label>
                        <input name="journal" class="form-control" ng-model="subgroup.journal">
                    </div>
                    <div class="form-group form-link">
                        <label>Корисні посилання</label>
                        <div ng-repeat="link in subgroup.links track by $index">
                            <div class="col-md-3">
                                <input type="text" class="form-control" placeholder="Назва ресурсу" ng-model="link.description">
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" placeholder="Посилання на ресурс" ng-model="link.link">
                            </div>
                            <div class="col-md-2">
                                <i class="fa fa-floppy-o fa-2x" title="Зберегти" aria-hidden="true" ng-click="updateSubgroupLink(link)"></i>
                                <i class="fa fa-trash fa-2x" title="Видалити" aria-hidden="true" ng-click="removeSubgroupLink(link)"></i>
                            </div>
                        </div>
                        <div>
                            <div class="col-md-3">
                                <input type="hidden" ng-init="newLink.id_subgroup=subgroupId" ng-model="newLink.id_subgroup">
                                <input type="text" class="form-control" placeholder="Назва ресурсу" ng-model="newLink.description">
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" placeholder="Посилання на ресурс" ng-model="newLink.link">
                            </div>
                            <div class="col-md-2">
                                <i class="fa fa-floppy-o fa-2x" title="Зберегти" aria-hidden="true" ng-click="updateSubgroupLink(newLink)"></i>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Тренер в підгрупі*:</label>
                        <input name="trainer" class="form-control" type="text" ng-model="trainerEntered" ng-model-options="{ debounce: 1000 }"
                               placeholder="Виберіть тренера" size="50"
                               uib-typeahead="item.nameEmail for item in getTrainers($viewValue) | limitTo : 10"
                               typeahead-no-results="trainerNoResults"
                               typeahead-on-select="onSelectTrainer($item)"
                               ng-change="reloadTrainer()">
                        <div ng-show="trainerNoResults">
                            <i class="glyphicon glyphicon-remove"></i>тренера не знайдено
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" ng-disabled="subgroupForm.$invalid  || !selectedTrainer">Зберегти
                        </button>
                        <a type="button" class="btn btn-default" ng-click="goBack();" href="">
                            Назад
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<style>
    .form-link{
        margin: 20px 0;
        overflow: hidden;
    }
    .form-link input{
        border:none;
        border-radius: 0;
        border-bottom: 1px solid #ccc;
        padding-left: 0;
        padding-right: 0;
        margin-right: 10px;
        box-shadow: none;
    }
    .form-link i{
        cursor: pointer;
    }
</style>

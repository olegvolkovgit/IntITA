<?php
/* @var $agreement UserAgreements
 */
?>
<div ng-if="!writtenAgreement.agreement.cancel_date && writtenAgreement.agreement.contract" style="border: 1px solid #000;border-radius: 5px; background: #e8e8e8; padding: 5px">
    Даний договір передбачає укладення паперового договору та затвердження його сторонами.
    Лише після затвердження паперового договору проплати на рахунок будуть актуальні.
    Користувач зробив запит на генерування договору. Оберіть тип шаблону паперового договору, перегляньте згенерований паперовий договір
    на коректність документів користувача, які він за ним закріпив (текстові дані та скани документів).
    Підтвердіть запит, або скасуйте його. Після підтвердження користувачу буде надіслано згенерований договір на підтвердження.
    <br>

    <form ng-if="writtenAgreement.documents">
        <fieldset ng-disabled="true">
            <div ng-repeat="document in writtenAgreement.documents track by $index">
                <div>
                    <em>{{document.documentType.title_ua}}</em>
                </div>
                <div ng-if="document.type==1">
                    <div class="input-group">
                        <span class="input-group-addon"><strong><?php echo Yii::t('regexp', '0162') ?>:</strong></span>
                        <input type="text" class="form-control" placeholder="<?php echo Yii::t('regexp', '0162') ?>" ng-model="document.last_name" disabled>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon"><strong><?php echo Yii::t('regexp', '0160') ?>:</strong></span>
                        <input type="text" class="form-control" placeholder="<?php echo Yii::t('regexp', '0160') ?>" ng-model="document.first_name" disabled>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon"><strong><?php echo 'По-батькові' ?>:</strong></span>
                        <input type="text" class="form-control" placeholder="<?php echo 'По-батькові' ?>"  ng-model="document.middle_name" disabled>
                    </div>
                </div>

                <div class="input-group">
                    <span class="input-group-addon"><strong><?php echo Yii::t('regexp', '0927') ?>:</strong></span>
                    <input type="text" class="form-control" placeholder="<?php echo Yii::t('regexp', '0927') ?>" ng-model="document.number" disabled>
                </div>

                <div ng-if="document.type==1">
                    <div class="input-group">
                        <span class="input-group-addon"><strong><?php echo Yii::t('regexp', '0928') ?>:</strong></span>
                        <input type="text" class="form-control" placeholder="<?php echo Yii::t('regexp', '0928') ?>" ng-model="document.issued" disabled>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon"><strong><?php echo Yii::t('regexp', '0929') ?>:</strong></span>
                        <input type="text" class="form-control" placeholder="mm/dd/yyyy" ng-model="document.issued_date" disabled>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon"><strong>Приписка:</strong></span>
                        <input type="text" class="form-control" placeholder="Приписка" ng-model="document.registration_address" disabled>
                    </div>
                </div>
                <div class="input-group" style="text-align: left">
                    <span class="input-group-addon"><strong><?php echo Yii::t('edit', '0939'); ?>:</strong></span>
                    <span>
                        <span ng-repeat="item in document.documentsFiles track by $index">
                            <a ng-href="/files/documents/{{document.id_user}}/{{document.type}}/{{item.file_name}}" target="_blank">doc{{$index}}</a>
                        </span>
                    </span>
                </div>
                <br>
                <hr style="width:80%">
            </div>
        </fieldset>
        <div class="form-group">
            <label>Шаблон договору*:</label>
            <select class="form-control" ng-options="item.id as item.name for item in writtenTemplates"
                    ng-model="selectedTemplate" ng-change="getAgreementTemplate(selectedTemplate)">
                <option name="writtenTemplates" value="" disabled selected>(Обери шаблон)</option>
            </select>
        </div>
        <br>
        <div ng-if="writtenAgreement">
            <div class="tab-content">
                <div class="tab-pane fade in active" id="offer">
                    <div class="panel panel-default">
                        <div class="panel-body" >
                            <div class="row" style="padding:5px" id="printableArea">
                                <div class="offer" style="padding: 10px">
                                    <div compile="agreementTemplate"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <br>
        <div style="text-align: right" ng-if="agreementRequestStatus!=0 && agreementRequestStatus!=1">
            <button type="button" class="btn btn-success" ng-click="checkWrittenAgreementRequest(writtenAgreement)">Підтвердити</button>
            <button type="button" class="btn btn-warning" ng-click="rejectAgreementRequest(writtenAgreement.agreement.id)">Скасувати</button>
        </div>
        <div style="text-align: right" ng-if="agreementRequestStatus==0">
            Запит скасований
        </div>
        <div style="text-align: right" ng-if="agreementRequestStatus==1">
            Запит затвердженний
        </div>
    </form>
</div>
<link rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', '/_teacher/writtenAgreement.css'); ?>"/>
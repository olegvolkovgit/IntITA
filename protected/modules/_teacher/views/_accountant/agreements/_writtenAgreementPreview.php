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
            <a ng-href="#/users/profile/{{writtenAgreement.documents[0].idUser.id}}" target="_blank">
                Користувач: {{writtenAgreement.documents[0].idUser.secondName}} {{writtenAgreement.documents[0].idUser.firstName}} {{writtenAgreement.documents[0].idUser.email}}</a>
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
                            <a href="" ng-click="getDocument(item.id)">Переглянути документ {{$index+1}}</a>
                        </span>
                    </span>
                </div>
                <br>
                <hr style="width:80%">
            </div>
        </fieldset>
        <?php if($type=='agreement') {?>
            <div ng-if="(actualAgreement.checked_date | timestamp)<(actualAgreement.lastEditedUserDocument.updatedAt | timestamp)" style="color:red">
                *дані користувача не перевірялися бухгалтером після часу останьої зміни цих даних
            </div>
        <?php } ?>
        <div class="form-group">
            <label ng-if="!actualAgreement.id">Шаблон договору*:</label>
            <select ng-if="!actualAgreement.id" class="form-control" ng-options="item.id as item.name for item in writtenTemplates"
                    ng-model="options.selectedTemplate" ng-change="getAgreementTemplate()">
                <option name="writtenTemplates" value="" disabled selected>(Обери шаблон)</option>
            </select>
            <div style="overflow: hidden;cursor: pointer">
                <i ng-if="(options.selectedTemplate || actualAgreement.id) && agreementRequestStatus!=0" class="fa fa-edit fa-2x fa-fw" ng-click="editUserAgreement()" style="float: right;"></i>
            </div>
            <button ng-if="options.updatedUserAgreement" class="btn btn-primary" ng-click="saveUpdateAgreement(writtenAgreement.agreement, options.updatedUserAgreement)" style="margin-bottom: 5px">
                Зберегти
            </button>
            <textarea ng-if="editModeAgreement" id="CKE" ng-cloak ckeditor="editorOptionsAgreement" name="html_block" ng-model="options.updatedUserAgreement" required></textarea>
        </div>
        <br>
        <div ng-show="writtenAgreement && !editModeAgreement">
            <div class="tab-content">
                <div class="tab-pane fade in active" id="offer">
                    <div class="panel panel-default">
                        <div class="panel-body" >
                            <div class="offer" id="printableArea" compile="agreementTemplate"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <br>
        <div style="text-align: right" ng-if="(agreementRequestStatus=='null' || !agreementRequestStatus) && !actualAgreement.id">
            <button type="button" class="btn btn-success" ng-click="checkWrittenAgreement(writtenAgreement, agreementTemplate)">Підтвердити/згенерувати PDF</button>
            <button type="button" class="btn btn-success" ng-click="sendAgreementRequestToUser(writtenAgreement, agreementTemplate)">Відправити на перевірку користувачу</button>
            <button type="button" class="btn btn-warning" ng-click="rejectAgreementRequest(writtenAgreement.agreement.id)">Скасувати запит</button>
        </div>
        <div style="text-align: right" ng-if="actualAgreement.id && !agreementRequestStatus">
            <button type="button" class="btn btn-success" ng-click="checkWrittenAgreement(writtenAgreement, agreementTemplate)">Підтвердити/згенерувати PDF</button>
            <button ng-if="actualAgreement.checked_by_accountant==0" type="button" class="btn btn-success" ng-click="sendAgreementRequestToUser(writtenAgreement, agreementTemplate)">Відправити на перевірку користувачу</button>
            <button ng-if="actualAgreement.checked_by_accountant==1" type="button" class="btn btn-warning" ng-click="cancelAgreementRequestToUser(writtenAgreement, actualAgreement.id)">Скасувати перевірку</button>
            <button ng-if="actualAgreement.checked!=1" type="button" class="btn btn-warning" ng-click="removeWrittenAgreement(writtenAgreement, actualAgreement.id)">Видалити</button>
        </div>
        <div style="text-align: right" ng-if="agreementRequestStatus==0">
            Запит скасований
        </div>
        <div style="text-align: right" ng-if="agreementRequestStatus==1">
            Запит затвердженний
        </div>
    </form>
</div>

<?php
/* @var $agreement UserAgreements
 * @var $documents UserDocuments
 */
?>
<div ng-controller="writtenAgreementViewCtrl" ng-init="getAgreementContract('<?php echo $agreement->id ?>')">
    <ul class="list-inline">
        <li>
            <a ng-href="#/accountant/agreementsrequests" class="btn btn-primary">
                Список запитів на договори
            </a>
        </li>
    </ul>
    <div class="titleAgreement">
        <em ng-if="writtenAgreement.agreement.cancel_date" tyle="font-weight: bold;color:red">
            Договір скасований, проплати здійснені по договру не є актуальними
        </em>
        <div ng-if="!contract.personParty" >
            <?php $this->renderPartial('/_accountant/agreements/_writtenAgreementPreview', array(), false, true); ?>
        </div>
        <div ng-if="contract.personParty" >
            <?php $this->renderPartial('/_accountant/agreements/_writtenAgreementContract', array(), false, true); ?>
        </div>
    </div>
</div>
<style>
    em{
        font-weight: bold;
    }
    td{
        border: 1px solid #000;
    }
</style>
<?php
/* @var $agreement UserAgreements
 * @var $type
 * @var $documents UserDocuments
 */
?>
<div ng-controller="writtenAgreementViewCtrl" ng-init="checkAgreementPdf('<?php echo $agreement->id ?>')">
    <ul class="list-inline">
        <?php if($type=='request') {?>
        <li>
            <a ng-href="#/accountant/agreementsrequests" class="btn btn-primary">
                Список запитів на договори
            </a>
        </li>
        <?php } ?>
        <?php if($type=='agreement') {?>
        <li>
            <a ng-href="#/accountant/writtenagreementslist" class="btn btn-primary">
                Список паперових договорів
            </a>
        </li>
        <?php } ?>
    </ul>
    <div class="titleAgreement">
        <em ng-if="writtenAgreement.agreement.cancel_date" style="font-weight: bold;color:red">
            Договір скасований, проплати здійснені по договру не є актуальними
        </em>
        <div ng-if="!pdfAgreement">
            <?php $this->renderPartial('/_accountant/agreements/_writtenAgreementPreview', array('type'=>$type), false, true); ?>
        </div>
        <div ng-if="pdfAgreement">
            <?php $this->renderPartial('/_accountant/agreements/_writtenAgreementContract', array('agreementId'=>$agreement->id), false, true); ?>
        </div>
    </div>
</div>
<link rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', '/_teacher/writtenAgreement.css'); ?>"/>
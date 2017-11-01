<?php
/* @var $agreement UserAgreements
 * @var $documents UserDocuments
 */
?>
<div ng-controller="invoicesByAgreement" ng-init="checkAgreementPdf('<?php echo $agreement->id ?>')">

    <div class="titleAgreement">
        <em ng-if="writtenAgreement.agreement.cancel_date" tyle="font-weight: bold;color:red">
            Договір скасований, проплати здійснені по договру не є актуальними
        </em>
        <div ng-if="!pdfAgreement" >
            <?php $this->renderPartial('/_student/agreement/_writtenAgreementPreview', array(), false, true); ?>
        </div>
        <div ng-if="pdfAgreement" >
            <?php $this->renderPartial('/_student/agreement/_writtenAgreementContract', array(), false, true); ?>
        </div>
        <br>
        <div ng-if="writtenAgreementRequestStatus==1">
            Запит на затвердження паперового договору затверджений
        </div>
        <br>
    </div>
    <div>
        <h4>Рахунки до сплати за договором №<?php echo $agreement->number; ?> від
            <?= date("d.m.Y", strtotime($agreement->create_date));?></h4>
        <h4>
            <?php if($agreement->service->courseServices) {?>
                <a target="_blank" href="<?php echo Yii::app()->createUrl('course/index', array('id' => $agreement->service->courseServices->course_id)); ?>">
                    <?php echo $agreement->service->description.' ('.$agreement->service->courseServices->courseModel->organization->name.')'; ?>
                </a>
            <?php } else if($agreement->service->moduleServices) {?>
                <a target="_blank" href="<?php echo Yii::app()->createUrl('module/index', array('idModule' =>  $agreement->service->moduleServices->module_id)); ?>">
                    <?php echo $agreement->service->description.' ('.$agreement->service->moduleServices->moduleModel->organization->name.')'; ?>
                </a>
            <?php } ?>
        </h4>
        <h4>Вартість: <?php echo $agreement->summa==0?'безкоштовно':$agreement->summa.' грн.'; ?></h4>
        <h4>Форма
            навчання: <?= AbstractIntITAService::getServiceById($agreement->service->service_id)->getEducationForm()->title_ua ?></h4>
        <h4>Схема проплат: <?= PaymentScheme::getPaymentName($agreement); ?></h4>
    </div>
    <div ng-init="agreementId='<?php echo $agreement->id ?>';">
        <div class="panel panel-default">
            <div class="panel-body" >
                <table ng-table="invoicesTable" class="table table-striped table-bordered table-hover">
                    <tr ng-repeat="row in $data track by $index"
                        ng-class="{'bg-warning': (currentDate>=(row.payment_date  | shortDate:'yyyy-MM-dd') && currentDate<=(row.expiration_date  | shortDate:'yyyy-MM-dd')),
                    'bg-danger': (currentDate>(row.expiration_date  | shortDate:'yyyy-MM-dd')),
                    'bg-success': (row.summa==row.paidAmount)}">
                        <td data-title="'Рахунок'">
                            <span ng-if="(row.date_cancelled || row.agreement.cancel_date)">Рахунок № {{row.number}}</span>
                            <a ng-if="!(row.date_cancelled || row.agreement.cancel_date)" href="{{invoiceUrl}}{{row.id}}/?nolayout=1">Рахунок № {{row.number}}</a>
                        </td>
                        <td data-title="'Загальна сума, грн.'">{{row.summa}}</td>
                        <td data-title="'Сплачено, грн.'">{{row.paidAmount}}</td>
                        <td data-title="'Сплатити до'">{{row.payment_date | shortDate:'dd.MM.yyyy'}}</td>
                        <td data-title="'Крайній термін'">{{row.expiration_date | shortDate:'dd.MM.yyyy'}}</td>
                        <td data-title="'Статус'">{{(row.date_cancelled || row.agreement.cancel_date)?'скасований':'актуальний'}}</td>
                        <td data-title="'Надрукувати'" >
                            <a ng-if="!(row.date_cancelled || row.agreement.cancel_date)" href="{{invoiceUrl}}{{row.id}}/?nolayout=1">переглянути</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <em style="color:red">Доступ до контента надається після повного погашення першого рахунку по договору і діє до крайнього терміна оплати наступного рахунку, якщо такий є.
            Якщо наступний рахунок не погашений повністю до крайнього терміну оплати, доступ до контента скасовується до повної проплати рахунку</em><br>
        <span style="background-color: rgba(92,184,92,.6);">Проплачений повністю</span><br>
        <span style="background-color: #f0b370">Збігає термін проплати</span><br>
        <span style="background-color: rgba(217,82,82,.6)">Термін проплати збіг</span><br>
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
<?php
/* @var $agreement UserAgreements */
?>
<div ng-controller="invoicesByAgreement">
    <div class="titleAgreement">
        <?php if($agreement->cancel_date){ ?>
            <em style="font-weight: bold;color:red">
                Договір скасований, проплати здійснені по договру не є актуальними
            </em>
        <?php } else if($agreement->contract) {?>
            <div style="border: 1px solid #000;border-radius: 5px; background: #e8e8e8; padding: 5px">
                Даний договір передбачає укладення паперового договору та затвердження його сторонами.
                Лише після затвердження паперового договору проплати на рахунок будуть актуальні.
                Перед генеруванням паперового договору введіть актуальні дані документів та завантажте їхні копії у себе в
                <a target="_blank" href="<?php echo Yii::app()->createUrl('studentreg/edit'); ?>">профілі</a> у вкладці "Укладення договору".
                <br>
                <form name="contract" ng-submit="generateContract();">
                    <fieldset ng-disabled="true">
                        <label>Прізвище:</label>
                        <input type="text" class="form-control" ng-required value="<?php echo Yii::app()->user->model->secondName ?>"/>
                        <label>Ім'я:</label>
                        <input type="text" class="form-control" ng-required value="<?php echo Yii::app()->user->model->firstName ?>"/>
                        <label>Серія/номер паспорта:</label>
                        <input type="text" class="form-control" ng-required value="<?php echo Yii::app()->user->model->passport ?>"/>
                        <label>Ідентифікаційний код:</label>
                        <input type="text" class="form-control" ng-required value="<?php echo Yii::app()->user->model->inn ?>"/>
                    </fieldset>
                    <br>
                    <button type="submit" class="btn btn-primary">Згенерувати договір
                    </button>
                </form>
            </div>
        <?php } ?>
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
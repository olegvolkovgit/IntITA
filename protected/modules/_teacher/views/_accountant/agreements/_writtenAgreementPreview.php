<?php
/* @var $agreement UserAgreements
 */
?>
<div ng-if="!writtenAgreement.agreement.cancel_date && writtenAgreement.agreement.contract" style="border: 1px solid #000;border-radius: 5px; background: #e8e8e8; padding: 5px">
    Даний договір передбачає укладення паперового договору та затвердження його сторонами.
    Лише після затвердження паперового договору проплати на рахунок будуть актуальні.
    Користувач переглянув договір, підтвердив його з своїми даними, та зробив запит на затвердження бехгалтером.
    Перегляньте будь-ласка паперовий договір та перевірте на коректність документи користувача, які він за ним закріпив (текстові дані та скани документів).
    Підтвердіть запит, або скасуйте його.
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

        <br>
        <div ng-if="writtenAgreement">
            <div class="tab-content">
                <div class="tab-pane fade in active" id="offer">
                    <div class="panel panel-default">
                        <div class="panel-body" >
                            <div class="row" style="padding:5px" id="printableArea">
                                <div class="offer" style="background: #ccc; padding: 10px">
                                    <div style="text-align:center">ДОГОВІР № <em>{{writtenAgreement.agreement.number}}</em></div>
                                    <div style="text-align:center">про надання освітніх послуг за рівнем позашкільної освіти</div>
                                    <br>
                                    {{date | date}}
                                    <br>
                                    <br>
                                    <em>{{writtenAgreement.agreement.corporateEntity.title}}</em> в особі
                                    <em ng-repeat="resprsentative in writtenAgreement.agreement.corporateEntity.actualRepresentatives track by $index">{{resprsentative.position_accusative| lowercase}} {{resprsentative.representative.full_name_accusative}},</em>
                                    далі - Виконавець, та
                                    <em ng-repeat="document in writtenAgreement.documents track by $index">
                                        <span ng-if="document.type==1">{{document.last_name}} {{document.first_name}} {{document.middle_name}},
                                            {{document.documentType.title_ua | lowercase}} {{document.number}} виданий {{document.issued}} {{document.issued_date}},</span>
                                        <span ng-if="document.type==2">{{document.documentType.title_ua | lowercase}} {{document.number}},</span>
                                    </em> далі Замовник, з іншого боку, уклали Даний Договір про наступне:
                                    <div style="text-align:center">1. ПРЕДМЕТ ДОГОВОРУ</div>
                                    1.1. Виконавець бере на себе зобов'язання за рахунок коштів Замовника надати освітню послугу:<br>
                                    Назва сервіса  <em>{{writtenAgreement.agreement.service.description}}</em><br>
                                    <div style="text-align:center">2. ОБОВ'ЯЗКИ ВИКОНАВЦЯ</div>
                                    2.1. Надати Замовнику освітню послугу.<br>
                                    2.2. Забезпечити дотримання прав учасників навчального процесу відповідно до законодавства.<br>
                                    2.3. Видати Замовнику Диплом власного зразка про отримання ним знань.<br>
                                    2.4. Інформувати Замовника про правила та вимоги щодо організації надання освітньої послуги, її якості та  змісту, про права і обов'язки сторін під час надання та отримання таких послуг.<br>
                                    2.5. В разі успішного засвоєння матеріалу Замовником, Виконавець надає рекомендацію та направлення на працевлаштування Замовника потенційному Роботодавцю.<br>

                                    <div style="text-align:center">3. ОБОВ'ЯЗКИ ЗАМОВНИКА</div>
                                    3.1. Своєчасно вносити плату за отриману освітню послугу в розмірах та у строки, що встановлені цим договором.<br>
                                    3.2. Виконувати вимоги законодавства та Статуту, Правил внутрішнього розпорядку Виконавця з організації надання освітніх послуг.<br>
                                    <div style="text-align:center">4. ПЛАТА ЗА НАДАННЯ ОСВІТНЬОЇ ПОСЛУГИ ТА ПОРЯДОК РОЗРАХУНКІВ.</div>
                                    4.1. Розмір плати встановлюється за весь строк надання освітньої послуги і не може змінюватись.<br>
                                    4.2. Загальна вартість освітньої послуги становить <em>{{writtenAgreement.agreement.summa}}</em> гривень.<br>
                                    4.3.  Замовник здійснює оплату на користь Виконавця наступним чином:<br>

                                    <em ng-repeat="invoice in writtenAgreement.agreement.invoice track by $index">
                                        платіж №{{$index+1}} : сума {{invoice.summa}} без ПДВ до дати {{invoice.payment_date | limitTo: 10}}<br>
                                    </em>

                                    <div style="text-align:center">5. ВІДПОВІДАЛЬНІСТЬ СТОРІН ЗА НЕВИКОНАННЯ АБО НЕНАЛЕЖНЕ ВИКОНАННЯ ЗОБОВ'ЯЗАНЬ.</div>
                                    5.1. За невиконання або неналежне виконання зобов'язань за цим договором сторони несуть відповідальність згідно з чинним законодавством.<br>
                                    5.2. За несвоєчасне внесення плати за надання освітніх послуг Замовник сплачує на користь Виконавця пеню в розмірі 0,3% за кожен день прострочки.<br>
                                    6. ПРИПИНЕННЯ ДОГОВОРУ.<br>
                                    <div style="text-align:center">6.1. Дія договору припиняється:</div>
                                    -  за згодою сторін;<br>
                                    - за заявою будь-якої із сторін, за умови, що сторона, яка бажає розірвати Даний Договір, повідомила іншу сторону за 30 календарних днів;<br>
                                    - якщо виконання стороною договору своїх зобов'язань є неможливим у зв'язку з прийняттям нормативно-правових актів, що змінили умови, встановлені договором щодо освітньої послуги, і будь-яка із сторін не погоджується про внесення змін до договору;<br>
                                    - у разі відрахування Замовника - фізичної особи з навчального закладу згідно з законодавством;<br>
                                    - за рішенням суду в разі систематичного порушення або невиконання умов договору.<br>
                                    6.2. При розірванні договору кошти, проплачені Замовником за послуги, не повертаються.<br><br>
                                    <div style="text-align:center">Адреси, реквізити і підписи сторін:</div>
                                    <table style="width:100%">
                                        <tr>
                                            <td>ВИКОНАВЕЦЬ:</td>
                                            <td>ЗАМОВНИК:</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <em>{{writtenAgreement.agreement.corporateEntity.title}}</em>
                                                ЄРДПО <em>{{writtenAgreement.agreement.corporateEntity.EDPNOU}}</em><br>
                                                р/р <em>{{writtenAgreement.agreement.corporateEntity.latestCheckingAccount.checking_account}}</em>
                                                в <em>{{writtenAgreement.agreement.corporateEntity.latestCheckingAccount.bank_name}}</em>
                                                МФО <em>{{writtenAgreement.agreement.corporateEntity.latestCheckingAccount.bank_code}}</em>
                                                <em>{{writtenAgreement.agreement.corporateEntity.legal_address}}</em>
                                                <em>{{writtenAgreement.agreement.corporateEntity.contacts}}</em>
                                            </td>
                                            <td>
                                                <em ng-repeat="document in writtenAgreement.documents track by $index">
                                                     <span ng-if="document.type==1">
                                                         {{document.last_name}} {{document.first_name}} {{document.middle_name}},
                                                         {{document.registration_address}}
                                                     </span>
                                                </em>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <em ng-repeat="resprsentative in writtenAgreement.agreement.corporateEntity.actualRepresentatives track by $index">
                                                    {{resprsentative.position}}_________________/{{resprsentative.representative.full_name_short}}/</em><br>
                                                <div style="text-align:center">М.П.</div>
                                            </td>
                                            <td>
                                                ________________________/
                                                    <em ng-repeat="document in writtenAgreement.documents track by $index">
                                                     <span ng-if="document.type==1">
                                                         {{document.last_name}} {{document.first_name}} {{document.middle_name}}
                                                     </span>
                                                    </em>/
                                            </td>
                                        </tr>
                                    </table>
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
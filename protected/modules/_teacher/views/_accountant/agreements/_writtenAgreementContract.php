<?php
/* @var $agreement UserAgreements
 */
?>
<div style="border: 1px solid #000;border-radius: 5px; background: #e8e8e8; padding: 5px">
    <form ng-if="contract.personParty.contractingParty.contractingPartyPrivatePerson.documents">
        <fieldset ng-disabled="true">
            <div ng-repeat="document in contract.personParty.contractingParty.contractingPartyPrivatePerson.documents track by $index">
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
                        <input type="text" class="form-control" placeholder="<?php echo 'По-батькові' ?>" ng-model="document.middle_name" disabled>
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
                <div class="input-group">
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
        <h2 style="text-align:center">Договір затверджений</h2>
        <div style="text-align: center">
            <embed embed-src="<?php echo StaticFilesHelper::fullPathToFiles('documents/agreements') ?>/{{contract.personParty.agreement.user_id}}/a{{contract.personParty.agreement.id}}.pdf" width="90%" height="1200px">
        </div>
    </form>

<!--    <div class="tab-content" id="printableArea">-->
        <!--            <div class="tab-pane fade in active" id="offer">-->
        <!--                <div class="panel panel-default">-->
        <!--                    <div class="panel-body">-->
        <!--                        <div class="row" style="padding:5px">-->
        <!--                            <div class="offer" style="background: #ccc; padding: 10px">-->
        <!--                                <div style="text-align:center">ДОГОВІР № {{contract.personParty.agreement.number}}</div>-->
        <!--                                <div style="text-align:center">про надання освітніх послуг за рівнем позашкільної освіти</div>-->
        <!--                                <br>-->
        <!--                                {{contract.personParty.contractingParty.contractingPartyPrivatePerson.privatePersonDocuments["0"].create_date | limitTo: 10}}<br>-->
        <!--                                <br>-->
        <!--                                {{contract.corporateParty.contractingParty.contractingPartyCorporateEntity.corporateEntity.title}} в особі-->
        <!--                                <span ng-repeat="resprsentative in contract.corporateParty.contractingParty.corporateEntityRepresentatives track by $index" >-->
        <!--                                    {{resprsentative.position_accusative | lowercase}} {{resprsentative.representative.full_name_accusative}},</span>-->
        <!--                                далі - Виконавець, та-->
        <!--                                <span ng-repeat="document in contract.personParty.contractingParty.contractingPartyPrivatePerson.documents track by $index">-->
        <!--                                    <span ng-if="document.type==1">{{document.last_name}} {{document.first_name}} {{document.middle_name}},-->
        <!--                                        {{document.documentType.title_ua | lowercase}} {{document.number}} виданий {{document.issued}} {{document.issued_date}},</span>-->
        <!--                                    <span ng-if="document.type==2">{{document.documentType.title_ua | lowercase}} {{document.number}},</span>-->
        <!--                                </span> далі Замовник, з іншого боку, уклали Даний Договір про наступне:-->
        <!--                                <div style="text-align:center">1. ПРЕДМЕТ ДОГОВОРУ</div>-->
        <!--                                1.1. Виконавець бере на себе зобов'язання за рахунок коштів Замовника надати освітню послугу:<br>-->
        <!--                                Назва сервіса  <span>{{contract.personParty.agreement.service.description}}</span><br>-->
        <!--                                <div style="text-align:center">2. ОБОВ'ЯЗКИ ВИКОНАВЦЯ</div>-->
        <!--                                2.1. Надати Замовнику освітню послугу.<br>-->
        <!--                                2.2. Забезпечити дотримання прав учасників навчального процесу відповідно до законодавства.<br>-->
        <!--                                2.3. Видати Замовнику Диплом власного зразка про отримання ним знань.<br>-->
        <!--                                2.4. Інформувати Замовника про правила та вимоги щодо організації надання освітньої послуги, її якості та  змісту, про права і обов'язки сторін під час надання та отримання таких послуг.<br>-->
        <!--                                2.5. В разі успішного засвоєння матеріалу Замовником, Виконавець надає рекомендацію та направлення на працевлаштування Замовника потенційному Роботодавцю.<br>-->
        <!---->
        <!--                                <div style="text-align:center">3. ОБОВ'ЯЗКИ ЗАМОВНИКА</div>-->
        <!--                                3.1. Своєчасно вносити плату за отриману освітню послугу в розмірах та у строки, що встановлені цим договором.<br>-->
        <!--                                3.2. Виконувати вимоги законодавства та Статуту, Правил внутрішнього розпорядку Виконавця з організації надання освітніх послуг.<br>-->
        <!--                                <div style="text-align:center">4. ПЛАТА ЗА НАДАННЯ ОСВІТНЬОЇ ПОСЛУГИ ТА ПОРЯДОК РОЗРАХУНКІВ.</div>-->
        <!--                                4.1. Розмір плати встановлюється за весь строк надання освітньої послуги і не може змінюватись.<br>-->
        <!--                                4.2. Загальна вартість освітньої послуги становить <span>{{contract.personParty.agreement.summa}}</span> гривень.<br>-->
        <!--                                4.3.  Замовник здійснює оплату на користь Виконавця наступним чином:<br>-->
        <!--                                <br>-->
        <!--                                <span ng-repeat="invoice in contract.personParty.agreement.invoice track by $index">-->
        <!--                                    платіж №{{$index+1}} : сума {{invoice.summa}} без ПДВ до дати {{invoice.payment_date | limitTo: 10}}<br>-->
        <!--                                </span>-->
        <!--                                <br>-->
        <!--                                <div style="text-align:center">5. ВІДПОВІДАЛЬНІСТЬ СТОРІН ЗА НЕВИКОНАННЯ АБО НЕНАЛЕЖНЕ ВИКОНАННЯ ЗОБОВ'ЯЗАНЬ.</div>-->
        <!--                                5.1. За невиконання або неналежне виконання зобов'язань за цим договором сторони несуть відповідальність згідно з чинним законодавством.<br>-->
        <!--                                5.2. За несвоєчасне внесення плати за надання освітніх послуг Замовник сплачує на користь Виконавця пеню в розмірі 0,3% за кожен день прострочки.<br>-->
        <!--                                6. ПРИПИНЕННЯ ДОГОВОРУ.<br>-->
        <!--                                <div style="text-align:center">6.1. Дія договору припиняється:</div>-->
        <!--                                -  за згодою сторін;<br>-->
        <!--                                - за заявою будь-якої із сторін, за умови, що сторона, яка бажає розірвати Даний Договір, повідомила іншу сторону за 30 календарних днів;<br>-->
        <!--                                - якщо виконання стороною договору своїх зобов'язань є неможливим у зв'язку з прийняттям нормативно-правових актів, що змінили умови, встановлені договором щодо освітньої послуги, і будь-яка із сторін не погоджується про внесення змін до договору;<br>-->
        <!--                                - у разі відрахування Замовника - фізичної особи з навчального закладу згідно з законодавством;<br>-->
        <!--                                - за рішенням суду в разі систематичного порушення або невиконання умов договору.<br>-->
        <!--                                6.2. При розірванні договору кошти, проплачені Замовником за послуги, не повертаються.<br><br>-->
        <!--                                <div style="text-align:center">Адреси, реквізити і підписи сторін:</div>-->
        <!--                                <table style="width:100%">-->
        <!--                                    <tr>-->
        <!--                                        <td>ВИКОНАВЕЦЬ:</td>-->
        <!--                                        <td>ЗАМОВНИК:</td>-->
        <!--                                    </tr>-->
        <!--                                    <tr>-->
        <!--                                        <td>-->
        <!--                                            <span>{{contract.corporateParty.contractingParty.contractingPartyCorporateEntity.corporateEntity.title}}</span>-->
        <!--                                            ЄРДПО <span>{{contract.corporateParty.contractingParty.contractingPartyCorporateEntity.corporateEntity.EDPNOU}}</span><br>-->
        <!--                                            р/р <span>{{contract.corporateParty.contractingParty.contractingPartyCorporateEntity.checkingAccount.checking_account}}</span>-->
        <!--                                            в <span>{{contract.corporateParty.contractingParty.contractingPartyCorporateEntity.checkingAccount.bank_name}}</span>-->
        <!--                                            МФО <span>{{contract.corporateParty.contractingParty.contractingPartyCorporateEntity.checkingAccount.bank_code}}</span>-->
        <!--                                            <span>{{contract.corporateParty.contractingParty.contractingPartyCorporateEntity.corporateEntity.legal_address}}</span>-->
        <!--                                            <span>{{contract.corporateParty.contractingParty.contractingPartyCorporateEntity.corporateEntity.contacts}}</span>-->
        <!--                                        </td>-->
        <!--                                        <td>-->
        <!--                                            <span ng-repeat="document in contract.personParty.contractingParty.contractingPartyPrivatePerson.documents track by $index">-->
        <!--                                                 <span ng-if="document.type==1">-->
        <!--                                                     {{document.last_name}} {{document.first_name}} {{document.middle_name}},-->
        <!--                                                     {{document.registration_address}}-->
        <!--                                                 </span>-->
        <!--                                            </span>-->
        <!--                                        </td>-->
        <!--                                    </tr>-->
        <!--                                    <tr>-->
        <!--                                        <td>-->
        <!--                                            <span ng-repeat="resprsentative in contract.corporateParty.contractingParty.corporateEntityRepresentatives track by $index">-->
        <!--                                                {{resprsentative.position}}_________________/{{resprsentative.representative.full_name_short}}/</span><br>-->
        <!--                                            <div style="text-align:center">М.П.</div>-->
        <!--                                        </td>-->
        <!--                                        <td>-->
        <!--                                            ________________________/-->
        <!--                                            <span ng-repeat="document in contract.personParty.contractingParty.contractingPartyPrivatePerson.documents track by $index">-->
        <!--                                                 <span ng-if="document.type==1">-->
        <!--                                                     {{document.last_name}} {{document.first_name}} {{document.middle_name}}-->
        <!--                                                 </span>-->
        <!--                                            </span>/-->
        <!--                                        </td>-->
        <!--                                    </tr>-->
        <!--                                </table>-->
        <!--                            </div>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->
</div>
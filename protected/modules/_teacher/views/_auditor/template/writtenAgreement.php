<div class="tab-content">
    <div class="tab-pane fade in active" id="offer">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row" style="padding:5px">
                    <ul class="list-inline">
                        <li>
<!--                            <a type="button" class="btn btn-primary" ng-href="#/auditor/updateOfferTemplate">-->
<!--                                Редагувати текст оферти-->
<!--                            </a>-->
                        </li>
                    </ul>
                    <div class="offer" style="background: #ccc; padding: 10px">
                        <div style="text-align:center">ДОГОВІР № (acc_user_agreements->number)</div>
                        <div style="text-align:center">про надання освітніх послуг за рівнем позашкільної освіти</div>
                        <br>
                        <em>Дата укладання</em>  <em>адреса</em>
                        <br>
                        <em>Назва компанії (acc_corporate_entity->title)</em> в особі <em>посада (acc_corporate_entity_representatives->position_accusative) ім'я (acc_corporate_representative->full_name_accusative)</em>,
                        далі - Виконавець, та <em>ім'я замовника (acc_user_documents->last_name acc_user_documents->first_name acc_user_documents->middle_name)</em>,
                        <em>документ номер (acc_documents_type->title_ua acc_user_documents->number)</em> виданий <em>ким видано (acc_user_documents->issued)</em>
                        <em>дата видачі (acc_user_documents->issued_date)</em>, <em>документ номер (acc_documents_type->title_ua acc_user_documents->number)</em>,
                        далі Замовник, з іншого боку, уклали Даний Договір про наступне:
                        <div style="text-align:center">1. ПРЕДМЕТ ДОГОВОРУ</div>
                        1.1. Виконавець бере на себе зобов'язання за рахунок коштів Замовника надати освітню послугу:<br>
                        Назва сервіса (acc_service->description)<br>
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
                        4.2. Загальна вартість освітньої послуги становить <em>сума (acc_user_agreements->summa)</em> гривень.<br>
                        4.3.  Замовник здійснює оплату на користь Виконавця наступним чином:<br>
                                                <em>платіж № x (index) : сума x (acc_invoice->summa) без ПДВ до дати (acc_invoice->payment_date)</em><br>
                        <div style="text-align:center">5. ВІДПОВІДАЛЬНІСТЬ СТОРІН ЗА НЕВИКОНАННЯ АБО НЕНАЛЕЖНЕ ВИКОНАННЯ ЗОБОВ'ЯЗАНЬ.</div>
                        5.1. За невиконання або неналежне виконання зобов'язань за цим договором сторони несуть відповідальність згідно з чинним законодавством.<br>
                        5.2. За несвоєчасне внесення плати за надання освітніх послуг Замовник сплачує на користь Виконавця пеню в розмірі 0,3% за кожен день прострочки.<br>
                        <div style="text-align:center">6. ПРИПИНЕННЯ ДОГОВОРУ.</div>
                        6.1. Дія договору припиняється:<br>
                        -  за згодою сторін;<br>
                        - за заявою будь-якої із сторін, за умови, що сторона, яка бажає розірвати Даний Договір, повідомила іншу сторону за 30 календарних днів;<br>
                        - якщо виконання стороною договору своїх зобов'язань є неможливим у зв'язку з прийняттям нормативно-правових актів, що змінили умови, встановлені договором щодо освітньої послуги, і будь-яка із сторін не погоджується про внесення змін до договору;<br>
                        - у разі відрахування Замовника - фізичної особи з навчального закладу згідно з законодавством;<br>
                        - за рішенням суду в разі систематичного порушення або невиконання умов договору.<br>
                        6.2. При розірванні договору кошти, проплачені Замовником за послуги, не повертаються.<br><br>
                        <div style="text-align:center">Адреси, реквізити і підписи сторін:</div>
                        <table>
                            <tr>
                                <td>ВИКОНАВЕЦЬ:</td>
                                <td>ЗАМОВНИК:</td>
                            </tr>
                            <tr>
                                <td>
                                    <em>Назва компанії (acc_corporate_entity->title)</em>
                                    <em>Повна юридична адреса (acc_corporate_entity->legal_address)</em>
                                    <em>Контактні дані (acc_corporate_entity->contacts)</em>
                                </td>
                                <td>
                                    <em>Ім'я Замовника (acc_user_documents->last_name acc_user_documents->first_name acc_user_documents->middle_name)</em>
                                    <em>Приписка (acc_user_documents->registration_address)</em>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <em>посада (acc_corporate_entity_representatives->position)</em>_________________<em>ім'я (acc_corporate_representative->full_name_short)</em>
                                    <div style="text-align:center">М.П.</div>
                                </td>
                                <td>
                                    ________________________/<em>ім'я (acc_user_documents->last_name acc_user_documents->first_name acc_user_documents->middle_name)</em>/
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    em{
        font-weight: bold;
        border: 1px solid #000;
    }
    td{
        border: 1px solid #000;
    }
</style>

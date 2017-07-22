<?php

class m170719_165014_create_table_written_agreement_templates extends CDbMigration
{
    public function safeUp()
    {
        $this->createTable('acc_written_agreement_template', array(
            'id' => 'INT PRIMARY KEY AUTO_INCREMENT',
            'template' => 'TEXT',
            'id_organization' => 'INT(10) NOT NULL',
            'create_by' => 'INT(10) NOT NULL',
            'updateAt' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
        ));

        $this->insertMultiple('acc_written_agreement_template', array(
            array(
                'template' => '
                <p style="text-align: center;">ДОГОВІР №&nbsp;<span a-number=""><b><i>*номер_договора*</i></b></span></p>

<p style="text-align: center;">про надання освітніх послуг за рівнем позашкільної освіти</p>

<p><span a-date=""><b><i>*дата_укладення*</i></b></span></p>

<p><br />
<span c-title=""><b><i>*назва_компанії*</i></b></span> в особі <span c-representatives-data=""><b><i>*представники_та_їх_дані*&nbsp;</i></b></span>далі - Виконавець, та <span u-user-doc=""><b><i>*замовник_та_дані_документів*</i></b></span>&nbsp;&nbsp;далі Замовник, з іншого боку, уклали Даний Договір про наступне:</p>

<p style="text-align: center;">1. ПРЕДМЕТ ДОГОВОРУ</p>

<p>1.1. Виконавець бере на себе зобов&#39;язання за рахунок коштів Замовника надати освітню послугу:&nbsp;</p>

<p><span a-description=""><b><i>*назва_сервісу*</i></b></span></p>

<p style="text-align: center;">2. ОБОВ&#39;ЯЗКИ ВИКОНАВЦЯ</p>

<p>2.1. Надати Замовнику освітню послугу.<br />
2.2. Забезпечити дотримання прав учасників навчального процесу відповідно до законодавства.<br />
2.3. Видати Замовнику Диплом власного зразка про отримання ним знань.<br />
2.4. Інформувати Замовника про правила та вимоги щодо організації надання освітньої послуги, її якості та змісту, про права і обов&#39;язки сторін під час надання та отримання таких послуг.<br />
2.5. В разі успішного засвоєння матеріалу Замовником, Виконавець надає рекомендацію та направлення на працевлаштування Замовника потенційному Роботодавцю.</p>

<p>3. ОБОВ&#39;ЯЗКИ ЗАМОВНИКА</p>

<p>3.1. Своєчасно вносити плату за отриману освітню послугу в розмірах та у строки, що встановлені цим договором.<br />
3.2. Виконувати вимоги законодавства та Статуту, Правил внутрішнього розпорядку Виконавця з організації надання освітніх послуг.</p>

<p>4. ПЛАТА ЗА НАДАННЯ ОСВІТНЬОЇ ПОСЛУГИ ТА ПОРЯДОК РОЗРАХУНКІВ.</p>

<p>4.1. Розмір плати встановлюється за весь строк надання освітньої послуги і не може змінюватись.<br />
4.2. Загальна вартість освітньої послуги становить <span a-summa=""><b><i>*ціна_сервіса*</i></b></span>&nbsp;гривень.<br />
4.3. Замовник здійснює оплату на користь Виконавця наступним чином:</p>

<p><span a-invoices=""><b><i>*рахунки_та_ціни*</i></b></span></p>

<p style="text-align: center;">5. ВІДПОВІДАЛЬНІСТЬ СТОРІН ЗА НЕВИКОНАННЯ АБО НЕНАЛЕЖНЕ ВИКОНАННЯ ЗОБОВ&#39;ЯЗАНЬ.</p>

<p>5.1. За невиконання або неналежне виконання зобов&#39;язань за цим договором сторони несуть відповідальність згідно з чинним законодавством.<br />
5.2. За несвоєчасне внесення плати за надання освітніх послуг Замовник сплачує на користь Виконавця пеню в розмірі 0,3% за кожен день прострочки.</p>

<p style="text-align: center;">6. ПРИПИНЕННЯ ДОГОВОРУ.</p>

<p>6.1. Дія договору припиняється:<br />
- за згодою сторін;<br />
- за заявою будь-якої із сторін, за умови, що сторона, яка бажає розірвати Даний Договір, повідомила іншу сторону за 30 календарних днів;<br />
- якщо виконання стороною договору своїх зобов&#39;язань є неможливим у зв&#39;язку з прийняттям нормативно-правових актів, що змінили умови, встановлені договором щодо освітньої послуги, і будь-яка із сторін не погоджується про внесення змін до договору;<br />
- у разі відрахування Замовника - фізичної особи з навчального закладу згідно з законодавством;<br />
- за рішенням суду в разі систематичного порушення або невиконання умов договору.<br />
6.2. При розірванні договору кошти, проплачені Замовником за послуги, не повертаються.<br />
&nbsp;</p>

<p style="text-align: center;">Адреси, реквізити і підписи сторін:</p>

<table>
	<tbody>
		<tr>
			<td style="width:45%">ВИКОНАВЕЦЬ:</td>
			<td style="width:45%">ЗАМОВНИК:</td>
		</tr>
		<tr>
			<td>
			<p><span c-title=""><b><i>*назва_компанії*</i></b></span></p>

			<p><span c-legal-address=""><b><i>*адреса_компанії*</i></b></span></p>

			<p><span c-contacts=""><b><i>*контакти_компанії*</i></b></span></p>
			</td>
			<td><span u-user-data-address=""><b><i>*замовник_дані_документів_адресса*</i></b></span></td>
		</tr>
		<tr>
			<td><span c-representatives-position-name=""><b><i>*представники_посади_імена*</i></b></span>
			<p>&nbsp;</p>
			</td>
			<td>________________________/<span u-name=""><b><i>*ім&#39;я_замовника*</i></b></span>/</td>
		</tr>
	</tbody>
</table>

                ',
                'id_organization' => '1',
                'create_by' => '822',
            ),
        ));

        $this->addForeignKey('FK_written_agreement_template_organization', 'acc_written_agreement_template', 'id_organization', 'organization', 'id', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('FK_written_agreement_template_user', 'acc_written_agreement_template', 'create_by', 'user', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropForeignKey('FK_written_agreement_template_user', 'acc_written_agreement_template');
        $this->dropForeignKey('FK_written_agreement_template_organization', 'acc_written_agreement_template');

        $this->dropTable('acc_written_agreement_template');
    }
}
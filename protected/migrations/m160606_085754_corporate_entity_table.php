<?php

class m160606_085754_corporate_entity_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('acc_corporate_entity', array(
            'id' => 'pk',
			'title' => 'VARCHAR(255) NOT NULL',
            'EDPNOU' => 'VARCHAR(14) NOT NULL COMMENT \'National State Registry of Ukrainian Enterprises and Organizations\'',
            'edpnou_issue_date' => 'DATETIME NULL DEFAULT NULL COMMENT \'Дата видачі  ЄДРПОУ\'',
            'certificate_of_vat' => 'VARCHAR(14) NOT NULL COMMENT \'Свідоцтво платника ПДВ\'',
            'certificate_of_vat_issue_date' => 'DATETIME NULL DEFAULT NULL COMMENT \'Дата видачі свідоцтва платника ПДВ\'',
            'tax_certificate' => 'VARCHAR(14) NOT NULL COMMENT \'Свідоцтво платника податку\'',
            'tax_certificate_issue_date' => 'DATETIME NULL DEFAULT NULL COMMENT \'Дата видачі свідоцтва платника податку\'',
            'legal_address' => 'VARCHAR(255) NOT NULL COMMENT \'Юридична адреса\'',
            'legal_address_city_code' => 'INT(11) NOT NULL COMMENT \'Код міста (юридична адреса)\'',
            'actual_address' => 'VARCHAR(255) NOT NULL COMMENT \'Фактична адреса\'',
            'actual_address_city_code' => 'INT(11) NOT NULL COMMENT \'Код міста (фактична адреса)\'',
            'CONSTRAINT `FK_acc_corporate_entity_address_city` FOREIGN KEY (`legal_address_city_code`) REFERENCES `address_city` (`id`)',
            'CONSTRAINT `FK_acc_corporate_entity_address_city_2` FOREIGN KEY (`actual_address_city_code`) REFERENCES `address_city` (`id`)'
        ));
	}

	public function down()
	{
		$this->dropForeignKey('FK_acc_corporate_entity_address_city', 'acc_corporate_entity');
        $this->dropForeignKey('FK_acc_corporate_entity_address_city_2', 'acc_corporate_entity');
        $this->dropTable('acc_corporate_entity');
	}
}
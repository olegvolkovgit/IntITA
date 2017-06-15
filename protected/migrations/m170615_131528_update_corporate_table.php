<?php

class m170615_131528_update_corporate_table extends CDbMigration
{
	public function safeUp()
	{
        $this->alterColumn('acc_corporate_entity', 'certificate_of_vat', 'VARCHAR(14) DEFAULT NULL');
        $this->alterColumn('acc_corporate_entity', 'tax_certificate', 'VARCHAR(14) DEFAULT NULL');
        $this->alterColumn('acc_corporate_entity', 'actual_address', 'VARCHAR(255) DEFAULT NULL');
        $this->alterColumn('acc_corporate_entity', 'actual_address_city_code', 'INT(11) DEFAULT NULL');
	}

	public function safeDown()
	{
        $this->alterColumn('acc_corporate_entity', 'certificate_of_vat', 'VARCHAR(14) NOT NULL COMMENT \'Свідоцтво платника ПДВ\'');
        $this->alterColumn('acc_corporate_entity', 'tax_certificate', 'VARCHAR(14) NOT NULL COMMENT \'Свідоцтво платника податку\'');
        $this->alterColumn('acc_corporate_entity', 'actual_address', 'VARCHAR(255) NOT NULL COMMENT \'Фактична адреса\'');
        $this->alterColumn('acc_corporate_entity', 'actual_address_city_code', 'INT(11) NOT NULL COMMENT \'Код міста (фактична адреса)\'');
	}
}
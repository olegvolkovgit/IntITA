<?php

class m170228_143031_add_column_to_acc_payment_schema_template extends CDbMigration
{
	public function up()
	{
		$this->addColumn('acc_payment_schema_template', 'printPromotionForCourse', 'BOOLEAN NOT NULL DEFAULT FALSE');
		$this->addColumn('acc_payment_schema_template', 'printPromotionForModule', 'BOOLEAN NOT NULL DEFAULT FALSE');
		$this->addColumn('acc_payment_schema_template', 'description_ua', 'TEXT DEFAULT NULL');
		$this->addColumn('acc_payment_schema_template', 'description_ru', 'TEXT DEFAULT NULL');
		$this->addColumn('acc_payment_schema_template', 'description_en', 'TEXT DEFAULT NULL');
		$this->renameColumn('acc_payment_schema_template', 'template_name', 'template_name_ua');
		$this->addColumn('acc_payment_schema_template', 'template_name_ru', 'VARCHAR(64) DEFAULT NULL COLLATE `utf8_bin`');
		$this->addColumn('acc_payment_schema_template', 'template_name_en', 'VARCHAR(64) DEFAULT NULL COLLATE `utf8_bin`');
		$this->addColumn('acc_payment_schema_template', 'startDate', 'DATE DEFAULT NULL');
		$this->addColumn('acc_payment_schema_template', 'endDate', 'DATE DEFAULT NULL');
	}

	public function down()
	{
		$this->dropColumn('acc_payment_schema_template', 'printPromotionForCourse');
		$this->dropColumn('acc_payment_schema_template', 'printPromotionForModule');
		$this->dropColumn('acc_payment_schema_template', 'template_name_ru');
		$this->dropColumn('acc_payment_schema_template', 'template_name_en');
		$this->renameColumn('acc_payment_schema_template', 'template_name_ua', 'template_name');
		$this->dropColumn('acc_payment_schema_template', 'description_ua');
		$this->dropColumn('acc_payment_schema_template', 'description_ru');
		$this->dropColumn('acc_payment_schema_template', 'description_en');
		$this->dropColumn('acc_payment_schema_template', 'startDate');
		$this->dropColumn('acc_payment_schema_template', 'endDate');
	}
}
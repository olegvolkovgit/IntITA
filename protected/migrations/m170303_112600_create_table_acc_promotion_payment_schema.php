<?php

class m170303_112600_create_table_acc_promotion_payment_schema extends CDbMigration
{
	public function up()
	{
		$this->dropColumn('acc_payment_schema_template', 'printPromotionForCourse');
		$this->dropColumn('acc_payment_schema_template', 'printPromotionForModule');
		$this->dropColumn('acc_payment_schema_template', 'startDate');
		$this->dropColumn('acc_payment_schema_template', 'endDate');

		$this->createTable('acc_promotion_payment_schema', array(
			'id' => 'pk',
			'id_template' => 'INT(10) NOT NULL',
			'courseId' => 'INT(10) NULL DEFAULT NULL',
			'moduleId' => 'INT(10) NULL DEFAULT NULL',
			'serviceType' => 'TINYINT(1) NULL DEFAULT NULL',
			'showDate'=> 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP',
			'startDate'=> 'DATE DEFAULT NULL',
			'endDate'=> "DATE DEFAULT NULL",
		));
	}

	public function down()
	{
		$this->addColumn('acc_payment_schema_template', 'printPromotionForCourse', 'BOOLEAN NOT NULL DEFAULT FALSE');
		$this->addColumn('acc_payment_schema_template', 'printPromotionForModule', 'BOOLEAN NOT NULL DEFAULT FALSE');
		$this->addColumn('acc_payment_schema_template', 'startDate', 'DATE DEFAULT NULL');
		$this->addColumn('acc_payment_schema_template', 'endDate', 'DATE DEFAULT NULL');

		$this->dropTable('acc_promotion_payment_schema');
	}
}
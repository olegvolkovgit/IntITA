<?php

class m170402_100556_drop_old_table_pay_course_and_module extends CDbMigration
{
	public function safeUp()
	{
		$this->dropTable('pay_courses');
		$this->dropTable('pay_modules');
		$this->dropTable('permissions');
	}

	public function safeDown()
	{
		echo "m170402_100556_drop_old_table_pay_course_and_module does not support migration down.\n";
		return false;
	}
}
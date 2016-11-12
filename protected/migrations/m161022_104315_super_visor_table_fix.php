<?php

class m161022_104315_super_visor_table_fix extends CDbMigration
{
	public function up()
	{
		$this->dropForeignKey('FK_user_super_visor', 'user_super_visor');
		$this->dropPrimaryKey('id_user','user_super_visor');
		$this->addForeignKey('FK_user_super_visor', 'user_super_visor', 'id_user', 'user', 'id');
	}

	public function down()
	{
		echo "m161022_104315_super_visor_table_fix does not support migration down.\n";
		return false;
	}
}
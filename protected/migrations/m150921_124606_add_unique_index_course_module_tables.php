<?php

class m150921_124606_add_unique_index_course_module_tables extends CDbMigration
{
	public function safeUp()
	{
        $this->createIndex('course_number', 'course', 'course_number', true);
        $this->createIndex('module_number', 'module', 'module_number', true);
        $this->createIndex('course', 'course', 'alias', true);
        $this->createIndex('module', 'module', 'alias', true);
	}

	public function safeDown()
	{
        $this->dropIndex('course_number', 'course');
        $this->dropIndex('module_number', 'module');
        $this->dropIndex('alias', 'course');
        $this->dropIndex('alias', 'module');
	}

}
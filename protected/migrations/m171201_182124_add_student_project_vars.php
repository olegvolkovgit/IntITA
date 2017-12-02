<?php

class m171201_182124_add_student_project_vars extends CDbMigration
{

	public function safeUp()
	{
	$this->insert('config', array(
			'param' => 'tempProjectsPath',
            'value' => '/var/www/IntITA/test',
            'default' => '/var/www/IntITA/test',
            'label' => 'Шлях до тиимчасового зберігання проектыв студентів',
            'type' => 'string'
		));

        $this->insert('config', array(
            'param' => 'realProjectsPath',
            'value' => '/var/www/IntITA/projects',
            'default' => '/var/www/IntITA/projects',
            'label' => 'Шлях до зберігання проектыв студентів',
            'type' => 'string'
        ));

        $this->insert('config', array(
            'param' => 'studentsProjectsUrl',
            'value' => 'https://projects.intita.com',
            'default' => 'https://projects.intita.com',
            'label' => 'Посилання на студентські проекти',
            'type' => 'string'
        ));
	}

	public function safeDown()
	{
        echo "m171201_182124_add_student_project_vars does not support migration down.\n";
        return false;
	}

}
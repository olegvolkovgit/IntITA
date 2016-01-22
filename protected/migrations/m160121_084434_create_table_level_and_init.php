<?php

class m160121_084434_create_table_level_and_init extends CDbMigration
{

    public function safeUp()
    {
        $this->createTable('level', array(
            'id' => 'INT(10) NOT NULL AUTO_INCREMENT',
            'title_ua' => 'VARCHAR(50) NOT NULL',
            'title_ru' => 'VARCHAR(50) NOT NULL',
            'title_en' => 'VARCHAR(50) NOT NULL',
            'PRIMARY KEY (`id`)',
        ));
        $this->insertMultiple('level', array(
                array(
                    'id' => '1',
                    'title_ua' => 'стажер',
                    'title_ru' => 'стажер',
                    'title_en' => 'intern'
                ),
                array(
                    'id' => '2',
                    'title_ua' => 'початківець',
                    'title_ru' => 'начинающий',
                    'title_en' => 'junior'
                ),
                array(
                    'id' => '3',
                    'title_ua' => 'сильний початківець',
                    'title_ru' => 'начинающий сильный',
                    'title_en' => 'strong junior'
                ),
                array(
                    'id' => '4',
                    'title_ua' => 'середній',
                    'title_ru' => 'средний',
                    'title_en' => 'middle'
                ),
                array(
                    'id' => '5',
                    'title_ua' => 'високий',
                    'title_ru' => 'высокий',
                    'title_en' => 'senior'
                )
            )
        );
        $sqlCourses = 'SELECT course_ID, `level` FROM course';
        $courseLevels = $this->getDBConnection()->createCommand($sqlCourses)->queryAll();
        $sqlModules = 'SELECT module_ID, `level` FROM module';
        $moduleLevels = $this->getDBConnection()->createCommand($sqlModules)->queryAll();

        //update courses level
        $this->update('course', array('level' => ''));
        $this->alterColumn('course', 'level', 'INT(11) NOT NULL');
        for($i = 0, $count = count($courseLevels); $i < $count; $i++){
            switch($courseLevels[$i]["level"]){
                case 'intern': $this->update('course', array('`level`' => '1'), 'course_ID='.$courseLevels[$i]["course_ID"]);
                    break;
                case 'junior': $this->update('course', array('`level`' => '2'), 'course_ID='.$courseLevels[$i]["course_ID"]);
                    break;
                case 'strong junior': $this->update('course', array('`level`' => '3'), 'course_ID='.$courseLevels[$i]["course_ID"]);
                    break;
                case 'middle': $this->update('course', array('`level`' => '4'), 'course_ID='.$courseLevels[$i]["course_ID"]);
                    break;
                case 'senior': $this->update('course', array('`level`' => '5'), 'course_ID='.$courseLevels[$i]["course_ID"]);
                    break;
            }
        }
        $this->addForeignKey('FK_course_level', 'course', 'level', 'level', 'id');

        //update modules level
        $this->update('module', array('level' => ''));
        $this->alterColumn('module', 'level', 'INT(11) NOT NULL');
        for($i = 0, $count = count($moduleLevels); $i < $count; $i++){
            switch($moduleLevels[$i]["level"]){
                case 'intern': $this->update('module', array('`level`' => '1'), 'module_ID='.$moduleLevels[$i]["module_ID"]);
                    break;
                case 'junior': $this->update('module', array('`level`' => '2'), 'module_ID='.$moduleLevels[$i]["module_ID"]);
                    break;
                case 'strong junior': $this->update('module', array('`level`' => '3'), 'module_ID='.$moduleLevels[$i]["module_ID"]);
                    break;
                case 'middle': $this->update('module', array('`level`' => '4'), 'module_ID='.$moduleLevels[$i]["module_ID"]);
                    break;
                case 'senior': $this->update('module', array('`level`' => '5'), 'module_ID='.$moduleLevels[$i]["module_ID"]);
                    break;
            }
        }
        $this->addForeignKey('FK_module_level', 'module', 'level', 'level', 'id');
    }

    public function safeDown()
    {
        echo "m160121_084434_create_table_level_and_init does not support migration down.\n";
        return false;
    }

}
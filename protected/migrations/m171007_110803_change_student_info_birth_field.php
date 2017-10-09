<?php

class m171007_110803_change_student_info_birth_field extends CDbMigration
{
    public function up()
    {
        $this->dropTable('student_info');

        $this->createTable('student_info', array(
            'id' => 'INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT',
            'id_student' => 'INT(11) NOT NULL',
            'first_name' => 'VARCHAR(255) NULL DEFAULT NULL',
            'second_name' => 'VARCHAR(255) NULL DEFAULT NULL',
            'middle_name' => 'VARCHAR(255) NULL DEFAULT NULL',
            'birthday' => 'VARCHAR(255) NULL DEFAULT NULL',
            'mobile_phone' => 'VARCHAR(15) NULL DEFAULT NULL',
            'mobile_phone_2' => 'VARCHAR(15) NULL DEFAULT NULL',
            'email' => 'VARCHAR(255) NULL DEFAULT NULL',
            'email_intita' => 'VARCHAR(255) NULL DEFAULT NULL',
            'address' => 'TEXT DEFAULT NULL',
            'family_status_children' => 'VARCHAR(255) NULL DEFAULT NULL',
            'facebook' => 'VARCHAR(255) NULL DEFAULT NULL',
            'notes' => 'TEXT DEFAULT NULL',
            'education' => 'VARCHAR(255) NULL DEFAULT NULL',
            'source_about_us' => 'TEXT DEFAULT NULL',
            'interests' => 'TEXT DEFAULT NULL',
            'current_job' => 'TEXT DEFAULT NULL',
            'prev_job' => 'TEXT DEFAULT NULL',
            'english_level' => 'VARCHAR(255) NULL DEFAULT NULL',
            'rather_form_study' => 'INT(10) NULL DEFAULT NULL',
            'rather_time_study' => 'INT(10) NULL DEFAULT NULL',
            'rather_form_payment' => 'VARCHAR(255) NULL DEFAULT NULL',
            'id_organization' => 'INT(10) NULL DEFAULT NULL',
            'pay_form' => 'TINYINT(1) NULL DEFAULT NULL',
            'debt_comment' => 'VARCHAR(255) NULL DEFAULT NULL',
            'time_call' => 'VARCHAR(255) NULL DEFAULT NULL',
            'date_converse' => 'VARCHAR(255) NULL DEFAULT NULL'
        ));

        $criteria = new CDbCriteria();
        $criteria->join = 'left join user_student us on us.id_user = t.id';
        $criteria->condition = 'us.end_date is null and us.id_organization = 1 and t.cancelled = 0';
        $students = StudentReg::model()->findAll($criteria);

        foreach($students as $student){
            $this->insert('student_info',
                [
                    'id_student' => $student['id'],
                    'first_name' => $student['firstName'],
                    'second_name' => $student['secondName'],
                    'middle_name' => $student['middleName'],
                    'birthday' => $student['birthday']?date('Y-m-d', strtotime(str_replace('/', '-', $student['birthday']))):null,
                    'email' => $student['email'],
                    'mobile_phone' => $student['phone'],
                    'address' => $student['address'],
                    'facebook' => $student['facebook'],
                    'education' => $student['education'],
                    'interests' => $student['interests'],
                    'source_about_us' => $student['aboutUs'],
                    'prev_job' => $student['prev_job'],
                    'current_job' => $student['current_job'],
                    'rather_form_study' => $student['educform'],
                    'rather_time_study' => $student['education_shift'],
                    'id_organization' => '1',
                ]);
        }
    }

    public function down()
    {
        $this->dropTable('student_info');
    }
}
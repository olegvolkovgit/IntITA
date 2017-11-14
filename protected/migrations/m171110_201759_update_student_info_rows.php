<?php

class m171110_201759_update_student_info_rows extends CDbMigration
{
    public function up()
    {
        $criteria = new CDbCriteria();
        $criteria->join = 'left join user_student us on us.id_user = t.id';
        $criteria->condition = 'us.end_date is null and us.id_organization = 1 and t.cancelled = 0';
        $students = StudentReg::model()->findAll($criteria);

        foreach($students as $student){
            if(!StudentInfo::model()->findByAttributes(array('id_student'=>$student->id))){
                $this->insert('student_info',
                    [
                        'id_student' => $student['id'],
                        'first_name' => $student['firstName'],
                        'second_name' => $student['secondName'],
                        'middle_name' => $student['middleName'],
                        'birthday' => $student['birthday'],
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
    }

	public function down()
	{
		echo "m171110_201759_update_student_info_rows does not support migration down.\n";
		return false;
	}
}
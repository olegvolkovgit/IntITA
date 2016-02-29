<?php

class m160229_101813_update_consultant_module_and_trainer_student_tables extends CDbMigration
{
    public function safeUp()
    {
        $sqlConsultant = "update consultant_modules set consultant = (select user_id from teacher where teacher_id=consultant);";
        $sqlTrainer = "update trainer_student set trainer = (select user_id from teacher where teacher_id=trainer);";

        $this->dropForeignKey('FK_teacher', 'consultant_modules');
        $this->dropForeignKey('FK_trainer_student_teacher', 'trainer_student');
        $this->execute($sqlConsultant);
        $this->execute($sqlTrainer);
    }

    public function safeDown()
    {
        echo "m160229_101813_update_consultant_module_and_trainer_student_tables does not support migration down.\n";
        return false;
    }
}
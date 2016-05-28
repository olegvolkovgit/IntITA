<?php

class m160521_141536_add_vc_lecture_ready_status extends CDbMigration
{

    public function safeUp() {
        $this->addColumn('vc_lecture_properties', 'release_date', 'TIMESTAMP NULL');
        $this->addColumn('vc_lecture_properties', 'id_user_released', 'INT(11) DEFAULT NULL');

        $query = 'UPDATE vc_lecture_properties AS t1
                  INNER JOIN
                      vc_lecture_properties AS t2 ON t1.id = t2.id 
                  SET 
                      t1.release_date = t2.approve_date,
                      t1.id_user_released = t2.id_user_approved
                  WHERE
                      t1.id_user_cancelled IS NULL
                          AND t1.end_date IS NULL
                          AND t1.approve_date IS NOT NULL
                          AND t1.id_user_approved IS NOT NULL;';

        $this->getDbConnection()->createCommand($query)->execute();
    }

    public function safeDown() {
        $this->dropColumn('vc_lecture_properties', 'release_date');
        $this->dropColumn('vc_lecture_properties', 'id_user_released');
        return true;
    }
}
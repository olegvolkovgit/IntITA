<?php

class m161103_183935_service_special_offer extends CDbMigration {

    public function safeUp() {
        $this->addColumn('acc_payment_schema', 'serviceId', 'INT');

        $this->execute('
                UPDATE 
                    acc_payment_schema ps JOIN (
                SELECT 
                    ps.id, cs.service_id
                FROM
                    acc_payment_schema ps
                    JOIN acc_course_service cs ON ps.courseId = cs.course_id
                WHERE
                    courseId IS NOT NULL
                UNION
                SELECT 
                    ps.id, ms.service_id
                FROM
                    acc_payment_schema ps
                    JOIN acc_module_service ms ON ps.moduleId = ms.module_id
                WHERE
                    ps.moduleId IS NOT NULL) t ON ps.id = t.id
                SET ps.serviceId=t.service_id;
                ');

        $this->dropColumn('acc_payment_schema', 'courseId');
        $this->dropColumn('acc_payment_schema', 'moduleId');
        $this->dropColumn('acc_payment_schema', 'type');
    }

    public function safeDown() {
        $this->addColumn('acc_payment_schema', 'courseId', 'INT');
        $this->addColumn('acc_payment_schema', 'moduleId', 'INT');
        $this->addColumn('acc_payment_schema', 'type', 'INT');

        $this->execute('UPDATE 
                            acc_payment_schema ps JOIN (
                        SELECT 
                            ps.id, course_id AS courseId, NULL AS moduleId, IF(ps.userId,1,2) AS type
                        FROM
                            acc_course_service cs
                                JOIN
                            acc_payment_schema ps ON cs.service_id = ps.serviceId
                        UNION
                        SELECT 
                            ps.id, NULL, module_id, IF(ps.userId,1,3) AS type
                        FROM
                            acc_module_service ms
                                JOIN
                            acc_payment_schema ps ON ms.service_id = ps.serviceId) t ON ps.id = t.id
                        set ps.moduleId = t.moduleId, ps.courseId = t.courseId, ps.type=t.type;');

        $this->dropColumn('acc_payment_schema', 'serviceId');
    }
}
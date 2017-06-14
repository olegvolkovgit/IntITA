<?php

class m170516_132413_offline_groups_teacher_consultant_module extends CDbMigration
{
    public function safeUp()
    {
        $this->createTable('offline_groups_teacher_consultant_module', array(
            'id' => 'INT(10) AUTO_INCREMENT PRIMARY KEY',
            'id_group' => 'INT(10) NOT NULL',
            'id_teacher' => 'INT(10) NOT NULL',
            'id_module' => 'INT(10) NOT NULL',
            'assigned_by' => 'INT(10) NOT NULL',
            'start_date' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP',
            'cancelled_by' => 'INT(10) DEFAULT NULL',
            'end_date' => 'DATETIME NULL DEFAULT NULL',
            'INDEX `FK_offline_groups_teacher_consultant_module_user` (`id_teacher`)',
            'INDEX `FK_offline_groups_teacher_consultant_module_module` (`id_module`)',
            'INDEX `FK_offline_groups_teacher_consultant_module_group` (`id_group`)',
            'CONSTRAINT `FK_offline_groups_teacher_consultant_module_module` FOREIGN KEY (`id_module`) REFERENCES `module` (`module_ID`)',
            'CONSTRAINT `FK_offline_groups_teacher_consultant_module_user` FOREIGN KEY (`id_teacher`) REFERENCES `user` (`id`)',
            'CONSTRAINT `FK_offline_groups_teacher_consultant_module_group` FOREIGN KEY (`id_group`) REFERENCES `offline_groups` (`id`)'
        ), 'COLLATE=\'utf8_general_ci\' ENGINE=InnoDB');
    }

    public function safeDown()
    {
        $this->dropForeignKey('FK_offline_groups_teacher_consultant_module_module', 'offline_groups_teacher_consultant_module');
        $this->dropForeignKey('FK_offline_groups_teacher_consultant_module_user', 'offline_groups_teacher_consultant_module');
        $this->dropForeignKey('FK_offline_groups_teacher_consultant_module_group', 'offline_groups_teacher_consultant_module');
        $this->dropTable('offline_groups_teacher_consultant_module');
    }
}
<?php

class m161129_185341_user_service_access extends CDbMigration {

    public function up() {
        $this->createTable('user_service_access', [
                'userId' => 'INT NOT NULL',
                'serviceId' => 'INT NOT NULL',
                'endDate' => 'DATETIME NOT NULL',
                'userChanged' => 'INT NOT NULL',
                'comment' => 'VARCHAR(1024) DEFAULT NULL',
                'PRIMARY KEY(userId, serviceId)']
        );

        $this->createTable('user_service_access_history', [
                'id' => 'INT NOT NULL PRIMARY KEY AUTO_INCREMENT',
                'userId' => 'INT NOT NULL',
                'serviceId' => 'INT NOT NULL',
                'endDate' => 'DATETIME NOT NULL',
                'userChanged' => 'INT NOT NULL',
                'comment' => 'VARCHAR(1024) DEFAULT NULL',
                'action' => 'SET("INSERT", "UPDATE", "DELETE") NOT NULL',
                'mysqlUser' => 'varchar(256) NOT NULL'],
            'COMMENT="user_service_access table change history. Fill in by triggers on user_service_access table"'
        );

        $triggers = "
                    DROP TRIGGER IF EXISTS user_service_access_AFTER_INSERT;
                    CREATE TRIGGER user_service_access_AFTER_INSERT
                    AFTER INSERT ON user_service_access
                    FOR EACH ROW
                      BEGIN
                        INSERT IGNORE INTO user_service_access_history
                        SET `userId` = NEW.userId,
                          `serviceId` = NEW.serviceId,
                          `endDate` = NEW.endDate,
                          `userChanged` = NEW.userChanged,
                          `comment` = NEW.`comment`,
                          `action` = 'INSERT',
                          `mysqlUser` = CURRENT_USER();
                      END;
                    
                    DROP TRIGGER IF EXISTS user_service_access_AFTER_UPDATE;
                    CREATE TRIGGER user_service_access_AFTER_UPDATE
                    AFTER UPDATE ON user_service_access
                    FOR EACH ROW
                      BEGIN
                        INSERT IGNORE INTO user_service_access_history
                        SET `userId` = OLD.userId,
                          `serviceId` = OLD.serviceId,
                          `endDate` = OLD.endDate,
                          `userChanged` = OLD.userChanged,
                          `comment` = OLD.`comment`,
                          `action` = 'UPDATE',
                          `mysqlUser` = CURRENT_USER();
                      END;
                    
                    DROP TRIGGER IF EXISTS user_service_access_AFTER_DELETE;
                    CREATE TRIGGER user_service_access_AFTER_DELETE
                    AFTER DELETE ON user_service_access
                    FOR EACH ROW
                      BEGIN
                        INSERT IGNORE INTO user_service_access_history
                        SET `userId` = OLD.userId,
                          `serviceId` = OLD.serviceId,
                          `endDate` = OLD.endDate,
                          `userChanged` = OLD.userChanged,
                          `comment` = OLD.`comment`,
                          `action` = 'DELETE',
                          `mysqlUser` = CURRENT_USER();
                      END;
        ";

        $this->dbConnection->createCommand($triggers)->execute();
    }

    public function down() {
        $this->dropTable('user_service_access');
        $this->dropTable('user_service_access_history');

        $dropTriggers = "
                DROP TRIGGER IF EXISTS user_service_access_AFTER_DELETE;
                DROP TRIGGER IF EXISTS user_service_access_AFTER_UPDATE;
                DROP TRIGGER IF EXISTS user_service_access_AFTER_INSERT;";

        $this->dbConnection->createCommand($dropTriggers)->execute();
    }
}
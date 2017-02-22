<?php

class m170221_184218_move_tags_into_one_column extends CDbMigration {
    public function safeUp() {
        $this->renameColumn('tags', 'tag_ua', 'tag');
        $this->createIndex('U_tag', 'tags', 'tag', true);
        $this->alterColumn('tags', 'tag_ru', 'VARCHAR(50) DEFAULT NULL');
        $this->alterColumn('tags', 'tag_en', 'VARCHAR(50) DEFAULT NULL');
        $qs = ' INSERT IGNORE INTO intita.tags (tag)
                SELECT tag_ru AS tag
                FROM intita.tags
                UNION
                SELECT tag_en AS tag
                FROM intita.tags';
        $this->dbConnection->createCommand($qs)->execute();
        $this->dropIndex('U_tag', 'tags');

    }

    public function safeDown() {
        echo "m170221_184218_move_tags_into_one_column does not support migration down.\n";
        return false;
    }
}
<?php

class m171120_194529_add_translations_984 extends CDbMigration
{
    private function addTranslate($id, $category, $message, $translates) {
        $this->insert('sourcemessages', [
            'id' => $id,
            'category' => $category,
            'message' => $message
        ]);

        foreach ($translates as $lang => $translation) {
            $this->insert('translate',
                [
                    'id' => $id,
                    'language' => $lang,
                    'translation' => $translation
                ]);
        }
    }

    public function safeUp()
    {
        $this->addTranslate(984, 'profile', '0984',
            [
                'ua' => 'Проекти',
                'ru' => 'Проэкты',
                'en' => 'Projects'
            ]);

    }

    public function safeDown()
    {
        $this->delete('translate', 'id=0984');
        $this->delete('sourcemessages', 'id=0984');
    }
}
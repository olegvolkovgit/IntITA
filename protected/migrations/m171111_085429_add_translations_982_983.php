<?php

class m171111_085429_add_translations_982_983 extends CDbMigration
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
        $this->addTranslate(982, 'graduates', '0982',
            [
                'ua' => 'пошук випускників',
                'ru' => 'поиск преподавателей',
                'en' => 'graduates search'
            ]);
        $this->addTranslate(983, 'teachers', '0983',
            [
                'ua' => 'пошук викладачів',
                'ru' => 'поиск преподавателей',
                'en' => 'teachers search'
            ]);
    }

    public function safeDown()
    {
        $this->delete('translate', 'id=0982');
        $this->delete('sourcemessages', 'id=0982');
        $this->delete('translate', 'id=0983');
        $this->delete('sourcemessages', 'id=0983');
    }
}
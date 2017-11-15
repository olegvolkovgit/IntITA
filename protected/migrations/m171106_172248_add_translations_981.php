<?php

class m171106_172248_add_translations_981 extends CDbMigration
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
        $this->addTranslate(981, 'header', '0981',
            [
                'ua' => 'Партнери',
                'ru' => 'Партнеры',
                'en' => 'Partners'
            ]);
    }

    public function safeDown()
    {
        $this->delete('translate', 'id=0981');
        $this->delete('sourcemessages', 'id=0981');
    }
}
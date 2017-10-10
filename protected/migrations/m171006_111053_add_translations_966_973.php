<?php

class m171006_111053_add_translations_966_973 extends CDbMigration
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
	    $this->addTranslate(973, 'profile', '0966',
            [
                'ua' => 'Назва організації: ',
                'ru' => 'Название организации: ',
                'en' => 'Name of organization: '
            ]);
        $this->addTranslate(974, 'profile', '0967',
            [
                'ua' => 'Автор контента ',
                'ru' => 'Автор контента ',
                'en' => 'Author of content '
            ]);
        $this->addTranslate(975, 'profile', '0968',
            [
                'ua' => 'Викладач ',
                'ru' => 'Преподаватель ',
                'en' => 'Teacher '
            ]);
        $this->addTranslate(976, 'profile', '0969',
            [
                'ua' => 'Консультант ',
                'ru' => 'Консультант ',
                'en' => 'Consultant '
            ]);
        $this->addTranslate(977, 'profile', '0970',
            [
                'ua' => 'Контент менеджер ',
                'ru' => 'Контент менеджер ',
                'en' => 'Content manager '
            ]);
        $this->addTranslate(978, 'profile', '0971',
            [
                'ua' => 'Бухгалтер ',
                'ru' => 'Бухгалтер ',
                'en' => 'Accountant '
            ]);
        $this->addTranslate(979, 'profile', '0972',
            [
                'ua' => 'Супервізор ',
                'ru' => 'Супервизор ',
                'en' => 'Supervisor '
            ]);
        $this->addTranslate(980, 'profile', '0973',
            [
                'ua' => 'Кар\'єра ',
                'ru' => 'Карьера ',
                'en' => 'Career '
            ]);
	}

	public function safeDown()
	{
        $this->delete('translate', 'id=0966');
        $this->delete('sourcemessages', 'id=0966');
        $this->delete('translate', 'id=0967');
        $this->delete('sourcemessages', 'id=0967');
        $this->delete('translate', 'id=0968');
        $this->delete('sourcemessages', 'id=0968');
        $this->delete('translate', 'id=0969');
        $this->delete('sourcemessages', 'id=0969');
        $this->delete('translate', 'id=0970');
        $this->delete('sourcemessages', 'id=0970');
        $this->delete('translate', 'id=0971');
        $this->delete('sourcemessages', 'id=0971');
        $this->delete('translate', 'id=0972');
        $this->delete('sourcemessages', 'id=0972');
        $this->delete('translate', 'id=0973');
        $this->delete('sourcemessages', 'id=0973');
	}

}
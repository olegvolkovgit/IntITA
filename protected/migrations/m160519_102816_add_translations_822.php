<?php

class m160519_102816_add_translations_822 extends CDbMigration
{
	public function up()
	{
        $this->insertMultiple('sourcemessages', array(
            array(
                'id' => '822',
                'category' => 'profile',
                'message' => '0822'
            ),
            array(
                'id' => '823',
                'category' => 'profile',
                'message' => '0823'
            ),
            array(
                'id' => '824',
                'category' => 'profile',
                'message' => '0824'
            ),
            array(
                'id' => '825',
                'category' => 'revision',
                'message' => '0825'
            ),
            array(
                'id' => '826',
                'category' => 'revision',
                'message' => '0826'
            ),
            array(
                'id' => '827',
                'category' => 'revision',
                'message' => '0827'
            ),
            array(
                'id' => '828',
                'category' => 'revision',
                'message' => '0828'
            ),
            array(
                'id' => '829',
                'category' => 'revision',
                'message' => '0829'
            ),
            array(
                'id' => '830',
                'category' => 'revision',
                'message' => '0830'
            )
        ));
        $this->insertMultiple('translate', array(
            array(
                'id_record' => null,
                'id' => '0822',
                'language' => 'ua',
                'translation' => 'Курси'
            ),
            array(
                'id_record' => null,
                'id' => '0822',
                'language' => 'ru',
                'translation' => 'Курсы'
            ),
            array(
                'id_record' => null,
                'id' => '0822',
                'language' => 'en',
                'translation' => 'Courses'
            ),
            array(
                'id_record' => null,
                'id' => '0823',
                'language' => 'ua',
                'translation' => 'Рейтинг'
            ),
            array(
                'id_record' => null,
                'id' => '0823',
                'language' => 'ru',
                'translation' => 'Рейтинг'
            ),
            array(
                'id_record' => null,
                'id' => '0823',
                'language' => 'en',
                'translation' => 'Rating'
            ),
            array(
                'id_record' => null,
                'id' => '0824',
                'language' => 'ua',
                'translation' => 'Оцінювання'
            ),
            array(
                'id_record' => null,
                'id' => '0824',
                'language' => 'ru',
                'translation' => 'Оценки'
            ),
            array(
                'id_record' => null,
                'id' => '0824',
                'language' => 'en',
                'translation' => 'Assessments'
            ),
            array(
                'id_record' => null,
                'id' => '0825',
                'language' => 'ua',
                'translation' => 'У тебе немає прав для редагування цієї ревізії'
            ),
            array(
                'id_record' => null,
                'id' => '0825',
                'language' => 'ru',
                'translation' => 'У тебя нет прав для редактирования этой ревизии'
            ),
            array(
                'id_record' => null,
                'id' => '0825',
                'language' => 'en',
                'translation' => 'You have not privileges to edit this revision'
            ),
            array(
                'id_record' => null,
                'id' => '0826',
                'language' => 'ua',
                'translation' => 'Статус цієї ревізії не дозволяє її редагувати'
            ),
            array(
                'id_record' => null,
                'id' => '0826',
                'language' => 'ru',
                'translation' => 'Статус этой ревизии не позволяет ее редактировать'
            ),
            array(
                'id_record' => null,
                'id' => '0826',
                'language' => 'en',
                'translation' => 'You have not privileges to edit this revision'
            ),
            array(
                'id_record' => null,
                'id' => '0827',
                'language' => 'ua',
                'translation' => 'Доступ заборонено. У вас недостатньо прав для відхилення даної ревізії'
            ),
            array(
                'id_record' => null,
                'id' => '0827',
                'language' => 'ru',
                'translation' => 'Доступ запрещен. У вас нет прав для отклонения этой ревизии'
            ),
            array(
                'id_record' => null,
                'id' => '0827',
                'language' => 'en',
                'translation' => 'Access denied. You have not privileges to reject a revision'
            ),
            array(
                'id_record' => null,
                'id' => '0828',
                'language' => 'ua',
                'translation' => 'Доступ заборонено. У вас недостатньо прав для затвердження даної ревізії'
            ),
            array(
                'id_record' => null,
                'id' => '0828',
                'language' => 'ru',
                'translation' => 'Доступ запрещен. У вас нет прав для утверждения этой ревизии'
            ),
            array(
                'id_record' => null,
                'id' => '0828',
                'language' => 'en',
                'translation' => 'Access denied. You have not privileges to approve a revision'
            ),
            array(
                'id_record' => null,
                'id' => '0829',
                'language' => 'ua',
                'translation' => 'Доступ заборонено. У вас недостатньо прав для перегляду ревізій цього модуля'
            ),
            array(
                'id_record' => null,
                'id' => '0829',
                'language' => 'ru',
                'translation' => 'Доступ запрещен. У вас нет прав для просмотра ревизий этого модуля'
            ),
            array(
                'id_record' => null,
                'id' => '0829',
                'language' => 'en',
                'translation' => 'Access denied. You have not privileges to view this module revisions'
            ),
            array(
                'id_record' => null,
                'id' => '0830',
                'language' => 'ua',
                'translation' => 'Доступ заборонено. У вас недостатньо прав для видалення даної ревізії'
            ),
            array(
                'id_record' => null,
                'id' => '0830',
                'language' => 'ru',
                'translation' => 'Доступ запрещен. У вас нет прав для удаления этой ревизии'
            ),
            array(
                'id_record' => null,
                'id' => '0830',
                'language' => 'en',
                'translation' => 'Access denied. You have not privileges to cancelling a revision'
            ),
        ));
	}

	public function down()
	{
        $this->delete('translate', 'id=822');
        $this->delete('sourcemessages', 'id=822');
        $this->delete('translate', 'id=823');
        $this->delete('sourcemessages', 'id=823');
        $this->delete('translate', 'id=824');
        $this->delete('sourcemessages', 'id=824');
        $this->delete('translate', 'id=825');
        $this->delete('sourcemessages', 'id=825');
        $this->delete('translate', 'id=826');
        $this->delete('sourcemessages', 'id=826');
        $this->delete('translate', 'id=827');
        $this->delete('sourcemessages', 'id=827');
        $this->delete('translate', 'id=828');
        $this->delete('sourcemessages', 'id=828');
        $this->delete('translate', 'id=829');
        $this->delete('sourcemessages', 'id=829');
        $this->delete('translate', 'id=830');
        $this->delete('sourcemessages', 'id=830');
	}
}
<?php

class m151001_104542_add_translation_637_646 extends CDbMigration
{
	public function up()
	{
        $sqlSourceMessages = "
        INSERT INTO `sourcemessages` VALUES ('637', 'payment', '0637');
        INSERT INTO `sourcemessages` VALUES ('638', 'lecture', '0638');
        INSERT INTO `sourcemessages` VALUES ('639', 'lecture', '0639');
        INSERT INTO `sourcemessages` VALUES ('640', 'lecture', '0640');
        INSERT INTO `sourcemessages` VALUES ('641', 'lecture', '0641');
        INSERT INTO `sourcemessages` VALUES ('642', 'lecture', '0642');
        INSERT INTO `sourcemessages` VALUES ('643', 'sharing', '0643');
        INSERT INTO `sourcemessages` VALUES ('644', 'sharing', '0644');
        INSERT INTO `sourcemessages` VALUES ('645', 'sharing', '0645');
        INSERT INTO `sourcemessages` VALUES ('646', 'errors', '0646');
        ";
        $this->execute($sqlSourceMessages);

        $sqlMessages = "
        INSERT INTO `messages` VALUES (null, '637', 'ua', 'Виберіть схему оплати:');
        INSERT INTO `messages` VALUES (null, '637', 'ru', 'Выберите схему оплаты:');
        INSERT INTO `messages` VALUES (null, '637', 'en', 'Choose payment scheme:');
        INSERT INTO `messages` VALUES (null, '638', 'ua', 'Частина недоступна');
        INSERT INTO `messages` VALUES (null, '638', 'ru', 'Часть недоступна');
        INSERT INTO `messages` VALUES (null, '638', 'en', 'Part not available');
        INSERT INTO `messages` VALUES (null, '639', 'ua', 'На жаль, відео для цієї сторінки ще не завантажено.');
        INSERT INTO `messages` VALUES (null, '639', 'ru', 'К сожалению, видео для этой страницы еще не загружено.');
        INSERT INTO `messages` VALUES (null, '639', 'en', 'Unfortunately, the video for this has not been downloaded.');
        INSERT INTO `messages` VALUES (null, '640', 'ua', 'В доступі відмовлено. Ви не пройшли попередні кроки.');
        INSERT INTO `messages` VALUES (null, '640', 'ru', 'В доступе отказано. Вы не прошли предыдущие шаги.');
        INSERT INTO `messages` VALUES (null, '640', 'en', 'Access is denied. You have not passed the previous steps.');
        INSERT INTO `messages` VALUES (null, '641', 'ua', '(показати)');
        INSERT INTO `messages` VALUES (null, '641', 'ru', '(показать)');
        INSERT INTO `messages` VALUES (null, '641', 'en', '(showing)');
        INSERT INTO `messages` VALUES (null, '642', 'ua', '(згорнути)');
        INSERT INTO `messages` VALUES (null, '642', 'ru', '(свернуть)');
        INSERT INTO `messages` VALUES (null, '642', 'en', '(minimize)');
        INSERT INTO `messages` VALUES (null, '643', 'ua', 'INTITA - ПРОГРАМУЙ МАЙБУТНЄ!');
        INSERT INTO `messages` VALUES (null, '643', 'ru', 'INTITA - ПРОГРАММИРУЙ БУДУЩЕЕ!');
        INSERT INTO `messages` VALUES (null, '643', 'en', 'INTITA - PROGRAM THE FUTURE!');
        INSERT INTO `messages` VALUES (null, '644', 'ua', 'Хочеш стати висококласним спеціалістом? Приймай вірне рішення - навчайся разом з нами!\r\nМи працюємо на результат!');
        INSERT INTO `messages` VALUES (null, '644', 'ru', 'Хочешь стать высококлассным специалистом? Принимай правильное решение - учись вместе с нами!\r\nМы работаем на результат!');
        INSERT INTO `messages` VALUES (null, '644', 'en', 'Would you like to become a highly qualified programmer? Make the right decision, join us for learning! We aim for results!');
        INSERT INTO `messages` VALUES (null, '645', 'ua', 'Якщо ви професійний ІТ-шник і бажаєте викладати окремі ІТ теми чи модулі і співпрацювати з нами в напрямку підготовки програмістів, напишіть нам листа.');
        INSERT INTO `messages` VALUES (null, '645', 'ru', 'Если Вы профессиональный ІТ-шник и хотите преподавать некоторые ІТ курсы и сотрудничать с нами в подготовке программистов, напишите нам письмо.');
        INSERT INTO `messages` VALUES (null, '645', 'en', 'If you are an expert in IT and want to teach IT material or modules and collaborate with us on  educating future   programmers, contact us...');
        INSERT INTO `messages` VALUES (null, '646', 'ua', 'У тебе немає доступу до цього заняття. Спочатку пройди попередній матеріал.');
        INSERT INTO `messages` VALUES (null, '646', 'ru', 'У тебя нет доступа к этому занятию. Сначала пройди предыдущий материал.');
        INSERT INTO `messages` VALUES (null, '646', 'en', 'You do not have access to this occupation. First, go through the previous material.');
        ";
        $this->execute($sqlMessages);
	}

	public function down()
	{
        $this->delete('messages', 'id=637');
        $this->delete('sourcemessages', 'id=637');
        $this->delete('messages', 'id=638');
        $this->delete('sourcemessages', 'id=638');
        $this->delete('messages', 'id=639');
        $this->delete('sourcemessages', 'id=639');
        $this->delete('messages', 'id=640');
        $this->delete('sourcemessages', 'id=640');
        $this->delete('messages', 'id=641');
        $this->delete('sourcemessages', 'id=641');
        $this->delete('messages', 'id=642');
        $this->delete('sourcemessages', 'id=642');
        $this->delete('messages', 'id=643');
        $this->delete('sourcemessages', 'id=643');
        $this->delete('messages', 'id=644');
        $this->delete('sourcemessages', 'id=644');
        $this->delete('messages', 'id=645');
        $this->delete('sourcemessages', 'id=645');
        $this->delete('messages', 'id=646');
        $this->delete('sourcemessages', 'id=646');
	}
}
<?php

class m150925_141510_add_translations_618_636 extends CDbMigration
{
	public function up()
	{
        $sqlSourceMessages = "
        INSERT INTO `sourcemessages` VALUES ('618', 'edit', '0618');
INSERT INTO `sourcemessages` VALUES ('619', 'edit', '0619');
INSERT INTO `sourcemessages` VALUES ('620', 'edit', '0620');
INSERT INTO `sourcemessages` VALUES ('621', 'edit', '0621');
INSERT INTO `sourcemessages` VALUES ('622', 'edit', '0622');
INSERT INTO `sourcemessages` VALUES ('623', 'edit', '0623');
INSERT INTO `sourcemessages` VALUES ('624', 'edit', '0624');
INSERT INTO `sourcemessages` VALUES ('625', 'edit', '0625');
INSERT INTO `sourcemessages` VALUES ('626', 'edit', '0626');
INSERT INTO `sourcemessages` VALUES ('627', 'edit', '0627');
INSERT INTO `sourcemessages` VALUES ('628', 'edit', '0628');
INSERT INTO `sourcemessages` VALUES ('629', 'edit', '0629');
INSERT INTO `sourcemessages` VALUES ('630', 'edit', '0630');
INSERT INTO `sourcemessages` VALUES ('631', 'edit', '0631');
INSERT INTO `sourcemessages` VALUES ('632', 'edit', '0632');
INSERT INTO `sourcemessages` VALUES ('633', 'edit', '0633');
INSERT INTO `sourcemessages` VALUES ('634', 'edit', '0634');
INSERT INTO `sourcemessages` VALUES ('635', 'edit', '0635');
INSERT INTO `sourcemessages` VALUES ('636', 'validation', '0636');";
        $this->execute($sqlSourceMessages);

        $sqlMessages = "
        INSERT INTO `messages` VALUES (null, '618', 'ua', 'Ваш профіль заповнено на ');
INSERT INTO `messages` VALUES (null, '618', 'ru', 'Ваш профиль заполнен на');
INSERT INTO `messages` VALUES (null, '618', 'en', 'Your profile is completed by');
INSERT INTO `messages` VALUES (null, '619', 'ua', 'Додати аватар');
INSERT INTO `messages` VALUES (null, '619', 'ru', 'Добавить аватар');
INSERT INTO `messages` VALUES (null, '619', 'en', 'Add an avatar');
INSERT INTO `messages` VALUES (null, '620', 'ua', 'Додати');
INSERT INTO `messages` VALUES (null, '620', 'ru', 'Добавить');
INSERT INTO `messages` VALUES (null, '620', 'en', 'Add');
INSERT INTO `messages` VALUES (null, '621', 'ua', 'ім\'я');
INSERT INTO `messages` VALUES (null, '621', 'ru', 'имя');
INSERT INTO `messages` VALUES (null, '621', 'en', 'name');
INSERT INTO `messages` VALUES (null, '622', 'ua', 'прізвище');
INSERT INTO `messages` VALUES (null, '622', 'ru', 'фамилию');
INSERT INTO `messages` VALUES (null, '622', 'en', 'surname');
INSERT INTO `messages` VALUES (null, '623', 'ua', 'нік');
INSERT INTO `messages` VALUES (null, '623', 'ru', 'ник');
INSERT INTO `messages` VALUES (null, '623', 'en', 'nickname');
INSERT INTO `messages` VALUES (null, '624', 'ua', 'дату народження');
INSERT INTO `messages` VALUES (null, '624', 'ru', 'дату рождения');
INSERT INTO `messages` VALUES (null, '624', 'en', 'date of birth');
INSERT INTO `messages` VALUES (null, '625', 'ua', 'телефон');
INSERT INTO `messages` VALUES (null, '625', 'ru', 'телефон');
INSERT INTO `messages` VALUES (null, '625', 'en', 'phone');
INSERT INTO `messages` VALUES (null, '626', 'ua', 'адресу');
INSERT INTO `messages` VALUES (null, '626', 'ru', 'адрес');
INSERT INTO `messages` VALUES (null, '626', 'en', 'address');
INSERT INTO `messages` VALUES (null, '627', 'ua', 'освіту');
INSERT INTO `messages` VALUES (null, '627', 'ru', 'образование');
INSERT INTO `messages` VALUES (null, '627', 'en', 'education');
INSERT INTO `messages` VALUES (null, '628', 'ua', 'про себе');
INSERT INTO `messages` VALUES (null, '628', 'ru', 'о себе');
INSERT INTO `messages` VALUES (null, '628', 'en', 'about myself');
INSERT INTO `messages` VALUES (null, '629', 'ua', 'захоплення');
INSERT INTO `messages` VALUES (null, '629', 'ru', 'увлечения');
INSERT INTO `messages` VALUES (null, '629', 'en', 'interests');
INSERT INTO `messages` VALUES (null, '630', 'ua', 'звідки про нас дізналися');
INSERT INTO `messages` VALUES (null, '630', 'ru', 'откуда о нас узнали');
INSERT INTO `messages` VALUES (null, '630', 'en', 'where you hear about us');
INSERT INTO `messages` VALUES (null, '631', 'ua', 'посилання на facebook');
INSERT INTO `messages` VALUES (null, '631', 'ru', 'ссылку на facebook');
INSERT INTO `messages` VALUES (null, '631', 'en', 'link to facebook');
INSERT INTO `messages` VALUES (null, '632', 'ua', 'посилання на googleplus');
INSERT INTO `messages` VALUES (null, '632', 'ru', 'ссылку на googleplus');
INSERT INTO `messages` VALUES (null, '632', 'en', 'link to googleplus');
INSERT INTO `messages` VALUES (null, '633', 'ua', 'посилання на linkedin');
INSERT INTO `messages` VALUES (null, '633', 'ru', 'ссылку на linkedin');
INSERT INTO `messages` VALUES (null, '633', 'en', 'link to linkedin');
INSERT INTO `messages` VALUES (null, '634', 'ua', 'посилання на vkontakte');
INSERT INTO `messages` VALUES (null, '634', 'ru', 'ссылку на vkontakte');
INSERT INTO `messages` VALUES (null, '634', 'en', 'link to vkontakte');
INSERT INTO `messages` VALUES (null, '635', 'ua', 'посилання на twitter');
INSERT INTO `messages` VALUES (null, '635', 'ru', 'ссылку на twitter');
INSERT INTO `messages` VALUES (null, '635', 'en', 'link to twitter');
INSERT INTO `messages` VALUES (null, '636', 'ua', 'Ви ввели некоректну сторінку');
INSERT INTO `messages` VALUES (null, '636', 'ru', 'Вы ввели неправильную страницу');
INSERT INTO `messages` VALUES (null, '636', 'en', 'You entered an incorrect page');

        ";
        $this->execute($sqlMessages);
	}

	public function down()
	{
		echo "m150925_141510_add_translations_618_636 does not support migration down.\n";
		return false;
	}
}
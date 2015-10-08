<?php

class m151008_144046_add_translation_647_655 extends CDbMigration
{
	public function safeUp()
	{
		$sqlSourceMessages = "
        INSERT INTO `sourcemessages` VALUES ('647', 'module', '0647');
		INSERT INTO `sourcemessages` VALUES ('648', 'module', '0648');
		INSERT INTO `sourcemessages` VALUES ('649', 'module', '0649');
		INSERT INTO `sourcemessages` VALUES ('650', 'module', '0650');
		INSERT INTO `sourcemessages` VALUES ('651', 'module', '0651');
		INSERT INTO `sourcemessages` VALUES ('652', 'module', '0652');
		INSERT INTO `sourcemessages` VALUES ('653', 'module', '0653');
		INSERT INTO `sourcemessages` VALUES ('654', 'module', '0654');
		INSERT INTO `sourcemessages` VALUES ('655', 'module', '0655');
        ";
		$this->execute($sqlSourceMessages);

		$sqlMessages = "
        INSERT INTO `messages` VALUES ('2101', '647', 'ua', 'Рекомендований час');
		INSERT INTO `messages` VALUES ('2102', '647', 'ru', 'Рекомендуемое время');
		INSERT INTO `messages` VALUES ('2103', '647', 'en', 'Recommended time');
		INSERT INTO `messages` VALUES ('2104', '648', 'ua', 'На черзі');
		INSERT INTO `messages` VALUES ('2105', '648', 'ru', 'На очереди');
		INSERT INTO `messages` VALUES ('2106', '648', 'en', 'The next step');
		INSERT INTO `messages` VALUES ('2107', '649', 'ua', 'Завершено!');
		INSERT INTO `messages` VALUES ('2108', '649', 'ru', 'Завершен!');
		INSERT INTO `messages` VALUES ('2109', '649', 'en', 'Finished!');
		INSERT INTO `messages` VALUES ('2110', '650', 'ua', 'Затрачено');
		INSERT INTO `messages` VALUES ('2111', '650', 'ru', 'Ушло');
		INSERT INTO `messages` VALUES ('2112', '650', 'en', 'Spent');
		INSERT INTO `messages` VALUES ('2113', '651', 'ua', 'Модуль в роботі!');
		INSERT INTO `messages` VALUES ('2114', '651', 'ru', 'Модуль в работе!');
		INSERT INTO `messages` VALUES ('2115', '651', 'en', 'The module work!');
		INSERT INTO `messages` VALUES ('2116', '652', 'ua', 'з');
		INSERT INTO `messages` VALUES ('2117', '652', 'ru', 'из');
		INSERT INTO `messages` VALUES ('2118', '652', 'en', 'of the');
		INSERT INTO `messages` VALUES ('2119', '653', 'ua', 'днів');
		INSERT INTO `messages` VALUES ('2120', '653', 'ru', 'дней');
		INSERT INTO `messages` VALUES ('2121', '653', 'en', 'days');
		INSERT INTO `messages` VALUES ('2122', '654', 'ua', 'день');
		INSERT INTO `messages` VALUES ('2123', '654', 'ru', 'день');
		INSERT INTO `messages` VALUES ('2124', '654', 'en', 'day');
		INSERT INTO `messages` VALUES ('2125', '655', 'ua', 'дні');
		INSERT INTO `messages` VALUES ('2126', '655', 'ru', 'дня');
				INSERT INTO `messages` VALUES ('2127', '655', 'en', 'days');
        ";
		$this->execute($sqlMessages);
	}

	public function down()
	{
		$this->delete('messages', 'id=647');
		$this->delete('sourcemessages', 'id=647');
		$this->delete('messages', 'id=648');
		$this->delete('sourcemessages', 'id=648');
		$this->delete('messages', 'id=649');
		$this->delete('sourcemessages', 'id=649');
		$this->delete('messages', 'id=650');
		$this->delete('sourcemessages', 'id=650');
		$this->delete('messages', 'id=651');
		$this->delete('sourcemessages', 'id=651');
		$this->delete('messages', 'id=652');
		$this->delete('sourcemessages', 'id=652');
		$this->delete('messages', 'id=653');
		$this->delete('sourcemessages', 'id=653');
		$this->delete('messages', 'id=654');
		$this->delete('sourcemessages', 'id=654');
		$this->delete('messages', 'id=655');
		$this->delete('sourcemessages', 'id=655');
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}
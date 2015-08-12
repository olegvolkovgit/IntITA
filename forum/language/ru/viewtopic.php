<?php
/**
*
* This file is part of the phpBB Forum Software package.
*
* @copyright (c) phpBB Limited <https://www.phpbb.com>
* @license GNU General Public License, version 2 (GPL-2.0)
*
* For full copyright and license information, please see
* the docs/CREDITS.txt file.*
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
exit;
}

if (empty($lang) || !is_array($lang))
{
$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fеine

$lang = array_merge($lang, array(
	'APPROVE'								=> 'Утвердить',
	'ATTACHMENT'							=> 'Вложение',
	'ATTACHMENT_FUNCTIONALITY_DISABLED'		=> 'Функция вложений выключена.',

	'BOOKMARK_ADDED'			=> 'Тема успешно помещена в закладки',
	'BOOKMARK_ERR'				=> 'Не удалось добавить тему в закладки. Пожалуйста, попробуйте снова. ',
	'BOOKMARK_REMOVED'			=> 'Тема успешно удалена из закладок.',
	'BOOKMARK_TOPIC'			=> 'В закладки',
	'BOOKMARK_TOPIC_REMOVE'		=> 'Удалить из закладок',
	'BUMPED_BY'					=> 'Последний раз поднималось %1$s %2$s.',
	'BUMP_TOPIC'				=> 'Поднять тему',

	'CODE'					=> 'Код',
	
	'DELETE_TOPIC'			=> 'Удалить тему',
	'DELETED_INFORMATION'	=> 'Удалено %2$s пользователем %1$s',
	'DISAPPROVE'			=> 'Отклонить',
	'DOWNLOAD_NOTICE'		=> 'У вас нет необходимых прав для просмотра вложений в этом сообщении.',

	'EDITED_TIMES_TOTAL'	=> array(
	1	=> 'Последний раз редактировалось %2$s %3$s, всего редактировалось %1$d раз.',
	2	=> 'Последний раз редактировалось %2$s %3$s, всего редактировалось %1$d раз.',
	),
	'EMAIL_TOPIC'			=> 'Отправить тему по email',
	'ERROR_NO_ATTACHMENT'	=> 'Выбранного вложения больше не существует.',

	'FILE_NOT_FOUND_404'	=> 'Файл <strong>%s</strong> не существует.',
	'FORK_TOPIC'			=> 'Копировать тему',
	'FULL_EDITOR'			=> 'Стандартный ответ &amp; предпросмотр',

	'LINKAGE_FORBIDDEN'			=> 'Вы не авторизованы для просмотра, скачивания файлов и перехода по ссылкам этого сайта.',
	'LOGIN_NOTIFY_TOPIC'		=> 'Вы получили уведомление о новом сообщении в теме, авторизируйтесь, пожалуйста, для его просмотра',
	'LOGIN_VIEWTOPIC'			=> 'Для просмотра темы Вы должны быть зарегистрированным пользователем.',

	'MAKE_ANNOUNCE'					=> 'Сделать объявлением',
	'MAKE_GLOBAL'					=> 'Сделать важной',
	'MAKE_NORMAL'					=> 'Сделать обычной',
	'MAKE_STICKY'					=> 'Сделать прилепленной',
	'MAX_OPTIONS_SELECT'		=> array(
		1	=> 'Можно выбрать до <strong>%d</strong> варианта ответа',
		2	=> 'Можно выбрать до <strong>%d</strong> вариантов ответа',
		3	=> 'Можно выбрать до <strong>%d</strong> вариантов ответа',
	),
	'MISSING_INLINE_ATTACHMENT'		=> 'Вложение <strong>%s</strong> больше недоступно.',
	'MOVE_TOPIC'					=> 'Переместить тему',

	'NO_ATTACHMENT_SELECTED'=> 'Вы не выбрали вложение для скачивания или просмотра.',
	'NO_NEWER_TOPICS'			=> 'Нет более новых тем на этом форуме .',
	'NO_OLDER_TOPICS'			=> 'Нет более старых тем на этом форуме .',
	'NO_UNREAD_POSTS'			=> 'Нет новых непрочитанных сообщений в этой теме ',
	'NO_VOTE_OPTION'			=> 'Вы должны указать вариант ответа при голосовании.',
	'NO_VOTES'					=> 'Нет ответов.',

	'POLL_ENDED_AT'				=> 'Голосование закончилось %s',
	'POLL_RUN_TILL'				=> 'Голосование проводится до %s',
	'POLL_VOTED_OPTION'			=> 'Вы голосовали за этот вариант',
	'POST_DELETED_RESTORE'		=> 'Это сообщение было удалено, но ещё может быть восстановлено.',
	'PRINT_TOPIC'				=> 'Для печати',

	'QUICK_MOD'					=> 'Быстрые операции',
	'QUICKREPLY'				=> 'Быстрый ответ',
	'QUOTE'						=> 'Цитата',

	'REPLY_TO_TOPIC'			=> 'Ответить на тему',
	'RESTORE'					=> 'Восстановить',
	'RESTORE_TOPIC'				=> 'Восстановить тему',
	'RETURN_POST'				=> '%sВернуться к сообщению%s',

	'SUBMIT_VOTE'				=> 'Проголосовать',
	
	'TOPIC_TOOLS'				=> 'Управление темой',
	'TOTAL_VOTES'				=> 'Всего голосов',

	'UNLOCK_TOPIC'				=> 'Открыть тему',

	'VIEW_INFO'					=> 'Информация о сообщении',
	'VIEW_NEXT_TOPIC'			=> 'Следующая тема',
	'VIEW_PREVIOUS_TOPIC'		=> 'Предыдущая тема',
	'VIEW_RESULTS'				=> 'Результаты голосования',
	'VIEW_TOPIC_POSTS'			=> array(
		1	=> '%d сообщение',
		2	=> '%d сообщений',
	),
	'VIEW_UNREAD_POST'			=> 'Первое новое сообщение',
	'VOTE_SUBMITTED'			=> 'Ваш голос был зачтен, спасибо.',
	'VOTE_CONVERTED'			=> 'Не доступно изменение голосов в сконвертированных опросах.',
));

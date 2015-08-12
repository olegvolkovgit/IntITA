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
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine

$lang = array_merge($lang, array(
	'CONFIG_NOT_EXIST'					=> 'Настройка конфигурации "%s" не существует.',

	'GROUP_NOT_EXIST'					=> 'Группа "%s" не существует.',
	
	'MIGRATION_APPLY_DEPENDENCIES'		=> 'Установка зависимостей обновления %s.',

	'MIGRATION_DATA_DONE'				=> 'Перенос данных выполнен: %1$s; Время: %2$.2f секунд',
	'MIGRATION_DATA_IN_PROGRESS'		=> 'Выполняется перенос данных: %1$s; Время: %2$.2f секунд',
	'MIGRATION_DATA_RUNNING'			=> 'Добавление данных: %s.',
	'MIGRATION_EFFECTIVELY_INSTALLED'	=> 'Перенос данных успешно произведен (пропущен): %s',
	'MIGRATION_EXCEPTION_ERROR'			=> 'Что-то пошло не так во время запроса и было сгенерировано исключение. Изменения, внесенные до ошибки были отменены настолько, насколько это возможно, но Вам необходимо будет проверить форум на предмет наличия ошибок.',
	'MIGRATION_NOT_FULFILLABLE'			=> 'Перенос "%1$s" не может быть выполнен, отсутствует перенос "%2$s".',
	'MIGRATION_NOT_VALID'				=> '%s не является корректным обновлением.',
	'MIGRATION_SCHEMA_DONE'				=> 'Установленная схема: %1$s; Время: %2$.2f секунд',
	'MIGRATION_SCHEMA_RUNNING'			=> 'Обновление схемы: %s.',

	'MIGRATION_INVALID_DATA_MISSING_CONDITION'		=> 'Файл обновления содержит ошибки. Обработчик оператора if не смог найти условие.',
	'MIGRATION_INVALID_DATA_MISSING_STEP'			=> 'Файл обновления содержит ошибки. Обработчик оператора if не смог обнаружить корректный запуск шага обновления.',
	'MIGRATION_INVALID_DATA_CUSTOM_NOT_CALLABLE'	=> 'Файл обновления содержит ошибки. Попытка обращения к пользовательской функции, которая не может быть вызвана.',
	'MIGRATION_INVALID_DATA_UNKNOWN_TYPE'			=> 'Файл обновления содержит ошибки. Тип обновления не указан.',
	'MIGRATION_INVALID_DATA_UNDEFINED_TOOL'			=> 'Файл обновления содержит ошибки. Требуемый файл обновления не существует.',
	'MIGRATION_INVALID_DATA_UNDEFINED_METHOD'		=> 'Файл обновления содержит ошибки. Требуемый метод отсутствует в файле обновления.',
	
	'MODULE_ERROR'						=> 'При создании модуля произошла ошибка: %s',
	'MODULE_INFO_FILE_NOT_EXIST'		=> 'Отсутствует модуль info-файла: %2$s',
	'MODULE_NOT_EXIST'					=> 'Отсутствует необходимый модуль: %s',

	'PERMISSION_NOT_EXIST'				=> 'Настройка доступа "%s" отсутствуют.',

	'ROLE_NOT_EXIST'					=> 'Роль доступа "%s" отсутствует.',
));

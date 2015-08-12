<?php
/**
*
* This file is part of the phpBB Forum Software package.
*
* @copyright (c) phpBB Limited <https://www.phpbb.com>
* @license GNU General Public License, version 2 (GPL-2.0)
*
* For full copyright and license information, please see
* the docs/CREDITS.txt file.
*
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
	'ACP_FILES'						=> 'Управление языковыми файлами',
	'ACP_LANGUAGE_PACKS_EXPLAIN'	=> 'Здесь Вы можете устанавливать/удалять языковые пакеты. Языковой пакет, который установлен по умолчанию, помечен звёздочкой (*).',
	
	'DELETE_LANGUAGE_CONFIRM'		=> 'Вы уверены, что хотите удалить «%s»?',
	
	'INSTALLED_LANGUAGE_PACKS'		=> 'Установленные языковые пакеты',

	'LANGUAGE_DETAILS_UPDATED'				=> 'Языковая информация успешно обновлена.',
	'LANGUAGE_PACK_ALREADY_INSTALLED'		=> 'Этот языковой пакет уже установлен.',
	'LANGUAGE_PACK_DELETED'					=> 'Языковой пакет «%s» успешно удалён. Все пользователи, использующие этот язык, переключены на язык конференции по умолчанию.',
	'LANGUAGE_PACK_DETAILS'					=> 'Информация о языковом пакете',
	'LANGUAGE_PACK_INSTALLED'				=> 'Языковой пакет «%s» успешно установлен.',
	'LANGUAGE_PACK_CPF_UPDATE'				=> 'Установлен язык по умолчанию. Если есть необходимость вы можете его изменить.',
	'LANGUAGE_PACK_ISO'						=> 'ISO',
	'LANGUAGE_PACK_LOCALNAME'				=> 'Местное название',
	'LANGUAGE_PACK_NAME'					=> 'Название',
	'LANGUAGE_PACK_NOT_EXIST'				=> 'Выбранный языковой пакет не существует.',
	'LANGUAGE_PACK_USED_BY'					=> 'Используют (включая роботов)',
	'LANGUAGE_VARIABLE'						=> 'Языковая переменная',
	'LANG_AUTHOR'							=> 'Автор языкового пакета',
	'LANG_ENGLISH_NAME'						=> 'Имя на английском',
	'LANG_ISO_CODE'							=> 'Код ISO',
	'LANG_LOCAL_NAME'						=> 'Местное название',

	'MISSING_LANG_FILES'			=> 'Отсутствующие языковые файлы',
	'MISSING_LANG_VARIABLES'		=> 'Отсутствующие языковые переменные',

	'NO_FILE_SELECTED'					=> 'Вы не указали языковой файл.',
	'NO_LANG_ID'						=> 'Вы не указали языковой пакет.',
	'NO_REMOVE_DEFAULT_LANG'			=> 'Вы не можете удалить языковой пакет, используемый по умолчанию.<br />Если Вы хотите удалить этот языковой пакет, сначала измените язык форума по умолчанию.',
	'NO_UNINSTALLED_LANGUAGE_PACKS'		=> 'Все языковые пакеты установлены',

	'THOSE_MISSING_LANG_FILES'			=> 'Следующие языковые файлы отсутствуют в языковом пакете «%s»',
	'THOSE_MISSING_LANG_VARIABLES'		=> 'Следующие языковые переменные отсутствуют в языковом пакете «%s»',
	
	'UNINSTALLED_LANGUAGE_PACKS'		=> 'Доступные для установки языковые пакеты',

));

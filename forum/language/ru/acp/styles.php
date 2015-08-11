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
	'ACP_STYLES_EXPLAIN'				=> 'Здесь Вы можете управлять стилями, доступными на форуме. Вы можете изменять существующие стили, удалять, отключать, переключать, устанавливать новые. Также Вы сможете просматривать стили используя функцию предварительного просмотра. Еще в данном списке отображается общее число пользователей каждого стиля, при этом обратите внимание, что переопределение стилей пользователя здесь не отобразится.',

	'CANNOT_BE_INSTALLED'				=> 'Не может быть установлен',
	'CONFIRM_UNINSTALL_STYLES'			=> 'Вы уверены что хотите деинсталлировать выбранные стили?',
	'COPYRIGHT'							=> 'Копирайт',

	'DEACTIVATE_DEFAULT'			=> 'Вы не можете сделать неактивным стиль по умолчанию.',
	'DELETE_FROM_FS'				=> 'Удалить с сервера',
	'DELETE_STYLE_FILES_FAILED'		=> 'Ошибка удаления файлов для стиля "%s".',
	'DELETE_STYLE_FILES_SUCCESS'	=> 'Файлы стиля "%s" были удалены.',
	'DETAILS'						=> 'Детали',
	
	'INHERITING_FROM'				=> 'Наследует из',
	'INSTALL_STYLE'					=> 'Установить стиль',
	'INSTALL_STYLES'			=> 'Установить стили',
	'INSTALL_STYLES_EXPLAIN'	=> 'Здесь Вы можете установить новые стили.<br />Если Вы не можете найти необходиый в списке, убедитесь, что стиль установлен. Если стиль не установлен, проверьте корректность загрузки всех необходимых файлов.',
	'INVALID_STYLE_ID'			=> 'Неверный ID стиля.',

	'NO_MATCHING_STYLES_FOUND'	=> 'Нет стиля, соответствующего запросу.',
	'NO_UNINSTALLED_STYLE'		=> 'Деинсталированных стилей не обнаружено.',
	
	'PURGED_CACHE'				=> 'Кеш очищен.',
	
	'REQUIRES_STYLE'			=> 'Данный стиль требует, чтобы был установлен стиль "%s".',

	'STYLE_ACTIVATE'				=> 'Активировать',
	'STYLE_ACTIVE'					=> 'Активирован',
	'STYLE_DEACTIVATE'				=> 'Деактивировать',
	'STYLE_DEFAULT'					=> 'Назначить используемым по умолчанию',
	'STYLE_DEFAULT_CHANGE_INACTIVE'	=> 'Необходимо сначала активировать стиль, после этого Вы сможете назначить его используемым по умолчанию.',
	'STYLE_ERR_INVALID_PARENT'		=> 'Неверный родительский стиль.',
	'STYLE_ERR_NAME_EXIST'			=> 'Стиль с таким именем уже существует.',
	'STYLE_ERR_STYLE_NAME'			=> 'Вы должны задать имя для этого стиля.',
	'STYLE_INSTALLED'				=> 'Стиль "%s" установлен.',
	'STYLE_INSTALLED_RETURN_INSTALLED_STYLES'	=> 'Вернуться к списку установленных стилей.',
	'STYLE_INSTALLED_RETURN_UNINSTALLED_STYLES'	=> 'Установить другие стили.',
	'STYLE_NAME'				=> 'Имя стиля',
	'STYLE_NAME_RESERVED'		=> 'Стиль «%s» не может быть установлен, так как данное имя является зарезервированным.',
	'STYLE_NOT_INSTALLED'		=> 'Стиль "%s" не был установлен.',
	'STYLE_PATH'				=> 'Путь стиля:',
	'STYLE_UNINSTALL'			=> 'Деинсталлировать',
	'STYLE_UNINSTALL_DEPENDENT'	=> 'Стиль "%s" не может быть деинстраллирован так как у них есть один или более дочерних стилей.',
	'STYLE_UNINSTALLED'			=> 'Стиль "%s" деинсталлирован успешно.',
	'STYLE_USED_BY'				=> 'Используют (включая роботов)',

	'UNINSTALL_DEFAULT'			=> 'Вы не можете деинсталлировать стиль по умолчанию.',

));
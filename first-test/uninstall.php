<?php

/**
 * Срабатывает при деинсталяции плагина.
 *
 * При заполнении этого файла учитывается следующий порядок действий контроля:
 *
 * - Этот метод должен быть статическим
 * - Проверьте, действительно ли содержимое $_REQUEST является именем плагина.
 * - Запустите проверку реферера администратора, чтобы убедиться, что он проходит аутентификацию.
 * — Убедитесь, что вывод $_GET имеет смысл.
 * - Повторите действия с другими ролями пользователей. Лучше всего напрямую, используя параметры ссылки/строки запроса.
 * - Повторите действия для мультисайта. Один раз для одного сайта в сети, один раз для всего сайта.
 *
 * Этот файл может быть обновлен в будущей версии шаблона; однако, это
 * общий скелет и описание того, как должен работать файл.
 *
 * Для получения дополнительной информации см. следующее обсуждение:
 * https://github.com/tommcfarlin/WordPress-Plugin-Boilerplate/pull/123#issuecomment-28541913
 *
 * @link       https://sgimancs.blogspot.com/
 * @since      1.0.0
 *
 * @package    First_Test
 */

// Если деинасталяция не вызвана из WordPress, выйти.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

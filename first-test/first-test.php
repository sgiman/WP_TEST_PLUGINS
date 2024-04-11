<?php

/**
 * Файл начальной загрузки плагина
 *
 * Этот файл читается WordPress для создания информации о плагине и в админке.
 * Этот файл также включает в себя все зависимости, используемые плагином.
 * Регистрирует функции активации и деактивации и определяет функцию запускающую плагин.
 *
 * @link              https://sgimancs.blogspot.com/
 * @since             1.0.0
 * @package           First_Test
 *
 * @wordpress-plugin
 * Plugin Name:       FirstTest
 * Plugin URI:        https://www.youtube.com/c/sgimancs/videos
 * Description:       Wordpress FirstTest plugin (structure from wppb.me)
 * Version:           1.0.0
 * Author:            sgiman
 * Author URI:        https://sgimancs.blogspot.com//
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       first-test
 * Domain Path:       /languages
 */

/*=================================================================================
  Writing by sgiman @ 2024
 =================================================================================*/
// Если этот файл вызывается напрямую, прекратить выполнение.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Текущая версия плагина.
 * Начните с версии 1.0.0 и используйте SemVer — https://semver.org.
 * Переименуйте это для своего плагина и обновляйте его по мере выпуска новых версий.
 */
define( 'FIRST_TEST_VERSION', '1.0.0' );
define( 'FIRST_TEST_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'FIRST_TEST_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

/**
 * Код, который запускается во время активации плагина.
 * Это действие описано в файле include/class-first-test-activator.php.*/
/****** SGIMAN ******/
function activate_first_test() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-first-test-activator.php';
	//First_Test_Activator::activate();
    $activator = new First_Test_Activator();
    $activator->activate();
}

/**
 * Код, который запускается при деактивации плагина.
 * Это действие описано в файле include/class-first-test-deactivator.php.
 */
function deactivate_first_test() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-first-test-deactivator.php';
	//First_Test_Deactivator::deactivate();
    $deactivator = new First_Test_Deactivator();
    $deactivator->deactivate();
}

register_activation_hook( __FILE__, 'activate_first_test' );
register_deactivation_hook( __FILE__, 'deactivate_first_test' );

/**
 * Основной класс плагина, который используется для определения интернационализации,
 * хуки, специфичные для администратора, и хуки для общедоступных сайтов.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-first-test.php';

/**
 * Начинает выполнение плагина.
 *
 * Поскольку все в плагине регистрируется с помощью хуков,
 * тогда запуск плагина с этого места в файле
 * и не влияет на жизненный цикл страницы.
 *
 * @since    1.0.0
 */
function run_first_test() {

	$plugin = new First_Test();
	$plugin->run();

}
run_first_test();

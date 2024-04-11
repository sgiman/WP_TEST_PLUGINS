<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://sgimancs.blogspot.com/
 * @since      1.0.0
 *
 * @package    First_Test
 * @subpackage First_Test/includes
 */

/**
 * Основной класс плагина.
 *
 * Используется для определения интернационализации, специфичных для администратора перехватчиков и
 * крючки общедоступных сайтов.
 *
 * Также сохраняется уникальный идентификатор этого плагина, а также текущий
 * версия плагина.
 *
 * @since      1.0.0
 * @package    First_Test
 * @subpackage First_Test/includes
 * @author     sgiman <sgimancs@gmail.com>
 */
/*=================================================================
  Writing by sgiman @ 2024 (common)
==================================================================*/

class First_Test {

	/**
     * Загрузчик, который отвечает за поддержание и регистрацию всех хуков, которые активны.
     * плагин.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      First_Test_Loader    $loader    Поддерживает и регистрирует все хуки плагина
	 */
	protected $loader;

	/**
     * Уникальный идентификатор этого плагина.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    Строка, используемая для уникальной идентификации этого плагина.
	 */
	protected $plugin_name;

	/**
	 * Текущая версия плагина.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    Текущая версия плагина.
	 */
	protected $version;

	/**
     *
     * Определите основные функции плагина.
     *
     * Установить имя и версию плагина, которые можно использовать во всем плагине.
     * Загрузить зависимости, определить локаль и установить перехватчики для области администрирования и
     * общедоступной части сайта.
     *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'FIRST_TEST_VERSION' ) ) {
			$this->version = FIRST_TEST_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'first-test';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
     *
     * Загрузить необходимые зависимости для этого плагина.
     *
     * Включить следующие файлы, составляющие плагин:
     *
     * - First_Test_Loader. Управляет перехватчиками плагина.
     * - First_Test_i18n. Определяет функциональность интернационализации.
     * - First_Test_Admin. Определяет все хуки для административной области.
     * - First_Test_Public. Определяет все хуки для общедоступной части сайта.
     *
     * Создать экземпляр загрузчика, который будет использоваться
     * для регистрации хуков с WordPress.
     *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
         * Класс, отвечающий за организацию действий и фильтров
         * основной плагин.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-first-test-loader.php';

		/**
         * Класс, отвечающий за определение функциональности интернационализации.
         * плагина.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-first-test-i18n.php';

		/**
         * Класс, отвечающий за определение всех действий, происходящих в админке.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-first-test-admin.php';

		/**
         * Класс, ответственный за определение всех действий, происходящих в общедоступной среде.
         * сторона сайта.
         */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-first-test-public.php';

		$this->loader = new First_Test_Loader();

	}

	/**
     * Определите локаль для этого плагина для интернационализации.
     *
     * Использует класс First_Test_i18n для установки домена
     * и регистрации перехватчика с WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new First_Test_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

    /****** SGIMAN ******/

	/**
     * Зарегистрировать все хуки, связанные с функциональностью админки плагина (admin).
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new First_Test_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

        // action hook for admin menu (sgiman)
        $this->loader->add_action( 'admin_menu', $plugin_admin, 'first_test_menu' ); // !!!

	}

	/**
     * Зарегистрировать все хуки, связанные с общедоступной функциональностью плагина (public).
	 *
	 * @since    1.0.0
	 * @access   private
	 */
    private function define_public_hooks() {

		$plugin_public = new First_Test_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

    }

	/**
     * Запустите загрузчик, чтобы выполнить все хуки WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
     * Имя плагина, используемое для его уникальной идентификации в контексте
     * WordPress и определение функций интернационализации.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
     * Ссылка на класс, который управляет перехватчиками с помощью плагина.
	 *
	 * @since     1.0.0
	 * @return    First_Test_Loader    Управляет перехватчиками плагина.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Получить номер версии плагина.
	 *
	 * @since     1.0.0
	 * @return    string    Номер версии плагина.
	 */
	public function get_version() {
		return $this->version;
	}

}

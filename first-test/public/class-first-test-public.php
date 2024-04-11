<?php

/**
 * Публичная функциональность плагина.
 *
 * @link       https://https://sgimancs.blogspot.com/
 * @since      1.0.0
 *
 * @package    First_Test
 * @subpackage First_Test/public
 */

/**
 * Публичная функциональность плагина.
 *
 * Определяет имя и версию плагина, а также два примера хуков, объясняющих, как его использовать.
 * Включить в очередь общедоступную таблицу стилей и JavaScript.
 *
 * @package    First_Test
 * @subpackage First_Test/public
 * @author     sgiman <sgimancs@gmail.com>
 */
class First_Test_Public {

	/**
	 * Идентификатор (ID) этого плагина
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    ID этого плагина
	 */
	private $plugin_name;

	/**
	 * Версия этого плагина.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    Текущая версия этого плагина.
	 */
	private $version;

	/**
	 * Инициализировать класс и установить его свойства.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       Название плагина.
	 * @param      string    $version           Версия этого плагина.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Зарегистрировать таблицы стилей для общедоступной части сайта.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
         * Эта функция предназначена только для демонстрационных целей.
         *
         * Экземпляр этого класса должен быть передан в функцию run().
         * Определено в First_Test_Loader, поскольку определены все перехватчики
         * в этом конкретном классе.
         *
         * First_Test_Loader затем создаст связь
         * между определенными хуками и функциями, определенными в этом классе.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/first-test-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Зарегистрировать JavaScript для общедоступной части сайта.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

        /**
         * Эта функция предназначена только для демонстрационных целей.
         *
         * Экземпляр этого класса должен быть передан в функцию run().
         * определено в First_Test_Loader, поскольку определены все перехватчики
         * в этом конкретном классе.
         *
         * First_Test_Loader затем создаст связь
         * между определенными хуками и функциями, определенными в этом классе.
         */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/first-test-public.js', array( 'jquery' ), $this->version, false );

	}

}

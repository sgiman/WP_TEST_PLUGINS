<?php

/**
 * Определить функциональность интернационализации
 *
 * Загружает и определяет файлы интернационализации для этого плагина.
 * чтобы он был готов к переводу.
 *
 * @link       https://sgimancs.blogspot.com/
 * @since      1.0.0
 *
 * @package    First_Test
 * @subpackage First_Test/includes
 */

/**
 * Определить функциональность интернационализации.
 *
 * Загружает и определяет файлы интернационализации для этого плагина.
 * чтобы он был готов к переводу.
 *
 * @since      1.0.0
 * @package    First_Test
 * @subpackage First_Test/includes
 * @author     sgiman <sgimancs@gmail.com>
 */
class First_Test_i18n {
	/**
     * Загрузить текстовый домен плагина для перевода.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'first-test',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}

}

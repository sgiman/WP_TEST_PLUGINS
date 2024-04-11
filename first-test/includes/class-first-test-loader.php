<?php

/**
 * Зарегистрировать все действия и фильтры для плагина
 *
 * @link       https://sgimancs.blogspot.com/
 * @since      1.0.0
 *
 * @package    First_Test
 * @subpackage First_Test/includes
 */

/**
 * Зарегистрировать все действия и фильтры для плагина.
 *
 * Ведение списка всех хуков, зарегистрированных во всем плагине
 * и зарегистрировать его с помощью WordPress API. Вызвать в
 * функцию запуска для выполнения списка действий и фильтров.
 *
 * @package    First_Test
 * @subpackage First_Test/includes
 * @author     sgiman <sgimancs@gmail.com>
 */
class First_Test_Loader {

	/**
	 * Массив действий, зарегистрированных в WordPress.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $actions    Действия, зарегистрированные в WordPress, которые будут выполняться при загрузке плагина.
	 */
	protected $actions;

	/**
	 * Массив фильтров, зарегистрированных в WordPress.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $filters    Фильтры, зарегистрированные в WordPress, срабатывают при загрузке плагина.
	 */
	protected $filters;

	/**
	 * Инициализиррвать коллекции, используемые для поддержки действий и фильтров.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->actions = array();
		$this->filters = array();

	}

	/**
	 * Добавить новое действие в коллекцию для регистрации в WordPress.
	 *
	 * @since    1.0.0
	 * @param    string               $hook             Имя регистрируемого действия WordPress.
	 * @param    object               $component        Ссылка на экземпляр объекта, для которого определено действие.
	 * @param    string               $callback         Имя определения функции в $component.
	 * @param    int                  $priority         Необязательный. Приоритет, с которым должна быть запущена функция. По умолчанию 10.
	 * @param    int                  $accepted_args    Необязательный. Количество аргументов, которые должны быть переданы в $callback. По умолчанию 1.
	 */
	public function add_action( $hook, $component, $callback, $priority = 10, $accepted_args = 1 ) {
		$this->actions = $this->add( $this->actions, $hook, $component, $callback, $priority, $accepted_args );
	}

	/**
	 * Добавить новый фильтр в коллекцию для регистрации в WordPress.
	 *
	 * @since    1.0.0
	 * @param    string               $hook             Имя регистрируемого фильтра WordPress.
	 * @param    object               $component        Ссылка на экземпляр объекта, для которого определен фильтр.
	 * @param    string               $callback         Имя определения функции в $component.
	 * @param    int                  $priority         Необязательный. Приоритет, с которым должна быть запущена функция. По умолчанию 10.
	 * @param    int                  $accepted_args    Необязательный. Количество аргументов, которые должны быть переданы в $callback. По умолчанию 1.
	 */
	public function add_filter( $hook, $component, $callback, $priority = 10, $accepted_args = 1 ) {
		$this->filters = $this->add( $this->filters, $hook, $component, $callback, $priority, $accepted_args );
	}

	/**
	 *
     * Вспомогательная функция, которая используется для регистрации действий и перехватов в одной коллекции.
     *
	 * @since    1.0.0
	 * @access   private
	 * @param    array                $hooks            Коллекция регистрируемых перехватчиков (то есть действий или фильтров).
	 * @param    string               $hook             Имя регистрируемого фильтра WordPress.
	 * @param    object               $component        Ссылка на экземпляр объекта, для которого определен фильтр.
	 * @param    string               $callback         Имя определения функции в компоненте $component.
	 * @param    int                  $priority         Приоритет, с которым должна быть запущена функция.
	 * @param    int                  $accepted_args    Количество аргументов, которые должны быть переданы в $callback.
	 * @return   array                                  Коллекция действий и фильтров, зарегистрированных в WordPress.
	 */
	private function add( $hooks, $hook, $component, $callback, $priority, $accepted_args ) {

		$hooks[] = array(
			'hook'          => $hook,
			'component'     => $component,
			'callback'      => $callback,
			'priority'      => $priority,
			'accepted_args' => $accepted_args
		);

		return $hooks;

	}

	/**
	 * Зарегистриривать фильтры и действия в WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {

		foreach ( $this->filters as $hook ) {
			add_filter( $hook['hook'], array( $hook['component'], $hook['callback'] ), $hook['priority'], $hook['accepted_args'] );
		}

		foreach ( $this->actions as $hook ) {
			add_action( $hook['hook'], array( $hook['component'], $hook['callback'] ), $hook['priority'], $hook['accepted_args'] );
		}

	}

}

<?php

/**
 * Функциональность плагина, специфичная для администратора.
 *
 * @link       https://sgimancs.blogspot.com/
 * @since      1.0.0
 *
 * @package    First_Test
 * @subpackage First_Test/admin
 */

/**
 * Функциональность плагина, специфичная для администратора.
 *
 * Определяет имя и версию плагина, а также два примера хуков, объясняющих, как его использовать.
 * Включить в очередь таблицу стилей, специфичную для администратора, и JavaScript.
 *
 * @package    First_Test
 * @subpackage First_Test/admin
 * @author     sgiman <sgimancs@gmail.com>
 */
/*=================================================================
  Writing by sgiman @ 2024 (admin)
==================================================================*/
class First_Test_Admin {

	/**
	 * ID этого плагина.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    Идентификатор этого плагина.
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
	 * @since    1.0.0
	 * @param      string    $plugin_name       Название этого плагина.
	 * @param      string    $version           Версия этого плагина.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Зарегистрирровать таблицы стилей для административной области.
	 *
	 * @since    1.0.0
	 */
    /****** SGIMAN ******/
	public function enqueue_styles() {

        $valid_pages = array("first-test", "first_test_option_one", "first_test_option_two");
        $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : "";

        // adding css files is valid pages
        if(in_array($page, $valid_pages))
        {
            // bootstrap.css
            wp_enqueue_style( "sg-bootstrap", FIRST_TEST_PLUGIN_URL .
                'assets/css/bootstrap.min.css', array(), $this->version, 'all' );

            // dataTable.css
            wp_enqueue_style( "sg-datatable", FIRST_TEST_PLUGIN_URL .
                'assets/css/dataTables.min.css', array(), $this->version, 'all' );
        }

		//wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/first-test-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Зарегистрироровать JavaScript для административной области.
	 *
	 * @since    1.0.0
	 */
    /****** SGIMAN ******/
	public function enqueue_scripts() {

        $valid_pages = array("first-test", "first_test_option_one", "first_test_option_two");
        $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : "";

        // adding js files is valid pages
        if(in_array($page, $valid_pages))
        {
            wp_enqueue_script("jquery");

            // bootstrap.js
            wp_enqueue_script( "sg-bootstrap-js", FIRST_TEST_PLUGIN_URL .
                'assets/js/bootstrap.min.js', array( 'jquery' ), $this->version, false );

            // jquery.datatable.js
            wp_enqueue_script( "sg-datatables-js", FIRST_TEST_PLUGIN_URL .
                'assets/js/jquery.dataTables.min.js', array( 'jquery' ), $this->version, false );

            // jquery.validate.js
            wp_enqueue_script( "sg-validate-js", FIRST_TEST_PLUGIN_URL .
                'assets/js/jquery.validate.min.js', array( 'jquery' ), $this->version, false );

            // sweetalert.js
            wp_enqueue_script( "sg-sweetalert-js", FIRST_TEST_PLUGIN_URL .
                'assets/js/sweetalert.min.js', array( 'jquery' ), $this->version, false );

            wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) .
                'js/first-test-admin.js', array( 'jquery' ), $this->version, false );

            wp_localize_script($this->plugin_name, "sg_test", array(
                "name" => "Sgiman Web Test",
                "author" => "Sergey Gasanov",
                "ajaxurl" => admin_url("admin-ajax.php")
            ));
        }

	}

    /****** SGIMAN ******/

    // create menu method
    public function first_test_menu ()
    {
        // create plugin menu
        add_menu_page("Fist Test Tools ", "Fist Test Tools ", "manage_options", "first-test", array($this, "first_test_plugin"),
            'dashicons-admin-site-alt3', 22);

        // create plugin submenu
        // http://localhost/wptest/wp-admin/admin.php?page=first-test
        add_submenu_page("first-test", "Main Options", "Main Options", "manage_options", "first-test", array($this, "first_test_plugin") );
        add_submenu_page("first-test", "Options One", "Options One", "manage_options", "first_test_option_one", array($this, "first_test_option_one") );
        add_submenu_page("first-test", "Options Two", "Options Two", "manage_options", "first_test_option_two", array($this, "first_test_option_two") );

    }

    // menu callback function
    public function first_test_option_one ()
    {
        echo "<h3>Welcome to Plugin Option 1 </h3>";
    }

    public function first_test_option_two ()
    {
        echo "<h3>Welcome to Plugin Option 2</h3>";
    }

    public function first_test_plugin ()
    {
        echo "<h3>Welcome to Plugin Menu</h3>";

        ob_start(); // started buffer

        include_once (FIRST_TEST_PLUGIN_PATH . "admin/partials/tmpl-create-book.php"); // included template file

        $template = ob_get_contents(); // reading content

        ob_end_clean(); // closing and cleaning buffer

        echo $template;


        // --- Data Base ---
        //global $wpdb;

        //$user_email = $wpdb->get_var("SELECT user_email from wp_users WHERE ID=1");
        //echo $user_email;

        /*
        $user_data = $wpdb->get_row(
            "SELECT * from wp_users WHERE ID=1", ARRAY_A
        );
        echo "<pre>";
        print_r($user_data);
        */

        /*
        $post_title = $wpdb->get_col("SELECT post_title from wp_posts");
        echo "<pre>";
        print_r($post_title);
        */

        /*
        $all_posts = $wpdb->get_results("SELECT ID, post_title from wp_posts", ARRAY_A);
        echo "<pre>";
        print_r($all_posts);
        */

        /*
        $post_row = $wpdb->get_row(
            $wpdb->prepare("SELECT * from wp_posts WHERE ID = %d", 1)
        );
        echo "<pre>";
        print_r($post_row);
        */

    }


} /* --- class First_Test_Admin --- */

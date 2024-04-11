<?php

/**
 * Запускается во время деактивации плагина
 *
 * @link       https://sgimancs.blogspot.com/
 * @since      1.0.0
 *
 * @package    First_Test
 * @subpackage First_Test/includes
 */

/**
 * Срабатывает при деактивации плагина.
 *
 * Этот класс определяет весь код, необходимый для запуска во время деактивации плагина.
 *
 * @since      1.0.0
 * @package    First_Test
 * @subpackage First_Test/includes
 * @author     sgiman <sgimancs@gmail.com>
 */
/*======================================================================================
    Writing by sgiman @ 2024
 ======================================================================================*/
class First_Test_Deactivator {

	/**
	 * Краткое описание. (период использования)
	 *
	 * Длинное описание.
	 *
	 * @since    1.0.0
	 */

    /****** SGIMAN ******/
    /*
    private $table_activator;
    public function __construct($activator)
    {
        $this->table_activator = $activator;
    }
    */

	public function deactivate()
    {
        global $wpdb;

        // dropping tables on plugin uninstall

        $full_name_table1 = $wpdb->prefix . "sgiman_tbl_books";
        $wpdb->query("DROP TABLE IF EXISTS " . $full_name_table1);

        $full_name_table2 = $wpdb->prefix . "sgiman_tbl_book_shelf";
        $wpdb->query("DROP TABLE IF EXISTS " . $full_name_table2);

        // delete page ehen plugin unistalls
        $get_data = $wpdb->get_row(
            //$wpdb->prepare("SELECT * from " . $wpdb->prefix . "posts WHERE post_name = %s", 'book_tool')
            $wpdb->prepare("SELECT ID FROM wp_posts WHERE post_name = %s", 'book_tool')
        );

        //echo $wpdb->last_query; die;
        $page_id = $get_data->ID;
        if($page_id > 0) {
            wp_delete_post($page_id, true); // delete post wp function
        }

    }

}

<?php
/*
Plugin Name: ACF Real Estate Objects 
Plugin URI: https://sgimancs.blogspot.com/
Description: Create New Type Posts for Reale Estate Objects with ACF
Version: 1.0
Author: sgiman
Author URI: https://www.youtube.com/c/sgimancs/videos
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PLUGIN_NAME_PLUGIN_NAME', 'acf_realestate' );
define( 'ACF_REALESTATE_VERSION', '1.0.0' );
define( 'ACF_REALESTATE_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'ACF_REALESTATE_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

/**
 * Store plugin base dir, for easier access later from other classes.
 * (eg. Include, pubic or admin)
 */
define( 'PLUGIN_NAME_BASE_DIR', plugin_dir_path( __FILE__ ) );

/********************************************
 * RUN CODE ON PLUGIN UPGRADE AND ADMIN NOTICE
 *
 * @tutorial run_code_on_plugin_upgrade_and_admin_notice.php
 */
define( 'PLUGIN_NAME_BASE_NAME', plugin_basename( __FILE__ ) );
// RUN CODE ON PLUGIN UPGRADE AND ADMIN NOTICE


//*************************************
// All Custom Post Type UI Post Types
//*************************************
function sg_register_custom_posts() {

	/**
	 * Post Type: Real Estate Objects.
	 */

	$labels = [
		"name" => __( "Real Estate Objects", "sg" ),
		"singular_name" => __( "Real Estate Object", "sg" ),
		"menu_name" => __( "REAL ESTATE OBJECTS", "sg" ),
		"all_items" => __( "All Objects", "sg" ),
		"add_new" => __( "Add New", "sg" ),
		"add_new_item" => __( "Add New Object", "sg" ),
		"edit_item" => __( "Edit Object", "sg" ),
		"new_item" => __( "New Object", "sg" ),
		"view_item" => __( "View Object", "sg" ),
		"view_items" => __( "View Element", "sg" ),
		"search_items" => __( "Seacrh Element", "sg" ),
		"not_found" => __( "No Object Found", "sg" ),
		"featured_image" => __( "Image", "sg" ),
		"set_featured_image" => __( "Set Image", "sg" ),
		"remove_featured_image" => __( "Remove Image", "sg" ),
		"name_admin_bar" => __( "Object", "sg" ),
		"item_published" => __( "Object published", "sg" ),
	];

	$args = [
		"label" => __( "Real Estate Objects", "sg" ),
		"labels" => $labels,
		"description" => "Real Estate Objects",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"rest_namespace" => "wp/v2",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"can_export" => false,
		"rewrite" => [ "slug" => "real_estate_objects", "with_front" => true ],
		"query_var" => true,
		"menu_position" => 22,
		"menu_icon" => "dashicons-admin-site",
		"supports" => [ "title", "editor", "thumbnail", "excerpt", "custom-fields", "author", "page-attributes", "post-formats" ],
		"taxonomies" => [ "category", "post_tag", "region" ],
		"show_in_graphql" => false,
	];
	register_post_type( "real_estate_objects", $args );
}
add_action( 'init', 'sg_register_custom_posts' );


//*********************
//  Regions Taxonomy
//*********************
function sg_register_taxes_region() {

	/**
	 * Taxonomy: Regions.
	 */

	$labels = [
		"name" => __( "Regions", "sg" ),
		"singular_name" => __( "Region", "sg" ),
		"menu_name" => __( "Regions", "sg" ),
		"all_items" => __( "All Regions", "sg" ),
		"edit_item" => __( "Edit Region", "sg" ),
		"view_item" => __( "View Region", "sg" ),
		"update_item" => __( "Update View Region", "sg" ),
		"add_new_item" => __( "Add New Region", "sg" ),
		"new_item_name" => __( "New Region Name", "sg" ),
		"search_items" => __( "Search Region", "sg" ),
		"popular_items" => __( "Popular Region", "sg" ),
		"add_or_remove_items" => __( "Add or Remove Region", "sg" ),
		"not_found" => __( "No Region Found", "sg" ),
		"no_terms" => __( "No Region", "sg" ),
		"items_list" => __( "Regions List", "sg" ),
	];

	$args = [
		"label" => __( "Regions", "sg" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => false,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'region', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"show_tagcloud" => false,
		"rest_base" => "region",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"rest_namespace" => "wp/v2",
		"show_in_quick_edit" => false,
		"sort" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "region", [ "real_estate_objects" ], $args );
}
add_action( 'init', 'sg_register_taxes_region' );


//***************************
// ADMIN MENU - REAL ESTATE
//***************************
function Realestate_options_panel()
{
	add_menu_page('REAL ESTATE OPTIONS', 'REAL ESTATE OPTIONS', 'manage_options', 'options-1', 'create_options_one',"", 22);
	add_submenu_page( 'options-1', 'Option 2', 'Option 2', 'manage_options', 'option-2', 'create_options_two');
	add_submenu_page( 'options-1', 'Option 3', 'Option 3', 'manage_options', 'option-3', 'create_options_three');
}
add_action('admin_menu', 'Realestate_options_panel');

function create_options_two()
{
	echo '<div class="wrap"><div id="icon-options-general" class="icon32"><br></div>
        <h2>Welcome to Plugin Option 2</h2></div>';
}

function create_options_three()
{
	echo '<div class="wrap"><div id="icon-options-general" class="icon32"><br></div>
        <h2>Welcome to Plugin Option 3</h2></div>';
}

function create_options_one()
{
    echo '<div class="wrap"><div id="icon-options-general" class="icon32"><br></div>
        <h1>Welcome to Plugin Option 1</h1></div>';
}

//****************************
//  ADMIN-BAR MENU - SGIMAN
//****************************
function create_bar_menu() {

	global $wp_admin_bar;

	$menu_id = 'sgiman';

	$wp_admin_bar->add_menu(array('id' => $menu_id, 'title' => __('SGIMAN'), 'href' => '/'));
	//$wp_admin_bar->add_menu(array('parent' => $menu_id, 'title' => __('Homepage'), 'id' => 'sgiman-home', 'href' => 'index.php', 'meta' => array('target' => '_blank')));
	$wp_admin_bar->add_menu(array('parent' => $menu_id, 'title' => __('Dashboard'), 'id' => 'sgiman-dashboard', 'href' => admin_url('')));
	$wp_admin_bar->add_menu(array('parent' => $menu_id, 'title' => __('Users'), 'id' => 'sgiman-users', 'href' => admin_url('users.php')));
	$wp_admin_bar->add_menu(array('parent' => $menu_id, 'title' => __('Posts'), 'id' => 'sgiman-edit', 'href' => admin_url('edit.php')));
	$wp_admin_bar->add_menu(array('parent' => $menu_id, 'title' => __('Pages'), 'id' => 'sgiman-post', 'href' => admin_url('edit.php?post_type=page')));
	$wp_admin_bar->add_menu(array('parent' => $menu_id, 'title' => __('Plugins'), 'id' => 'sgiman-plugins', 'href' => admin_url('plugins.php')));
	$wp_admin_bar->add_menu(array('parent' => $menu_id, 'title' => __('Widgets'), 'id' => 'sgiman-widgets', 'href' => admin_url('widgets.php')));
	$wp_admin_bar->add_menu(array('parent' => $menu_id, 'title' => __('Menu'), 'id' => 'sgiman-menu', 'href' => admin_url('nav-menus.php')));
	$wp_admin_bar->add_menu(array('parent' => $menu_id, 'title' => __('Themes'), 'id' => 'sgiman-themes', 'href' => admin_url('themes.php')));
	$wp_admin_bar->add_menu(array('parent' => $menu_id, 'title' => __('Settings'), 'id' => 'sgiman-custom', 'href' => admin_url('customize.php')));
}
add_action('admin_bar_menu', 'create_bar_menu', 999);

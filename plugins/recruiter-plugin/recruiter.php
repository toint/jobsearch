<?php
/*
 * Plugin Name: Recruiter Plugin
 * Version: 1.0
 * Description: This is plugin Recruiter
 * Author: ToiNT
 * Author URI: http://luckyit.asia
 * Plugin URI: http://luckyit.asia/wordpress/plugins
 * License: GPLv2
*/

define( 'RECRUITER__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

register_activation_hook(__FILE__, 'recruiter_install');
function recruiter_install()
{
	// do something

}

function load_custom_wp_admin_style($hook) {
	//wp_enqueue_style( 'datatablecss', plugins_url('/assets/css/datatables.css', __FILE__) );
	//echo $hook;
	if ($hook == 'toplevel_page_offer_main_menu') {
	    wp_enqueue_script( 'all-offer-page-js', plugin_dir_url( __FILE__ ) . '/assets/js/all-offer-page.js' , array(), '1.0', true );
	}
	if ($hook == 'all-offers_page_offer_page' || $hook == 'tat-ca-cong-viec_page_offer_page') {
		wp_enqueue_script( 'map-js', plugin_dir_url( __FILE__ ) . '/assets/js/map.js' , array(), '1.0', true );
		wp_enqueue_script( 'offer-page-js', plugin_dir_url( __FILE__ ) . '/assets/js/offer-page.js' , array(), '1.0', true );
	}
	if ($hook == 'toplevel_page_company_main_menu') {
		wp_enqueue_script( 'company-js', plugin_dir_url( __FILE__ ) . '/assets/js/company.js' , array(), '1.0', true );
	}
	if ($hook == 'toplevel_page_post_main_menu') {
	    wp_enqueue_script( 'post-js', plugin_dir_url( __FILE__ ) . '/assets/js/post.js' , array(), '1.0', true );
	    wp_localize_script( 'ajax-script', 'post_var', array( 'url' => 'recruiter_post_page' ));
	}
	if ($hook == 'all-post_page_recruiter_post_page' || $hook == 'tin-nhanh_page_recruiter_post_page') {
	    wp_enqueue_script( 'map-js', plugin_dir_url( __FILE__ ) . '/assets/js/map.js' , array(), '1.0', true );
	    wp_enqueue_script( 'new-post-js', plugin_dir_url( __FILE__ ) . '/assets/js/new-post.js' , array(), '1.0', true );
	}
	

	wp_enqueue_script( 'recruiter-js', plugin_dir_url( __FILE__ ) . '/assets/js/recruiters.js' , array(), '1.0', true );
	wp_localize_script( 'ajax-script', 'admin_url', array( 'url' => admin_url( 'admin.php' ), 'nonce' => wp_create_nonce('ajaxnonce') )); // setting ajaxurl
}
add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_style' );

function recruiter_create_menu()
{
    add_menu_page(__('All Post'), __('All Post'), 'recruiter', 'post_main_menu', 'all_post_page', plugins_url('/images/post.png', __FILE__));
    add_submenu_page('post_main_menu', __('Post Now'), __('Post Now'), 'recruiter', 'recruiter_post_page', 'new_post_page');
    
	add_menu_page(__('All Offers'), __('All Offers'), 'recruiter', 'offer_main_menu', 'list_offer_page', plugins_url('/images/job.png', __FILE__));
	
	add_submenu_page('offer_main_menu', __('New Offer'), __('New Offer'), 'recruiter', 'offer_page', 'new_offer_page');

	add_menu_page(__('Company'), __('Company'), 'recruiter', 'company_main_menu', 'update_company_plugin_page', plugins_url('/images/company.png', __FILE__));
	
}
add_action('admin_menu', 'recruiter_create_menu');

function format_date($str) {
	$d = date_create_from_format('m/d/Y', $str);
	return date_format($d, 'Y-m-d');
}

function date_to_MDY($date) {
    $d = date_create_from_format('Y-m-d', $date);
    $str_d = date_format($d, 'm/d/Y');
    return $str_d;
}


//require_once( RECRUITER__PLUGIN_DIR . 'class.data-table.php' );
require_once( RECRUITER__PLUGIN_DIR . 'functions.php' );
require_once( RECRUITER__PLUGIN_DIR . 'class.offer.php' );
require_once( RECRUITER__PLUGIN_DIR . 'class.hours-per-week.php' );
require_once( RECRUITER__PLUGIN_DIR . 'class.company-type.php' );
require_once( RECRUITER__PLUGIN_DIR . 'class.business-type.php' );
require_once( RECRUITER__PLUGIN_DIR . 'class.company.php' );
require_once( RECRUITER__PLUGIN_DIR . 'class.contract-duration.php' );
require_once( RECRUITER__PLUGIN_DIR . 'company-page.php' );
require_once( RECRUITER__PLUGIN_DIR . 'offer-page.php' );
require_once( RECRUITER__PLUGIN_DIR . 'new-offer-page.php' );
require_once( RECRUITER__PLUGIN_DIR . 'all-post-page.php' );
require_once( RECRUITER__PLUGIN_DIR . 'new-post-page.php' );
require_once( RECRUITER__PLUGIN_DIR . 'class.post.php' );


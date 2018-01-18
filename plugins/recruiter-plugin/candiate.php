<?php
/*
 * Plugin Name: Candidate Plugin
 * Version: 1.0
 * Description: This is plugin Candidate
 * Author: ToiNT
 * Author URI: http://luckyit.asia
 * Plugin URI: http://luckyit.asia/wordpress/plugins
 * License: GPLv2
 */

define( 'CANDIDATE__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

register_activation_hook(__FILE__, 'candidate_install');
function candidate_install()
{
    // do something
    
}


function load_candidate_wp_admin_style($hook) {
    //echo $hook;
    if ($hook == 'toplevel_page_candidate_post_menu') {
        wp_enqueue_script( 'post-js', plugin_dir_url( __FILE__ ) . '/assets/js/post.js' , array(), '1.0', true );
        wp_localize_script( 'ajax-script', 'post_var', array( 'url' => 'candiate_post_page' ));
    }
    if ($hook == 'all-post_page_candiate_post_page') {
        wp_enqueue_script( 'map-js', plugin_dir_url( __FILE__ ) . '/assets/js/map.js' , array(), '1.0', true );
        wp_enqueue_script( 'new-post-js', plugin_dir_url( __FILE__ ) . '/assets/js/new-post.js' , array(), '1.0', true );
    }
    
    
}
add_action( 'admin_enqueue_scripts', 'load_candidate_wp_admin_style' );

function candidate_create_menu()
{
    add_menu_page(__('All Post'), __('All Post'), 'candidate', 'candidate_post_menu', 'all_post_page', plugins_url('/images/post.png', __FILE__));
    add_submenu_page('candidate_post_menu', __('Post Now'), __('Post Now'), 'candidate', 'candiate_post_page', 'new_post_page');
}
add_action('admin_menu', 'candidate_create_menu');

require_once( CANDIDATE__PLUGIN_DIR . 'functions.php' );
require_once( CANDIDATE__PLUGIN_DIR . 'all-post-page.php' );
require_once( CANDIDATE__PLUGIN_DIR . 'new-post-page.php' );
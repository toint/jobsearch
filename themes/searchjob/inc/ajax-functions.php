<?php

function action_search_driving_license() {
    global $wpdb;
    
    die(json_encode(array(0 => array('id' => 1, 'value' => 'ToiNT'))));
}
add_action('wp_ajax_action_search_driving_license', 'action_search_driving_license');


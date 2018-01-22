<?php
class Level {
    
    function get_levels() {
        global $wpdb;

        $sql = "select * from ". $wpdb->prefix ."level where delete_flag = '0' ";
        $results = $wpdb->get_results($sql);
        return $results;
    }
}
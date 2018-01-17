<?php
class Post {
    
    function insert($offer_data, $post_data) {
        global $wpdb;
        
        $post_id = wp_insert_post($post_data);
        $offer_data['post_id'] = $post_id;
        
        $new_offer = $wpdb->insert($wpdb->prefix . 'new_offer', $offer_data);
        if ($new_offer == FALSE) {
        	die();
        	return '';
        }
        
        $offer_id = $wpdb->insert_id;
        
        return $offer_id;
    }
    
}
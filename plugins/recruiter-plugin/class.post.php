<?php
class Post {
    
    function insert($offer_data, $post_data) {
        global $wpdb;
        
        $post_id = wp_insert_post($post_data);
        $offer_data['post_id'] = $post_id;

        $new_offer = $wpdb->insert($wpdb->prefix . 'new_offer', $offer_data);
        if ($new_offer == FALSE) {
        	return FALSE;
        }
        
        $offer_id = $wpdb->insert_id;
        
        return $offer_id;
    }
    
    function update($offer_data, $post_data, $id) {
        global $wpdb;
        wp_update_post($post_data);
        
        $status = $wpdb->update($wpdb->prefix . 'new_offer', $offer_data, array('id' => $id));
    }
    
    function search($param) {
        global $wpdb;
        $user = wp_get_current_user();
        
        $sql = "SELECT a.id, b.post_title as title, a.place_code, a.place_text, a.posted_date, case when a.status = 0 then 'Bản nháp' else 'Đang mở' end as status_name, a.salary, a.post_id, b.post_content ";
        $sql .= " FROM " . $wpdb->prefix . "new_offer a ";
        $sql .= " JOIN " . $wpdb->prefix . "posts b on a.post_id = b.id ";
        $sql .= " WHERE a.type = 1 and a.user_id = " . $user->ID;
        
        if (isset($param['id']) && !empty($param['id'])) {
            $sql .= " and a.id = " . $param['id'];
        }
        
        $results = $wpdb->get_results($sql);
        
        return $results;
    }
    
}
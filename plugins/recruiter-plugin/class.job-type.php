<?php
class Job_Type {
    
    function find_by_name($name) {
        global $wpdb;
        
        $sql = "select * from " . $wpdb->prefix . "job_type where 1 = 1 ";
        if (!empty($name)) {
            $sql .= " and lower(name) like '%" . $name ."%'";
        }
        $results = $wpdb->get_results($sql);
        return $results;
    }
    
}
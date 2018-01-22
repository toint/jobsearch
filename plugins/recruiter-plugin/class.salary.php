<?php
class Salary {
    
    function find_by_salary($salary) {
        global $wpdb;
        
        $sql = "select * from " . $wpdb->prefix ."salary where 1 = 1 ";
        if (!empty($salary)) {
            $sql .= " and lower(salary) like '%" . strtolower($salary) . "%'";
        }
        $results = $wpdb->get_results($sql);
        
        return $results;
    }
    
}
<?php 
class User_Profile {
	
	function insert($data) {
		global $wpdb;
		
		$profile = $data['profile'];
		$profile_meta = $data['profile_meta'];
		
		$wpdb->insert($wpdb->prefix .'user_profile', $profile);
		
		$profile_id = $wpdb->insert_id;
		for ($i = 0; $i < count($profile_meta); $i++) {
			$meta = $profile_meta[$i];
			$meta['profile_id'] = $profile_id;
			$wpdb->insert($wpdb->prefix .'profile_meta', $meta);
		}
		
	}
	
	function get_profile() {
		global $wpdb;
		$user_id = get_current_user_id();
		$sql = "select * from " . $wpdb->prefix . 'user_profile a where a.user_id = ' . $user_id;
		
		$result = $wpdb->get_results($sql);
		return $result;
	}
	
	function get_profile_meta() {
		global $wpdb;
		
		$sql = 'select a.* from ' . $wpdb->prefix . 'profile_meta a ';
		$sql .= ' join ' . $wpdb->prefix . 'user_profile b on a.profile_id = b.id and b.user_id = ' . get_current_user_id();
		
		$result = $wpdb->get_results($sql);
		return $result;
	}
	
}
?>
<?php
if ( ! function_exists( 'wp_handle_upload' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/file.php' );
}


function create_message($msg) {
    return '<div class="alert alert-danger" role="alert">' . $msg . '</div>';
}



function get_offer_meta($name, $code) {
    global $wpdb;
    
    $sql = "select * from " . $wpdb->prefix ."offer_meta where code = '". $code ."' ";
    if (!empty($salary)) {
        $sql .= " and lower(name) like '%" . strtolower($salary) . "%'";
    }
    $results = $wpdb->get_results($sql);
    
    return $results;
    
} 

function autocomplete_company_type() {
    $business = new Business_Type();
    $data = array();
    if (isset($_POST['name'])) {
        $results = $business->find_by_name($_POST['name']);
        if (!empty($results)) {
            foreach($results as $item) {
                array_push($data, array('id' => $item->id, 'value' => $item->name));
            }
        }
    }

	die(json_encode($data));
}
//add_action('wp_ajax_nopriv_autocomplete_industry', 'autocomplete_industry');
add_action('wp_ajax_autocomplete_company_type', 'autocomplete_company_type');

function autocomplete_salary() {
    $data = array();
    if (isset($_POST['name'])) {
        $results = get_offer_meta($_POST['name'], 'SALARY');
        if (!empty($results)) {
            foreach ($results as $item) {
                array_push($data, array('id' => $item->name, 'value' => $item->name));
            }
        }
    }
    die(json_encode($data));
}
add_action('wp_ajax_autocomplete_salary', 'autocomplete_salary');

function autocomplete_job_type() {
    $data = array();
    if (isset($_POST['name'])) {
        $result = get_offer_meta($_POST['name'], 'JOB_TYPE');
        if (!empty($result)) {
            foreach ($result as $item) {
                array_push($data, array('id' => $item->name, 'value' => $item->name));
            }
        }
    }
    die(json_encode($data));
}
add_action('wp_ajax_autocomplete_job_type', 'autocomplete_job_type');

function autocomplete_occupation() {
    $data = array();
    if (isset($_POST['name'])) {
        $result = get_offer_meta($_POST['name'], 'OCCUPATION');
        if (!empty($result)) {
            foreach ($result as $item) {
                array_push($data, array('id' => $item->name, 'value' => $item->name));
            }
        }
    }
    die(json_encode($data));
}
add_action('wp_ajax_autocomplete_occupation', 'autocomplete_occupation');

function autocomplete_driving_licesine() {
    $data = array();
    if (isset($_POST['name'])) {
        $result = get_offer_meta($_POST['name'], 'DRIVING_LICENSE');
        if (!empty($result)) {
            foreach ($result as $item) {
                array_push($data, array('id' => $item->name, 'value' => $item->name));
            }
        }
    }
    die(json_encode($data));
}
add_action('wp_ajax_autocomplete_driving_licesine', 'autocomplete_driving_licesine');

function autocomplete_level() {
    $data = array();
    if (isset($_POST['name'])) {
        $result = get_offer_meta($_POST['name'], 'LEVEL');
        if (!empty($result)) {
            foreach ($result as $item) {
                array_push($data, array('id' => $item->name, 'value' => $item->name));
            }
        }
    }
    die(json_encode($data));
}
add_action('wp_ajax_autocomplete_level', 'autocomplete_level');

function autocomplete_job_activity() {
    $data = array();
    if (isset($_POST['name'])) {
        $result = get_offer_meta($_POST['name'], 'JOB_ACTIVITY');
        if (!empty($result)) {
            foreach ($result as $item) {
                array_push($data, array('id' => $item->id, 'value' => $item->name));
            }
        }
    }
    die(json_encode($data));
}
add_action('wp_ajax_autocomplete_job_activity', 'autocomplete_job_activity');


function autocomplete_it_skill() {
    $data = array();
    if (isset($_POST['name'])) {
        $result = get_offer_meta($_POST['name'], 'IT_SKILL');
        if (!empty($result)) {
            foreach ($result as $item) {
                array_push($data, array('id' => $item->id, 'value' => $item->name));
            }
        }
    }
    die(json_encode($data));
}
add_action('wp_ajax_autocomplete_it_skill', 'autocomplete_it_skill');


function autocomplete_language() {
    $data = array();
    if (isset($_POST['name'])) {
        $result = get_offer_meta($_POST['name'], 'LANGUAGE');
        if (!empty($result)) {
            foreach ($result as $item) {
                array_push($data, array('id' => $item->id, 'value' => $item->name));
            }
        }
    }
    die(json_encode($data));
}
add_action('wp_ajax_autocomplete_language', 'autocomplete_language');

function autocomplete_human_skill() {
    $data = array();
    if (isset($_POST['name'])) {
        $result = get_offer_meta($_POST['name'], 'HUMAN_SKILL');
        if (!empty($result)) {
            foreach ($result as $item) {
                array_push($data, array('id' => $item->id, 'value' => $item->name));
            }
        }
    }
    die(json_encode($data));
}
add_action('wp_ajax_autocomplete_human_skill', 'autocomplete_human_skill');

function action_load_all_offer() {
    $data = array();
    
    $offer = new Offer();
    $data = $offer->search(array());
    
    die(json_encode($data));
}
add_action('wp_ajax_action_load_all_offer', 'action_load_all_offer');

function action_load_all_post() {
    $data = array();
    $post = new Post();
    
    $data = $post->search(array());
    die(json_encode($data));
}
add_action('wp_ajax_action_load_all_post', 'action_load_all_post');


function upload_avatar() {
    $file = $_FILES['pic'];
    $upload_overrides = array( 'test_form' => false );
    
    $movefile = wp_handle_upload( $file, $upload_overrides );
    
    if ( $movefile && ! isset( $movefile['error'] ) ) {
        echo $movefile['url'];
    } else {
        echo 0;
    }
    die();
}
add_action('wp_ajax_upload_avatar', 'upload_avatar');

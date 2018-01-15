<?php
function the_detail_post($args) {
    global $wpdb;
    $sql = "select b.name com_name, b.address from " . $wpdb->prefix . "new_offer a ";
    $sql .= " lef join " .$wpdb->prefix . "company b on a.user_id = b.user_id ";
    $sql .= " where a.post_id = " . get_the_ID();
    
    $query = $wpdb->get_results($sql);
    $offer = null;
    if (!empty($query)) { 
    	$offer = $query[0]; 
    }
?>

<div class="row">
	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
		<div class="thumbnail">
			<img src="<?php echo get_template_directory_uri() . '/assets/images/no-img.png' ?>" />
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
		<h1><?php the_title(); ?></h1>
		<h3><?php echo $offer->com_name;?> : <?php echo $offer->address;?></h3>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
		<button type="button"><?php echo __('Apply');?></button>
	</div>
</div> 


<?php     
}

add_filter('the_detail_post', 'the_detail_post');
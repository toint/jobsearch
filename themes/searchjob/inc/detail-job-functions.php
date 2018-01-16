<?php
function the_detail_post($args) {
    global $wpdb;
    $sql = "SELECT a.id as offer_id, b.name com_name, a.place_text from " . $wpdb->prefix . "new_offer a ";
    $sql .= " LEFT JOIN " .$wpdb->prefix . "company b on a.user_id = b.user_id ";
    $sql .= " WHERE a.post_id = " . get_the_ID();
    
    $query = $wpdb->get_results($sql);
    $offer = null;
    
    if (!empty($query)) { 
    	$offer = $query[0]; 
    	$sql = "SELECT a.name, a.code FROM " . $wpdb->prefix . "offer_meta a ";
    	$sql .= " JOIN " . $wpdb->prefix . "new_offer_meta b on a.id = b.meta_id and b.offer_id = " . $wpdb->offer_id;
    	$offer_metas = $wpdb->get_results($sql);
?>
<div class="page-view-background"></div>
<div class="page-detail">
    <div class="page-detail-title">
    	<div class="page-title-container container">
            <div class="row">
            	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            		<div class="thumbnail col-md-12">
            			<img src="<?php echo get_template_directory_uri() . '/assets/images/no-img.png' ?>" />
            		</div>
            	</div>
            	<div class="view-title col-lg-8 col-md-8 col-sm-8 col-xs-8">
            		<h3><?php the_title(); ?></h3>
            		<h5><?php echo $offer->com_name;?> - <?php echo $offer->place_text;?></h5>
            	</div>
            	<div class="view-btn col-lg-2 col-md-2 col-sm-2 col-xs-2">
            		<button type="button" class="btn btn-warning btn-lg"><?php echo __('Apply Now');?></button>
            	</div>
            </div>
        </div> 
    </div>
    <br/>
    <div class="page-detail-content">
    	<div class="container">
        	 <ul class="nav nav-tabs" role="tablist">
        	 	<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><?php echo __('JOB INFO');?></a></li>
        	 	<li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"><?php echo __('COMPANY INFO');?></a></li>
        	 </ul>
        	 <div class="tab-content">
        	 	<div role="tabpanel" class="tab-pane active" id="home">
        	 		<h3><?php echo __('JOB DESCRIPTION');?></h3>
        	 		<?php 
        	 		if (!empty($offer_metas)) {
        	 		    foreach ($offer_metas as $meta) {
        	 		        if ($meta->code == 'JOB_ACTIVITY')
        	 		 ?>
        	 		<div><?php echo $meta->name;?></div>
        	 		<?php 
        	 		    }
        	 		}?>
        	 	</div>
        	 	<div role="tabpanel" class="tab-pane" id="profile">...</div>
        	 </div>
    	</div>
    </div>
</div>
<?php     
} }

add_filter('the_detail_post', 'the_detail_post');
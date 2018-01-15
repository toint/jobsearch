<?php
function the_detail_post($args) {
    global $wpdb;
    
?>

<div class="row">
	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
		
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
		<?php the_title();?>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
	
	</div>
</div> 


<?php     
}

add_filter('the_detail_post', 'the_detail_post');
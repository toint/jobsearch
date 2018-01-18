<?php
function the_list_post_now($args) {
    global $wpdb;
    $sql = "SELECT a.id, b.post_title as title, a.post_id, b.post_content ";
    $sql .= " FROM " . $wpdb->prefix . "new_offer a ";
    $sql .= " JOIN " . $wpdb->prefix . "posts b on a.post_id = b.id ";
    $sql .= " WHERE a.type = 1 and a.status = 1 order by posted_date desc ";
    $sql .= " LIMIT 0, 10 ";
    
    $list_post = $wpdb->get_results($sql);
?>
    <div class="panel-post">
    	<div class="panel-post-heading">
    		<?php echo __('NEWS NOW');?>
    	</div>
    	<div class="panel-post-body">
    		<div class="container">
    			<?php 
    			if (!empty($list_post)) {
    			    foreach ($list_post as $item) {
    			?>
    			<div class="row row-post" >
    				<div class="col-md-12">
    					<a href="<?php echo get_permalink($item->post_id);?>">
    						<i class="glyphicon glyphicon-flag"></i> <?php echo $item->title; ?>
						</a>
    				</div>
    			</div>
    			 <?php 
    			 }
    			}
    			?>
			</div>
    	</div>
    	<div class="panel-post-footer">
    	
    	</div>
    </div>
<?php 
    
}

add_filter('the_list_post_now', 'the_list_post_now');
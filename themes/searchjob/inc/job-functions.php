<?php
function the_post_offer($args) {
    global $wpdb;
    
    $sql = "SELECT a.post_id, d.post_title title, a.place_text, a.posted_date, a.salary, c.name as com_name ";
    $sql .= " FROM " . $wpdb->prefix . "new_offer a ";
    $sql .= " JOIN " . $wpdb->prefix . "company c on c.user_id = a.user_id ";
    $sql .= " JOIN " . $wpdb->prefix . "posts d on a.post_id = d.id ";
    $sql .= " WHERE a.status = 1 and a.type = 0 order by a.posted_date desc ";
    $sql .= " LIMIT " . $args[0] . ", " . $args[1];
    
    $offers = $wpdb->get_results($sql);
    $current_row = $wpdb->num_rows;
    
    
    $sql = "SELECT COUNT(*) as total ";
    $sql .= " FROM " . $wpdb->prefix . "new_offer a ";
    $sql .= " JOIN " . $wpdb->prefix . "company c on c.user_id = a.user_id ";
    $sql .= " WHERE a.status = 1 and a.type = 0 order by a.posted_date desc ";
    
    $count = $wpdb->get_results($sql);
    $rownum = 0;
    if ($wpdb->num_rows > 0) {
        $rownum = $count[0]->total;
    }
    
    $row_total = ceil($rownum/50);
?>
<?php 
    if (!empty($offers)) {
        foreach ($offers as $offer) {
?>
<div class="row list-job-posted">
	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 post-logo">
		<div class="com-logo">
			<a href="#" class="thumbnail">
    			<img class="media-object" src="<?php echo get_template_directory_uri() . '/assets/images/no-img.png' ?>">
			</a>
		</div>
	</div>
	<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 post-content">
		<div class="post-content">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<a href="<?php echo get_permalink($offer->post_id);?>"><?php echo $offer->title;?></a>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<?php echo $offer->com_name;?>
				</div>
			</div>
			<div class="row">
    			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
    				<?php echo __('Salary:') . ' <b class="orange">' . $offer->salary . '</b>';?>
    			</div>
    			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
    				<?php echo __('Location:') . ' <b>' . $offer->place_text. '</b>';?>
    			</div>
    			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
    				<?php echo __('Posted:') . ' <b>' . $offer->posted_date . '</b>';?>
    			</div>
			</div>
		</div>
	</div>
</div>



<?php
    }
    ?>

<?php if ($row_total > 0) {?>
<div class="row">
    <div class="col-sm-12">
        <nav aria-label="Page navigation">
        	<ul class="pager">
        		<li>
              		<a href="#" aria-label="Previous">
                    	<span aria-hidden="true">&laquo;</span>
              		</a>
            	</li>
            	<?php 
            	for($i = 1; $i <= $row_total; $i++) {
            	?>
            	<li><a href="page=<?php echo $i;?>"><?php echo $i;?></a></li>
            	<?php 
            	}
            	?>
            	<li>
                  	<a href="#" aria-label="Next">
                    	<span aria-hidden="true">&raquo;</span>
                  	</a>
                </li>
        	</ul>
        </nav>
    </div>
</div>
<?php } ?>
    
<?php
    
    }
}

add_filter('the_post_offer', 'the_post_offer');
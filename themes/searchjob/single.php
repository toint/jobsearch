<?php

get_header(); 

?>

<div class="page-view">
	<div class="page-view-title">
		<?php while ( have_posts() ) : the_post();?>
		<?php echo apply_filters('the_detail_post', array('id' => get_the_ID()));?>
		<?php endwhile; ?>
	</div>
</div>    

<?php get_footer();
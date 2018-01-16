<?php

get_header(); 

?>

<div class="page-view">
	<?php while ( have_posts() ) : the_post();?>
	<?php echo apply_filters('the_detail_post', array('id' => get_the_ID()));?>
	<?php endwhile; ?>
</div>    

<?php get_footer();
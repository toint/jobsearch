<?php
/**
 * The front page template file
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>
<div class="page-container container">
	<?php echo get_template_part('template-parts/content', 'search'); ?>
    <div class="page-content">
    	<div class="row">
    		<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
    			<?php echo get_template_part('template-parts/content', 'list-job'); ?>
    		</div>
    		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
    			
    		</div>
    	</div>
    </div>	
    
    
    
    

<?php get_footer();
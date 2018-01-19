<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
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
    		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    			<?php echo get_template_part('template-parts/content', 'search-list-job'); ?>
    		</div>
    	</div>
    </div>

<?php get_footer();

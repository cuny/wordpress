<?php get_header(); ?>
	<div id="wrap-content">
		<?php if (have_posts()): the_post(); ?>
			<?php include_once('includes/breadcrumbs.php') ?>
			<?php the_content(); ?>
		<?php endif; ?>
	</div><!-- #wrap-content -->
<?php get_footer(); ?>
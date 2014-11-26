<?php get_header(); ?>
	<div id="wrap-content"role="main">
		<?php include_once('includes/breadcrumbs.php'); ?>
		
		<section class="wpb_row vc_row-fluid">
			<div class="vc_col-sm-12 wpb_column column_container">
				<div class="wpb_wrapper">
					<h1 class="section-title"><a href="<?php $parent_home = get_bloginfo( 'description' ); echo !empty($parent_home)?$parent_home:home_url(); ?>"><?php bloginfo( 'name' ); ?></a></h1>
				</div> 
			</div> 
		</section><!-- .wpb_row.vc_row-fluid -->

		<section class="wpb_row vc_row-fluid">
			<div class="vc_col-sm-3 sidebar wpb_column column_container">
				<ul class="wpb_wrapper">
					<?php dynamic_sidebar( 'Left Sidebar' ); ?>
				</ul>
			</div><!-- .vc_col-sm-3.sidebar.wpb_column.column_container -->

			<div class="vc_col-sm-6 wpb_column column_container">
				<div class="wpb_wrapper wpb_teaser_grid">
					<?php if (have_posts()): while (have_posts()): the_post(); ?>

						<?php if (is_single()): ?>
						<h2 class="post-title"><?php the_title() ?></h2>
						<?php else: ?>
						<h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h2>
						<?php endif; ?>

						<h3 class="post-date"><?php the_time( 'F d, Y' ); ?></h3>
						
						<div class="entry-content"><?php the_content( ' Read More &raquo; '); ?></div>
					<?php endwhile; else: ?>
						<p>Sorry, but there was no match to the Search words.</p>
					<?php endif; ?>
				</div>
			</div><!-- .vc_col-sm-7.wpb_column.column_container -->

			<div class="vc_col-sm-3 sidebar wpb_column column_container" role="complementary">
				<ul class="wpb_wrapper">
					<?php dynamic_sidebar( 'Right Sidebar' ); ?>
				</ul>
			</div><!-- .vc_col-sm-2.sidebar.wpb_column.column_container -->
		</section>
	</div><!-- #wrap-content -->
<?php get_footer(); ?>

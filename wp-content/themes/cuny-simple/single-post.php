<?php get_header(); ?>

<div class="wpb_row vc_row-fluid">
	<!-- Left Area -->
	<div class="vc_col-sm-3 wpb_column column_container">
		<?php
		if(is_active_sidebar('left-sidebar')){
		dynamic_sidebar('left-sidebar');
		}
		?>
	</div>

	<!-- Middle Area -->
	
		<div class="vc_col-sm-6 wpb_column column_container">
			<div class="wpb_wrapper">
					<?php while ( have_posts() ) : the_post(); ?>
						
						<span class="date"><?php the_time('F j, Y') ?> | <?php the_category(', ') ?></span>
						<p><?php the_content(); ?></p>
					<?php endwhile; ?>
			</div>
		</div>	
	
	<!-- Right Area -->
	<div class="vc_col-sm-3 wpb_column column_container">
		<?php
		if(is_active_sidebar('right-sidebar')){
		dynamic_sidebar('right-sidebar');
		}
		?>
	</div>
</div>

		
<?php get_footer(); ?>
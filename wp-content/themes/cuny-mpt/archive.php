<?php get_header(); ?>

<div class="wpb_row vc_row-fluid">
	<!-- Left Sidebar -->
	<div class="vc_col-sm-3 wpb_column column_container">
		<div class="wpb_wrapper">
			<?php
			if(is_active_sidebar('left-sidebar')){
			dynamic_sidebar('left-sidebar');
			}
			?>
		</div>
	</div>

	<!-- Main Content/Posts -->
	
		<div class="vc_col-sm-6 wpb_column column_container post">
			<div class="wpb_wrapper">
				<ul class="post-list-container">
					
					<?php while ( have_posts() ) : the_post(); ?>
						<li>
						<h3 class="post-title"><a href="<?php the_permalink();?>"> <?php the_title(); ?></a></h3>
						<span class="date"><?php the_time('F j, Y') ?> | <?php the_category(', ') ?></span>
						<div class="entry-content">
							<?php the_excerpt(); ?>
							<?php endwhile; ?>
						</div>
						</li>
				</ul>
			</div>
		</div>	
	
	<!-- Right Sidebar -->
	<div class="vc_col-sm-3 wpb_column column_container">
		<div class="wpb_wrapper">
			<?php
			if(is_active_sidebar('right-sidebar')){
			dynamic_sidebar('right-sidebar');
			}
			?>
		</div>
	</div>
</div>

		
<?php get_footer(); ?>
</section><!--Main Content Ends -->
	<footer>
			<!--Top Footer Links -->
			<?php if ( has_nav_menu( 'footertoplinks' ) ): ?>
			<div class="footer-top-links container">
				<nav class="vc_row-fluid">
	                		<?php
						        $footerlinks = wp_nav_menu( array('theme_location' => 'footertoplinks',
						        'container' => false, // this is usually a div outside the menu ul, we don't need it
						        'items_wrap' => '<ul id="%1$s" class="footer-links">%3$s</ul>', // replacing the ul with nav     
						    ) );	
							?>	
				</nav>
			</div>
			<?php endif; ?>
			
			<?php if (is_active_sidebar( 'footer-sidebar-1' ) ): ?>
			<!-- BEGIN: Footer Area 1 -->
			<section id="footer-sidebar-widgets-1" class="footer-wrapper">
				<div class="container">
					<?php dynamic_sidebar( 'footer-sidebar-1' ); ?>
				</div>
			</section>
			<!-- END: Footer Area 1 -->
			<?php endif; ?>

			<!-- BEGIN: Footer Area 2 -->
			<?php if (is_active_sidebar( 'footer-sidebar-2' ) ): ?>
			<section id="footer-sidebar-widgets-2" class="footer-wrapper">
				<div class="container">
					<?php dynamic_sidebar('footer-sidebar-2'); ?>
				</div>
			</section>
			<!-- END: Footer Area 2 -->
			<?php endif; ?>

			<?php if (is_active_sidebar( 'footer-sidebar-3' ) ): ?>
			<!-- BEGIN: Footer Area 3 -->
			<section id="footer-sidebar-widgets-3" class="footer-wrapper">
				<div class="container">
					<?php dynamic_sidebar('footer-sidebar-3'); ?>
				</div>
			</section>
			<!-- BEGIN: Footer Area 3 -->
			<?php endif; ?>

	</footer>		
	</div>
	<?php wp_footer(); ?>
	<?php 
		$cuny_mpt_theme_settings = get_option( 'cuny_mpt_settings' );
		if (!empty( $cuny_mpt_theme_settings['google_analytics'] ) ) {
			echo $cuny_mpt_theme_settings['google_analytics']; 
		}
	?>
</body>
</html>
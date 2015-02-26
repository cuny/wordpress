
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
			
			<!--Footer Widgets Area -->
			<div class="footer-wrapper">
				<div id="footer-sidebar-widgets" class="container">
					<div class="vc_row-fluid">
						<div class="vc_col-sm-12 wpb_column">
							<div id="footer-sidebar">
								<?php
								if(is_active_sidebar('footer-sidebar')){
								dynamic_sidebar('footer-sidebar');
								}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--Bottom Footer Links -->
			<?php if (has_nav_menu( 'footerbottomlinks' )): ?>
			<div class="footer-bottom-links container">
				<nav class="vc_row-fluid">
                		<?php
					        $footerlinks = wp_nav_menu( array('theme_location' => 'footerbottomlinks',
					        'container' => false, // this is usually a div outside the menu ul, we don't need it
					        'items_wrap' => '<ul id="%1$s" class="footer-links">%3$s</ul>', // replacing the ul with nav     
					    ) );	
					?>	
				</nav>
			</div>
			<?php endif; ?>
	</footer>		
	</div>
	<?php wp_footer(); ?>
<script type="text/javascript">
		var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
		document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
	</script><script type="text/javascript">
		try {
		var pageTracker = _gat._getTracker("UA-4306471-2");
		pageTracker._setDomainName(".cuny.edu");
		pageTracker._trackPageview();
		var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-4306471-2']);
    _gaq.push(['_trackPageview']);
		} catch(err) {}</script>

</body>
</html>

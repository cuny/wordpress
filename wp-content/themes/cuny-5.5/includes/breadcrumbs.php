		<section id="breadcrumbs" class="wpb_row vc_row-fluid smartphone-hide">
			<div class="wpb_column vc_col-sm-12 column_container">
				<div class="wpb_wrapper">
					<?php if ( is_page() && !isset ( $show_breadcrumbs ) ): ?>
							<ul class="inline">
								<li><a href="http://www.cuny.edu">Home</a></li>
								<?php
									$ancestors = get_ancestors( $GLOBALS['post']->ID, 'page' );
									$ancestors = array_reverse( $ancestors );
									foreach ( $ancestors as $a_ancestor_id ){
										echo '<li><a href="'.get_permalink( $a_ancestor_id ).'">'.get_the_title( $a_ancestor_id ).'</a></li>';
									}
									echo '<li class="last">'.get_the_title($GLOBALS['post']->ID).'</li>';
								?>
							</ul><!-- #breadcrumbs.inline -->
					<?php elseif ( !isset ( $show_breadcrumbs ) ): ?>
						<?php dynamic_sidebar( 'Breadcrumb Bar' ); ?>
					<?php endif; ?>
				</div><!-- .wpb_wrapper -->
			</div><!-- .wpb_column.vc_col-sm-12.column_container -->
		</section><!-- .wpb_row.vc_row-fluid -->
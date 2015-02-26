<?php 

get_header();
if ( have_posts() ) {
	echo '<ul class="wpb_row vc_row-fluid search-result-container">';

	while ( have_posts() ) {
		the_post();
		echo "<li class='vc_col-sm-12'><h2><a href='".get_permalink()."'>" . get_the_title( ) . "</a></h2>";
		the_excerpt();
		echo '</li>';
	}

	echo '</ul>';
} 
get_footer();

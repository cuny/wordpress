<?php
/*
Template Name: No Title
*/

get_header();
the_post();

include_once('includes/breadcrumbs.php');
echo '<div id="wrap-content">';
the_content();
echo '</div><!-- #wrap-content -->';

get_footer();
<?php
/*
Template Name: No Breadcrumbs
*/

get_header();
the_post();

$show_breadcrumbs = false;
include_once('includes/breadcrumbs.php');
include_once('includes/page-title.php');


echo '<div id="wrap-content">';
the_content();
echo '</div><!-- #wrap-content -->';

get_footer();
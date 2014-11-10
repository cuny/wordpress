<?php 
/*
Template Name: Redirect
*/

the_post();
$redirect = get_the_content();
header('Location: '.$redirect);
exit;
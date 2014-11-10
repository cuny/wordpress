<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php wp_title() ?></title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, maximum-scale=1">
	<meta name="description" content="CUNY Independent Site">
	<meta property="og:title" content="CUNY Independent Site">

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div id="wrapper">
		
		<header>
			<!-- Top Bar Nav -->
			<section class="cuny-bar">
				<nav class="topnav container">
					<a href="http://www.cuny.edu/">The City University of New York</a>
				</nav>
			</section>
			<section class="logo-wrapper container">
				<div class="vc_row-fluid">
					<div class="vc_col-sm-4 wpb_column">
						<h1 id="logo">
							<a title="CUNY Home Page" href="http://www.cuny.edu/"><i class="cuny-icon-logo"></i></a>
						</h1>
					</div>
					<div class="vc_col-sm-8 wpb_column">
						<a href="<?php echo home_url('/'); ?>">
       					<img class="site-logo" alt="<?php echo get_bloginfo('name') ?>" src="<?php echo get_bloginfo('home'); $theme_options = get_option( 'cuny_iss_options' ); echo $theme_options['logo_url']; ?>" />
 						</a>
					</div>
				</div>
			</section>
			<!-- Mobile  Main navigation -->
			<section class="mobile-bar">
					<a id="mobile-navigation-toggle" class="mobile-only"><i class="cuny-icon-menu"></i></a>
			</section>
			<!-- Main navigation -->
			<nav class="mainmenu">
				<div class="menu-wrapper">
					<div class="container">
						<div class="vc_row-fluid">
								<div class="vc_col-sm-9 wpb_column">
									<div id="header-sidebar">
									<?php wp_nav_menu( array( 'theme_location' => 'mainnav' )); ?>
									</div>
								</div>
								<!-- Social Menu and Search -->
								<div class="vc_col-sm-3 wpb_column">
									<?php
										if(is_active_sidebar('header-sidebar')){
										dynamic_sidebar('header-sidebar');
										}
									?>
									<div class="search-wrapper">								
										<form class="searchform" method="get" action="<?php echo home_url(); ?>/">
											<input type="search" placeholder="">
										</form>
									</div>
								</div>
						</div>
					</div>				
				</div>
			</nav>
		</header>

		<section class="pagetitle-wrapper">
			
			<div class="pagetitle container">
				<div class="vc_row-fluid">
					<div class="breadcrumbwrap"><?php 
						if (function_exists('breadcrumb_trail')) 
							breadcrumb_trail( array( 
								'separator' => '&raquo;',
								'show_browse' => false,
								'show_title' => true,
								'labels' => array(
									'archive_minute_hour' => '',
									'archive_hour'        => '',
									'archive_day'         => '',
									'archive_month'       => '',
									'archive_year'        => ''
								)
							) ); ?></div>
					<h1 class="pagetitle">
							<?php 
								if (is_date()){
									echo get_the_date('F Y');
								}
								else if(is_category()){
									echo single_cat_title( '', false );
								}
								else if(is_search()){
									echo 'Search Results';
								}
								else the_title();
							?>
					</h1>
					<!-- Mobile Contextual Menu -->						
					<section class="contextual-nav-wrapper">
						<a id="mobile-contextual-toggle"><i class="cuny-icon-menu"></i></a>					
					</section>
					<!-- Mobile Contextual Menu-->
						<nav id="mobile-submenu-wrapper">							
						</nav>	
					<!-- End Mobile Contextual Menu -->
					
				</div>
			</div>
		</section>
		<!--Main Content Begins -->
		<section id="main-content" class="container">
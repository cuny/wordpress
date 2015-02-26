<?php $cuny_mpt_theme_settings = get_option( 'cuny_mpt_settings' ); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php bloginfo('name'); ?> | <?php is_front_page() ? bloginfo('description') : wp_title(''); ?></title>

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
			<section class="container" id="top-bar">
				<div class="container">
					<?php if (is_active_sidebar( 'top-sidebar' ) ): ?>
						<?php dynamic_sidebar('top-sidebar'); ?>
					<?php else: ?>
					<div class="wpb_row vc_row-fluid">
						<div class="vc_col-sm-6 wpb_column column_container">
							<div class="wpb_wrapper">
								<a href="http://www.cuny.edu/" class="left"><i class="cuny-icon-home"></i> CUNY Home</a>
							</div>
						</div>
						<div class="vc_col-sm-6 wpb_column column_container">
							<div class="wpb_wrapper">
								<a href="http://www.cuny.edu/" class="right">The City University of New York</a>
							</div>
						</div>
					</div>
					<?php endif; ?>
					</div>
			</section>

			<section class="logo-wrapper container">
				<div class="vc_row-fluid">
					<div class="vc_col-sm-12 wpb_column">
						<a href="<?php echo home_url('/'); ?>"><?php
       					if (empty($cuny_mpt_theme_settings['logo_url'])){
       						echo get_bloginfo('name');
       					}
       					else{
       						echo '<img class="site-logo" alt="'.get_bloginfo('name').'" src="'.get_bloginfo('url').$cuny_mpt_theme_settings['logo_url'].'" />';
       					}
       					?>
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
									<?php dynamic_sidebar('header-sidebar'); ?>
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
					<div class="contextual-nav-wrapper">
						<a id="mobile-contextual-toggle"><i class="cuny-icon-menu"></i></a>					
					</div>
					<!-- Mobile Contextual Menu-->
						<nav id="mobile-submenu-wrapper">							
						</nav>	
					<!-- End Mobile Contextual Menu -->
					
				</div>
			</div>
		</section>
		<!--Main Content Begins -->
		<section id="main-content" class="container">
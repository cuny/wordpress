<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php wp_title( ' - ', true, 'right' ); ?> The City University of New York</title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="copyright" content="The City University of New York" />
	<meta content="width=device-width, initial-scale=1, minimum-scale=1" name="viewport"/>

	<!--[if lt IE 9]>
		<script src="<?php echo get_template_directory_uri() ?>/js/html5shiv-printshiv.min.js"></script>
	<![endif]-->
	<!--[if lt IE 8]>
		<link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/css/ie7.css" />
	<![endif]-->
    
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="main-wrapper">
	<header id="top-header">
		<section id="hidden-navigations">
			<nav id="skip-links" class="hidden">
				<ul>
					<li><a href="#wrap-content">Skip to Content</a></li>
					<li><a href="#main-nav-content">Skip to Main Navigation</a></li>
					<li><a href="#colleges-sliding-nav">Skip to College Websites</a></li>
					<li><a href="#breadcrumbs">Skip to Page Breadcrumbs</a></li>
				</ul>
			</nav>
			
			<nav id="find-sliding-nav" class="wpb_row vc_row-fluid hidden">
				<div class="wpb_column vc_col-sm-3 column_container">
					<h2>General Finds</h2>
					<ul>
						<li><a href="https://home.cunyfirst.cuny.edu/psp/cnyepprd/GUEST/HRMS/c/COMMUNITY_ACCESS.CLASS_SEARCH.GBL?FolderPath=PORTAL_ROOT_OBJECT.HC_CLASS_SEARCH_GBL&amp;IsFolder=false&amp;IgnoreParamTempl=FolderPath%252cIsFolder">Find a Course</a></li>
						<li><a href="http://student.cuny.edu/cgi-bin/RegisteredPrograms/menu.pl?STYLE=NEW">Find a Program</a></li>
						<li><a href="http://student.cuny.edu/cgi-bin/RegisteredPrograms/menu.pl?STYLE=NEW">Find a Degree</a></li>
						<li><a href="http://www.cuny.edu/about/resources/directories.html">Find People (phone/emails)</a></li>
					</ul>
				</div>
				
				<div class="wpb_column vc_col-sm-3 column_container">
					<h2>Top Searches</h2>
					<ul>
						<li><a href="https://bbhosted.cuny.edu/webapps/login/NoPortal">Blackboard</a></li>
						<li><a href="https://esims.cuny.edu/NotLoggedInServlet?CurrentCommand=NonPortal">eSIMS (Student Registration)</a></li>
						<li><a href="https://home.cunyfirst.cuny.edu/">CUNYfirst</a></li>
						<li><a href="http://www.cuny.edu/about/administration/offices/ur/transcript.html">Transcripts</a></li>
						<li><a href="http://www.cuny.edu/employment/student-jobs.html">Student Jobs</a></li>
						<li><a href="http://www.cuny.edu/about/resources/helpdesks.html">Campus IT Help Desks</a></li>
						<li><a href="https://cunyportal.cuny.edu/cpr/emailpswd/emailpswd_form.jsp">How to Change Password?</a></li>
					</ul>
				</div>
				
				<div class="wpb_column vc_col-sm-3 column_container">
					<h2>Top Clicks</h2>
					<ul>
						<li><a href="http://www.cuny.edu/admissions.html">Admissions</a></li>
						<li><a href="http://www.cuny.edu/admissions/financial-aid.html">Financial Aid</a></li>
						<li><a href="https://cunyportal.cuny.edu/cpr/authenticate/portal_login.jsp">Portal Log-in</a></li>
						<li><a href="http://www.cuny.edu/news.html">News</a></li>
						<li><a href="http://www.cuny.edu/academics.html">Academics</a></li>
						<li><a href="http://www.cuny.edu/current-students.html">Current Student Services</a></li>
						<li><a href="http://www.cuny.edu/about/administration.html">Administration</a></li>
					</ul>
				</div>

				<div class="wpb_column vc_col-sm-3 column_container last">
					<h2>Quick Finds</h2>
					<ul>
						<li><a href="http://www.cuny.edu/academics/calendars.html">Academic Calendars</a></li>
						<li><a href="http://www.cuny.edu/about/administration/offices/ur/campus-registrars.html">College Registrars</a></li>
						<li><a href="http://www.cunyathletics.com/">CUNY Athletics</a></li>
						<li><a href="http://policy.cuny.edu/">CUNY Policies</a></li>
						<li><a href="http://online.sps.cuny.edu/">Online Education</a></li>
						<li><a href="http://www.cuny.tv/">CUNY TV</a></li>
						<li><a href="http://www.cuny.edu/winter">Winter Session</a></li>
						<li><a href="http://www.cuny.edu/summer">Summer Session</a></li>
					</ul>
				</div>

				<a href="javascript:;" class="close-sliding-nav">X</a>
			</nav>

			<nav id="colleges-sliding-nav" class="wpb_row vc_row-fluid hidden">
				<div class="wpb_column vc_col-sm-3 column_container">
					<h2>Senior Colleges</h2>
					<ul>
						<li><a href="http://www.baruch.cuny.edu">Baruch College</a></li>
						<li><a href="http://www.brooklyn.cuny.edu">Brooklyn College</a></li>
						<li><a href="http://www.ccny.cuny.edu">The City College of New York</a></li>
						<li><a href="http://www.csi.cuny.edu">College of Staten Island</a></li>
						<li><a href="http://www.hunter.cuny.edu">Hunter College</a></li>
						<li><a href="http://www.jjay.cuny.edu/">John Jay College of Criminal Justice</a></li>
					</ul>
				</div>

				<div class="wpb_column vc_col-sm-3 column_container">
					<h2>Senior Colleges</h2>
					<ul>
						<li><a href="http://www.lehman.cuny.edu">Lehman College</a></li>
						<li><a href="http://www.mec.cuny.edu">Medgar Evers College</a></li>
						<li><a href="http://www.citytech.cuny.edu">New York City College of Technology</a></li>
						<li><a href="http://www.qc.cuny.edu">Queens College</a></li>
						<li><a href="http://www.york.cuny.edu">York College</a></li>
					</ul>
				</div>

				<div class="wpb_column vc_col-sm-3 column_container">
					<h2>Honors and Professional</h2>
					<ul>
						<li><a href="http://www.gc.cuny.edu">CUNY Graduate Center</a></li>
						<li><a href="http://www.journalism.cuny.edu">CUNY Graduate School of Journalism</a></li>
						<li><a href="http://www.law.cuny.edu">CUNY School of Law</a></li>
						<li><a href="http://www.sps.cuny.edu">CUNY School of Professional Studies</a></li>
						<li><a href="http://www.cuny.edu/sph">CUNY School of Public Health</a></li>
						<li><a href="http://www.macaulay.cuny.edu">Macaulay Honors College</a></li>
					</ul>
				</div>

				<div class="wpb_column vc_col-sm-3 column_container last">
					<h2>Community Colleges</h2>
					<ul>
						<li><a href="http://www.bmcc.cuny.edu">Borough of Manhattan Community College</a></li>
						<li><a href="http://www.bcc.cuny.edu">Bronx Community College</a></li>
						<li><a href="http://www.guttman.cuny.edu">Stella and Charles Guttman Community College</a></li>
						<li><a href="http://www.hostos.cuny.edu">Hostos Community College</a></li>
						<li><a href="http://www.kbcc.cuny.edu">Kingsborough Community College</a></li>
						<li><a href="http://www.laguardia.cuny.edu">LaGuardia Community College</a></li>
						<li><a href="http://www.qcc.cuny.edu">Queensborough Community College</a></li>
					</ul>
				</div>

				<a href="javascript:;" class="close-sliding-nav">X</a>
			</nav>
		</section>

		<section id="logo-find-role-nav" class="wpb_row vc_row-fluid">
			<div class="wpb_column vc_col-sm-3 column_container">
				<h1 id="logo">
					<a class="no-bg" href="http://www.cuny.edu/" title="CUNY Home Page">&#59397;</a>
				</h1>
			</div>

			<div class="wpb_column vc_col-sm-9 column_container smartphone-hide">
				<nav id="tools-nav">
					<ul class="inline">
						<li><i class="cuny-icon-swipe_d"></i> <a href="javascript:;" class="menu-toggle" data-slide-nav="find-sliding-nav">Find It</a></li>
						<li><i class="cuny-icon-swipe_d"></i> <a href="javascript:;" class="menu-toggle" data-slide-nav="colleges-sliding-nav">College Websites</a></li>
						<li><a href="http://assistive.usablenet.com/tt/referrer" id="textversion-link" title="Text-Only page (produced automatically by Usablenet Assistive)">Text Version</a></li>
					</ul>
				</nav>

				<nav id="role-nav">
					<ul id="role-nav-content" class="inline">
						<li><a class="role-link" href="http://www.cuny.edu/future-students.html" title="Future Students">Future Students</a></li>
						<li><a class="role-link" href="http://www.cuny.edu/current-students.html" title="Current Students">Current Students</a></li>
						<li><a class="role-link" href="http://www.cuny.edu/faculty-staff.html" title="Faculty/Staff">Faculty/Staff</a></li>
						<li><a class="role-link" href="http://www.cuny.edu/alumni.html" title="Alumni">Alumni</a></li>
					</ul>
				</nav>
			</div>
		</section>

		<section id="main-nav-search" class="wpb_row vc_row-fluid smartphone-hide overflow-visible">
			<div class="wpb_column vc_col-sm-12 column_container">
				<nav id="main-nav" role="main">
					<ul id="main-nav-content" class="inline">
						<li><a href="http://www.cuny.edu/about.html">About</a>
							<ul>
								<li><a href="http://www.cuny.edu/about/colleges.html">Colleges &amp; Schools</a></li>
								<li><a href="http://www.cuny.edu/about/centers-and-institutes.html">Centers &amp; Institutes</a></li>
								<li><a href="http://www.cuny.edu/about/alumni-students-faculty.html">Alumni, Students &amp; Faculty</a></li>
								<li><a href="http://www.cuny.edu/about/administration.html">Administration</a></li>
								<li><a href="http://www.cuny.edu/about/trustees.html">Trustees</a></li>
								<li><a href="http://www.cuny.edu/about/masterplan.html">Master Plan 2012-2016</a></li>
								<li><a href="http://www.cuny.edu/about/resources.html">University Resources</a></li>
								<li><a href="http://www.cuny.edu/about/history.html">History</a></li>
								<li><a href="http://www.cuny.edu/about/cuny-city.html">CUNY  &amp;The City</a></li>
								<li><a href="http://www.cuny.edu/about/invest-in-cuny.html">Invest In CUNY</a></li>
							</ul>
						</li>
						<li><a href="http://www.cuny.edu/academics.html">Academics</a>
							<ul>
								<li><a href="http://www.cuny.edu/academics/calendars.html">Academic Calendars</a></li>
								<li><a href="http://www.cuny.edu/academics/programs.html">Academic Programs</a></li>
								<li><a href="http://www.cuny.edu/academics/conted.html">Continuing &amp; Professional Education</a></li>
								<li><a href="http://www.cuny.edu/academics/initiatives.html">Current Initiatives</a></li>
								<li><a href="http://www.cuny.edu/academics/k-to-12.html">Pre-College Education</a></li>
								<li><a href="http://www.cuny.edu/academics/resources.html">Resources</a></li>
								<li><a href="http://www.cuny.edu/academics/testing.html">Testing</a></li>
							</ul>
						</li>
						<li><a href="http://www.cuny.edu/admissions.html">Admissions</a>
							<ul>
								<li><a href="http://www.cuny.edu/admissions/undergraduate.html">Undergraduate</a></li>
								<li><a href="http://www.cuny.edu/admissions/graduate.html">Graduate</a></li>
								<li><a href="http://www.cuny.edu/admissions/apply.html">Apply to CUNY</a></li>
								<li><a href="http://www.cuny.edu/academics/conted.html">Continuing &amp; Professional Education</a></li>
								<li><a href="http://sps.cuny.edu/online/">Online Education</a></li>
								<li><a href="http://www.cuny.edu/admissions/apply/visiting.html">Visiting Students</a></li>
								<li><a href="http://www.cuny.edu/admissions/contact-us.html">Contact Us</a></li>
							</ul>
						</li>
						<li><a href="http://www.cuny.edu/admissions/financial-aid.html">Financial Aid</a>
							<ul>
								<li><a href="http://www.cuny.edu/admissions/financial-aid/apply-aid.html">Applying for Financial Aid</a></li>
								<li><a href="http://www.cuny.edu/admissions/financial-aid/student-eligibility.html">Student Eligibility</a></li>
								<li><a href="http://www.cuny.edu/admissions/financial-aid/grants.html">Federal and State Grants</a></li>
								<li><a href="http://www.cuny.edu/admissions/financial-aid/scholarships.html">Scholarships</a></li>
								<li><a href="http://www.cuny.edu/admissions/financial-aid/student-loans.html">Student Loans</a></li>
								<li><a href="http://www.cuny.edu/admissions/financial-aid/tax-benefits.html">Tax Benefits</a></li>
								<li><a href="http://www.cuny.edu/admissions/financial-aid/estimating-costs.html">Estimating College Costs</a></li>
								<li><a href="http://www.cuny.edu/admissions/financial-aid/grad-students.html">Graduate Students</a></li>
								<li><a href="http://www.cuny.edu/admissions/financial-aid/FinancialAidForms.html">Financial Aid Forms</a></li>
								<li><a href="http://www.cuny.edu/admissions/financial-aid/info-resources.html">Information &amp; Resources</a></li>
							</ul>
						</li>
						<li><a href="http://www.cuny.edu/research.html">Research</a>
							<ul class="sub-text-tabs-list" id="navlinks-research">
								<li><a href="http://www.cuny.edu/research/news-events.html">Research News &amp; Events</a></li>
								<li><a href="http://www.cuny.edu/research/faculty-resources.html">Faculty Resources</a></li>
								<li><a href="http://www.cuny.edu/research/compliance.html">Research Compliance</a></li>
								<li><a href="http://www.cuny.edu/research/ovcr.html">Office of the VC for Research</a></li>
								<li><a href="http://www.cuny.edu/research/postdoctoral-development-program.html">Postdoctoral Development</a></li>
								<li><a href="http://www.cuny.edu/research/sr.html">Student Research</a></li>
							</ul>
						</li>
						<li><a href="http://www.cuny.edu/news.html">News/Events</a>
							<ul>
								<li><a href="http://www.cuny.edu/news/newswire.html">CUNY Newswire</a></li>
								<li><a href="http://www.youtube.com/user/CUNYMedia">CUNY Channel</a></li>
								<li><a href="http://www.cuny.edu/news/cunyradio.html">CUNY Radio</a></li>
								<li><a href="http://www.cuny.edu/news/events.html">CUNY Events</a></li>
								<li><a href="http://www.cuny.edu/news/publications.html">Publications</a></li>
							</ul>
						</li>
						<li><a href="http://www.cuny.edu/libraries.html">Libraries</a>
							<ul>
								<li><a href="http://www.cuny.edu/main/libraries/news-redirect.html">Library News</a></li>
								<li><a href="http://www.cuny.edu/main/libraries/catalog.html">Online Catalog</a></li>
								<li><a href="http://www.cuny.edu/main/libraries/local-research.html">Local Research Links</a></li>
								<li><a href="http://www.cuny.edu/main/libraries/services.html">Library Services</a></li>
								<li><a href="http://www.cuny.edu/main/libraries/list.html">CUNY Campus Libraries</a></li>
								<li><a href="http://www.cuny.edu/main/libraries/j-and-r.html">E-Resources</a></li>
								<li><a href="http://www.cuny.edu/main/libraries/ols-redirect.html">Office of Library Services</a></li>
								<li><a href="http://www.cuny.edu/main/libraries.html">Libraries Home</a></li>
							</ul>
						</li>
						<li><a href="http://www.cuny.edu/employment.html">Employment</a>
							<ul class="sub-text-tabs-list" id="navlinks-employment">
								<li><a href="http://www.cuny.edu/main/employment/jobsearch.html">Search Job Postings</a></li>
								<li><a href="http://www.cuny.edu/main/employment/civil-service.html">Classified Civil Service</a></li>
								<li><a href="http://www.cuny.edu/main/employment/jobsearchprocess.html">Job Search Process</a></li>
								<li><a href="http://www.cuny.edu/main/employment/jobsysteminstructions.html">Job System Instructions</a></li>
								<li><a href="http://www.cuny.edu/main/employment/diversity.html">Diversity at CUNY</a></li>
								<li><a href="http://www.cuny.edu/main/employment/campus-hr.html">Campus HR Offices</a></li>
								<li><a href="http://www.cuny.edu/main/employment/student-jobs.html">Student Jobs</a></li>
								<li><a href="http://www.cuny.edu/main/employment.html">Employment Home</a></li>
							</ul>
						</li>
					</ul>
				</nav><!-- #main-nav -->

				<form action="http://search.cuny.edu/search" id="main-search-form" enctype="application/x-www-form-urlencoded" method="get" name="main-search-form">
					<fieldset>
						<label for="q" class="hidden">Search Input</label>
						<input type="text" value="" placeholder="SEARCH" class="search-input" maxlength="800" name="q" id="q" title="Search Input" size="15" />
						<input type="image" alt="Search" class="search-button" src="<?php echo get_stylesheet_directory_uri() ?>/images/search-button.png" />
						<input value="CUNYedu" name="site" type="hidden"/>
						<input value="cuny5" name="client" type="hidden"/>
						<input value="cuny5" name="proxystylesheet" type="hidden"/>
						<input value="xml_no_dtd" name="output" type="hidden"/>
					</fieldset>
				</form><!-- #main-search-form -->

				<nav id="login-nav">
					<ul class="inline">
						<li><a href="https://cunyportal.cuny.edu/cpr/authenticate/portal_login.jsp">Log-in</a>
							<ul id="login-nav-content">
								<li><a href="https://cunyportal.cuny.edu/cpr/authenticate/portal_login.jsp" title="Portal Login">CUNY Portal</a></li>
								<li><a href="https://home.cunyfirst.cuny.edu/oam/Portal_Login1.html" title="CUNYfirst Login">CUNYfirst</a></li>
								<li><a href="http://www.cuny.edu/about/administration/offices/CIS/bblandingpage.html" title="Blackboard Login">Blackboard</a></li>
								<li><a href="https://esims.cuny.edu/NotLoggedInServlet?CurrentCommand=NonPortal" title="eSims Login">eSIMS</a></li>
							</ul>
						</li>
					</ul>
				</nav><!-- #login-nav -->

				<span class="clear"></span>
			</div>
		</section><!-- #main-nav-search -->

		<section id="mobile-bar" class="wpb_row vc_row-fluid smartphone-only">
			<div class="wpb_column vc_col-sm-12 column_container">
				<ul class="toggles">
					<li id="mobile-login-toggle" class="menu-toggle" data-slide-nav="login-nav-content">Login</li>
					<li id="mobile-search-toggle" class="menu-toggle" data-slide-nav="main-search-form"><i class="cuny-icon-search"></i></li>
					<li id="mobile-menu-toggle" class="menu-toggle" data-slide-nav="main-role-nav-content"><i class="cuny-icon-menu"></i></li>
				</ul>
			</div>
		</section>

		<section id="mobile-menu-container" class="wpb_row vc_row-fluid smartphone-only"></section>

		<section id="mobile-contextual-menu-container" class="smartphone-only hidden">
			<div class="wpb_column vc_col-sm-12">
				<a class="menu-toggle" data-slide-nav="contextual-nav-content"><i class="cuny-icon-menu"></i></a>
			</div>
		</section>
	</header>
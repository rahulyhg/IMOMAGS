<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); } ?>
<!DOCTYPE html>
<!-- bid: <?php global $blog_id; print $blog_id ?>; env: <?php if(defined("WEB_ENV")) { print WEB_ENV; } else { print "production"; } ?> -->

<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes() ?>> <!--<![endif]-->
<head>
	<meta http-equiv="content-type" content="<?php bloginfo('html_type') ?>; charset=<?php bloginfo('charset') ?>" />

	<title><?php wp_title(''); ?></title>

	<meta http-equiv="X-UA-Compatible" content="chrome=1" />
	<link rel="pingback" href="<?php bloginfo('pingback_url') ?>" />
	<?php wp_get_archives(array('type' => 'monthly', 'format' => 'link')); ?>
  
  <script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.0.6/modernizr.min.js"></script>
	
	<?php // Include javascript for threaded comments if needed
	if ( is_singular() && get_option('thread_comments') ) { wp_enqueue_script( 'comment-reply' ); }
	
	wp_head();
	
	include_once get_stylesheet_directory() . "/head-includes.php";  ?>
  
  <?php if (is_page_template("page-cabelas.php")) : ?>
	<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('template_url'); ?>/css/contest.css?ver=<?php echo CFCT_URL_VERSION; ?>" />
  <?php  endif; ?>     	

  <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/scripts.js"/></script>
  
  <?php if (defined('JETPACK_SITE')): ?>
  <script type='text/javascript' src='http://ads.jetpackdigital.com/sites/<?php print JETPACK_SITE; ?>/jpd.js'></script>
  <?php endif; ?> 
</head>
<body <?php body_class(); ?>>
  
	<header id="header">
    <div class="container">

      <div class="centerad">
        <div class="ad-left">
          <?php if (function_exists("imo_dart_tag")) {
            imo_dart_tag("728x90");
          } else { ?>
  	        <!-- 728x90 Ad: -->
            <script type="text/javascript">
              document.write(unescape('%3Cscript src="http://ad.doubleclick.net/adj/imo.'+dartadsgen_site+'/;sect=;page=index;subs=;sz=728x90;dcopt=;tile='+pr_tile+';ord='+dartadsgen_rand+'?"%3E%3C/script%3E'));
            </script>
            <script type="text/javascript">
              ++pr_tile;
            </script>
            <noscript>
              <a href="http://ad.doubleclick.net/adj/imo.outdoorsbest/;sect=;page=index;subs=;sz=728x90;dcopt=;tile=1;ord=7391727509?">
                <img src="http://ad.doubleclick.net/ad/imo.outdoorsbest/home;sect=;page=index;subs=;sz=728x90;dcopt=;tile=1;ord=7391727509?" border="0" />
              </a>
            </noscript>
            <!-- END 728x90 Ad: -->
          <?php } ?>
        </div>
        <div class="ad-right">
          <a href="http://www.nssf.org/FirstShots/" target="_blank"><img src='<?php print bloginfo('stylesheet_directory') . "/img/nssf.png"?>' alt="Visit the National Shooting Sports Foundation"/></a>
        </div>
      </div>
			
      <a href="<?php echo home_url('/'); ?>" class="brand" title="<?php _e('Home', 'carrington-business') ?>"><img src="<?php print get_stylesheet_directory_uri(); ?>/img/logo.png" alt="<?php bloginfo('name'); ?>" /></a>
      
      <?php cfct_form('search'); ?>
			
			<?php get_template_part('head', 'subscribe') ?>
			
		</div>
		
		<div class="uber-nav">
	    <?php wp_nav_menu(array( 'theme_location' => 'featured' )); ?>
	  </div>
		
		<div id="site-menu">
		  <div class="container">
		    <?php wp_nav_menu(array( 
  				'theme_location' => 'main',
  				'container' => 'nav',
  				'container_class' => 'nav-main nav',
  				'depth' => 2,
  			)); ?>
  			
  			<div class="stay-connected">
  			 <div class="fb-like" data-href="http://www.facebook.com/pages/Guns-and-Ammo/110008639020864" data-send="false" data-layout="button_count" data-width="100" data-show-faces="false"></div>
  			 <span class="label">Stay Connected</span>
  			 <ul class="connections">
  			   <li><a class="facebook" href="http://www.facebook.com/GunsAndAmmoMag" title="Find us on Facebook">Facebook</a></li>
  			   <li><a class="twitter" href="http://twitter.com/gunsandammomag" title="Follow us on Twitter">Twitter</a></li>
  			   <li><a class="feed" href="http://feeds.feedburner.com/GunsAndAmmoMag" title="Get the RSS Feed">RSS Feed</a></li>
  			 </ul>
  			</div>
		  </div>
		</div>
	</header>
	
	<section id="main" class="container">
	  <?php // Yoast Breadcrumbs
  	// if (!is_front_page() && function_exists('yoast_breadcrumb'))
  	//  yoast_breadcrumb('<div id="breadcrumbs">','</div>'); ?>

<?php

/**
 * @package carrington-business
 *
 * This file is part of the Carrington Business Theme for WordPress
 * http://crowdfavorite.com/wordpress/themes/carrington-business/
 *
 * Copyright (c) 2008-2011 Crowd Favorite, Ltd. All rights reserved.
 * http://crowdfavorite.com
 *
 * **********************************************************************
 * This program is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. 
 * **********************************************************************
 */
 


if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }


//If the post is a Superpost, get the title
if (get_the_title(null, false) == 'superpost-single') {
  $postTitle = "Superpost! - ";
} else {
  $postTitle = wp_title( '-', false, 'right' ); 
}

?>
<!DOCTYPE html>
<!-- bid: <?php global $blog_id; print $blog_id ?>; env: <?php if(defined("WEB_ENV")) { print WEB_ENV; } else { print "production"; } ?> -->
<!--[if IE 6]><![endif]-->
<html <?php language_attributes() ?>>
<head>
	
	<meta http-equiv="content-type" content="<?php bloginfo('html_type') ?>; charset=<?php bloginfo('charset') ?>" />

	<title><?php echo $postTitle; esc_attr_e(get_bloginfo('name')); ?></title>

	<meta http-equiv="X-UA-Compatible" content="chrome=1" />
	<link rel="pingback" href="<?php bloginfo('pingback_url') ?>" />
	<?php wp_get_archives(array('type' => 'monthly', 'format' => 'link')); ?>
	
	<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('template_url'); ?>/css/css.php?ver=<?php echo CFCT_URL_VERSION; ?>" />
	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<!--[if lte IE 7]>
		<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('template_url'); ?>/css/lte-ie7.css?ver=<?php echo CFCT_URL_VERSION; ?>" />
	<![endif]-->
	<script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.0.6/modernizr.min.js"></script>
	<?php
	// Include javascript for threaded comments if needed
	if ( is_singular() && get_option('thread_comments') ) { wp_enqueue_script( 'comment-reply' ); }
	wp_enqueue_script('my_scripts_method');
	wp_head();
	?>
	<link href='http://fonts.googleapis.com/css?family=Rokkitt:400,700' rel='stylesheet' type='text/css'>
	<!--
/* @license
 * MyFonts Webfont Build ID 2288984, 2012-05-09T13:35:45-0400
 * 
 * The fonts listed in this notice are subject to the End User License
 * Agreement(s) entered into by the website owner. All other parties are 
 * explicitly restricted from using the Licensed Webfonts(s).
 * 
 * You may obtain a valid license at the URLs below.
 * 
 * Webfont: Proxima Nova A Thin by Mark Simonson
 * URL: http://www.myfonts.com/fonts/marksimonson/proxima-nova/a-thin/
 * Licensed pageviews: 100,000
 * 
 * Webfont: Proxima Nova S Thin by Mark Simonson
 * URL: http://www.myfonts.com/fonts/marksimonson/proxima-nova/s-thin/
 * Licensed pageviews: unspecified
 * 
 * Webfont: Proxima Nova A Extrabold by Mark Simonson
 * URL: http://www.myfonts.com/fonts/marksimonson/proxima-nova/a-extrabld/
 * Licensed pageviews: unspecified
 * 
 * Webfont: Proxima Nova S Extrabold by Mark Simonson
 * URL: http://www.myfonts.com/fonts/marksimonson/proxima-nova/s-extrabld/
 * Licensed pageviews: unspecified
 * 
 * Webfont: Proxima Nova S Semibold by Mark Simonson
 * URL: http://www.myfonts.com/fonts/marksimonson/proxima-nova/s-semibold/
 * Licensed pageviews: unspecified
 * 
 * Webfont: Proxima Nova S Black by Mark Simonson
 * URL: http://www.myfonts.com/fonts/marksimonson/proxima-nova/s-black/
 * Licensed pageviews: unspecified
 * 
 * Webfont: Proxima Nova A Regular by Mark Simonson
 * URL: http://www.myfonts.com/fonts/marksimonson/proxima-nova/a-regular/
 * Licensed pageviews: unspecified
 * 
 * Webfont: Proxima Nova A Black by Mark Simonson
 * URL: http://www.myfonts.com/fonts/marksimonson/proxima-nova/a-black/
 * Licensed pageviews: unspecified
 * 
 * Webfont: Proxima Nova S Light by Mark Simonson
 * URL: http://www.myfonts.com/fonts/marksimonson/proxima-nova/s-light/
 * Licensed pageviews: unspecified
 * 
 * Webfont: Proxima Nova A Light by Mark Simonson
 * URL: http://www.myfonts.com/fonts/marksimonson/proxima-nova/a-light/
 * Licensed pageviews: unspecified
 * 
 * Webfont: Proxima Nova S Bold by Mark Simonson
 * URL: http://www.myfonts.com/fonts/marksimonson/proxima-nova/s-bold/
 * Licensed pageviews: unspecified
 * 
 * Webfont: Proxima Nova A Bold by Mark Simonson
 * URL: http://www.myfonts.com/fonts/marksimonson/proxima-nova/a-bold/
 * Licensed pageviews: unspecified
 * 
 * Webfont: Proxima Nova A Semibold by Mark Simonson
 * URL: http://www.myfonts.com/fonts/marksimonson/proxima-nova/a-semibold/
 * Licensed pageviews: unspecified
 * 
 * Webfont: Proxima Nova S Regular by Mark Simonson
 * URL: http://www.myfonts.com/fonts/marksimonson/proxima-nova/s-regular/
 * Licensed pageviews: unspecified
 * 
 * Webfont: Proxima Nova Thin by Mark Simonson
 * URL: http://www.myfonts.com/fonts/marksimonson/proxima-nova/thin/
 * Licensed pageviews: unspecified
 * 
 * Webfont: Proxima Nova Extrabold by Mark Simonson
 * URL: http://www.myfonts.com/fonts/marksimonson/proxima-nova/extrabld/
 * Licensed pageviews: unspecified
 * 
 * Webfont: Proxima Nova Regular by Mark Simonson
 * URL: http://www.myfonts.com/fonts/marksimonson/proxima-nova/regular/
 * Licensed pageviews: unspecified
 * 
 * Webfont: Proxima Nova Semibold by Mark Simonson
 * URL: http://www.myfonts.com/fonts/marksimonson/proxima-nova/semibold/
 * Licensed pageviews: unspecified
 * 
 * Webfont: Proxima Nova Black by Mark Simonson
 * URL: http://www.myfonts.com/fonts/marksimonson/proxima-nova/black/
 * Licensed pageviews: unspecified
 * 
 * Webfont: Proxima Nova Light by Mark Simonson
 * URL: http://www.myfonts.com/fonts/marksimonson/proxima-nova/light/
 * Licensed pageviews: unspecified
 * 
 * Webfont: Proxima Nova Bold by Mark Simonson
 * URL: http://www.myfonts.com/fonts/marksimonson/proxima-nova/bold/
 * Licensed pageviews: unspecified
 * 
 * 
 * License: http://www.myfonts.com/viewlicense?type=web&buildid=2288984
 * Webfonts copyright: Copyright (c) Mark Simonson, 2005. All rights reserved.
 * 
 * � 2012 Bitstream Inc
*/

-->
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('url'); ?>/wp-content/themes/imo-mags-northamericanwhitetail/MyFontsWebfontsKit.css">
	 <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/scripts.js"></script>
	<!-- IMO MODS -->
	<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-5816642-20']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<!-- BEGIN Tynt Script -->
<script type="text/javascript">
if(document.location.protocol=='http:'){
 var Tynt=Tynt||[];Tynt.push('d0GR6eRaSr4Agcacwqm_6l');Tynt.i={"ap":"Read more:"};
 (function(){var s=document.createElement('script');s.async="async";s.type="text/javascript";s.src='http://tcr.tynt.com/ti.js';var h=document.getElementsByTagName('script')[0];h.parentNode.insertBefore(s,h);})();
}
</script>
<!-- END Tynt Script -->
<script type="text/javascript" src="/wp-content/themes/imo-mags-northamericanwhitetail/js/jquery.jcarousel.js"></script>
<script type="text/javascript" src="/wp-content/themes/imo-mags-northamericanwhitetail/js/flash_heed.js"></script>
</head>
<body <?php body_class(); ?>>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<header id="header">
	<!-- <div id="tophat">
    		<div class="user-bar">
    			<ul id="tophat-left">
    				<li><a href="#">+ Post</a></li>
    				<li><a href="#">People</a></li>
    				<li><a href="#">Messages (<?php echo '3'; //some sort of fun code for Aaron. :) ?>)</a></li>
    				<li><a href="#">Saved Articles</a></li>
    				<li><a href="#">Your Profile</a></li>
    			</ul>
    			<ul id="tophat-right">
    				<li><img src="<?php bloginfo('url'); ?>/wp-content/themes/imo-mags-northamericanwhitetail/img/user-temp.jpg" alt="user photo" /></li>
    				<li>Hello, <a href="#"><?php echo 'Batman'; //OMG, it's BATMAN!!!! ?><span></span></a></li>
    				<li><a href="#">Sign Out</a></li>
    			</ul>
    		</div>
		</div> -->
    <div class="container">
    	    	
    	
	<div class="centered">
       	<a href="<?php echo home_url('/'); ?>" class="brand" title="<?php _e('Home', 'carrington-business') ?>"><img src="<?php print get_stylesheet_directory_uri(); ?>/img/nawp-logo.png" alt="<?php bloginfo('name'); ?>" /></a>
      	<div id="header-search">
      		<?php cfct_form('search'); ?>
		</div>
		<?php get_template_part('head', 'subscribe') ?>

   	</div>
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
  			 
  			 <span class="label">Stay Connected</span>
  			 <ul class="connections">
  			   <li><a class="facebook" href="http://www.facebook.com/americanwhitetail" title="Find us on Facebook">Facebook</a></li>
  			   <li><a class="twitter" href="http://twitter.com/americanwhitetail" title="Follow us on Twitter">Twitter</a></li>
  			   <li><a class="feed" href="http://feeds.feedburner.com/americanwhitetail" title="Get the RSS Feed">RSS Feed</a></li>
  			   <li><a class="like" href="#" title="Like us on Facebook">Like</a></li>
  			 </ul>
  			</div>
		  </div>
		</div>
	</header>
	<hr class="accessibility" />
	<section id="main" class="str-container">
		<div id="main-content">
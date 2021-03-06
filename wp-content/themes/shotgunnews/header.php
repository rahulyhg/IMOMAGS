<?php
?><!DOCTYPE html>
<!-- bid: <?php global $blog_id; print $blog_id ?>; env: <?php if(defined("WEB_ENV")) { print WEB_ENV; } else { print "production"; } ?> -->
<!-- X-Device-Type Varnish Header Found: <?php global $varnishHeaderExists; echo ($varnishHeaderExists ? "YES" : 'NO'); ?> -->
<!-- Mobile Detected: <?php echo (mobile() ? "YES" : 'NO'); ?> -->
<!-- Tablet Detected: <?php echo (tablet() ? "YES" : 'NO'); ?> -->
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 9]>
<html id="ie9" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 10]>
<html id="ie10" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="initial-scale=1, maximum-scale=1" />
	<meta http-equiv="x-ua-compatible" content="IE=edge" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
	<title><?php
	    /*
	     * Print the <title> tag based on what is being viewed.
	     */
	    global $page, $paged;

	    wp_title( '| ', true, 'right' );

	    // Add the blog name.
	    //bloginfo( 'name' );
				
	    // Add the blog description for the home/front page.
	
	    if ( $site_description && ( is_home() || is_front_page() ) )
	        get_bloginfo( 'description', 'display' );

	    // Add a page number if necessary:
	    if ( $paged >= 2 || $page >= 2 )
	        echo ' | ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );
		
	    ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<!--[if IE 8]><style type="text/css">img{max-width: none !important;}.BCLvideoWrapper object{width:480px !important;}</style><![endif]-->
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
	<![endif]-->
	<?php
		
	    /* We add some JavaScript to pages with the comment form
	     * to support sites with threaded comments (when in use).
	     */
	    if ( is_singular() && get_option( 'thread_comments' ) )
	        wp_enqueue_script( 'comment-reply' );

	    /* Always have wp_head() just before the closing </head>
	     * tag of your theme, or you will break many plugins, which
	     * generally use this hook to add elements to <head> such
	     * as styles, scripts, and meta tags.
	     */
	    wp_enqueue_script("jquery");
	    wp_head();
	    
	    $magazine_img = get_option('magazine_cover_uri' );
		$subs_link = get_option('subs_link'); 
		$iMagID = get_option('iMagID' );
		$deal_copy = get_option('deal_copy' );
		$gift_link = get_option('gift_link' );
		$service_link = get_option('service_link' );
		$subs_form_link = get_option('subs_form_link' );
		$i4ky = get_option('i4ky' );
		$dartDomain = get_option("dart_domain", $default = false);
		include_once get_template_directory() . "/head-includes.php";
		include_once get_stylesheet_directory() . "/head-includes.php";
	?>
	<link href='http://fonts.googleapis.com/css?family=Rokkitt:400,700' rel='stylesheet' type='text/css'>
	<script src="<?php echo get_template_directory_uri(); ?>/js/dart.js" type="text/javascript"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.jfollow.js" type="text/javascript"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/flash_heed.js" type="text/javascript"></script>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/snap.js"></script>
	<script type='text/javascript'>
		var googletag = googletag || {};
		googletag.cmd = googletag.cmd || [];
		(function() {
		var gads = document.createElement('script');
		gads.async = true;
		gads.type = 'text/javascript';
		var useSSL = 'https:' == document.location.protocol;
		gads.src = (useSSL ? 'https:' : 'http:') +
		'//www.googletagservices.com/tag/js/gpt.js';
		var node = document.getElementsByTagName('script')[0];
		node.parentNode.insertBefore(gads, node);
		})();
	</script>
	 
	<script type='text/javascript'>
		googletag.cmd.push(function() {
			googletag.defineSlot('/4930/<?php echo $dartDomain; ?>', [1, 1], 'div-gpt-ad-1386782139095-0').addService(googletag.pubads());
			googletag.defineSlot('/4930/<?php echo $dartDomain; ?>', [240, 60], 'div-gpt-ad-1386782139095-1').addService(googletag.pubads());
			googletag.defineSlot('/4930/<?php echo $dartDomain; ?>', [300, 120], 'div-gpt-ad-1386782139095-2').addService(googletag.pubads());
			googletag.defineSlot('/4930/<?php echo $dartDomain; ?>', [300, 250], 'div-gpt-ad-1386782139095-3').addService(googletag.pubads());
			googletag.defineSlot('/4930/<?php echo $dartDomain; ?>', [300, 300], 'div-gpt-ad-1386782139095-4').addService(googletag.pubads());
			googletag.defineSlot('/4930/<?php echo $dartDomain; ?>', [300, 600], 'div-gpt-ad-1386782139095-5').addService(googletag.pubads());
			googletag.defineSlot('/4930/<?php echo $dartDomain; ?>', [300, 602], 'div-gpt-ad-1386782139095-6').addService(googletag.pubads());
			googletag.defineSlot('/4930/<?php echo $dartDomain; ?>', [728, 90], 'div-gpt-ad-1386782139095-7').addService(googletag.pubads());
			googletag.defineSlot('/4930/<?php echo $dartDomain; ?>', [1080, 90], 'div-gpt-ad-1386782139095-8').addService(googletag.pubads());
			googletag.pubads().enableSingleRequest();
			googletag.pubads().enableVideoAds();
			googletag.enableServices();
		});
	</script>
	<script type='text/javascript' src='http://ads.jetpackdigital.com/sites/<?php print JETPACK_SITE; ?>/jpd.js'></script>
</head>

<body <?php body_class(); ?> domain="<?php echo $dartDomain; ?>" >
<div id='interstitial'>
	<script type='text/javascript'>
		googletag.cmd.push(function() { googletag.display('interstitial'); });
	</script>
</div>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="snap-drawers">
    <div class="snap-drawer snap-drawer-left" id="left-drawer">
        <div>
	        <div class="mob-aside-menu">
	            <?php
	            if(has_nav_menu( 'mobile' )){
	                wp_nav_menu(array(
	                    'menu_class'=>'menu',
	                    'theme_location'=>'mobile',
	                    'walker'=> new AddParentClass_Walker()
	                ));
	            }else{
	                wp_nav_menu(array(
	                'menu_class'=>'menu',
	                'theme_location'=>'bottom',
	                'walker'=> new AddParentClass_Walker()
	            ));
	            }
	
	            ?>
	        </div>
	
	        <div class="menu-subscribe">
	            <a href="<?php print $subs_link . get_option("mobile_menu_key"); ?>" target="_blank"><img src="<?php print $magazine_img;?>" alt="Subscribe" /><span>Subscribe Now!</span></a>
	        </div>
	        <?php wp_nav_menu(array(
	            'menu_class'=>'menu',
	            'theme_location'=>'top',
	        ));   ?>
	        <div class="aside-socials">
	            <strong>Connect</strong>
	            <?php social_networks(); ?>
	        </div>

		</div>
	</div>
	
	<!--<div class="snap-drawer snap-drawer-right" id="right-drawer">
        <div>
			<?php //echo the_widget("imo\NetworkTopicsWidgetMobile"); ?>
        </div>
	</div>-->
</div>
<div class="imo-superheader">
	<?php imo_ad_placement("superheader"); ?>
</div>
<?php 
	include_once get_stylesheet_directory() . "/network-bar.php";
	fixed_connect_footer(); 
?>
<div id="page" class="snap-content smooth-menu">
	<div class="hfeed wrapper" data-role="content" role="main">
	    <div class="layout-frame">
	        <div id="branding" class="header clearfix" role="banner">
	
                <div class="clearfix">

                   <a id="open-left" class="open-menu">open menu</a>
                   <div class="tagline"></div>
                    <strong class="logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/logo.png" alt="<?php bloginfo( 'name' ); ?>" /></a></strong>
                    	<?php if ( function_exists('imo_community_template') ){ ?>
							<a id="comm-mob-menu" class="user-btn" <?php if( is_user_logged_in() ) { echo 'style="background:url(/avatar?uid=' . $data->ID . ') no-repeat center center;"'; } ?>>user</a>
							<div class="community-tooltip"></div>
						<?php }else{ ?>
							<a id="comm-mob-menu" class="user-btn" style="display:none;">
						<?php } ?>
                     
						<?php
                        // Check to see if the header image has been removed
                        $header_image = get_header_image();
                        if ( ! empty( $header_image ) ) :
                    ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <?php
                            // The header image
                            // Check if this is a post or page, if it has a thumbnail, and if it's a big one
                            if ( is_singular() &&
                                    has_post_thumbnail( $post->ID ) &&
                                    ( /* $src, $width, $height */ $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), array( HEADER_IMAGE_WIDTH, HEADER_IMAGE_WIDTH ) ) ) &&
                                    $image[1] >= HEADER_IMAGE_WIDTH ) :
                                // Houston, we have a new header image!
                                echo get_the_post_thumbnail( $post->ID, 'post-thumbnail' );
                            else : ?>
                            <img src="<?php header_image(); ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="" />
                        <?php endif; // end check for featured image or standard header ?>
                    </a>
                    <?php endif; // end check for removed header image ?>

                    <?php
                        // Has the text been hidden?
                        if ( 'blank' == get_header_textcolor() ) :
                    ?>
                        <div class="only-search<?php if ( ! empty( $header_image ) ) : ?> with-image<?php endif; ?>">
                        <?php parent_theme_get_search_form(); ?>
                        </div>
                    <?php
                        else :
                    ?>
					<a href="#" class="open-search jq-open-search">search</a>
					<div id="subscribe-area" class="widget widget_text header-elements">
						<div class="subscribe-box">
						    <div class="clearfix">
						        <div class="journal">
						        <img src="<?php echo $magazine_img; ?>" alt="Subscribe">
						    </div>

						    <div class="subscribe-now">
								<span><?php print $deal_copy;?></span>
								<a href="<?php print $subs_link . get_option("header_key"); ?>" target="_blank" class="btn-base">Subscribe <span>Now!</span></a>
								<ul class="subscribe-links">
							        <li><a href="<?php print $gift_link;?>" target="_blank">Give a Gift <span>&raquo;</span></a></li>
							        <li><a href="<?php print $service_link; ?>" target="_blank">Subscriber Services <span>&raquo;</span></a></li>
							    </ul>
						    </div>
						    </div>
						</div>
					</div>
					<?php endif; ?>
                </div><!-- #branding -->
                <div class="clearfix">
	                	<div class="menu-top-menu-container subscribe-left">
							<ul class="menu">
								<li class="menu-item"><a href="<?php echo $subs_link . get_option("menu_key"); ?>" target="_blank">Subscribe!</a></li>
							</ul>
						</div>
                	<?php
					if(has_nav_menu( 'top' )){
                    	wp_nav_menu(array(
	                        'menu_class'=>'menu',
	                        'theme_location'=>'top',
						));  
                    } ?>
                <!-- #access -->
                </div>
				<div class="sn-menu">
                    <?php
                    wp_nav_menu(array(
                        'menu_class'=>'menu',
                        'theme_location'=>'bottom',
                        'walker'=> new AddParentClass_Walker()
                    ));   ?>
                <!-- #access -->
                <div class="h-mdl-widget">
                    <div class="socials-hold">
                    	<?php social_networks(); ?>
					</div>
                    <div class="h-search-form">
                        <?php parent_theme_get_search_form(); ?>
                    </div>
                </div>
			</div>
        </div><!-- #branding -->
		<div class="content-banner-section">
			<div class="mob-mdl-banner">
					<?php imo_ad_placement("320_atf"); ?>
				</div>
				<div class="mdl-banner">
					<?php 
					imo_ad_placement("leaderboard"); 
					imo_ad_placement("billboard"); 
					?>
			</div>
        </div>
        <div id="main" class="main clearfix js-responsive-layout">
<?php

define("JETPACK_SITE", "gamefish");
define("DARTADGEN_SITE", "imo.gameandfish");
define("USE_IFRAME_ADS",FALSE);
define("SUBS_LINK", "http://subs.gameandfishmag.com/");
define("GIFT_LINK", "http://subs.gameandfishmag.com/gift");
define("SERVICE_LINK", "https://secure.palmcoastd.com/pcd/eServ?iServ=MDE0ODg0NDcwNSZpVHlwZT1FTlRFUg==");
define("SUBS_DEAL_STRING", "Save Over 70% off<br/> the Cover Price");

define("FACEBOOK_LINK", "https://www.facebook.com/GameAndFish");

/* This function allows for logging when debugging mode is on */
if(!function_exists('_log')){
  function _log( $message ) {
    if( WP_DEBUG === true ){
      if( is_array( $message ) || is_object( $message ) ){
        error_log( print_r( $message, true ) );
      } else {
        error_log( $message );
      }
    }
  }
}

function imo_sidebar($type){
	//Speed up mobile load time by not loading sidebar in the background
	if(!mobile()){
		$dartDomain = get_option("dart_domain", $default = false);
		echo '<div class="sidebar-area">';
			echo '<div class="sidebar">';
				echo '<div class="widget_advert-widget">';
				imo_dart_tag("300x250");
				echo '</div>';
			echo '</div>';
		    get_sidebar($type);
			    	echo '<div id="responderfollow"></div>';
					echo '<div class="sidebar advert">';
			    	echo '<iframe src="//www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2FGameAndFish&amp;width=300&amp;height=75&amp;colorscheme=light&amp;show_faces=false&amp;border_color=%23DDDDDD&amp;stream=false&amp;header=false&amp;appId=218070564894418" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:300px; height:75px;" allowTransparency="true"></iframe>';
						echo '<div class="widget_advert-widget">';
							echo '<iframe id="sticky-iframe-ad" width="310" height="250" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no" src="/iframe-ad-sticky.php?ad_code='.$dartDomain.'"></iframe>';
						echo '</div>';
					echo '</div>';
				
		echo '</div>';
	}
}

function social_networks(){
	echo '<div class="socials">';
		echo '<a href="https://www.twitter.com/@gameandfishmag" class="twitter">Twitter</a>';
	    echo '<a href="http://www.youtube.com/user/InFishermanTV" class="youtube">YouTube</a>';
	    echo '<a href="http://www.gameandfishmag.com/feed" class="rss">RSS</a>';
	    echo '<div class="fb-like" data-href="' . FACEBOOK_LINK . '" data-send="false" data-layout="button_count" data-width="100" data-show-faces="true"></div>';
	echo '</div>';
}

function sub_footer(){ ?>
	<div class="sub-boxes">
		<div class="sub-box banner-box">
			<?php imo_dart_tag("300x250",array("pos"=>"mid")); ?>
			</div>
			<div class="sub-box fb-box">
			<div class="fb-recommendations" data-site="gameandfishmag.com" data-width="309" data-height="252" data-header="true" data-font="arial"></div>
		</div>
	</div>

	<div class="foot-social clearfix">
		<strong class="social-title">Like us on Facebook to <span>stay updated !</span></strong>
		<div class="fb-like" data-href="<?php echo FACEBOOK_LINK; ?>" data-send="false" data-layout="button_count" data-width="100" data-show-faces="true"></div>
		<?php social_networks(); ?>
	</div>
	<a href="/newsletter-signup" class="get-newsletter">Get the Game & Fish <br />Newsletter</a>
	<a href="<?php print SUBS_LINK;?>" class="subscribe-banner">
		<img src="<?php bloginfo('stylesheet_directory'); ?>/images/pic/subscribe-banner.jpg" alt="" />
	</a>
	<a href="#" class="back-top jq-go-top">back to top</a>
<?php }

function social_footer(){ ?>
	<div class="foot-social clearfix">
		<strong class="social-title">Like us on Facebook to <span>stay updated !</span></strong>
		<div class="fb-like" data-href="<?php echo FACEBOOK_LINK; ?>" data-send="false" data-layout="button_count" data-width="100" data-show-faces="true"></div>
		<?php social_networks(); ?>
	</div>
<?php }



//Configure infish community
//This section does nothing unless imo-community plugin is enabled
add_action("init","infish_community_init",0);
function infish_community_init() {

	//////////////////////////////////
	//Community Configuration
	//////////////////////////////////

	//This Post Types array is used in multiple configurations
	$inFishPostTypes = array(

		"bass" => array(
			"display_name" => "Bass",
			"post_list_style" => "tile"
		),

		"panfish" => array(
			"display_name" => "Panfish",
			"post_list_style" => "tile"
		),

		"pike" => array(
			"display_name" => "Pike",
			"post_list_style" => "tile"
		),

		"muskie" => array(
			"display_name" => "Muskie",
			"post_list_style" => "tile"
		),

		"trout" => array(
			"display_name" => "Trout",
			"post_list_style" => "tile"
		),
		"salmon" => array(
			"display_name" => "Salmon",
			"post_list_style" => "tile"
		),
		"walleye" => array(
			"display_name" => "Walleye",
			"post_list_style" => "tile"
		),

		"carp" => array(
			"display_name" => "Carp",
			"post_list_style" => "tile"
		),

		"paddlefish" => array(
			"display_name" => "Paddlefish",
			"post_list_style" => "tile"
		),
		"walleye" => array(
			"display_name" => "Walleye",
			"post_list_style" => "tile"
		),

		"burbot" => array(
			"display_name" => "Burbot",
			"post_list_style" => "tile"
		)
	);

	
	//External Community Configurations
	include("community-config/new-post.php");
	include("community-config/single.php");

	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//NOTE: Configuration order matters! More specific URLs should appear before less specific urls on the same path.
	// For example, the "single" page_type below needs to appear before "listing" page type on the same path.
	//Also, solunar-calendar-mobile should appear before solunar-calendar
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



	///////////////////////////////////////////
	//Underscore Testing Page Configuration
	///////////////////////////////////////////
	$IMO_COMMUNITY_CONFIG = NULL;
	$IMO_COMMUNITY_CONFIG['community_home_slug'] = "underscore_test";//This slug will override ANY setting in wordpress.
	$IMO_COMMUNITY_CONFIG['page_title'] = "Underscore"; //On single pages, title is taken from Post
	$IMO_COMMUNITY_CONFIG['template'] = '/infish/underscore-test.php';
	$IMO_COMMUNITY_CONFIG['dart_page'] = 'infish_community';
	$IMO_COMMUNITY_CONFIG['dart_sect'] = 'infishcommunity';
	$IMO_COMMUNITY_CONFIG['post_types'] = $inFishPostTypes;


	$IMO_COMMUNITY_CONFIG['additional_scripts'] = array(
		//Third Part Scripts
		array(
			"script-name" => "underscore-js",
			"script-path" => "js/underscore-min.js",
			"script-dependencies" => array('jquery')
		),
		array(
			"script-name" => "underscore-testing-js",
			"script-path" => "infish/js/underscore-test.js",
			"script-dependencies" => array('jquery',"underscore-js")
		)
	);


	global $IMO_COMMUNITY;
	$IMO_COMMUNITY['underscore-test'] = $IMO_COMMUNITY_CONFIG;


	///////////////////////////////////////////
	//Profile Community Page Configuration
	///////////////////////////////////////////
	$IMO_COMMUNITY_CONFIG = NULL;
	$IMO_COMMUNITY_CONFIG['community_home_slug'] = "profile";//This slug will override ANY setting in wordpress.
	$IMO_COMMUNITY_CONFIG['page_type'] = 'profile';
	$IMO_COMMUNITY_CONFIG['page_title'] = 'User Profile';
	$IMO_COMMUNITY_CONFIG['template'] = '/infish/profile.php';
	$IMO_COMMUNITY_CONFIG['dart_page'] = 'infish_community';
	$IMO_COMMUNITY_CONFIG['dart_sect'] = 'infishcommunity';
	$IMO_COMMUNITY_CONFIG['post_types'] = $inFishPostTypes;


	$IMO_COMMUNITY_CONFIG['additional_scripts'] = array(
		//Third Part Scripts
		array(
			"script-name" => "underscore-js",
			"script-path" => "js/underscore-min.js",
			"script-dependencies" => array('jquery')
		),
		array(
			"script-name" => "timeago-js",
			"script-path" => "js/jquery.timeago.js",
			"script-dependencies" => array('jquery')
		),
		array(
			"script-name" => "community-common-js",
			"script-path" => "infish/js/community-common.js",
			"script-dependencies" => array('jquery')
		),
		array(
			"script-name" => "community-profile-js",
			"script-path" => "infish/js/community-profile.js",
			"script-dependencies" => array('jquery')
		)
	);

	$IMO_COMMUNITY_CONFIG['additional_styles'] = array(
		array(
			"style-name" => "community-common-css",
			"style-path" => "infish/css/community-common.css",
			"style-dependencies" => null
		),
		array(
			"style-name" => "community-profile-css",
			"style-path" => "infish/css/community-profile.css",
			"style-dependencies" => array('community-common-css')
		)
	);

	global $IMO_COMMUNITY;
	$IMO_COMMUNITY['community-profile'] = $IMO_COMMUNITY_CONFIG;


	///////////////////////////////////////////
	//Edit Profile Community Page Configuration
	///////////////////////////////////////////
	$IMO_COMMUNITY_CONFIG = NULL;
	$IMO_COMMUNITY_CONFIG['community_home_slug'] = "profile";//This slug will override ANY setting in wordpress.
	$IMO_COMMUNITY_CONFIG['page_type'] = 'profile-edit';
	$IMO_COMMUNITY_CONFIG['page_title'] = 'Edit Profile';
	$IMO_COMMUNITY_CONFIG['template'] = '/infish/profile-edit.php';
	$IMO_COMMUNITY_CONFIG['dart_page'] = 'infish_community';
	$IMO_COMMUNITY_CONFIG['dart_sect'] = 'infishcommunity';
	$IMO_COMMUNITY_CONFIG['post_types'] = $inFishPostTypes;


	$IMO_COMMUNITY_CONFIG['additional_scripts'] = array(
		//Third Part Scripts
		array(
			"script-name" => "underscore-js",
			"script-path" => "js/underscore-min.js",
			"script-dependencies" => array('jquery')
		),
		array(
			"script-name" => "community-common-js",
			"script-path" => "infish/js/community-common.js",
			"script-dependencies" => array('jquery')
		),
		array(
			"script-name" => "community-profile-edit-js",
			"script-path" => "infish/js/community-profile.js",
			"script-dependencies" => array('jquery')
		)
	);

	$IMO_COMMUNITY_CONFIG['additional_styles'] = array(
		array(
			"style-name" => "community-common-css",
			"style-path" => "infish/css/community-common.css",
			"style-dependencies" => null
		),
		array(
			"style-name" => "community-profile-edit-css",
			"style-path" => "infish/css/community-profile.css",
			"style-dependencies" => array('community-common-css')
		)
	);

	global $IMO_COMMUNITY;
	$IMO_COMMUNITY['community-profile-edit'] = $IMO_COMMUNITY_CONFIG;


	///////////////////////////////////////////
	//Main Community Page Configuration
	///////////////////////////////////////////
	$IMO_COMMUNITY_CONFIG = NULL;
	$IMO_COMMUNITY_CONFIG['community_home_slug'] = "photos";//This slug will override ANY setting in wordpress.
	$IMO_COMMUNITY_CONFIG['page_type'] = 'listing';
	$IMO_COMMUNITY_CONFIG['page_title'] = 'FishHeads';
	$IMO_COMMUNITY_CONFIG['template'] = '/infish/listing.php';
	$IMO_COMMUNITY_CONFIG['dart_page'] = 'infish_community';
	$IMO_COMMUNITY_CONFIG['dart_sect'] = 'infishcommunity';
	$IMO_COMMUNITY_CONFIG['post_types'] = $inFishPostTypes;

	$IMO_COMMUNITY_CONFIG['additional_scripts'] = array(
		//Third Part Scripts
		array(
			"script-name" => "underscore-js",
			"script-path" => "js/underscore-min.js",
			"script-dependencies" => array('jquery')
		),
		array(
			"script-name" => "community-common-js",
			"script-path" => "infish/js/community-common.js",
			"script-dependencies" => array('jquery')
		),
		array(
			"script-name" => "bootstrap-dropdown-js",
			"script-path" => "infish/js/bootstrap-dropdown.js",
			"script-dependencies" => array('jquery')
		),
		array(
			"script-name" => "community-listing-js",
			"script-path" => "infish/js/community-listing.js",
			"script-dependencies" => array('jquery',"bootstrap-dropdown-js")
		)
	);

	$IMO_COMMUNITY_CONFIG['additional_styles'] = array(
		array(
			"style-name" => "community-common-css",
			"style-path" => "infish/css/community-common.css",
			"style-dependencies" => null
		),
		array(
			"style-name" => "bootstrap-dropdown-css",
			"style-path" => "infish/css/bootstrap-dropdown.css",
			"style-dependencies" => null
		),
		array(
			"style-name" => "community-listing-css",
			"style-path" => "infish/css/community-listing.css",
			"style-dependencies" => array('community-common-css',"bootstrap-dropdown-css")
		)
	);

	global $IMO_COMMUNITY;
	$IMO_COMMUNITY['community-main'] = $IMO_COMMUNITY_CONFIG;

	
	///////////////////////////////////////////
	//Admin Page Testing
	///////////////////////////////////////////
	$IMO_COMMUNITY_CONFIG = NULL;
	$IMO_COMMUNITY_CONFIG['community_home_slug'] = "beta-community";//This slug will override ANY setting in wordpress.
	$IMO_COMMUNITY_CONFIG['page_title'] = 'Game & Fish Community';
	$IMO_COMMUNITY_CONFIG['template'] = '/templates/blank-template.php';
	$IMO_COMMUNITY_CONFIG['dart_page'] = 'infish_community';
	$IMO_COMMUNITY_CONFIG['dart_sect'] = 'infishcommunity';
	$IMO_COMMUNITY_CONFIG['post_types'] = $inFishPostTypes;

	$IMO_COMMUNITY_CONFIG['additional_scripts'] = array(
		//Third Part Scripts
		array(
			"script-name" => "underscore-js",
			"script-path" => "js/underscore-min.js",
			"script-dependencies" => array('jquery')
		),
		array(
			"script-name" => "backbone-js",
			"script-path" => "js/backbone-min.js",
			"script-dependencies" => array('jquery','underscore-js')
		),
		array(
			"script-name" => "form-params-js",
			"script-path" => "js/formParams.min.js",
			"script-dependencies" => array('jquery')
		),
		array(
			"script-name" => "filepicker-io-js",
			"script-path" => "js/filepicker.js",
			"script-dependencies" => array('jquery')
		),
		array(
			"script-name" => "imo-community-grid-js",
			"script-path" => "js/backgrid.min.js",
			"script-dependencies" => array('jquery','backbone-js','underscore-js')
		),
		//Application specific scripts
		array(
			"script-name" => "imo-community-common",
			"script-path" => "js/common.js",
			"script-dependencies" => array('jquery','backbone-js','underscore-js')
		),
		array(
			"script-name" => "imo-community-models",
			"script-path" => "js/models.js",
			"script-dependencies" => array('jquery','backbone-js','underscore-js','imo-community-common')
		),
		array(
			"script-name" => "imo-community-mod",
			"script-path" => "js/mod2.js",
			"script-dependencies" => array('jquery','backbone-js','underscore-js','imo-community-models','imo-community-common')
		),
		array(
			"script-name" => "imo-community-community",
			"script-path" => "js/community.js",
			"script-dependencies" => array('jquery','backbone-js','underscore-js','imo-community-models','imo-community-common','imo-community-mod')
		),
		array(
			"script-name" => "imo-community-routes",
			"script-path" => "js/routes.js",
			"script-dependencies" => array('jquery','backbone-js','underscore-js','imo-community-community','imo-community-mod')
		),
		array(
			"script-name" => "backgrid-select-all",
			"script-path" => "js/backgrid-select-all.js",
			"script-dependencies" => array('jquery','backbone-js','underscore-js','imo-community-grid-js','custom.js','jquery.timeago.js')
		)

	);

	$IMO_COMMUNITY_CONFIG['additional_styles'] = array(
		array(
			"style-name" => "imo-community-stylesheet-main",
			"style-path" => "css/bootstrap.min.css",
			"style-dependencies" => null
		),
		array(
			"style-name" => "stylesheet_responsive",
			"style-path" => "css/bootstrap-responsive.css",
			"style-dependencies" => null
		),
		array(
			"style-name" => "imo-community-grid-css",
			"style-path" => "css/backgrid.min.css",
			"style-dependencies" => null
		),
		array(
			"style-name" => "styles-select-all",
			"style-path" => "css/styles-select-all.css",
			"style-dependencies" => array('custom.css')
		),
		array(
			"style-name" => "stylesheet_custom",
			"style-path" => "css/custom.css",
			"style-dependencies" => null
		)
	);

	global $IMO_COMMUNITY;
	$IMO_COMMUNITY['beta-community'] = $IMO_COMMUNITY_CONFIG;
	/////////////////////////////////////////////////



	//////////////////////////////////
	//Solunar Calendar iPad Embed config
	//////////////////////////////////
	$IMO_COMMUNITY_CONFIG = NULL;
	$IMO_COMMUNITY_CONFIG['community_home_slug'] = "solunar-calendar-ipad";//This slug will override ANY setting in wordpress.
	$IMO_COMMUNITY_CONFIG['page_title'] = 'Solunar Calendar';
	$IMO_COMMUNITY_CONFIG['template'] = '/solunar/solunar-template-minimal.php';
	$IMO_COMMUNITY_CONFIG['dart_page'] = 'solunar_calendar';
	$IMO_COMMUNITY_CONFIG['dart_sect'] = 'solunarcalendar';
	$IMO_COMMUNITY_CONFIG['post_types'] = null;
	$IMO_COMMUNITY_CONFIG['additional_scripts'] = array(
		array(
			"script-name" => "jquery-mousewheel-zf",
			"script-path" => "solunar/js/plugins/zfselect/js/jquery.mousewheel.js",
			"script-dependencies" => array('jquery')
		),
		array(
			"script-name" => "jquery-zfselect",
			"script-path" => "solunar/js/plugins/zfselect/js/jquery.zfselect.min.js",
			"script-dependencies" => array('jquery')
		),
		array(
			"script-name" => "jquery-carousel-fred",
			"script-path" => "solunar/js/plugins/carouFredSel/jquery.carouFredSel-6.2.0-packed.js",
			"script-dependencies" => array('jquery')
		),
		array(
			"script-name" => "lodash",
			"script-path" => "solunar/js/lodash.min.js",
			"script-dependencies" => array('jquery')
		),
		array(
			"script-name" => "solunar-googletag",
			"script-path" => "solunar/js/googletag.js",
			"script-dependencies" => null,
			"show-in-header" => true
		),
		array(
			"script-name" => "solunar-app",
			"script-path" => "solunar/js/script.js",
			"script-dependencies" => array('jquery','lodash','jquery-carousel-fred','jquery-zfselect','jquery-mousewheel-zf')
		),



	);

	$IMO_COMMUNITY_CONFIG['additional_styles'] = array(
		array(
			"style-name" => "solunar-base-css",
			"style-path" => "solunar/css/css-php.css",
			"style-dependencies" => null
		),
		array(
			"style-name" => "solunar-style-css",
			"style-path" => "solunar/css/styles.css?v=2",
			"style-dependencies" => null
		),
		array(
			"style-name" => "zfselect-css",
			"style-path" => "solunar/js/plugins/zfselect/css/zfselect.css",
			"style-dependencies" => null
		),
		array(
			"style-name" => "flexslider-css",
			"style-path" => "solunar/js/plugins/flexslider/flexslider.css",
			"style-dependencies" => null
		),
	);
	global $IMO_COMMUNITY;
	$IMO_COMMUNITY['solunar-calendar-ipad'] = $IMO_COMMUNITY_CONFIG;
	/////////////////////////////////////////////////
	/////////////////////////////////////////////////




	//////////////////////////////////
	//Mobile Solunar Calendar config
	//////////////////////////////////
	$IMO_COMMUNITY_CONFIG = NULL;
	$IMO_COMMUNITY_CONFIG['community_home_slug'] = "solunar-calendar-mobile";//This slug will override ANY setting in wordpress.
	$IMO_COMMUNITY_CONFIG['page_title'] = 'Best Times';
	$IMO_COMMUNITY_CONFIG['template'] = '/solunar-mobile/solunar-template-mobile.php';
	$IMO_COMMUNITY_CONFIG['dart_page'] = 'solunar_calendar';
	$IMO_COMMUNITY_CONFIG['dart_sect'] = 'solunarcalendar';
	$IMO_COMMUNITY_CONFIG['post_types'] = null;

	global $IMO_COMMUNITY;

	$IMO_COMMUNITY['solunar-calendar-mobile'] = $IMO_COMMUNITY_CONFIG;
	/////////////////////////////////////////////////



	//////////////////////////////////
	//Solunar Calendar config
	//////////////////////////////////
	$IMO_COMMUNITY_CONFIG = NULL;
	$IMO_COMMUNITY_CONFIG['community_home_slug'] = "solunar-calendar";//This slug will override ANY setting in wordpress.
	$IMO_COMMUNITY_CONFIG['page_title'] = 'Solunar Calendar';
	$IMO_COMMUNITY_CONFIG['template'] = '/solunar/solunar-template.php';
	$IMO_COMMUNITY_CONFIG['post_types'] = null;
	$IMO_COMMUNITY_CONFIG['dart_page'] = 'solunar_calendar';
	$IMO_COMMUNITY_CONFIG['dart_sect'] = 'solunarcalendar';
	$IMO_COMMUNITY_CONFIG['additional_scripts'] = array(
		array(
			"script-name" => "jquery-mousewheel-zf",
			"script-path" => "solunar/js/plugins/zfselect/js/jquery.mousewheel.js",
			"script-dependencies" => array('jquery')
		),
		array(
			"script-name" => "jquery-zfselect",
			"script-path" => "solunar/js/plugins/zfselect/js/jquery.zfselect.min.js",
			"script-dependencies" => array('jquery')
		),
		array(
			"script-name" => "jquery-carousel-fred",
			"script-path" => "solunar/js/plugins/carouFredSel/jquery.carouFredSel-6.2.0-packed.js",
			"script-dependencies" => array('jquery')
		),
		array(
			"script-name" => "lodash",
			"script-path" => "solunar/js/lodash.min.js",
			"script-dependencies" => array('jquery')
		),
		array(
			"script-name" => "solunar-googletag",
			"script-path" => "solunar/js/googletag.js",
			"script-dependencies" => null,
			"show-in-header" => true
		),
		array(
			"script-name" => "solunar-app",
			"script-path" => "solunar/js/script.js",
			"script-dependencies" => array('jquery','lodash','jquery-carousel-fred','jquery-zfselect','jquery-mousewheel-zf')
		),

	);

	$IMO_COMMUNITY_CONFIG['additional_styles'] = array(
		array(
			"style-name" => "solunar-base-css",
			"style-path" => "solunar/css/css-php.css",
			"style-dependencies" => null
		),
		array(
			"style-name" => "solunar-style-css",
			"style-path" => "solunar/css/styles.css?v=2",
			"style-dependencies" => null
		),
		array(
			"style-name" => "zfselect-css",
			"style-path" => "solunar/js/plugins/zfselect/css/zfselect.css",
			"style-dependencies" => null
		),
		array(
			"style-name" => "flexslider-css",
			"style-path" => "solunar/js/plugins/flexslider/flexslider.css",
			"style-dependencies" => null
		),
	);
	global $IMO_COMMUNITY;
	$IMO_COMMUNITY['solunar-calendar'] = $IMO_COMMUNITY_CONFIG;
	/////////////////////////////////////////////////
	/////////////////////////////////////////////////






}


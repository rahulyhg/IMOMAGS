<?php
	///////////////////////////////////////////
	//Community Single Post Page Configuration
	///////////////////////////////////////////
	$IMO_COMMUNITY_CONFIG = NULL;
	$IMO_COMMUNITY_CONFIG['community_home_slug'] = "photos";//This slug will override ANY setting in wordpress.
	$IMO_COMMUNITY_CONFIG['page_type'] = 'nested-single';
	$IMO_COMMUNITY_CONFIG['page_title'] = "Community Post"; //On single pages, title is taken from Post
	$IMO_COMMUNITY_CONFIG['template'] = '/gameandfish/single.php';
	$IMO_COMMUNITY_CONFIG['dart_page'] = 'gf_community';
	$IMO_COMMUNITY_CONFIG['dart_sect'] = 'gfcommunity';
	$IMO_COMMUNITY_CONFIG['post_types'] = $gfPostTypes;


	$IMO_COMMUNITY_CONFIG['additional_scripts'] = array(
		//Third Part Scripts
		array(
			"script-name" => "community-common-js",
			"script-path" => "gameandfish/js/community-common.js",
			"script-dependencies" => array('jquery')
		),
		array(
			"script-name" => "community-single-js",
			"script-path" => "gameandfish/js/community-single.js",
			"script-dependencies" => array('jquery',"form-params-js")
		),
		array(
			"script-name" => "jquery-mousewheel-js",
			"script-path" => "gameandfish/js/zfselect/js/jquery.mousewheel.js",
			"script-dependencies" => array('jquery')
		),
		array(
			"script-name" => "form-params-js",
			"script-path" => "js/formParams.min.js",
			"script-dependencies" => array('jquery')
		),
		array(
			"script-name" => "zfselect-js",
			"script-path" => "gameandfish/js/zfselect/js/jquery.zfselect.min.js",
			"script-dependencies" => array('jquery')
		),
		array(
			"script-name" => "community-single-js",
			"script-path" => "gameandfish/js/community-single.js",
			"script-dependencies" => array('jquery',"form-params-js","community-common-js")
		)
	);

	$IMO_COMMUNITY_CONFIG['additional_styles'] = array(
		array(
			"style-name" => "community-common-css",
			"style-path" => "gameandfish/css/community-common.css",
			"style-dependencies" => null
		),
		array(
			"style-name" => "community-single-css",
			"style-path" => "gameandfish/css/community-single.css",
			"style-dependencies" => array('community-common-css')
		),
		array(
			"style-name" => "zfselect-css",
			"style-path" => "gameandfish/js/zfselect/css/zfselect.css",
			"style-dependencies" => array('community-common-css')
		)
	);

	global $IMO_COMMUNITY;
	$IMO_COMMUNITY['photo-single'] = $IMO_COMMUNITY_CONFIG;
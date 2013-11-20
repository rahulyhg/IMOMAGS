<?php

///////////////////////////////////////////
//Community Single Post Page Configuration
///////////////////////////////////////////
$IMO_COMMUNITY_CONFIG = NULL;
$IMO_COMMUNITY_CONFIG['community_home_slug'] = "photos/new";//This slug will override ANY setting in wordpress.
$IMO_COMMUNITY_CONFIG['page_title'] = "New Post";
$IMO_COMMUNITY_CONFIG['template'] = '/infish/new-post.php';
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
		"script-dependencies" => array('jquery',"underscore-js")
	),
	array(
		"script-name" => "master-angler-data-js",
		"script-path" => "infish/js/master-angler-data.js",
		"script-dependencies" => array('jquery',"underscore-js")
	),
	array(
		"script-name" => "form-params-js",
		"script-path" => "js/formParams.min.js",
		"script-dependencies" => array('jquery')
	),
	array(
		"script-name" => "bootstrap-dropdown-js",
		"script-path" => "infish/js/bootstrap-dropdown.js",
		"script-dependencies" => array('jquery')
	),
	array(
		"script-name" => "community-new-post-js",
		"script-path" => "infish/js/community-new-post.js",
		"script-dependencies" => array('jquery',"underscore-js","community-common-js","form-params-js","bootstrap-dropdown-js","master-angler-data-js")
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
		"style-name" => "gravity-forms-copy-css",
		"style-path" => "infish/css/forms.css",
		"style-dependencies" => null
	),
	array(
		"style-name" => "community-new-post-css",
		"style-path" => "infish/css/community-new-post.css",
		"style-dependencies" => array('community-common-css',"bootstrap-dropdown-css")
	)
);

global $IMO_COMMUNITY;
$IMO_COMMUNITY['community-new-post'] = $IMO_COMMUNITY_CONFIG;

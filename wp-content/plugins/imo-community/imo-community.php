<?php
/*
 * Plugin Name: IMO Community
 * Plugin URI: http://github.com/imoutdoors
 * Description: Provides a framework for deploying and maintaining communities
 * Version: 0.1
 * Author: aaron baker
 * Author URI: http://imomags.com
 */
 
$IMO_COMMUNITY_CONFIG['community_home_slug'] = "crown-royal-contest";//This slug will override ANY setting in wordpress.
$IMO_COMMUNITY_CONFIG['template'] = '/templates/default-template.php';
$IMO_COMMUNITY_CONFIG['stylesheet'] = 'css/bootstrap.min.css';
$IMO_COMMUNITY_CONFIG['page_title'] = 'Community';

add_action('template_redirect', 'imo_community_template');
add_filter( 'wp_title', 'imo_community_set_title', 0, 3 );


function imo_community_template() {


	global $IMO_COMMUNITY_CONFIG;

     $matchString = "/^\/" . $IMO_COMMUNITY_CONFIG['community_home_slug'] . "(\?(.+)?)?$/";
     
     if (preg_match($matchString, $_SERVER['REQUEST_URI'])) {
     
     
     	//Third Party libraries
		wp_enqueue_script('underscore-js', plugins_url('js/underscore-min.js', __FILE__), array('jquery'), '1.0','true');
		wp_enqueue_script('backbone-js', plugins_url('js/backbone-min.js', __FILE__), array('jquery','underscore-js'), '1.0','true');
		wp_enqueue_script('form-params-js', plugins_url('js/formParams.min.js', __FILE__), array('jquery'), '1.0','true');
		wp_enqueue_script('filepicker-io-js', plugins_url('js/filepicker.js', __FILE__), array('jquery'), '1.0','true');
		
		//Organized Backbone Scripts
		wp_enqueue_script('imo-community-common', plugins_url('js/common.js', __FILE__), array('jquery','backbone-js','underscore-js'), '1.0','true');
		wp_enqueue_script('imo-community-models', plugins_url('js/models.js', __FILE__), array('jquery','backbone-js','underscore-js','imo-community-common'), '1.0','true');
		wp_enqueue_script('imo-community-mod', plugins_url('js/mod.js', __FILE__), array('jquery','backbone-js','underscore-js','imo-community-models','imo-community-common'), '1.0','true');
		//This is the one with most of the logic:
		wp_enqueue_script('imo-community-community', plugins_url('js/community.js', __FILE__), array('jquery','backbone-js','underscore-js','imo-community-models','imo-community-common','imo-community-mod'), '1.0','true');
		wp_enqueue_script('imo-community-routes', plugins_url('js/routes.js', __FILE__), array('jquery','backbone-js','underscore-js','imo-community-community','imo-community-mod'), '1.0','true');
		
		//And the CSS
		wp_enqueue_style('bootstrap-css',plugins_url( $IMO_COMMUNITY_CONFIG['stylesheet'] , __FILE__));
		

	    imo_include_wordpress_template(dirname( __FILE__ ) . $IMO_COMMUNITY_CONFIG['template'] );
	    exit;
     }
     
  
}

function imo_community_set_title($title,$sep,$seplocation) {

	global $IMO_COMMUNITY_CONFIG;

	$matchString = "/^\/" . $IMO_COMMUNITY_CONFIG['community_home_slug'] . "(\?(.+)?)?$/";

	if (preg_match($matchString, $_SERVER['REQUEST_URI'])) {
     
     	$title = $IMO_COMMUNITY_CONFIG['page_title'];
     }
	
	return $title;
}



function imo_include_wordpress_template($t) {
    global $wp_query;
    if ($wp_query->is_404) {
        $wp_query->is_404 = false;
        $wp_query->is_archive = true;
    }
    header("HTTP/1.1 200 OK");
    include($t);
}





<?php
/*  Copyright 2012 Aaron Baker*/
/*
Plugin Name: IMO Facebook Auth
Plugin URI: http://imomags.com
Description: Adds facebook PHP & Javascript SDKs and another tools for facebook authentication
Author: aaron
Author URI:
Version: 0.1
Stable tag: 0.1
License: IMO
*/

/********************************
*******LOAD SCRIPTS & SDKs*******
*********************************/

add_action('init', 'imo_facebook_auth_setup');
function imo_facebook_auth_setup() {

    require 'src/facebook.php';
    wp_enqueue_script('jquery-timeago',plugins_url('js/facebook-auth.js', __FILE__));

}

/********************************
**********JSON RESPONSES*********
*********************************/

function imo_facebook_usercheck() {

    if (preg_match("/^\/facebook-usercheck\.json(\?(.+)?)?$/", $_SERVER['REQUEST_URI'])) {
        header('Content-type: application/json');


        $facebook = new Facebook(array(
		  'appId'  => '127971893974432',
		  'secret' => '998a58347d730b52dd2bac877180bedd',
		));

		// Get FB User ID
		$user = $facebook->getUser();

		if ($user) {
		  try {
		    // Proceed knowing you have a logged in user who's authenticated.
		    $user_profile = $facebook->api('/me');
		  } catch (FacebookApiException $e) {
		    error_log($e);
		    $user = null;
		  }
		}

		$email = $user_profile['email'];

		_log($user_profile);

		$json = json_encode("NO USER EXISTS");


		//Check if user already exists
        if ($user = get_user_by("email",$email)) {//if yes, log them in
        	wp_authenticate("facebook","dgrsvgqt4523facebook");
        	$json = json_encode($user);
        } else { //if not, register the user

        	$userdata = array();
        	$userdata['user_email'] = $email;
        	$userdata['first_name'] = $user_profile['first_name'];
        	$userdata['last_name'] = $user_profile['last_name'];
        	$userdata['display_name'] = $user_profile['first_name'] . " " . $user_profile['last_name'];
        	$userdata['user_login'] = strtolower($user_profile['first_name']) . strtolower($user_profile['last_name']) . rand(100,999);
        	$userdata['user_pass'] = imo_facebook_generate_password();

        	_log("User Inserted?");

       		$userID = wp_insert_user($userdata);
       		wp_set_auth_cookie($userID,true);

       		$json = json_encode($userdata);

        }

        

        print $json;
        //print_r($user_profile);
        die();
    } 


}

add_action("init", "imo_facebook_usercheck");


function imo_facebook_generate_password($length=9, $strength=0) {
	$vowels = 'aeuy23456789';
	$consonants = 'bdghjmnpqrstvz';
 
	$password = '';
	$alt = time() % 2;
	for ($i = 0; $i < $length; $i++) {
		if ($alt == 1) {
			$password .= $consonants[(rand() % strlen($consonants))];
			$alt = 0;
		} else {
			$password .= $vowels[(rand() % strlen($vowels))];
			$alt = 1;
		}
	}
	return $password;
}
 


/********************************
******AUTHENTICATION PLUGGABLE******
*********************************/
if ( !function_exists('wp_authenticate') ) :
/**
 * Checks a user's login information and logs them in if it checks out.
 *
 * @since 2.5.0
 *
 * @param string $username User's username
 * @param string $password User's password
 * @return WP_Error|WP_User WP_User object if login successful, otherwise WP_Error object.
 */
function wp_authenticate($username, $password) {
	$username = sanitize_user($username);
	$password = trim($password);

	$user = apply_filters('authenticate', null, $username, $password);



	$ignore_codes = array('empty_username', 'empty_password');


	//Check if facebook!
	if ($username == "facebook" && $password == "dgrsvgqt4523facebook") {

		$facebook = new Facebook(array(
		  'appId'  => '127971893974432',
		  'secret' => '998a58347d730b52dd2bac877180bedd',
		));

		// Get FB User ID
		$user = $facebook->getUser();

		if ($user) {
		  try {
		    // Proceed knowing you have a logged in user who's authenticated.
		    $user_profile = $facebook->api('/me');
		  } catch (FacebookApiException $e) {
		    error_log($e);
		    $user = null;
		  }
		}

		$email = $user_profile['email'];	
		$user = get_user_by("email",$email);

		wp_set_auth_cookie($user->ID,true);


	}

	if ( $user == null ) {
		// TODO what should the error message be? (Or would these even happen?)
		// Only needed if all authentication handlers fail to return anything.
		$user = new WP_Error('authentication_failed', __('<strong>ERROR</strong>: Invalid username or incorrect password.'));
	}

	if (is_wp_error($user) && !in_array($user->get_error_code(), $ignore_codes) ) {
		do_action('wp_login_failed', $username);
	}


	return $user;
}
endif;
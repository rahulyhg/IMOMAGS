<?php
/*
 * Plugin Name: IMO Dart Tags
 * Plugin URI: http://github.com/imoutdoors
 * Description: Basic doubleclick library for generating tags. 
 * Version: 0.1
 * Author: jacob angel 
 * Author URI: http://imomags.com
 */
include_once("AdvertWidget.php");
/**
 * returns a string containing the formatted dart tag.
 */
function get_imo_dart_tag($size, $tile=1, $iframe="false", $override_params=array()) {
    $params = array_merge(_imo_dart_get_params($size, $tile), $override_params);
    $tag = _imo_dart_get_tag($iframe);
    return _imo_dart_sprint_tag($params, $tag); 
}


/**
 * format the correct parameters based on the size and tile wanted.
 */
function _imo_dart_get_params($size, $tile) {
    // only allow proper sizes to be used; the names are only included
    // for referecee
    $sizes = array(
        "box-ad" => "300x250", "skyscraper" => "160x600", "leaderboard" => "728x90",
        "rectangle" => "180x150", "wide-skyscraper" => "300x600", "button2" => "120x60",
    );
    if ( !in_array($size, $sizes)) {
        $size = "300x250";
    }

    // grab the correct parameters
    $params = array(
        "domain" => get_option("dart_domain", _imo_dart_guess_domain()),
        "width"=> array_shift(explode("x", $size)),
        "height"=> array_pop(explode("x", $size)),
        "size" => $size,
        "tile" => $tile,
    );
    if (is_front_page()) {
        $params = array_merge( $params, array(
            "zone" => "home",
            "sect" => "home",
            "subs" => "",
            "page" => "index",)
        );
    }
    elseif (is_page()) {
    }
    elseif ( is_tax() || is_tag() || is_category() ) {
    }
    else {
        $params = array_merge( $params, array(
            "zone" => "misc",
            "sect" => "misc",
            "subs" => "",
            "page" => "index",)
        );  
    }
    return $params;
} 


/**
 * Return the correct tag structure.
 */
function _imo_dart_get_tag($iframe) {
    if ($iframe) 
    {
        $tag = '<iframe src="/iframe-advertisement.php?size=%1$s&zone=%2$s" frameBorder="0" width="%8$s" height="%9$s" scrolling="no" allowTransparency="true">';
        $tag .= _imo_dart_get_tag(false);
        $tag .="</iframe>";
    }
    else
    {
        $tag = '<!-- %1$s Ad: -->
            <script type="text/javascript">
document.write(unescape(\'%%3Cscript src="http://ad.doubleclick.net/adj/%2$s/%3$s;sect=%4$s;page=%6$s;subs=%5$s;sz=%1$s;dcopt=;tile=%7$s;ord=\'+dartadsgen_rand+\'?"%%3E%%3C/script%%3E\'));
    </script>
    <noscript>
        <a href="http://ad.doubleclick.net/adj/%2$s/%3$s;sect=%4$s;page=%6$s;subs=%5$s;sz=%1$s;dcopt=;tile=%7$s;ord=6545512368?">
            <img src="http://ad.doubleclick.net/ad/%2$s/%3$s;sect=%4$s;page=%6$s;subs=%5$s;sz=%1$s;dcopt=;tile=%7$s;ord=6545512368?" border="0" />
        </a>
    </noscript>
<!-- END %1$s Ad: -->';
    }
    return $tag;
}


function _imo_dart_sprint_tag($params, $tag) {
    return sprintf($tag, $params['size'], $params['domain'], $params['zone'], $params['sect'], $params['subs'],$params['page'], $params['tile'], $params['width'], $params['height']);
}
/**
 * Attempt to formulate a domain based on the currentiste domain.
 */
function _imo_dart_guess_domain() {
    if ($site = get_site_url()) {
        $domain = explode(".", substr($site, 7));
        $domain = "imo." . $domain[1];        
        if (substr($domain, -3)=="mag") {
            $domain = substr($domain, 0, -3);
        }
        return $domain;
    }
    else {
        return "imo.outdoorsbest";
    }
}

/**
 * prints the dart tag to the page.
 *
 * $size - size of the placement
 * $iframe - boolean - set to true or false depending on whether to generate an iframetag or normal tag.
 * $override_params: will be merged into params at the end, so that we can pass params to the iframe
 *
 */
function imo_dart_tag($size, $iframe="false", $override_params=array()) {
    static $tile = 0; 
    $tile++;
    print get_imo_dart_tag($size, $tile, $iframe, $override_params);
}


/**
 * Testing
 */
function imo_dart_run_tests() {
    $params = array(
        "domain" => get_option("dart_domain", _imo_dart_guess_domain()),
        "size" => "300x250",
        "tile" => 1,
        'height'=>250,
        'width' => 300,
        "zone" => "misc",
        "sect" => "misc",
        "subs" => "",
        "page" => "index",);
    echo _imo_dart_sprint_tag($params, _imo_dart_get_tag(False) );
    echo _imo_dart_sprint_tag($params, _imo_dart_get_tag(True) );
}

if (__FILE__ == $_SERVER['PWD'] . '/'. $_SERVER['SCRIPT_FILENAME']) { 
    if (! function_exists("get_option")) {
        function get_option($a, $b) {
            return $b;
        }
    }
    imo_dart_run_tests(); 
}


function iframe_maker () {
    if (preg_match("/^\/iframe-advert\.php(\?(.+)?)?$/", $_SERVER['REQUEST_URI'])) {
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="refresh" content="45">
    </head>
    <body style="margin:0px;border:0px;">
        <script type="text/javascript">
        var dartadsgen_rand = Math.floor((Math.random()) * 100000000), pr_tile = 1; 
        </script>
<?php
        $sizes = array(
            "box-ad" => "300x250", "skyscraper" => "160x600", "leaderboard" => "728x90",
            "rectangle" => "180x150", "wide-skyscraper" => "300x600", "button2" => "120x60",
        );
        $size=$_GET['size'];

        if ( !in_array($size, $sizes)) {
            $size = "300x250";
        }
        
        $params = array();
        if (isset($_GET['page'])) {
            $params["page"] = imo_dart_clean_tag($_GET['page']);
        }
        
if (isset($_GET['zone'])) {
            $params["zone"] = imo_dart_clean_tag($_GET['zone']);
        }
        
        imo_dart_tag($size, False, $params);
?>
    </body>
    </html>
<?php
        die();
    }
}


function imo_dart_clean_tag($string) {
    return preg_replace("/\s+/", '_', preg_replace("/[^a-z0-9 ]/", '', strtolower($string)));
}
add_action("init", "iframe_maker");

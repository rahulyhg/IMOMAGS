<?php
/*
Plugin Name: IMO Primary Category
Plugin URI: http://imomags.com/
Description: You can choose a Primary Category in posts.
Version: 1.00
Author: Fox Bowdem
Author URI: http://imomags.com/
*/

/**!
*
* I, Hikari, from http://Hikari.WS , and the original author of the Wordpress plugin named
* Hikari Category Permalink, please keep this license terms and credit me if you redistribute the plugin
*
*   This program is distributed in the hope that it will be useful,
*    but WITHOUT ANY WARRANTY; without even the implied warranty of
*    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*
/*****************************************************************************
* © Copyright Hikari (http://wordpress.Hikari.ws), 2010
* If you want to redistribute this script, please leave a link to
* http://hikari.WS
*
* Parts of this code are provided or based on ideas and/or code written by others
* Translations to different languages are provided by users of this script
* IMPORTANT CONTRIBUTIONS TO THIS SCRIPT (listed in alphabetical order):
*
** Hikari Category Permalink is a fork of Dmytro Shteflyuk's sCategory Permalink plugin < http://kpumuk.info/projects/wordpress-plugins/scategory-permalink/ >
** Nikolay Kolev < http://nikolay.com/ > developed the JavaScript UI software to manage category permalink in posts edit page.
*
* Please send a message to the address specified on the page of the script, for credits
*
* Other contributors' (nick)names may be provided in the header of (or inside) the functions
* SPECIAL THANKS to all contributors and translators of this script !
*****************************************************************************/

define('IMOprimaryCat_basename',plugin_basename(__FILE__));
define('IMOprimaryCat_pluginfile',__FILE__);

require_once 'imo-primary-category-tools.php';
require_once 'imo-primary-category-core.php';

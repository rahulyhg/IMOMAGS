<?php
/*  Copyright 2011 Aaron Baker

*/

/*
Plugin Name: IMO Add This
Plugin URI: https://imomags.com
Description: Use this code in templates:  if (function_exists('imo_add_this')) {imo_add_this();}
Author: aaron
Author URI:
Version: 0.1
Stable tag: 0.1
License: IMO
*/



function imo_add_this($print = true) {


	$output = '<!-- IMO AddThis Button BEGIN -->
<div addthis:url="' . get_permalink() . '" addthis:title="' . htmlentities(get_the_title()) . '" class="addthis_toolbox addthis_default_style ">
	<a class="addthis_button_facebook_like"fb:like:layout="button_count"></a>
	<a class="addthis_button_tweet"></a>
	<a class="addthis_button_google_plusone"g:plusone:size="medium"></a>
	<!--<a class="addthis_counter addthis_pill_style"></a>-->
</div>
<script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4de0e5f24e016c81"></script>
<script type="text/javascript">
addthis.addEventListener("addthis.menu.share", postShared);

function postShared(event) {


	if ($("#imo-add-this-spid").length > 0) {
		var postID = $("#imo-add-this-spid").text();

	$.post("/slim/api/post/flag", { post_id: postID, etype: "share", user_id: "0" },
   function(data) {

   });
	}




}

</script>
<!-- IMO AddThis Button END -->
';

	if ($print)
		print($output);
	else
		return $output;

}




function imo_add_this_for_this($url,$title,$print = true) {


	$output =  '<!-- IMO AddThis Button BEGIN -->
<div addthis:url="' . $url . '" addthis:title="' . $title . '" class="addthis_toolbox addthis_default_style ">
	<a class="addthis_button_facebook_like"fb:like:layout="button_count"></a>
	<a class="addthis_button_tweet"></a>
</div>
<script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4de0e5f24e016c81"></script>
<script type="text/javascript">
addthis.addEventListener("addthis.menu.share", postShared);

function postShared(event) {


	if ($("#imo-add-this-spid").length > 0) {
		var postID = $("#imo-add-this-spid").text();

		$.post("/slim/api/post/flag", { post_id: postID, etype: "share", user_id: "0" },
	   function(data) {

	   });
	}




}

</script>
<!-- IMO AddThis Button END -->
';

	if ($print)
		print($output);
	else
		return $output;
}



function imo_add_this_big() {


	print '<!-- IMO BIG AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
	<a class="addthis_button_facebook"><img src="/wp-content/themes/imo-mags-northamericanwhitetail/img/big-facebook.png" width="150" height="150" border="0" alt="Share on Facebook" /></a>
	<a class="addthis_button_twitter"><img src="/wp-content/themes/imo-mags-northamericanwhitetail/img/big-twitter.png" width="150" height="150" border="0" alt="Share on Twitter" /></a>

</div>
<script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4de0e5f24e016c81"></script>
<script type="text/javascript">
addthis.addEventListener("addthis.menu.share", postShared);

function postShared(event) {


	if ($("#imo-add-this-spid").length > 0) {
		var postID = $("#imo-add-this-spid").text();

	$.post("/slim/api/post/flag", { post_id: postID, etype: "share", user_id: "0" },
   function(data) {

   });
	}




}

</script>
<!-- IMO AddThis Button END -->
';
}

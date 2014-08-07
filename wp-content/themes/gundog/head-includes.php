<?php

/**
 *head-includes.php makes special things special.
 */

?>
<meta name="apple-itunes-app" content="app-id=582715169">
<!-- BEGIN Tynt Script -->
<script type="text/javascript">
if(document.location.protocol=='http:'){
 var Tynt=Tynt||[];Tynt.push('cv-SKkRaWr4y-6acwqm_6l');Tynt.i={"ap":"Read more:"};
 (function(){var s=document.createElement('script');s.async="async";s.type="text/javascript";s.src='http://tcr.tynt.com/ti.js';var h=document.getElementsByTagName('script')[0];h.parentNode.insertBefore(s,h);})();
}
</script>
<?php 
$id = get_the_ID();
$campaign = wp_get_post_terms($id,"campaign");
foreach($campaign as $c){
	$camp = $c->name;
}

if(is_home()){
	$term = "home";
}
else if (is_category()) {
	$cat = get_query_var('cat');
	$yourcat = get_category ($cat);
	$term = $yourcat->slug;

}
else if (is_single()) {
    global $the_ID;

    $post = get_queried_object();

    $categories = get_the_category($the_ID);

    $count = 0;
    foreach ($categories as $cat) {
    	$count++;
        $term .= $cat->name;
        if ($count != count($categories))
        	$term .= ",";
    }



    if ($post->post_type == "imo_caption_contest") {
        if ($term != "")
        	$term .= ",";
        $term .= "caption_contest";

    }

    if ($post->post_type == "imo_video") {
        if ($term != "")
        	$term .= ",";
        $term .= "video";

    }

    if ($post->post_type == "reviews"){
    	$terms = wp_get_post_terms( $post->ID, "guntype");

    	$count = 0;
    	foreach ($terms as $term) {
        	$count++;
	        $term .= $term->name;
	        if ($count != count($terms))
	        	$term .= ",";
        }

        if ($term != "")
        	$term .= ",";
        $term .= "post_type_review";

    }

    if (get_option("dart_domain") == "imo.floridasportsman") {

      $term_array = wp_get_post_terms($post->ID, "activity" );
      $term = $term_array[0]->slug;

      if ($term_array[0]->parent == 308 || $term_array[0]->term_id == 308)
        $term = "fishing";
      if ($term_array[0]->parent == 292 || $term_array[0]->term_id == 292)
        $term = "hunting";
      if ($term_array[0]->parent == 635 || $term_array[0]->term_id == 635)
        $term = "boating";
      if ($term_array[0]->parent == 637 || $term_array[0]->term_id == 637)
        $term = "conservation";
      if ($term_array[0]->parent == 636 || $term_array[0]->term_id == 636)
        $term = "cooking";
      if ($term_array[0]->parent == 634 || $term_array[0]->term_id == 634)
        $term = "diving";
      if ($term_array[0]->parent == 705 || $term_array[0]->term_id == 705)
        $term = "paddling";
    }

    $params = array(
       "sect" => $term,
    );

}
else if (is_page()) {
    global $post;
    $page = get_page($post->ID);
    $term = (isset($page->cat_name)) ? $page->cat_name : $page->post_name;
    $params = array(
        "sect" => $term,
    ); }
else if ( is_tax() || is_tag() || is_category() ) {
    if (is_category()) {
        $tax_title = single_cat_title('', False);
    }
    else {
        $tax_title = single_tag_title("", False);
    }
    $params = array(
        "sect" => $tax_title,
    ); 
}
else {
    $params = array(
        "sect" => "misc",
    );
}



   
?>
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
/*googletag.defineSlot('/4930/imo.gundog/<?php echo $term; ?>/breeds_Interstitial', [1, 1], 'div-1x1-interstitial').addService(googletag.pubads());
googletag.defineSlot('/4930/imo.gundog/<?php echo $term; ?>/breeds_Leaderboard_BTF', [728, 90], 'div-728x90-leaderboard').addService(googletag.pubads());
googletag.defineSlot('/4930/imo.gundog/<?php echo $term; ?>/breeds_Mobile_Adhesion', [320, 50], 'div-320x50-mobile-adhesion').addService(googletag.pubads());
googletag.defineSlot('/4930/imo.gundog/<?php echo $term; ?>/breeds_Mobile_Flex', [1, 1], 'div-1x1-mobile-flex').addService(googletag.pubads());
googletag.defineSlot('/4930/imo.gundog/<?php echo $term; ?>/breeds_Mobile_Leaderboard', [320, 50], 'div-320x50-mobile-leaderboard').addService(googletag.pubads());
googletag.defineSlot('/4930/imo.gundog/<?php echo $term; ?>/breeds_Pushdown', [[728, 90], [1080, 90]], 'div-pushdown').addService(googletag.pubads());*/
googletag.defineSlot('/4930/imo.gundog/<?php echo $term; ?>/<?php echo $term; ?>_Rectangle_ATF', [[300, 250], [300, 600]], 'div-300x50-rectangle-atf').addService(googletag.pubads());
/*googletag.defineSlot('/4930/imo.gundog/<?php echo $term; ?>/breeds_Rectangle_BTF', [[300, 250], [300, 600]], 'div-300x50-rectangle-btf').addService(googletag.pubads());
googletag.defineSlot('/4930/imo.gundog/<?php echo $term; ?>/breeds_Screenshift', [1, 1], 'div-1x1-screenshift').addService(googletag.pubads());
googletag.defineSlot('/4930/imo.gundog/<?php echo $term; ?>/breeds_Skin', [1, 1], 'div-1x1-skin').addService(googletag.pubads());
googletag.defineSlot('/4930/imo.gundog/<?php echo $term; ?>/breeds_SponsorLogo', [240, 60], 'div-240x60-sponsor').addService(googletag.pubads());
googletag.defineSlot('/4930/imo.gundog/<?php echo $term; ?>/breeds_Tablet_Flex', [1, 1], 'div-1x1-tablet-flex').addService(googletag.pubads());*/

googletag.pubads().setTargeting("sect","<?php echo $term; ?>");
googletag.pubads().setTargeting("camp","<?php echo $camp; ?>");
googletag.pubads().setTargeting("Audience segment","<?php echo $term; ?>");

googletag.pubads().enableSingleRequest();
googletag.pubads().enableVideoAds();
googletag.enableServices();
});
</script>

























<?php

/**
 * Template Name: report
 * Description: Community Rut Reports Page
 *
 * @package carrington-business
 *
 * This file is part of the Carrington Business Theme for WordPress
 * http://crowdfavorite.com/wordpress/themes/carrington-business/
 *
 * Copyright (c) 2008-2011 Crowd Favorite, Ltd. All rights reserved.
 * http://crowdfavorite.com
 *
 * **********************************************************************
 * This program is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * **********************************************************************
 */
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }

//Gallery Scripts
wp_enqueue_script('flexslider-js',plugins_url('imo-flex-gallery/jquery.flexslider.js'));
wp_enqueue_script('flex-gallery-js',plugins_url('imo-flex-gallery/flex-gallery.js'));
wp_enqueue_script('jquery-mobile',plugins_url('imo-flex-gallery/jquery.mobile.custom.min.js'));
wp_enqueue_script('jquery-ui-slide-effect',plugins_url('imo-flex-gallery/jquery-ui-slide-effect.min.js'));
wp_enqueue_script('jquery-scrollface',plugins_url('imo-flex-gallery/jquery.scrollface.min.js'));
wp_enqueue_script('jquery-buffet',plugins_url('imo-flex-gallery/jquery.buffet.min.js'));
wp_enqueue_script('jquery-mousewheel',plugins_url('imo-flex-gallery/jquery.mousewheel.min.js'));
wp_enqueue_script('perfect-scrollbar-js',plugins_url('imo-flex-gallery/perfect-scrollbar-0.4.3.with-mousewheel.min.js'));
wp_enqueue_style('ajax-gallery-css',plugins_url('imo-flex-gallery/flex-gallery.css','imo-flex-gallery'));
wp_enqueue_style('perfect-scrollbar-css',plugins_url('imo-flex-gallery/perfect-scrollbar-0.4.3.min.css'));

get_header();
imo_sidebar("community");

the_post();
$displayStyle = "display:none;";
$loginStyle = "";

if ( is_user_logged_in() ) {

	$displayStyle = "";
	$loginStyle = "display:none;";

	wp_get_current_user();

	$current_user = wp_get_current_user();
    if ( !($current_user instanceof WP_User) )
         return;
}


include 'common-templates.php';
$crop = "/convert?w=650&h=650&fit=crop&rotate=exif";
if(mobile()){
	$crop = "/convert?w=458&h=458&fit=crop&rotate=exif";
}

?>
<!-- *********************************************************** -->
<!-- ***************** UNDERSCORE TEMPLATE ********************* -->
<!-- *********************************************************** -->
<script type="text/template" id="post-template">
<%
if(post.score == 1){
	niceScore = post.score + ' Point';
}else{
	niceScore = post.score + ' Points';
}
%>
	<div class="dif-post">
       <% if(post.img_url){ %>
	        <div class="feat-img">
	            <a href="/community/<%= post.id %>"><img class="feat-img" src="<%= post.img_url %>" alt="<%= post.title %>" title="<%= post.img_url %>" /></a>
	        </div>
        <% }else{ %>
        	 <div class="feat-img">
	            <a href="/community/<%= post.id %>"><img class="feat-img" src="<?php echo plugins_url('images/crosshair.jpg' , __FILE__ ); ?>" alt="<%= post.title %>" title="<%= post.img_url %>" /></a>
	        </div>
        <% } %>
        <div class="dif-post-text">
            <h3><a href="/photos/<%= post.id %>"><%= post.title %></a></h3>
            <div class="profile-panel">
                <div class="profile-photo">
                    <a href="/profile/<%= post.user_nicename %>"><img src="/avatar?uid=<%= post.user_id %>" alt="<%= post.user_nicename %>" title="<%= post.user_nicename %>" /></a>
                </div>
                <div class="profile-data">
                    <h4><a href="/profile/<%= post.user_nicename %>"><%= post.display_name %></a></h4>
                    <ul class="prof-tags">
                        <!--<li><a href="#"><%= post.state %></a></li>-->
                        <li><a href="/<%= post.post_type %>" style="text-transform:capitalize;"><%= post.post_type %></a></li>
                    </ul>
                    <ul class="replies">
                        <li><a href="/photos/<%= post.id %>#reply_field"><%= post.comment_count %> Reply</a></li>
						<li><%= niceScore %></li>
                    </ul>
                    <ul class="prof-like">
                    	<li>
                    		<div addthis:url="http://<?php echo $_SERVER['SERVER_NAME']; ?>/photos/<%= post.id %>" addthis:title="<%= post.title %>" class="addthis_toolbox addthis_default_style ">
								<a class="addthis_button_facebook_like"fb:like:layout="button_count"></a>
							</div>
							
                       </li>
                    </ul>
                </div>
            </div>
            <% if (post.master == 1) {  %><span class="badge"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/pic/badge-ma.png" alt="Master Angler" /></span><% } %>
        </div>
    </div>
</script>
<!-- *********************************************************** -->
<!-- *********************************************************** -->
<!-- *********************************************************** -->

<div class="page-community">
    <div class="general general-com">
    	<div class="custom-title clearfix">
    		<img src="<?php echo plugins_url('images/naw-plus.png' , __FILE__ ); ?>" alt="NAW Community" class="custom-tite-logo">
            <div class="title-crumbs">
            	<h1>State Rut Reports</h1>
                <div class="sponsor"><?php imo_dart_tag("240x60"); ?></div>
			</div>
        </div>
        
		<div class="custom-slider-section">
            <?php //echo do_shortcode('[imo-slideshow community=true]'); ?>
        </div>
        <div class="photo-link-area">
            <div id="fileupload">
                <div class="fileupload-buttonbar ">
                    <label class="upload-button share-photo">
                        <span class="add-photo-link">Share Your Photo</span>
                        <input id="image-upload" class="common-image-upload" type="file" name="photo-upload">
                    </label>
                </div>
            </div>
        </div>

        <div class="btn-group btn-bar">
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
            <span class="menu-title browse-community">Browse by State</span> <span class="caret"></span>
          </button>
         <ul class="dropdown-menu filter" role="menu">
			<li><a href="/community/report/alabama" class="filter-menu" order_by="created">alabama</a></li><div class="divider"></div>
			<li><a href="/community/report/alaska" class="filter-menu" order_by="created">alaska</a></li><div class="divider"></div>
			<li><a href="/community/report/arizona" class="filter-menu" order_by="created">arizona</a></li><div class="divider"></div>
			<li><a href="/community/report/arkansas" class="filter-menu" order_by="created">arkansas</a></li><div class="divider"></div>
			<li><a href="/community/report/california" class="filter-menu" order_by="created">california</a></li><div class="divider"></div>
			<li><a href="/community/report/colorado" class="filter-menu" order_by="created">colorado</a></li><div class="divider"></div>
			<li><a href="/community/report/connecticut" class="filter-menu" order_by="created">connecticut</a></li><div class="divider"></div>
			<li><a href="/community/report/delaware" class="filter-menu" order_by="created">delaware</a></li><div class="divider"></div>
			<li><a href="/community/report/district-of-columbia" class="filter-menu" order_by="created">district of columbia</a></li><div class="divider"></div>
			<li><a href="/community/report/florida" class="filter-menu" order_by="created">florida</a></li><div class="divider"></div>
			<li><a href="/community/report/georgia" class="filter-menu" order_by="created">georgia</a></li><div class="divider"></div>
			<li><a href="/community/report/hawaii" class="filter-menu" order_by="created">hawaii</a></li><div class="divider"></div>
			<li><a href="/community/report/idaho" class="filter-menu" order_by="created">idaho</a></li><div class="divider"></div>
			<li><a href="/community/report/illinois" class="filter-menu" order_by="created">illinois</a></li><div class="divider"></div>
			<li><a href="/community/report/indiana" class="filter-menu" order_by="created">indiana</a></li><div class="divider"></div>
			<li><a href="/community/report/iowa" class="filter-menu" order_by="created">iowa</a></li><div class="divider"></div>
			<li><a href="/community/report/kansas" class="filter-menu" order_by="created">kansas</a></li><div class="divider"></div>
			<li><a href="/community/report/kentucky" class="filter-menu" order_by="created">kentucky</a></li><div class="divider"></div>
			<li><a href="/community/report/louisiana" class="filter-menu" order_by="created">louisiana</a></li><div class="divider"></div>
			<li><a href="/community/report/maine" class="filter-menu" order_by="created">maine</a></li><div class="divider"></div>
			<li><a href="/community/report/maryland" class="filter-menu" order_by="created">maryland</a></li><div class="divider"></div>
			<li><a href="/community/report/massachusetts" class="filter-menu" order_by="created">massachusetts</a></li><div class="divider"></div>
			<li><a href="/community/report/michigan" class="filter-menu" order_by="created">michigan</a></li><div class="divider"></div>
			<li><a href="/community/report/minnesota" class="filter-menu" order_by="created">minnesota</a></li><div class="divider"></div>
			<li><a href="/community/report/mississippi" class="filter-menu" order_by="created">mississippi</a></li><div class="divider"></div>
			<li><a href="/community/report/missouri" class="filter-menu" order_by="created">missouri</a></li><div class="divider"></div>
			<li><a href="/community/report/montana" class="filter-menu" order_by="created">montana</a></li><div class="divider"></div>
			<li><a href="/community/report/nebraska" class="filter-menu" order_by="created">nebraska</a></li><div class="divider"></div>
			<li><a href="/community/report/nevada" class="filter-menu" order_by="created">nevada</a></li><div class="divider"></div>
			<li><a href="/community/report/new-hampshire" class="filter-menu" order_by="created">new hampshire</a></li><div class="divider"></div>
			<li><a href="/community/report/new-jersey" class="filter-menu" order_by="created">new jersey</a></li><div class="divider"></div>
			<li><a href="/community/report/new-mexico" class="filter-menu" order_by="created">new mexico</a></li><div class="divider"></div>
			<li><a href="/community/report/new-york" class="filter-menu" order_by="created">new york</a></li><div class="divider"></div>
			<li><a href="/community/report/north-carolina" class="filter-menu" order_by="created">north carolina</a></li><div class="divider"></div>
			<li><a href="/community/report/north-dakota" class="filter-menu" order_by="created">north dakota</a></li><div class="divider"></div>
			<li><a href="/community/report/ohio" class="filter-menu" order_by="created">ohio</a></li><div class="divider"></div>
			<li><a href="/community/report/oklahoma" class="filter-menu" order_by="created">oklahoma</a></li><div class="divider"></div>
			<li><a href="/community/report/oregon" class="filter-menu" order_by="created">oregon</a></li><div class="divider"></div>
			<li><a href="/community/report/pennsylvania" class="filter-menu" order_by="created">pennsylvania</a></li><div class="divider"></div>
			<li><a href="/community/report/rhode-island" class="filter-menu" order_by="created">rhode island</a></li><div class="divider"></div>
			<li><a href="/community/report/south-carolina" class="filter-menu" order_by="created">south carolina</a></li><div class="divider"></div>
			<li><a href="/community/report/south-dakota" class="filter-menu" order_by="created">south dakota</a></li><div class="divider"></div>
			<li><a href="/community/report/tennessee" class="filter-menu" order_by="created">tennessee</a></li><div class="divider"></div>
			<li><a href="/community/report/texas" class="filter-menu" order_by="created">texas</a></li><div class="divider"></div>
			<li><a href="/community/report/utah" class="filter-menu" order_by="created">utah</a></li><div class="divider"></div>
			<li><a href="/community/report/vermont" class="filter-menu" order_by="created">vermont</a></li><div class="divider"></div>
			<li><a href="/community/report/virginia" class="filter-menu" order_by="created">virginia</a></li><div class="divider"></div>
			<li><a href="/community/report/washington" class="filter-menu" order_by="created">washington</a></li><div class="divider"></div>
			<li><a href="/community/report/west-virginia" class="filter-menu" order_by="created">west virginia</a></li><div class="divider"></div>
			<li><a href="/community/report/wisconsin" class="filter-menu" order_by="created">wisconsin</a></li><div class="divider"></div>
			<li><a href="/community/report/wyoming" class="filter-menu" order_by="created">wyoming</a></li><div class="divider"></div>
          </ul>
        </div>

        <div class="dif-posts">
			<div id="posts-container"></div>
         </div>
         <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="pager-holder js-responsive-section">
            <a href="#" class="btn-base load-more" style="display:block;">Load More</a>

            <a href="#" class="go-top jq-go-top">go top</a>

            <img src="/wp-content/themes/imo-mags-parent/images/ajax-loader.gif" id="ajax-loader" style="display:none;"/>
        </div>
		<?php social_footer(); ?>
		<div class="hr mobile-hr"></div>
		<a href="#" class="back-top jq-go-top">back to top</a>
        
    </div>
</div>

<?php get_footer(); ?>
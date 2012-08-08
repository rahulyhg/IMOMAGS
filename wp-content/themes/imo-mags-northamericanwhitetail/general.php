<?php

/**
 * Template Name: General
 * Description: The NAW+ Community - General Category
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
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

get_header();

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

?>
<div class="page-community">
<div class="col-abc super-post">
    <header class="header-title">
   		<ul id="user-bar" style="<?php echo $displayStyle; ?>">	          
			<li class="user-name">Hello, <a href="/profile/<?php echo $current_user->user_nicename; ?>"><span id="current-user-name"><?php echo $current_user->display_name; ?></span></a></li>
			<li><a href="/profile/<?php echo $current_user->user_nicename; ?>"><img src="/avatar?uid=<?php echo $current_user->ID; ?>" alt="User Avatar" class="recon-gravatar" /></a></li>                      
       </ul>
       <h1><a href="/community/">Community</a> <span>| General Discussion</span></h1>
	</header>
	<div class="col-abc super-post">
		<div class="imo-fb-login-button" style="<?php echo $loginStyle; ?>">
	    	LOGIN
	    </div>
	    <ul class="post-type-select add-post" style="<?php echo $displayStyle; ?>">
	    	<li id="new-post-button" class="new-post post general">+ POST IN GENERAL DISCUSSION</li>
		</ul>
		<div id="recon-activity" term="general" display="tile">


        </div>
        <span id="more-superposts-button">Load More<span></span></span>
    </div>
</div>
<div class="clear"></div>
	<!-- Editor's Picks w/ Sidebar Bottom -->		
	<div class="bonus-background">
		<div class="bonus">
			<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-home-top')) : else : ?><?php endif; ?>
		</div>		
	</div>
	
	<div class="col-abc">
				<div class="clear"></div>
					<div class="header-sort home-questions">
						<h1 class="more-header">Q&A</h1>
					</div>
					<div class="questions-slider">
		                <div class="slides-container-f">
		                	<a href="/question" class="see-all home-see-all">See All Questions</a>
		                     	<ul id="slides-questions" class="jcarousel-skin-tango questions-feed">
		                        	<?php 
		                     		for ($i = 1; $i <= 4; $i++) {
			                     		echo '<li>';
										echo '<div class="user-info">';
											echo '<a href="/profile/username"><img alt="user photo" src="http://www.northamericanwhitetail.fox/wp-content/themes/imo-mags-northamericanwhitetail/img/user-temp.jpg"></a>';
											echo '<span>Batman asks...</span>';
										echo '</div>';
										echo '<div class="quote-area">';
											echo '<div class="top"></div>';
											echo '<div class="mdl">';
												echo '<h4 class="quote">&#8220;Can anyone suggest a good camo bat-suit for hunting in the forest? I am having trouble hunting in the day time.&#8221;</h4>';
											echo '</div>';
											echo '<div class="btm"></div>';
										echo '</div>';
										echo '<div class="answers-area">';
											echo '<div class="answers-count">';
												echo 'Answers <a href="#"><span class="count">18</span></a>';
											echo '</div>';
											echo '<a href="#" class="answers-link">Answer This Question</a> '; 
											echo '<a class="plus-button new-post question questions-right"><span class="plus">+</span><span>Ask Your Question</span></a>';             
										echo '</div>';
									echo '</li>';
									} ?>
		                        </ul>
		                    </div>    
		                </div>
		            <div class="clear"></div>
	</div>
<?php get_footer(); ?>


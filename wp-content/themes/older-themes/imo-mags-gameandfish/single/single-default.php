<?php

/**
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
?>
<div class="col-ab">
	<?php
	cfct_loop(); ?>
	<div class="post-content-area">
		<div style="float:left">
	         <?php imo_dart_tag("300x250",false,array("pos"=>"mid")); ?>			
	    </div>		
		<div class="fb-recommendations recommendations" data-site="www.gameandfishmag.com" data-width="300" data-height="250" data-header="true"></div>
	</div>
	<?php comments_template();
	?>
</div>
<div id="sidebar" class="col-c">
	<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-default')) : else : ?><?php endif; ?>
	
	<div id="responderfollow"></div>
	<div class="sidebar advert">
		<?php imo_dart_tag("300x250",false,array("pos"=>"btf")); ?>
		<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('scroll-sidebar')) : else : endif; ?>
	</div>
</div>
<?php get_footer(); ?>

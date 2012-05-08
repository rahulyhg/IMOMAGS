<?php

/**
 * Template Name: Recon Photos
 * Description: A page the displays photos for Recon Network
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

$requestURL = "http://www.northamericanwhitetail.deva/slim/api/superpost/type/photo";

$file = file_get_contents($requestURL);
$data = json_decode($file);


?>
<header id="masthead">
	<h1>RECON NETWORK: PHOTOS</h1>
	<?php edit_post_link(__('Edit', 'carrington-business')); ?>
</header><!-- #masthead -->
<div class="bonus-background">
	<div class="bonus">
		<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-landing')) : else : ?><?php endif; ?>
	</div>
</div>
<div class="col-abc">
	<div <?php post_class('entry entry-full clearfix'); ?>>
		<div class="entry-content">


<script type="text/javascript">
         
    </script>

        <div class="main">
            <div class="container">
                <header>
                    <div class="page-header">
                        <h1 class="welcome-header">Welcome to Animal Post!</h1>
                    </div>




                </header>
            </div>
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="post-container masonry-container">
                        <div class="superpost-box masonry-box">
                             <form id="fileUploadForm" method="POST" action="/slim/api/superpost/add" enctype="multipart/form-data" class="masonry-form superpost-form">
                                <h3>Post a Photo!</h3>
                                <input type="file" id="photo-upload" name="photo-upload"  /><br/>
                                <input type="text" name="title" id="title" placeholder="Title"/>
                                <input type="text" name="body" id="body" placeholder="Add a Description!"/>
                                <input type="hidden" name="post_type" value="photo">
                                <input type="hidden" name="clone_target" value="superpost-box">
                                <input type="hidden" name="attach_target" value="post-container">
                                <input type="hidden" name="attachment_point" value="prepend">
                                <input type="hidden" name="masonry" value="true">
                                <input type="hidden" name="form_id" value="fileUploadForm">
                                <input type="submit" value="Submit" class="submit" />
                            </form>
                        </div>

                      <?php foreach ($data as $superpost): ?>
                            <div class='superpost-box'>
                                <div>
                                    <a class="superclass-id_url" href="/recon-photo/<?php echo $superpost->id; ?>"><img src='<?php echo $superpost->img_url; ?>' class='superclass-img_url animal-img'/></a>
                                </div>
                                <h3 class="superclass-title"><?php echo $superpost->title; ?></h3>
                                <div class='superclass-body'><?php echo $superpost->body; ?></div>
                                <div class="avatar-holder">
                                    <img src="http://www.gravatar.com/avatar/<?php echo $superpost->gravatar_hash; ?>.jpg?s=25&d=identicon" class="superclass-gravatar_hash">
                                    <a href="userlink"><?php echo $superpost->username; ?></a>
                                </div>
                            </div>
                      <?php endforeach; ?>
                        <pre><?php  ?></pre>

                                

                    </div>
                </div>
            </div>
        </div>




		</div>
	</div><!-- .entry -->
	




</div><!-- .col-abc -->
<?php get_footer(); ?>
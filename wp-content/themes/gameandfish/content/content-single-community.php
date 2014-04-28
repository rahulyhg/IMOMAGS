<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
$postID = get_the_ID();
$byline = get_post_meta($postID, 'ecpt_byline', true);
?>

<div id="post-<?php the_ID(); ?>" <?php post_class('full-post'); ?>>
    <?php if ( is_single() ) : ?>
    <?php if (function_exists('primary_and_secondary_categories')){ echo primary_and_secondary_categories(); } ?>
    <div class="sponsor"><?php imo_dart_tag("240x60"); ?></div>
    <div class="post-header">
        <h1 class="entry-title"><?php the_title(); ?></h1>
        <?php else : ?>
        <h1 class="entry-title">
            <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
        </h1>
        <?php endif; // is_single() ?>
        <div class="post-date"><?php the_time('F jS, Y'); ?>&nbsp;&nbsp;|&nbsp;&nbsp;</div>
        <div addthis:url="<?php the_permalink(); ?>" addthis:title="<?php the_title(); ?>" class="addthis_toolbox addthis_default_style" id="posts-container"><a class="addthis_button_facebook_like"fb:like:layout="button_count"></a></div>

        <a class="comment-count" href="<?php echo get_comments_link(); ?>"><?php echo get_comments_number(); ?></a>
	</div>

    <?php if ( mobile() ){ ?>
    <div class="image-banner posts-image-banner">
        <?php imo_dart_tag("300x250",array("pos"=>"mob")); ?>
        <small>ADVERTISEMENT</small>
    </div>
    <?php } ?>

    <?php $checked = get_field("cc_sweeps_viral_msg","options");
	if ($_GET['message'] == "share" && $checked) { ?>
	    <div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
	    <div class="share-photo-now clearfix">
	    	<div class="share-container">
	        	<?php if( get_field("cc_sweeps_viral_msg_1","options") ){ ?><h2><?php echo get_field("cc_sweeps_viral_msg_1","options"); ?></h2>
	        	<div class="fb-share-button" data-href="<?php the_permalink(); ?>" data-type="button_count"></div><?php } ?>
	        	<?php if( get_field("cc_sweeps_viral_msg_2","options") ){ ?><p><?php echo get_field("cc_sweeps_viral_msg_2","options"); ?></p><?php } ?>
	        	<?php if( get_field("cc_sweeps_viral_img","options") ){ ?><img src="<?php echo get_field("cc_sweeps_viral_img","options"); ?>" alt="Camera Corner Sweeps" title="Camera Corner Sweeps" /><?php } ?>
	    	</div>
	    </div>
    <?php } ?>
    <!-- .entry-header -->
    <div class="entry-content-holder">
        <?php if ( is_search() ) : // Only display Excerpts for Search ?>
        <div class="entry-summary">
            <?php the_excerpt(); ?>
        </div><!-- .entry-summary -->
        <?php else : ?>
        <div class="entry-content">
            <?php echo get_the_post_thumbnail( $postID, "large"); ?>
            <h4>By <a class="author-link" href="/author/<?php echo get_the_author_meta( "user_nicename" ); ?>/"><?php the_author(); ?></a></h4>
            <?php the_content( __( 'more <span class="meta-nav">&raquo;</span>', 'twentytwelve' ) ); ?>
			<ul>
                <!-- <li><b>Species: </b><?php echo $species; ?></li> -->
                <li><b>Taken At: </b><?php echo get_post_meta($postID,"camera_corner_taken",true); ?></li>
                <li><b>Taken On: </b><?php echo get_post_meta($postID,"camera_corner_when",true); ?></li>
                <li><b>With: </b><?php echo get_post_meta($postID,"camera_corner_who",true); ?></li>
            </ul>

            <?php wp_link_pages( array( 'before' => '<div class="page-links">' . 'Pages:', 'after' => '</div>' ) ); ?>
        </div><!-- .entry-content -->
        <?php endif; ?>

         <div class="article-brief">
         	<div class="addthis-below" <?php if(mobile()){ echo 'style="width: 320px;"'; } ?>><?php if (function_exists('imo_add_this')) {imo_add_this();} ?></div>
	    </div>

        <?php the_widget('imo_related_footer_widget'); ?>

	    <?php imo_dart_tag("564x252"); ?>

	    <?php if ( function_exists('yarpp_plugin_activate') ): ?>
		    <?php if ( isset_related_posts() ): ?>
			    <?php if(mobile() || tablet()){ ?>
			    	<h2 class="related-stories">Related Stories</h2>
			    <?php } ?>
			    <div class="paging-posts paging-single-post">
			        <div class="jq-single-paging-slider">
			        <?php related_posts(); ?>
			        </div>
			    </div>
		    <?php endif; ?>
	    <?php endif; ?>
		    <?php //sub_footer(); ?>
			<div class="hr mobile-element"></div>
	    <div class="entry-meta">
	        <?php edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?>

	               </div><!-- .entry-meta -->
	</div><!-- #post -->
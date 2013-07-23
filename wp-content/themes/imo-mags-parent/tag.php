<?php
$dataPos = 0;
get_header(); ?>
        <?php imo_sidebar();?>
        <div id="primary" class="general">
            <div id="content" role="main" class="general-frame">
                
                <?php if ( have_posts() ) : ?>
    
                    <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="page-header clearfix js-responsive-section">
                        <h1 class="page-title"><?php
                            printf('<span>' . single_tag_title( '', false ) . '</span>' );
                            ?>
                        </h1>
                    </div>
                                        
                    <?php //echo '<div class="category-img"><img src="'.z_taxonomy_image_url().'" alt="'.single_tag_title( '', false ).'" title="'.single_tag_title( '', false ).'" /></div>'; ?>   
                        <?php
                            $tag_description = tag_description();
                            if ( ! empty( $tag_description ) )
                                echo apply_filters( 'tag_archive_meta', '<div data-position="'.$dataPos + 1.'" class="tag-archive-meta taxdescription js-responsive-section">' . $tag_description . '</div>' ); ?>
                                
                    <!--<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="filter-by jq-filter-by js-responsive-section">               
                        <strong>filter by:</strong>
                        <ul class="filter-links">
                            <li><a href="#">Latest</a></li>
                            <li><a href="#">Most Viewed</a></li>
                            <li><a href="#">Most Discussed</a></li>
                            <li><a href="#">Most Shared</a></li>
                        </ul>
                    </div>-->
                    
                    <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="js-responsive-section main-content-preppend">
                        <?php //twentyeleven_content_nav( 'nav-above' ); ?>
    
                        <?php /* Start the Loop */ ?>
                        <?php $i = 1; while ( have_posts() ) : the_post(); ?>
        
                            <?php
                                /* Include the Post-Format-specific template for the content.
                                 * If you want to overload this in a child theme then include a file
                                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                 */
                                get_template_part( 'content', get_post_format() );
                            ?>

                        <?php if ( (($i - (($paged -1) * 2 ))%6) == 0 ): ?>
	                        <?php if ( mobile() ){ ?>
	                        <div class="image-banner posts-image-banner">
	                            <?php imo_dart_tag("300x250",array("pos"=>"mob")); ?> 
	                        </div>
	                        <?php } ?>
                        <?php endif;?>
        
                        <?php $i++; endwhile; ?>
        
                        <?php //twentyeleven_content_nav( 'nav-below' ); ?>
                    </div>
    
                    <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="pager-holder js-responsive-section">
                        <a href="#" class="btn-base">Load More</a>
                        <div class="next" style="display:none;"><?php next_posts_link(); ?></div>
                        <a href="#" class="go-top jq-go-top">go top</a>

                        <img src="/wp-content/themes/infisherman/images/ajax-loader.gif" id="ajax-loader" style="display:none;"/>
                    </div>
                <?php else : ?>
    
                    <div id="post-0" class="post no-results not-found">
                        <div class="entry-header">
                            <h1 class="entry-title"><?php _e( 'Nothing Found', 'twentyeleven' ); ?></h1>
                        </div><!-- .entry-header -->
    
                        <div class="entry-content">
                            <p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'twentyeleven' ); ?></p>
                            <?php get_search_form(); ?>
                        </div><!-- .entry-content -->
                    </div><!-- #post-0 -->
    
                <?php endif; ?>
                <?php social_footer(); ?>                 
                <a href="#" class="back-top jq-go-top">back to top</a>
                
            </div><!-- #content -->
        </div><!-- #primary -->
<?php get_footer(); ?>
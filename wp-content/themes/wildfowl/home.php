<?php
$dataPos = 0;
get_header(); ?>
	<?php imo_sidebar('home');?>
	<div id="primary" class="general">
        <div class="general-frame">
            <div id="content" role="main">
            <?php if ( is_home() ) : ?>

            	<?php $featured_query = new WP_Query( 'category_name=featured&posts_per_page=1' ); ?>
                <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="home-featured clearfix js-responsive-section">
                    <!--<div class="general-title clearfix">
                        <h2>Featured</h2>
                    </div>-->
                    <div class="clearfix">
                        <ul>
                         <?php while ($featured_query->have_posts()) : $featured_query->the_post(); 
                          ?>
						  	<li>
                                <div class="feat-post">
                                    <div class="feat-img"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('index-thumb'); ?></a></div>
                                    <div class="feat-text">
                                        <h3><a href="<?php the_permalink(); ?>" ><?php the_title(); ?></a></h3>
                                </div>
                            </li>
                        <?php endwhile; ?>
                        </ul>
                    </div>
                </div>

				<?php $featured_right_query = new WP_Query( 'category_name=featured&posts_per_page=2&offset=1' ); ?>
                <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="home-featured-right clearfix js-responsive-section">
                    <!--<div class="general-title clearfix">
                        <h2>Featured</h2>
                    </div>-->
                    <div class="clearfix">
                        <ul>
                         <?php while ($featured_right_query->have_posts()) : $featured_right_query->the_post(); 
                         ?>
						  	<li>
                                <div class="feat-post">
                                    <div class="feat-img"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('list-thumb'); ?></a></div>
                                    <div class="feat-text">
                                        <h3><a href="<?php the_permalink(); ?>" ><?php the_title(); ?></a></h3>
                                </div>
                            </li>
                        <?php endwhile; ?>
                        </ul>
                    </div>
                </div>

				
                <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="posts-list js-responsive-section main-content-preppend">

                    <?php $more_query = new WP_Query( 'posts_per_page=20' ); ?>
                    <?php while ($more_query->have_posts()) : $more_query->the_post(); ?>

                    <div class="article-brief clearfix">
                        <a href="<?php the_permalink(); ?>" ><?php the_post_thumbnail('legacy-thumb');?></a>
                        <div class="article-holder">
                            <div class="clearfix">
                                <?php 
	                                if(function_exists('primary_and_secondary_categories')){
	                                	echo primary_and_secondary_categories(); 
	                                }                                
                                ?>
                            </div>
                            <h3 class="entry-title">
                                <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
                            </h3>
                            <!-- .entry-header -->
                            <a class="comment-count" href="<?php echo get_comments_link(); ?>"><?php echo get_comments_number(); ?></a>
                            <div class="entry-content">
                                <?php the_excerpt(); ?>
                                <?php //the_content( __( 'more <span class="meta-nav">&raquo;</span>', 'twentytwelve' ) ); ?>
                                <?php wp_link_pages( array( 'before' => '<div class="page-links">' . 'Pages:', 'after' => '</div>' ) ); ?>
                            </div><!-- .entry-content -->
                        </div>
                    </div><!-- #post -->
                    <?php endwhile; ?>
                </div>
				<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="pager-holder js-responsive-section">
                    <a href="#" class="btn-base">Load More</a>
                    <div class="next-link" style="display:none;"><?php next_posts_link(); ?></div>
                    <a href="#" class="go-top jq-go-top">go top</a>

                    <img src="/wp-content/themes/imo-mags-parent/images/ajax-loader.gif" id="ajax-loader" style="display:none;"/>
                </div>

                <?php sub_footer(); ?>
                <!-- end home page content-->
            <?php endif; // end have_posts() check ?>

            </div><!-- #content -->
        </div>
    </div><!-- #primary -->


<?php get_footer(); ?>

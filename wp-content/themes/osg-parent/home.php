<?php
	
get_header(); 
$is_home_cat 	= true;
$dartdomain 	= get_option('dart_domain', false);
$magazine_img 	= get_option('magazine_cover_uri' );
$deal_copy 		= get_option('deal_copy' );
$features 		= get_field('homepage_featured_stories_','options' );
$site_name		= trim(get_bloginfo('name'), "Magazine");
?>

<div id="sections_wrap" class="sections-wrap">
	<section class="section-latest-posts">
		<div id="l_container" class="section-inner-wrap">
				<ul id="latest_list" class="c-list">
				<?php 
					$features_ids = array();
					if( $features ){ 
						$feat_counter = 0;
				?>
                
					<?php 
					foreach( $features as $feature ){
						$features_ids[] = $feature->ID;
						$title 			= $feature->post_title;  if ($feature->promo_title) { $title = $feature->promo_title;}
						$url 			= $feature->guid;
						$author 		= get_the_author();
						$acf_byline 	= get_field("byline", $feature->ID);
						$thumb 			= get_the_post_thumbnail($feature->ID,"list-thumb");
						$tracking 		= "_gaq.push(['_trackEvent','Special Features Homepage','$title','$url']);"; 
					?>
						<li class="f-item">
							<a href="<?php echo $url; ?>" onclick="<?php echo $tracking; ?>"><?php echo $thumb; ?></a>
							<div class="c-info">
								<!--<div class="c-cats"><?php //if (function_exists('primary_and_secondary_categories')){ echo primary_and_secondary_categories(null, ','); } ?></div>-->
								<?php if (in_category('sponsored', $feature->ID)) echo '<span class="is-sponsored">Sponsored</span>'; ?>
								<h2><a href="<?php echo $url; ?>" onclick="<?php echo $tracking; ?>"><?php echo $title; ?></a></h2>
								<!--<span class="c-author"><?php //if (!$acf_byline) { if ($author != 'admin') echo 'by '. $author;} else {echo $acf_byline;} ?></span>-->
							</div>
						</li>
					<?php 
						if ($feat_counter == 1) { ?>
						<li class="c-ad ad-wrap"><span class="ad-span">Advertisement</span>
							<div id="c_ad_inner" class="ad-inner">
								<?php imo_ad_placement("medium_rect_ATF"); ?>
							</div>
						</li>
						<?php }
						$feat_counter++;
					} 
				} ?>
				</ul>
			<div id="btn_more_posts" class="btn-lg"  data-post-not="<?php echo implode(", ", $features_ids); ?>" data-cat="">
				<span>Show More</span>
				<div class="loader-anim dnone">
					<div class="line-spin-fade-loader">
						<div></div> <div></div> <div></div> <div></div> <div></div> <div></div> <div></div> <div></div>
					</div>
				</div>
			</div><!-- .btn-lg -->
		</div><!-- .l-container -->
	</section>
	<section id="section_loader">
		<div class="ball-grid-pulse clearfix">
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
        </div>
	</section>
	<?php //the rest of the page is loaded from /functions/redesign/home-and-cat.php  ?>
</div>

<?php get_footer(); ?>

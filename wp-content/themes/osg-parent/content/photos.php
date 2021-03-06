<?php
$dartDomain = get_option('dart_domain', false);
$is_home_cat= true;
$string = parse_url($_SERVER['REQUEST_URI']);
$term = (empty($string["query"])) ? '' : $string["query"];
$args = array(
	'category_name' => $term,
	'post_type' => $post_type,
	'posts_per_page' => 8,
	'order' => 'DESC'
);
?>

<div id="sections_wrap" class="sections-wrap">
	<section class="section-photo-menu">
		<div class="section-inner-wrap">
			<?php get_template_part('content/content', 'comunity-header'); ?>
		</div>
	</section>
	<section class="section-latest-posts">
		<div id="l_container" class="section-inner-wrap">
<!-- 			<h1 class="main-h"><?php echo $ph_cat_name;?></h1> -->
			<ul id="latest_list" class="c-list">
			<?php	
				$query = new WP_Query( $args );	
				$p_counter = 0;		
				if ( $query->have_posts() ) { 
					while ( $query->have_posts() ) { 
						$query->the_post();
					
					get_template_part('content/content', 'reader_photos');
					 
						if ($p_counter == 1) { ?>							
							<li class="c-ad ad-wrap"><span class="ad-span">Advertisement</span>
								<div id="c_ad_inner" class="ad-inner">
									<?php imo_ad_placement("medium_rect_ATF"); ?>
								</div>
							</li>
			<?php		}
						$p_counter++;
					} 
				} else { ?>
					<article id="post-0" class="post no-results not-found">
						<header class="entry-header">
							<h1 class="entry-title">No one has submitted a photo for <span style="text-transform:capitalize;font-size:1.2em;"><?php echo str_replace("-", " ", $term ); ?></span> yet.</h1>
							<p>Be the first to post one!</p>
							<label class="upload-button"><a href="/post-photo/"><span class="singl-post-photo"><span>Share Your Photo Now!</span></span></a></label>
						</header><!-- .entry-header -->
					</article><!-- #post-0 -->
				<?php } ?>
				</ul>
			<div id="btn_more_posts" class="btn-lg"  data-post-not="" data-cat-slug="<?php echo $term;?>" data-fb-like="1" data-post-type="<?php echo $post_type; ?>">
				<span>Show More</span>
				<div class="loader-anim dnone">
					<div class="line-spin-fade-loader">
						<div></div> <div></div> <div></div> <div></div> <div></div> <div></div> <div></div> <div></div>
					</div>
				</div>
			</div><!-- .btn-lg -->	
		</div>
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
</div>
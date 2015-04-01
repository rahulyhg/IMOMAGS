<?php
	get_header();
	
    $category_id = get_cat_ID( 'shoot101' );
    $category_link = get_category_link( $category_id );
?>
<div class="sponsors-disclaimer">
	<span>BROUGHT TO YOU BY VISTA OUTDOOR INC. AND ITS FAMILY OF <a href="http://www.vistaoutdoor.com/brands/" target="_blank">BRANDS</a></span>
</div>
<div class="content">
		<div class="posts-wrap">
			<div class="p-feat-container clearfix">
				<?php
				$post_counter = 0;	
					
				$args = array (
					'category_name'         	=> 'shoot101',			
					'posts_per_page'      		=> 3,
					'order'						=> 'DESC',
					'meta_query' => array(
					  array(
					    'key' => 'featured_post',
					    'value' => '1',
					    'compare' => '=='
					  )
					)
				);
				// The Query
				$query = new WP_Query( $args );
				// The Loop
				if ( $query->have_posts() ) {
					while ( $query->have_posts() ) {
						$query->the_post();			
						$image_id = get_post_meta(get_the_ID(),"image", true);
						$image = wp_get_attachment_image_src($image_id, "full");
						
						$wide_image_id = get_post_meta(get_the_ID(),"image_wide", true);
						$image_wide = wp_get_attachment_image_src($wide_image_id, "full");
						//$image = wp_get_attachment_image_src($image_id, $image_size);
				?>
				<a class="link-box" href="<?php the_permalink(); ?>">	
					<?php if ($post_counter == 2 && mobile() == false) { ?>
					<div class="post-box" style="background-image: url('<?php echo $image_wide[0]; ?>')"></div>	
					<?php } else { ?>
					<div class="post-box" style="background-image: url('<?php echo $image[0]; ?>')"></div>
					<?php } ?>
				</a>
				<?php
					$post_counter++;	
						}
					} else {
						echo "not found";
					}
					wp_reset_postdata();
				?>
			</div><!-- end .p-feat-container -->
						
			<div class="featured-message">
				<span>Help grow shooting in America.  Share this with a new shooter!</span>
				<div class="m-social-buttons">
					<ul>
						<li><a href="http://www.facebook.com/sharer/sharer.php?u=<?php print(urlencode(get_permalink())); ?>&title=<?php print(urlencode(the_title())); ?>" class="icon-facebook"></a></li>
						<li><a href="http://twitter.com/intent/tweet?status=<?php print(urlencode(the_title())); ?>+<?php print(urlencode(get_permalink())); ?>" class="icon-twitter"></a></li>
						<li><a href="mailto:?subject=Website I came across&body=Check out this website! A starter's guide every new shooter should read. <?php echo $category_link; ?>" class="icon-mail"></a></li>
					</ul>
				</div>
			</div><!-- end .featured-message -->
			<div class="p-container clearfix">
				<?php
				//$id_obj = get_category_by_slug('shoot101-featured'); 
				//$cat_id = $id_obj->term_id;
				// WP_Query arguments
				$args = array (
					'category_name'         	=> 'shoot101',			
					'posts_per_page'      		=> -1,
					'order'						=> 'DESC',
					'meta_query' => array(
					  array(
					    'key' => 'featured_post',
					    'value' => '0',
					    'compare' => '=='
					  )
					)
				);
				// The Query
				$query = new WP_Query( $args );
				// The Loop
				if ( $query->have_posts() ) {
					while ( $query->have_posts() ) {
						$query->the_post();
					
					//$box_size = get_post_meta(get_the_ID(),"box_size", true);
					//later you can add cnditional if mobile $image_size = "medium"
	/*
					if ($box_size == "wide") {
						$image_size = "full";
					}  else {
						$image_size = "large";
					}
	*/					
					$image_id = get_post_meta(get_the_ID(),"image", true);
					$image = wp_get_attachment_image_src($image_id, "large");
					//$image = wp_get_attachment_image_src($image_id, $image_size);
				?>
				<a class="link-box" href="<?php the_permalink(); ?>">	
					<div class="post-box" style="background-image: url('<?php echo $image[0]; ?>')"></div>
				</a>
				<?php
						}
					} else {
						echo "not found";
					}
					wp_reset_postdata();
				?>
			</div><!-- end .p-container -->
			
			<?php // echo get_template_part( 'content/relative', 'microsite' ); ?>
		</div><!-- end .posts-wrap -->
</div><!-- end .content -->


<?php echo get_template_part( 'footer', 'shoot101' ); ?>
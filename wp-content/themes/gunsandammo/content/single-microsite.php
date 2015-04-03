<?php
/**
 * Template Name: Shoot101
 * Description: A page template for shoot101 articles
 */
get_header(); 
// echo get_template_part( 'header', 'shoot101' ); 
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );	
	$postID = get_the_ID();
	$byline = get_post_meta($postID, 'ecpt_byline', true);
	$acf_byline = get_field("byline",$postID); 
	$author = get_the_author();
?>
<div class="sponsors-disclaimer">
	<span>BROUGHT TO YOU BY VISTA OUTDOOR INC. AND ITS FAMILY OF <a href="http://www.vistaoutdoor.com/brands/" target="_blank">BRANDS</a></span>
</div>
<div class="m-article-wrap clearfix">
	<?php if($image[0]) { ?> <div class="m-article-image" style="background-image: url('<?php echo $image[0]; ?>');"></div> <?php }?>
	<article class="m-article clearfix">
		<?php echo get_template_part("content/social", "buttons"); ?>
		<h1><?php the_title();?></h1>
		<?php if(get_the_author() != "admin" && get_the_author() != "infisherman"){ ?><span class="m-post-byline">Words by <?php echo $author; ?></span><?php } ?><?php if ($acf_byline) { ?><span class="m-post-byline">&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $acf_byline;?></span><?php } ?>
		
		<?php if(mobile() == true) { 
			$content = apply_filters('the_content', $post->post_content);
			$mag_after_p = 0;
			//$ad1_after_p = 2;
			$contents = explode("</p>", $content);
			$p_counter = 0;
			foreach($contents as $content){
			    echo $content.'</p>';
			   
			    if($p_counter == $mag_after_p){ ?>
			    	<div class="alignright-content m-buy-wrap"> 
			    		<div class="m-buy-mag"> 
			    			<h2>NOW AVAILABLE ON NEWSSTANDS!</h2> 
			    			<div class="m-buy-mag-bottom clearfix"> 				
			    				<div class="m-buy-mag-img"></div> 
			    				<a href="https://store.intermediaoutdoors.com/products.php?product=Shoot-101" target="_blank">BUY THE MAGAZINE NOW!</a> 
			    				<a href="https://store.intermediaoutdoors.com/products.php?product=Shoot-101" target="_blank">GET THE DIGITAL EDITION!</a> 
			    			</div>
			    		</div>
			    	</div>
				<?php }
	
/*
			    if($p_counter == $ad1_after_p){
			    	//echo '<div class="alignright-content inline-ad">';
						//imo_ad_placement("atf_medium_rectangle_300x250"); 
					//echo '</div>';
				}
*/
			    $p_counter++;
			}
			
		} else { ?>
		<div class="alignright-content m-buy-wrap"> 
    		<div class="m-buy-mag" style="margin-top: 45px;"> 
    			<h2>NOW AVAILABLE ON NEWSSTANDS!</h2> 
    			<div class="m-buy-mag-bottom clearfix"> 				
    				<div class="m-buy-mag-img"></div> 
    				<a href="https://store.intermediaoutdoors.com/products.php?product=Shoot-101" target="_blank">BUY THE MAGAZINE NOW!</a> 
    				<a href="https://store.intermediaoutdoors.com/products.php?product=Shoot-101" target="_blank">GET THE DIGITAL EDITION!</a> 
    			</div>
    		</div>
    	</div>
		<?php
			 the_content();
		}
		?>
		
		<!-- end of the_content(); -->
		
		<div class="m-article-bottom clearfix">
			<div class="m-social-wrap">
				<p class="m-hlep-grow">Help Grow Shooting in America. Share this with a new shooter!</p>
				<div class="m-social-buttons">
					<ul>
						<li><a class="icon-facebook" target="_blank" href="http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo urlencode(the_title());?>&amp;p[summary]=<?php echo urlencode(the_title()) ?>&amp;p[url]=<?php echo urlencode(get_permalink()); ?>&amp;p[images][0]=<?php echo urlencode($image[0])?>" ></a></li>
						<li><a href="http://twitter.com/intent/tweet?status=<?php print(urlencode(the_title())); ?>+<?php print(urlencode(get_permalink())); ?>" class="icon-twitter" target="_blank"></a></li>
						<li><a href="mailto:?subject=Article I came across&body=Check out this article! '<?php the_title(); ?>' <?php the_permalink(); ?>" class="icon-mail"></a></li>
					</ul>
				</div>
			</div><!-- .m-social-wrap -->
			<div class="alignright-content inline-ad">
				<?php imo_ad_placement("atf_medium_rectangle_300x250"); ?>
			</div>
		</div><!-- .m-article-bottom -->
	</article>
</div><!-- .m-article-wrap -->
<div class="m-more">
	<h2>More Stories</h2>
	<div class="m-more-wrap clearfix">
		<?php
		$args = array (
			'category_name'         	=> 'shoot101',			
			'posts_per_page'      		=> 6,
			'order'						=> 'DESC',
			'orderby'					=> 'rand'
		);
		$query = new WP_Query( $args );
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();								
				$image_id = get_post_meta(get_the_ID(),"image", true);
				$image = wp_get_attachment_image_src($image_id, "large");
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
	</div><!-- .m-more-wrap -->
</div><!-- .m-more -->


<?php echo get_template_part( 'footer', 'shoot101' ); ?>
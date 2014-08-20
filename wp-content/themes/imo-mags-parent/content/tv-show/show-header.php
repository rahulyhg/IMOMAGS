<?php
/**
 * The template used for displaying page content in show-page.php
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
$postID = get_the_ID();

$idObj = get_category_by_slug('tv'); 
$id = $idObj->term_id;
$acfID = 'category_' . $id; ?>

<div class="clearfix js-responsive-section">
	<div id="header-top">
		<div class="shows-logo">
			<img src="<?php echo get_field('show_logo',$acfID); ?>" alt="">
		</div>
		<div class="shows-title">
			<h1><?php echo get_field('show_title',$acfID); ?></h1>
		    <div class="fb-like" data-href="" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false">			    
		    </div>
		</div><!-- end of #shows-title -->
		<div class="shows-sponsor">
			<span>presented by</span>
			<img src="/wp-content/themes/petersenshunting/images/shows/federal-logo.png" alt="">
		</div>
	</div><!-- end of #header-top -->
	<div id="shows-nav">
		<?php if( have_rows('show_menu',$acfID) ): ?>
			<div class="menu">
				<ul>
					<li class="page-item-mobile">
						<a href="#">
							<?php 
								$post = get_post($postID);
								$slug = $post->post_name;	
								if($post->post_parent) { 
									$post_data = get_post($post->post_parent);
									$parent_slug = $post_data->post_name; 
								}
									echo $slug;		
							?>
						</a>
					 </li>
				<?php while( have_rows('show_menu',$acfID) ): the_row(); ?>
					<li class="page_item"><a href="<?php echo get_sub_field('url'); ?>"><?php echo get_sub_field('name'); ?></a></li>
				<?php endwhile; ?>
				</ul>
			</div>
		<?php endif; ?>

	</div>
</div><!-- end of .page-header -->


<div class="shows-player-area">
	<div id="when-to-watch">
		<div class="when-label">
			<h3>WHEN TO<br>WATCH</h3>
		</div>
		
		<?php echo do_shortcode("[tscschedule format='singleshow' postid='1016']"); ?>		
		
		<div class="remind-me">
			<span>REMIND ME<br> TO WATCH</span>
		</div>
	</div><!-- end of #when-to-watch -->
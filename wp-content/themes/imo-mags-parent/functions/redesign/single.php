<?php

/* Add scripts only if $is_single_default = true. Scripts to be loaded only on single post pages
--------------------------------------------*/
add_action('init', 'register_single_script');
add_action('wp_footer', 'print_single_script');

function register_single_script() {
	wp_register_script( 'single-default-script', get_bloginfo( 'template_directory' ) . '/js/redesign/single.js', array( 'jquery' ), '1.0', true );
	wp_register_script( 'single-disqus', "//gundogmag.disqus.com/count.js", array( 'jquery' ), '1.0', true );
	
	wp_localize_script( 'single-default-script', 'ajax_object',
        array( 
        	'ajax_url' 	=> admin_url( 'admin-ajax.php' )
        ) 
	);
}


function print_single_script() {
	global $is_single_default;

	if ( ! $is_single_default )
		return;

	wp_print_scripts('single-default-script');
	wp_print_scripts('single-disqus');
}


/* Load More Posts
--------------------------------------------*/	
if ( is_admin()) {  
    add_action( 'wp_ajax_ms_load_more', 'ms_load_more' );
    add_action( 'wp_ajax_nopriv_ms_load_more', 'ms_load_more' );
} else {
    // Add non-Ajax front-end action hooks here
}

function ms_load_more() {
	global $wpdb;          
    ob_clean(); 
    
    $cat_id			= $_POST['cat_id'];
    $post_count		= $_POST['post_count'];
    $post_not		= $_POST['post_not'];
    $post_per_page	= $_POST['post_per_page'];
    $ad_after_post	= $_POST['ad_after_post'];
	$p_counter		= 0;
		
	$args = array (
		'cat'         		=> $cat_id,
		'posts_per_page'	=> $post_per_page,
		'order'				=> 'DESC',
		'post_status'		=> 'publish',
		'post__not_in'		=> array("$post_not"),
		'offset'			=> $post_count,
	);
	// The Query
	$query = new WP_Query( $args );
	// The Loop
	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();			
			$feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );?>
	
			<a class="ms-box" href="<?php the_permalink(); ?>">
				<div class="ms-image" style="background-image: url('<?php echo $feat_image; ?>')"></div>
				<div class="ms-desc"><?php the_title( '<h1>', '</h1>'); ?></div>
			</a>
<?php		if ($p_counter == $ad_after_post) {
				echo '<div class="ms-ad"><div class="ms-ad-inner"></div></div>';
			}
			$p_counter++;
		}
	} else { ?>
		<script>
			jQuery('#btn_more_stories > span').text('No more posts').css("color", "#999999"); 
			jQuery('#btn_more_stories').removeAttr("id");
		</script>
<?php }
	wp_reset_postdata();
   
	wp_die();
}


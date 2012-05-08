<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

// Test if this is a blog homepage (a child of Blogs landing page)
$blog = $post->post_parent == get_id_by_slug('blogs') ? "blog" : null;



//Check to see if we should show user avatar
if (!(has_term('news-brief','blog_tax')))
	$showAvatar = has_term(null,'blog_tax');

//COMMENT THIS OUT LATER TO BRING BACK AVATARS
	$showAvatar = FALSE;
?>

<article id="post-excerpt-<?php the_ID(); ?>" <?php post_class('entry entry-excerpt') ?>>

	<?php	if (has_post_thumbnail()) :
		echo '<a href="', the_permalink(),'">', the_post_thumbnail('post-thumbnail', array('class' => 'entry-img')), '</a>'; ?>

	  <?php if ($showAvatar): ?>
	  	<div class="author-photo"><?php	echo userphoto_the_author_thumbnail(); ?></div>
	  <?php endif; ?>
  <?php	endif; ?>
	
	<div class="entry-summary">
	  
	  <span class="entry-category">
	    <?php 


	    // if (has_term('', 'blogs')) {
	    //   the_terms($post->ID, 'blogs', '', ', ');
	    // } else {
	    //   the_category(', ');
	    // }	

	    //the_time(get_option('date_format'));
	    ?>

	    <span style="color:#CE181E;"><?php the_time(get_option('date_format')); ?></span>



	  </span>
		<h2 class="entry-title"><a rel="bookmark" href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
		<?php the_excerpt(); ?>
	</div>
  
  <a class="comment-count" href="<?php comments_link(); ?>"><?php echo get_comments_number(); ?></a>

</article>
<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

get_header(); ?>

<div id="content" class="col-abc">
  <div <?php post_class('entry entry-full clearfix') ?>>
  	<div class="entry-header">
			<h1 class="entry-title"><?php the_title() ?></h1>
  		<div class="entry-info">
  			<span class="author vcard"><span class="fn">by <?php the_author_link(); ?></span></span>
  			<span class="spacer">|</span>
  			<time class="published" datetime="<?php the_time('Y-m-d\TH:i'); ?>"><?php the_time('F j, Y'); ?></time>
  		</div>
  		<a class="comment-count" href="<?php comments_link(); ?>"><?php comments_number('0', '1', '%'); ?></a>
  	</div>
  	<div class="entry-content">
      <?php
      $video_id = get_post_meta(get_the_ID(), '_video_id', TRUE);
      $player_id = get_option("bc_player_id", _BC_DEFAULT_PLAYER_ID );
      $player_key = get_option("bc_player_key", _BC_DEFAULT_PLAYER_KEY);
      $adServerURL = "http://ad.doubleclick.net/pfadx/" .  get_option("dart_domain", _imo_dart_guess_domain())  ."/video";
      $video_link = !empty($the_ID) ? get_permalink($the_ID) :  site_url() . $_SERVER['REQUEST_URI']; ?>

      <!-- Start of Brightcove Player -->
    	<script language="JavaScript" type="text/javascript" src="http://admin.brightcove.com/js/BrightcoveExperiences.js"></script>
    	<p><object id="myExperience" class="BrightcoveExperience">
    		<param name="bgcolor" value="#FFFFFF" />
    		<param name="width" value="640" />
    		<param name="height" value="360" />
    		<param name="playerID" value="<?php echo $player_id;?>" />
    		<param name="playerKey" value="<?php echo $player_key; ?>" />
    		<param name="isVid" value="true" /><param name="isUI" value="true" />
    		<param name="dynamicStreaming" value="true" />
    		<param name="linkBaseURL" value="<?php echo $video_link; ?>" />
    		<param name="@videoPlayer" value="<?php echo $video_id; ?>" />
    		<param name="adServerURL" value="<?php echo $adServerURL; ?>" />
    		<param name="media_delivery" value="http" />
    		<param name="wmode" value="transparent" />
    		</object></p>
    	<!--<br />
    	This script tag will cause the Brightcove Players defined above it to be created as soon<br />
    	as the line is read by the browser. If you wish to have the player instantiated only after<br />
    	the rest of the HTML is processed and the page load is complete, remove the line.<br />
    	--><br />
    	<script type="text/javascript">brightcove.createExperiences();</script>

  		<?php the_content(__('Continued&hellip;', 'carrington-business')); ?>
  	</div>
    <!-- <div class="entry-footer">
      <?php the_tags(__('Tagged ', 'carrington-business'), ', ', '');
      wp_link_pages(); ?>
    </div> -->
  </div>
  <?php if (function_exists(related_posts())) related_posts(); ?>
  <?php comments_template(); ?>
</div>
<div id="sidebar">
  <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-video')) : else : ?><?php endif; ?>
</div>

<?php get_footer(); ?>

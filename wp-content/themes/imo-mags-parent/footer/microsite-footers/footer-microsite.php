<?php
	$microsite = true;
/*
	$category_id = get_cat_ID( 'shoot101' );
	$category_link = get_category_link( $category_id );	
*/
?>
<footer class="m-footer clearfix">
	<div class="m-footer-bottom">
		<div class="m-logo-nav">
			<a href="http://www.imoutdoors.com/"><div class="m-imo-logo"></div></a>
			<div class="m-footer-nav">
				<ul>
					<li><a href="http://www.imoutdoors.com/about/what-we-do/" target="_blank">ABOUT</a></li>
					<li><a href="http://www.imoutdoors.com/advertise/" target="_blank">ADVERTISE</a></li>
					<li><a href="http://www.imoutdoors.com/about/contact/" target="_blank">CONTACT</a></li>
					<li><a href="http://www.imoutdoors.com/about/careers/" target="_blank">CAREERS</a></li>
					<li><a href="http://www.imoutdoors.com/about/privacy/" target="_blank">PRIVACY POLICY</a></li>
				</ul>
			</div>
		</div><!-- end .m-logo-nav -->
		<div class="m-copyright">
	        <p>© 2015 InterMedia Outdoors. All Rights Reserved</p>
	    </div>
	</div><!-- end .m-footer-bottom -->
</footer>


</div><!-- .m-microsite -->
<!--
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.tipTip.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.cookie.js"></script>
-->
<!--     <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/breakpoints.js"></script> -->
<!-- 	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/plugins/flexslider/jquery.flexslider.js"></script> -->
<!--
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/plugins/ezmark/js/jquery.ezmark.min.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/plugins/classie.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/helper.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/plugins/jquery.placeholder.min.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/plugins/jquery.touchSwipe.min.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/plugins/Smart-jQuery-Brightcove-Video-Plugin/jquery.brightcove-video.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/video-portal.js"></script>
-->
<!--
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/script.js"></script>
    <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/script.js"></script>
-->
	<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/rigged-and-ready.js"></script>
<!--
    <link rel="STYLESHEET" type="text/css" href="<?php bloginfo('template_directory'); ?>/js/plugins/flexslider/flexslider.css">
    <link rel="STYLESHEET" type="text/css" href="<?php bloginfo('template_directory'); ?>/js/plugins/ezmark/css/ezmark.css">
-->
	<!--[if lt IE 9]><script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script><![endif]-->

	<?php wp_footer(); ?>
	<?php if(get_field("scroll_tracking","options")){ ?>
	<script src="<?php bloginfo('template_directory'); ?>/js/jquery.scrolldepth.js"></script>
	<script>
		jQuery.scrollDepth();
	</script>
	<?php } ?>
</body>
</html>
<?php
define("JETPACK_SITE", "gundogmag");
define("DARTADGEN_SITE", "imo.gundogmag");
define("SUBS_LINK", "https://secure.palmcoastd.com/pcd/eSv?iMagId=014HS&i4Ky=IBZN");
define("GIFT_LINK", "https://secure.palmcoastd.com/pcd/eSv?iMagId=014HS&i4Ky=IGZN");
define("SERVICE_LINK", "https://secure.palmcoastd.com/pcd/eServ?iServ=MDE0SFM0NDY5NiZpVHlwZT1FTlRFUg==");
define("SUBS_DEAL_STRING", "Save Over 60% off<br/> the Cover Price");

define("FACEBOOK_LINK", "https://www.facebook.com/GunDogMag");
define("TWITTER_LINK", "https://www.twitter.com/@gundogmag");
define("RSS_LINK", "http://www.gundogmag.com/feed/");
define("SITE_LINK", "gundogmag.com");
define("SITE_NAME", "Gun Dog Magazine");

function social_networks(){
	echo '<div class="socials">';
		echo '<a href="'.FACEBOOK_LINK.'" class="facebook">Facebook</a>';
	    echo '<a href="'.TWITTER_LINK.'" class="twitter">Twitter</a>';
	    echo '<a href="'.RSS_LINK.'" class="rss">RSS</a>';
	echo '</div>';
}

function sub_footer(){ ?>
	<div class="sub-boxes">
		<div class="sub-box banner-box">
			<?php imo_dart_tag("300x250",array("pos"=>"mid")); ?>
		</div>
		<div class="sub-box fb-box">
			<div class="newsletter-box bottom-newsletter">
				<?php the_widget("Signup_Widget_Header", "title=GET THE NEWSLETTER!"); ?>
			</div>
		</div>
	</div>
	<?php
}

function social_footer(){ ?>
	<div class="foot-social clearfix">
		<strong class="social-title">Like us on Facebook to <span>stay updated !</span></strong>
		<div class="fb-like" data-href="<?php echo FACEBOOK_LINK; ?>" data-send="false" data-layout="button_count" data-width="100" data-show-faces="true"></div>
		<?php social_networks(); ?>
	</div>
<?php }

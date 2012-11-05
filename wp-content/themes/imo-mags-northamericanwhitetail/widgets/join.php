<?php // Custom Join NAW+ Widget
    
class Join_Widget extends WP_Widget {
	function Join_Widget() {
		$widget_ops = array('classname' => 'widget_gravity_form', 'description' => 'Custom Join NAW+ Widget.' );
		$this->WP_Widget('join', 'Join NAW+', $widget_ops);
	}
 
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
     
    $displayStyle = "display:none";
	$loginStyle = "";
	
	if ( is_user_logged_in() ) {
	
		$displayStyle = "";
		$loginStyle = "display:none";
		
		wp_get_current_user();
		
		$current_user = wp_get_current_user();
	    if ( !($current_user instanceof WP_User) )
	         return;
	    }
    ?>

    <div class="fb-join-widget-box" style="<?php echo $loginStyle; ?>">
	    <aside id="join" class="box widget_gravity_form " style="<?php echo $loginStyle; ?>">
	      <div class="content_wrapper">
	      <h1>Join the NAW Community!</h1>
	      	  <div id="imo-fb-login-button" class="fb-login join-widget-fb-login">Fast Facebook Login</div>
		      <small>*we do not post anything to your wall unless you say so!</small>
		      <a class="email-signup">or use your email address</a>
		      <!--<a class="prize-title">Sign Up Now & You're Automatically Entered to Win a REMINGTON MODEL 700 BDL 50TH ANNIVERSARY EDITION!</a>
		      <div class="prize"></div>
		    <a href="/community/sweeps-rules/" class="about-link">Official Rules</a>-->
	        <a href="/community/help/" class="about-link">What is North American Whitetail +?</a>
	       </div>
	    </aside>
    </div>
    <div class="clear"></div>
<?php	}
 
}
register_widget('Join_Widget');
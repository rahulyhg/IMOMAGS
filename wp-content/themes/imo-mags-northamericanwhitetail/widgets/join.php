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

    <aside id="join" class="box widget_gravity_form" style="<?php echo $loginStyle; ?>">
      <div class="content_wrapper">
      	  <div id="imo-fb-login-button" class="fb-login">Fast Facebook Login</div>
	      <small>*we do not post anything to your wall unless you say so!</small>
	      <a class="email-signup">or use your email address</a>
	      <form style="display:none;" class="join-form">
		  	<input type="email" name="email" class="join-email" placeholder="Your Email">
		  	<input type="submit" name="submit" class="join-submit" value="Join">
	      </form>
	      <div class="clear"></div>
        <a href="#" class="about-link">What is North American Whitetail +?</a>
       </div>
    </aside>

<?php	}
 
}
register_widget('Join_Widget');
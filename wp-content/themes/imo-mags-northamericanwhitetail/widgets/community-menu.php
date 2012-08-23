<?php // Custom Community Menu Widget

class Community_Menu_Widget extends WP_Widget {
	function Community_Menu_Widget() {
		$widget_ops = array('classname' => 'widget_community_menu', 'description' => 'community menu for ubermenu' );
		$this->WP_Widget('community_menu', 'Community Menu', $widget_ops);
	}
 
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
?>

    <aside id="community-menu-nav" class="community-menu-widget">
    	<div class="header">
    		<h2>The NAW Community</h2>
    		<h3>Bringing Whitetailers together</h3>
    	</div>
    	<div class="nav">
	     	<a href="/community/report">State Rut Reports</a>
	     	<a href="/community/trophy">Trophy Bucks</a>
	     	<a href="/community/question">Questions</a>
	     	<a href="/community/gear">Gear</a>
	     	<a href="/community/lifestyle">Lifestyle</a>
			<a href="/community/tip">Tips & Tactics</a>
			<a href="/community/grneral">General Discussion</a>
    	</div>
     	<div id="imo-fb-login-button" class="fb-login join-widget-fb-login">Fast Facebook Login</div>
		<small>*we do not post anything to your wall unless you say so!</small>
    </aside>

<?php	}
 
}
register_widget('Community_Menu_Widget');
<?php // Custom Join NAW+ Widget powered by Gravity Forms

class Join_Widget extends WP_Widget {
	function Join_Widget() {
		$widget_ops = array('classname' => 'widget_gravity_form', 'description' => 'Add a Gravity Form email signup form.' );
		$this->WP_Widget('join', 'Join NAW+', $widget_ops);
	}
 
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
 
    $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']); ?>

    <aside id="join" class="box widget_gravity_form">
      <div class="content_wrapper">
      	<div class="join-sep">
        <span>or</span>
        <input id="fb-signup" class="fb-signup" type="submit" name="fb-signup" value="Submit">
        </div>

        <?php if(!empty($title)) : ?>
        <h5 class="box_title">
          <span><?php echo $title; ?></span>
        </h5>
        <?php endif; ?>
        <?php if (function_exists('gravity_form')) gravity_form(1, false, false); ?>
        <a href="#" class="about-link">Tell me about North American Whitetail +</a>
       </div>
    </aside>

<?php	}
 
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}
 
	function form($instance) {
		$instance = wp_parse_args((array) $instance, array('title' => ''));
		$title = strip_tags($instance['title']);
?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
<?php
	}
}
register_widget('Join_Widget');
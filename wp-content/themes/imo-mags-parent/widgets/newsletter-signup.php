<?php // Custom Signup Form Widget powered by Gravity Forms

class Signup_Widget extends WP_Widget {
	function Signup_Widget() {
		$widget_ops = array('classname' => 'widget_gravity_form', 'description' => 'Add a Gravity Form email signup form.' );
		$this->WP_Widget('newsletter_signup', 'Newsletter Signup', $widget_ops);
	}
 
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
 
    $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']); 
    
	$formID = get_option("newsletter_id");
	
	?>
	
	
<div class="widget newsletter-sidebar">	
	<script type="text/javascript">
	/***********************************************
	* Textarea Maxlength script- � Dynamic Drive (www.dynamicdrive.com)
	* This notice must stay intact for legal use.
	* Visit http://www.dynamicdrive.com/ for full source code
	***********************************************/
	function ismaxlength(obj, mlength)
	{
	  if (obj.value.length > mlength)
	    obj.value = obj.value.substring(0, mlength)
	}
	</script>
	
	
	<form method="post" name="profileform" action="https://intermediaoutdoors.informz.net/clk/remote_post.asp">
	      
		<SCRIPT LANGUAGE="JavaScript">
		function moveCaret(event, objThisField, objNextField, objPrevField, nSize)
		{
			var keynum;
			if(window.event) // IE	
				keynum = event.keyCode;	
			else if(event.which) // Netscape/Firefox/Opera	
				keynum = event.which;				
			if (keynum == 37 || keynum == 39 || keynum == 38 || keynum == 40 || keynum == 8) //left, right, up, down arrows, backspace
			{		
				var nCaretPosition = getCaretPosition(objThisField);		
				if (keynum == 39 && nCaretPosition == nSize)
					moveToNextField(objNextField);		   
				if ((keynum == 37 || keynum == 8) && nCaretPosition == 0)			
					moveToPrevField(objPrevField);		   
				return;
			}
			if (keynum == 9) //Tab
			return;
		if (objThisField.value.length >= nSize && objNextField != null)
			moveToNextField(objNextField);
	}  
	function moveToNextField(objNextField)
	{
		if (objNextField == null)
			return;
		objNextField.focus();
		if (document.selection) //IE
		{
			oSel = document.selection.createRange ();
			oSel.moveStart ('character', 0);
			oSel.moveEnd ('character', objNextField.value.length);
			oSel.select();							
		}
		else
		{
		   objNextField.selectionStart = 0;
	       objNextField.selectionEnd = objNextField.value.length;
		}
	}
	function moveToPrevField(objPrevField)
	{
		if (objPrevField == null)
			return;
		objPrevField.focus();
		if (document.selection) //IE
		{		
			oSel = document.selection.createRange ();
			oSel.moveStart ('character', 0);
			oSel.moveEnd ('character', objPrevField.value.length);
			oSel.select ();					
		}
		else
		{
		   objPrevField.selectionStart = 0;
	       objPrevField.selectionEnd = objNextField.value.length;
		}
	}
	function getCaretPosition(objField)
	{
		var nCaretPosition = 0;
		if (document.selection) //IE
		{
		   var oSel = document.selection.createRange ();
		   oSel.moveStart ('character', -objField.value.length);
		   nCaretPosition = oSel.text.length;
		}	
		if (objField.selectionStart || objField.selectionStart == '0')
	       nCaretPosition = objField.selectionStart;
		return nCaretPosition;
	}
	</script>
	
	
	   <div class="signup-box jq-custom-form">
	        <fieldset>
	             <?php if(!empty($title)) : ?>
				 	<h3><?php echo $title; ?></h3>
				 <?php endif; ?>
	            <div class="signup-mdl">
	                <p class="intro-text">Sign up to receive the latest updates from <?php echo SITE_NAME; ?></p>
	                <div class="f-row">
						<input alt="Email Address" type="text" name="email" size="25" maxlength="100" value="" placeholder="Enter Your Email..." >
	                </div>
	                <script type="text/javascript">
						function ShowDescriptions(SubDomain,val, brid) {
							myWindow = window.open(SubDomain + '/description.asp?brid=' + brid + '&id=' + val, 'Description', 'location=no,height=180,width=440,resizeable=no,scrollbars=yes,dependent=yes');
							myWindow.focus()
						}
					</script>
	                <div class="f-row check-row">
	                    <input alt="Third Party" type="checkbox" checked="checked" value="22697" name="interests" id="receive" />
	                    <input type="hidden" name="OptoutInfo" value="">
	                    <label for="receive">Yes, I'd like to receive offers from your partners</label>
	                </div>
	             </div>
	                <div class="signup-btn-row">
	                    <span class="btn-base"><input type="submit" value="Sign Up" name="update" ></span>
	                </div>
	                <input type=hidden name=fid value=<?php echo $formID; ?>>
					<input type=hidden name=b value=4038>
					<input type=hidden name=returnUrl value="http://<?php echo $_SERVER['SERVER_NAME']; ?>/?zmsg=1">  
	            
			</fieldset>
	    
		</div>
	</form>
</div>
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
register_widget('Signup_Widget');
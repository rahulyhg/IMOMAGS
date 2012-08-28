<?php // Custom Community Topics Widget



class community_topics_Widget extends WP_Widget {
	function community_topics_Widget() {
		$widget_ops = array('classname' => 'widget_community_topics', 'description' => 'Community Topics Widget.' );
		$this->WP_Widget('community_topics', 'Community Topics', $widget_ops);
	}
 
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		
		
		
		$hostname = $_SERVER['SERVER_NAME'];


//Get Post Count Data
$requestURL = "http://$hostname/slim/api/superpost/count/general";

$file = file_get_contents($requestURL);
$generalCount = json_decode($file);
$generalCount = $generalCount[0];

$requestURL2 = "http://$hostname/slim/api/superpost/count/report";

$file2 = file_get_contents($requestURL2);
$reportCount = json_decode($file2);
$reportCount = $reportCount[0];

$requestURL3 = "http://$hostname/slim/api/superpost/count/question";

$file3 = file_get_contents($requestURL3);
$questionCount = json_decode($file3);
$questionCount = $questionCount[0];

$requestURL4 = "http://$hostname/slim/api/superpost/count/trophy";

$file4 = file_get_contents($requestURL4);
$trophyCount = json_decode($file4);
$trophyCount = $trophyCount[0];

$requestURL5 = "http://$hostname/slim/api/superpost/count/tip";

$file5 = file_get_contents($requestURL5);
$tipCount = json_decode($file);
$$tipCount = $tipCount[0];

$requestURL6 = "http://$hostname/slim/api/superpost/count/lifestyle";

$file6 = file_get_contents($requestURL6);
$lifestyleCount = json_decode($file6);
$lifestyleCount = $lifestyleCount[0];

$requestURL7 = "http://$hostname/slim/api/superpost/count/gear";

$file7 = file_get_contents($requestURL7);
$gearCount = json_decode($file7);
$gearCount = $gearCount[0];

$requestURL8 = "http://$hostname/slim/api/superpost/count/tip";

$file8 = file_get_contents($requestURL8);
$tipCount = json_decode($file8);
$tipCount = $tipCount[0];

$requestURL9 = "http://$hostname/slim/api/superpost/count/gear";

$file9 = file_get_contents($requestURL9);
$gearCount = json_decode($file9);
$gearCount = $gearCount[0];
?>

    <aside id="community-topics" class="community-topics-widget">
     	<div class="sidebar-header">
		    <h2>Browse the Community</h2>
		</div>

	         	<ul class="community-cats">
				<li id="rut" class="title"><div></div><h2><a href="/community/report/" term="report" display="list">State Rut Reports</a></h2></li>
				<li class="selected points"><a href="/community/report/"><?php echo $reportCount->post_count.' Posts'; ?></a></li>
			</ul>
			
			<ul class="community-cats">
				<li id="tbucks" class="title"><div></div><h2><a href="/community/trophy/">Trophy Bucks</a></h2></li>
				<li class="selected points"><a href="/community/trophy/"><?php echo $trophyCount->post_count.' Posts'; ?></a></li>
			</ul>
			
			<ul class="community-cats">
				<li id="experts" class="title"><div></div><h2><a href="/community/question/">Q&A</a></h2></li>
				<li class="selected points"><a href="/community/question/"><?php echo $questionCount->post_count.' Posts'; ?></a></li>
			</ul>
			
			<ul class="community-cats">
				<li id="gear" class="title"><div></div><h2><a href="/community/gear/">Gear</a></h2></li>
				<li class="selected points"><a href="/community/gear/"><?php echo $gearCount->post_count.' Posts'; ?></a></li>
			</ul>
			
			<ul class="community-cats">
				<li id="lifestyle" class="title"><div></div><h2><a href="/community/lifestyle/">Lifestyle</a></h2></li>
				<li class="selected points"><a href="/community/lifestyle/"><?php echo $lifestyleCount->post_count.' Posts'; ?></a></li>
			</ul>
			
			<ul class="community-cats">
				<li id="tips-tactics" class="title"><div></div><h2><a href="/community/tip/">Tips & Tactics</a></h2></li>
				<li class="selected points"><a href="/community/tip/"><?php echo $tipCount->post_count.' Posts'; ?></a></li>
			</ul>
			
			<ul class="community-cats">
				<li id="general" class="title"><div></div><h2><a href="/community/general/">General Discussion</a></h2></li>
				<li class="selected points"><a href="/community/general/"><?php echo $generalCount->post_count.' Posts'; ?></a></li>
			</ul>	          
	   </aside>

<?php	}
 
}
register_widget('community_topics_Widget');
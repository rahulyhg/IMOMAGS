<?php

if (!class_exists('cfct_module_featured_thumb_wide') && class_exists('cfct_build_module')) {
	class cfct_module_featured_thumb_wide extends cfct_build_module {
		protected $context_excludes = array(
			'multi-module'
		);
		
		protected $js_base = 'cfct_thumb';
		
		public function __construct() {
			$opts = array(
				'description' => __('A wide thumb Image', 'carrington-build'),
				'icon' => 'featured-thumbs/icon.png'
			);
			parent::__construct('cfct-module-featured-thumb-wide', __('Featured Thumb Wide', 'carrington-build'), $opts);
			add_filter('wp_ajax_cfct_featured_thumbs_post_search', array($this, '_handle_featured_thumbs_request'));
			
			wp_register_script('featured-thumbs-js',$this->get_url().'js/featured-thumbs.js',array('jquery','jquery-ui-core','jquery-ui-tabs'));
			wp_register_style('featured-thumbs-css',$this->get_url().'css/featured-thumbs.css');
			
			if (!is_admin()) {
				
				wp_enqueue_script('jquery-ui-tabs');
				wp_enqueue_script('jquery-ui-core');
				wp_enqueue_script('featured-thumbs-js',NULL,array('jquery','jquery-ui-core','jquery-ui-tabs'));
				wp_enqueue_style('featured-thumbs-css');
			}
			
			
			
			// this is but a small subset of what the JS can do
			// but this is the "good" stuff, the rest is weird or fluffy
			$this->transitions = apply_filters('cfct-featured-thumbs-transitions-options', array(
				'none' => 'No transition effect',
				'fade' => 'Fade between images',
				'scrollHorz' => 'Scroll images left or right, per position',
				'scrollVert' => 'Scroll images up or down, per position',
				'cover' => 'Slide new image in on top',
				'uncover' => 'Slide old image off of top'
			));
			
			$this->nav_positions = apply_filters('cfct-featured-thumbs-nav-positions', array(
				'before' => 'Before Carousel',
				'after' => 'After Carousel',
				'overlay' => 'Inside Overlay'
			));
		}

// Display
		
		/**
		 * contains capacity to have pre-defined links & image urls,
		 * though that functionality is not exposed in the admin
		 *
		 * @param string $data 
		 * @return void
		 */
		public function display($data) {
			$image_size = $data[$this->get_field_name('image_size-size')];
		
			// walk items to make sure they're all valid
			$items = array();
			foreach ($data[$this->get_field_name('posts')] as $item) {
				if (empty($item['link'])) {
					$item['link'] = get_permalink($item['id']);
				}
				
				if (empty($item['img_src'])) {
					$_img = $_img_id = null;
					$_img_id = get_post_meta($item['id'], '_thumbnail_id', true);
					if (!empty($_img_id) && $_img = wp_get_attachment_image_src($_img_id, "huge-thumb", false)) {
						$item['img_src'] = $_img;
						$item['img_src_thumb'] = wp_get_attachment_image_src($_img_id, "thumbnail", false);
					}
				}
				
				// last chance for an image
				if (!empty($item['img_src'])) {
					$items[] = $item;
				}
			}
				
							
			$control_layout_order = apply_filters($this->id_base.'-control-layout-order', array(
				'title',
				'description',
				'call-to-action',
				'pagination'
			));
			
			// carousel defaults
			$car_opts = array(
				'link_images' => !empty($data[$this->get_field_name('link_images')]) ? true : false,
				'height' => intval($data[$this->get_field_name('height')]),
				'nav_pos' => esc_attr($data[$this->get_field_name('nav_pos')]),
				'nav_element' => apply_filters('cfct-featured-thumbs-nav-element', '<div class="car-pagination"><ol></ol></div>'),
				'nav_selector' => apply_filters('cfct-featured-thumbs-nav-selector', '#featured-thumbs-'.$data['module_id'].' .car-pagination ol', '#featured-thumbs-'.$data['module_id'])
			);
			
			// Make sure you quote string values - this distinguishes them from object literals
			$js_opts = apply_filters('cfct-featured-thumbs-js-options', array(
				'fx' => '"' . esc_attr($data[$this->get_field_name('transition')]) . '"',
				'speed' => abs(intval($data[$this->get_field_name('transition_duration')])),
				'timeout' => abs(intval($data[$this->get_field_name('auto_scroll')])),
				'pager' => '"' . $car_opts['nav_selector'] . '"',
				'activePagerClass' => '"active"',
				// Pause when hovering over nav
				'pauseOnPagerHover' => 'true',
				// Pause when hovering over slider
				'pause' => 'true',
				'prev' => '$(\'<a class="cfct-featured-thumbs-prev">'.__('Prev', 'carrington-build').'</a>\').insertBefore("'.$car_opts['nav_selector'].'")',
				'next' => '$(\'<a class="cfct-featured-thumbs-next">'.__('Next', 'carrington-build').'</a>\').insertAfter("'.$car_opts['nav_selector'].'")',
				// Callback for changing pane content
				'before' => 'cfctCarousel.PagerClick',
				'pagerAnchorBuilder' => 'cfctCarousel.PagerAnchorBuilder'
			), $car_opts);
			
			// Don't use json_encode because it quotes object literals, turning them into strings.
			$jobj = array();
			foreach ($js_opts as $key => $value) {
				$jobj[] = $key . ':' . $value;
			}
			$jobj = '{' . implode(',', $jobj) . ' }';
			
			$js_init = apply_filters('cfct-featured-thumbs-js-init', '
			<script type="text/javascript">
				jQuery(function($) {
					$("#featured-thumbs-'.$data['module_id'].' .car-content ul").cycle('.$jobj.');
				});
			</script>', $data['module_id'], $car_opts, $js_opts);
	
			return $this->load_view($data, compact('items', 'control_layout_order', 'image_size', 'car_opts', 'js_init'));
		}
		
// Admin

		public function text($data) {
			return 'Featured Thumb';
		}
		
		public function admin_form($data) {
			$size_select_args = array(
				'field_name' => 'image_size',
				'selected_size' => (!empty($data[$this->get_field_name('image_size-size')]) ? $data[$this->get_field_name('image_size-size')] : 'large')
			);
			
			$tabs = array(
				'car-items' => 'Items',
				
			);
			
			$transition_duration = !empty($data[$this->get_field_name('transition_duration')]) ? $data[$this->get_field_name('transition_duration')] : 300;
			$auto_scroll = !empty($data[$this->get_field_name('auto_scroll')]) ? $data[$this->get_field_name('auto_scroll')] : 0;
			$carousel_height = !empty($data[$this->get_field_name('height')]) ? $data[$this->get_field_name('height')] : '';
			$nav_pos = !empty($data[$this->get_field_name('nav_pos')]) ? $data[$this->get_field_name('nav_pos')] : 'after';
			
			$html = $this->cfct_module_tabs('cfct-car-tabs', $tabs, 'car-items').'
				<div id="cfct-car-tab-containers" class="cfct-module-tab-contents">
					<div id="car-settings" class="cfct-lbl-pos-left">
						<div class="cfct-elm-block">
							'.$this->_image_selector_size_select($size_select_args).'
						</div>
						<div class="cfct-elm-block has-checkbox mar-bottom-double">
							<input type="checkbox" class="elm-checkbox" id="'.$this->get_field_id('link_images').'" name="'.$this->get_field_name('link_images').'" value="1" '.checked('1', $data[$this->get_field_name('link_images')], false).' />
							<label for="'.$this->get_field_id('link_images').'" class="lbl-checkbox">'.__('Link images', 'carrington-buld').'</label>
						</div>
						<div class="cfct-elm-block elm-width-100">
							<label for="'.$this->get_field_id('height').'" class="lbl-text">'.__('Carousel Height', 'carrington-build').'</label>
							<input type="text" name="'.$this->get_field_name('height').'" id="'.$this->get_field_id('height').'" value="'.$carousel_height.'" class="elm-text"/>
							<span class="elm-help">pixels <em>(leave blank to set height based on tallest image)</em></span>
						</div>
						<div class="cfct-elm-block mar-bottom-double">
							<label class="lbl-select" for="'.$this->get_field_id('nav_pos').'">'.__('Navigation position', 'carrington-build').'</label>
							<select id="'.$this->get_field_id('nav_pos').'" name="'.$this->get_field_name('nav_pos').'" class="elm-select">';
			foreach ($this->nav_positions as $nav_pos_name => $nav_pos_title) {
				$html .= '
								<option value="'.$nav_pos_name.'"'.selected($nav_pos_name, $nav_pos, false).'>'.$nav_pos_title.'</option>';
			}		
			$html .= '
							</select>
						</div>
						<div class="cfct-elm-block">
							<label  class="lbl-select" for="'.$this->get_field_id('transition').'">'.__('Transition', 'carrington-build').'</label>
							<select id="'.$this->get_field_id('transition').'" name="'.$this->get_field_name('transition').'" class="elm-select">';
			foreach ($this->transitions as $transition_name => $transition_title) {
				$html .= '
								<option value="'.$transition_name.'"'.selected($transition_name, $data[$this->get_field_name('transition')], false).'>'.$transition_title.'</option>';
			}

			$html .= '
							</select>
						</div>
						<div class="cfct-elm-block elm-width-100">
							<label class="lbl-text" for="'.$this->get_field_name('transition_duration').'">'.__('Transition duration', 'carrington-build').'</label>
							<input type="text" name="'.$this->get_field_name('transition_duration').'" id="'.$this->get_field_id('transition_duration').'" value="'.intval($transition_duration).'" class="elm-text" /> 
							<span class="elm-help">'.__('milliseconds', 'carrington-build').'</span>
						</div>
						<div class="cfct-elm-block elm-width-100">
							<label class="lbl-text" for="'.$this->get_field_name('auto_scroll').'">'.__('Auto-scroll every', 'carrington-build').'</label>
							<input type="text" name="'.$this->get_field_name('auto_scroll').'" id="'.$this->get_field_id('auto_scroll').'" value="'.intval($auto_scroll).'" class="elm-text" /> 
							<span class="elm-help">'.__('milliseconds <i>(set to 0 to turn off auto-scroll)</i>', 'carrington-build').'</span>
						</div>
					</div>
					
					<div id="car-items" class="active">
						<div id="car-item-search" class="car-item-search-container">
							<label for="car-search-term">'.__('Search to add item:', 'carrington-build').'</label>
							<input type="text" name="car-search-term" id="car-search-term" value="" />
							<span class="elm-help elm-align-bottom">'.__('Only items with a featured image are available.', 'carrington-build').'</span>
						</div>
						<div class="car-items-wrapper">
							<ol class="featured-thumbs-list">';
				if (count($data[$this->get_field_name('posts')])) {
					foreach ($data[$this->get_field_name('posts')] as $item) {
						$html .= $this->get_featured_thumbs_admin_item($item);
					}
				}
				else {
					$html .= '
								<li class="no-items">'.__('No items in carousel', 'carrington-build').'</li>';
				}
				$html .= '
							</ol>
						</div>
					</div>
				</div>';
			return $html;
		}
		
		public function update($new, $old) {
			return $new;
		}
		
		
		/* Due to bad theme settings, this function does nothing */
		public function css() {
			$css = "
				/**
				 * Featured Widget
				 */
				
				#block-gunsandammo_blocks-front_page_featured_widget {
				  width: 420px; height: 365px; position:relative; margin-left:20px;float:left;overflow:hidden;
				}
				.featured-item-pane {
				  position: relative; height:275px;width: 100%;
				}
				.ui-tabs-hide {
				display: none;
				}
				.featured-item-image {
				  position:absolute;
				  z-index:2;
				  top:0;
				  left:0;
				  padding:0;margin:0;
				  overflow:hidden;
				}
				.featured-item-description {
				  position: absolute;
				  z-index:3;
				  width:100%;
				  left:0;bottom:0;
				  padding:0px;margin:0; background-color: black;
				  background: url(../images/black80.png);
				}
				.featured-item-description h2 {
				  margin:0;color:white;  font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
				  font-size: 30px;opacity:1;padding:20px;
				  font-weight: bold;letter-spacing: -1px;line-height:30px;
				}
				.featured-item-description h2 a {color:white;}
				#featured-articles-navigator {list-style:none;margin:0;padding:0;display:block;
				  height: 90px; position:absolute; bottom: 0;
				}
				#featured-articles-navigator li.first {margin-left:0;} 
				
				#featured-articles-navigator li {list-style:none; padding-top: 8px;margin-top:4px;float:left;
				display:block; width: 100px;height:79px; margin-left:6px;
				}
				#featured-articles-navigator li.ui-tabs-selected {
				  background-image: url(/sites/all/themes/gunsandammo/images/tab-selected-arrow-up.png);
				  background-position: center top;
				  background-repeat: no-repeat;
				  } 
				#featured-articles-navigator li a {background-color: #231F20; display:block;height: 71px;width:96px;border:2px solid #231F20;}
				.featured-articles .tab-content { cursor: pointer; }
				";
			
			
			
			return $css;
		}
		
		public function admin_css() {
			return preg_replace('/^(\t){4}/m', '', '
				.featured-thumbs-sortable-placeholder {
					height: 18px;
					background-color: gray;
					border: 1px solid white;
					border-width: 1px 0
				}
				
				/* Carousel List */
				.featured-thumbs-list {
					background-color: #eee;
					border: 1px solid #aaa;
					-moz-border-radius: 5px; /* FF1+ */
					-webkit-border-radius: 5px; /* Saf3+, Chrome */
					border-radius: 5px; /* Standard. IE9 */
					padding: 0;
					margin: 0;
				}
				.featured-thumbs-list li {
					border-bottom: 1px solid #aaa;
					list-style-type: none;
					margin: 0;
					min-height: 45px;
					padding: 5px;
				}
				.featured-thumbs-list li:hover {
					background: #fff url('.$this->get_url().'img/featured-thumbs-drag.gif) 100% 50% no-repeat;
					cursor: move;
				}
				.featured-thumbs-list li.featured-thumbs-item-edit:hover {
					background: none;
				}
				.featured-thumbs-list li:first-child {
					-moz-border-radius-topleft: 4px; /* FF1+ */
					-webkit-border-top-left-radius: 4px; /* Saf3+, Chrome */
					border-top-left-radius: 4px; /* Standard. IE9 */
					-moz-border-radius-topright: 4px; /* FF1+ */
					-webkit-border-top-right-radius: 4px; /* Saf3+, Chrome */
					border-top-right-radius: 4px; /* Standard. IE9 */
				}
				.featured-thumbs-list li:last-child {
					border-bottom: 0;
					-moz-border-radius-bottomleft: 4px; /* FF1+ */
					-webkit-border-bottom-left-radius: 4px; /* Saf3+, Chrome */
					border-bottom-left-radius: 4px; /* Standard. IE9 */
					-moz-border-radius-bottomright: 4px; /* FF1+ */
					-webkit-border-bottom-right-radius: 4px; /* Saf3+, Chrome */
					border-bottom-right-radius: 4px; /* Standard. IE9 */
				}
				/* clearfix */
				.featured-thumbs-list li:after { content: "."; display: block; height: 0; clear: both; visibility: hidden; }

				/* Floating */
				.featured-thumbs-item-img,
				.featured-thumbs-item-title,
				.featured-thumbs-edit-form {
					float: left;
				}

				/* Setting heights */
				.featured-thumbs-item-img,
				.featured-thumbs-item-title {
					height: 45px;
				}
				.featured-thumbs-item-img {
					background: #D2CFCF url('.$this->get_url().'img/featured-thumbs-none-icon.png) center center no-repeat;
					display: inline-block;
					margin-right: 10px;
					width: 150px;
				}
				.featured-thumbs-item-title {
					font-size: 15px;
					line-height: 42px;
				}

				/* Show/hide elements for editing */
				.featured-thumbs-item-edit .featured-thumbs-item-title {
					display: none;
				}
				.featured-thumbs-item-edit .featured-thumbs-item-img {
					height: 150px;
					background-position: 0px 0px !important;
				}
				.featured-thumbs-edit-form {
					display: none;
				}
				.featured-thumbs-item-edit .featured-thumbs-edit-form {
					display: block;
				}

				/* Edit mode */
				.featured-thumbs-edit-form {
					padding: 5px 0;
					width: 475px;
				}
				.featured-thumbs-edit-form label {
					display: none;
				}
				.featured-thumbs-edit-form input.text,
				.featured-thumbs-edit-form textarea {
					width: 90%;	
				}
				.featured-thumbs-edit-form input.text {
					font-size: 13px;
					margin-bottom: 8px;
				}
				.featured-thumbs-edit-form textarea {
					font-size: 11px;
					height: 80px;
				}
				.featured-thumbs-edit-done {
					margin-top: 7px;
				}
				.featured-thumbs-edit-remove {
					line-height: 1px;
					margin: 0 0 0 10px;
				}			
				
				/* Carousel Live Search */
				#car-items {
					min-height: 400px;
				}
				.cfct-popup-content #car-item-search {
					margin-bottom: 10px;
					position: relative;
				}
				.cfct-popup-content #car-item-search label {
					float: left;
					font-size: 13px;
					font-weight: bold;
					line-height: 23px;
					width: 165px;
				}
				.cfct-popup-content #car-item-search .elm-align-bottom {
					padding-left: 165px;
				}
				.cfct-module-form .cfct-popup-content #car-item-search #car-search-term {
					/**
					 * @workaround absolute positioning fix
					 * IE doesn\'t position absolute elements beneath inline-block els
					 * instead, it overlays them on top of elements.
					 * Basically, this caused the type-ahead search to sit on top
					 * of the input. A simple display: block fixes it.
					 * @affected ie7
					 */
					display: block;
					margin: 0;
					width: 500px; 
				}
				.cfct-popup-content #car-item-search .otypeahead-target {
					background: white;
					border: 1px solid #ccc;
					-moz-border-radius-bottomleft: 5px; /* FF1+ */
					-moz-border-radius-bottomright: 5px; /* FF1+ */
					-webkit-border-bottom-left-radius: 5px; /* Saf3+, Chrome */
					-webkit-border-bottom-right-radius: 5px; /* Saf3+, Chrome */
					border-bottom-left-radius: 5px; /* Standard. IE9 */
					border-bottom-right-radius: 5px; /* Standard. IE9 */
					border-width: 0 1px 1px 1px;
					display: none;
					left: 0;
					margin-top: 0;
					margin-left: 165px;
					padding: 0;
					position: absolute;
					width: 498px;
					z-index: 99;
				}
				.cfct-popup-content #car-item-search .otypeahead-target ul,
				.cfct-popup-content #car-item-search .otypeahead-target li,
				.cfct-popup-content #car-item-search .otypeahead-target li a {
					margin: 0;
					padding: 0;
				}
				.cfct-popup-content #car-item-search .otypeahead-target li a {
					color: #454545;
					text-decoration: none;
					display: block;
					/*width: 738px;*/
					padding: 5px;
				}
				.cfct-popup-content #car-item-search .otypeahead-target li a:hover,
				.cfct-popup-content #car-item-search .otypeahead-target li.otypeahead-current a {
					color: #333;
					background-color: #eee;
				}
				.cfct-popup-content #car-item-search .otypeahead-target li .featured-thumbs-item-title,
				.cfct-popup-content #car-item-search .otypeahead-target li.no-items-found {
					float: none;
					font-size: 12px;
					height: 15px;
					line-height: 15px;
				}
				.cfct-popup-content #car-item-search .otypeahead-target li:last-child a {
					-moz-border-radius-bottomleft: 5px; /* FF1+ */
					-moz-border-radius-bottomright: 5px; /* FF1+ */
					-webkit-border-bottom-left-radius: 5px; /* Saf3+, Chrome */
					-webkit-border-bottom-right-radius: 5px; /* Saf3+, Chrome */
					border-bottom-left-radius: 5px; /* Standard. IE9 */
					border-bottom-right-radius: 5px; /* Standard. IE9 */
				}
				.cfct-popup-content #car-item-search .otypeahead-target li.no-items-found,
				.cfct-popup-content #car-item-search .otypeahead-target li .otypeahead-loading {
					padding: 5px;
				}
				.cfct-popup-content #car-item-search .otypeahead-target .cfct-module-featured-thumbs-loading {
					padding: 5px;
					font-size: .9em;
					color: gray;
					-moz-border-radius-bottomleft: 5px; /* FF1+ */
					-moz-border-radius-bottomright: 5px; /* FF1+ */
					-webkit-border-bottom-left-radius: 5px; /* Saf3+, Chrome */
					-webkit-border-bottom-right-radius: 5px; /* Saf3+, Chrome */
					border-bottom-left-radius: 5px; /* Standard. IE9 */
					border-bottom-right-radius: 5px; /* Standard. IE9 */
				}
				.cfct-popup-content #car-item-search .otypeahead-target li .featured-thumbs-item-img {
					display: none;
				}
			');
		}
		
		/**
		 * Admin JS functionality for type-ahead-search
		 *
		 * @uses o-type-ahead.js
		 * @return string
		 */
		public function admin_js() {
			$js_base = str_replace('-', '_', $this->id_base);
			$js = preg_replace('/^(\t){4}/m', '', '
			
				cfct_builder.addModuleLoadCallback("'.$this->id_base.'", function() {
					'.$this->cfct_module_tabs_js().'
					
					// set up search
					$("#car-item-search #car-search-term").oTypeAhead({
						searchParams: {
							action: "cfct_featured_thumbs_post_search",
							carousel_action: "do_search"
						},
						url:cfct_builder.opts.ajax_url,
						loading: "<div class=\"'.$this->id_base.'-loading\">'.__('Loading...', 'carrington-build').'<\/div>",
						form: ".car-item-search-container",
						disableForm: false,
						resultsCallback: function(target) {
							$(target).unbind().bind("otypeahead-select", function() {
								var _insert = $(this).find("li.otypeahead-current").clone().removeClass("otypeahead-current");
								'.$js_base.'_insert_selected_item(_insert);
							}).find("a").click(function() {
								var _insert = $(this).closest("li").clone();
								'.$js_base.'_insert_selected_item(_insert);
								return false;
							});
						}
					});
									
					// init sortabled
					$("#car-items ol").sortable({
						items: "li",
						axis: "y",
						opacity: 0.6,
						containment: "parent",
						placeholder: "featured-thumbs-sortable-placeholder"
					});
				});
			
				var '.$js_base.'_insert_selected_item = function(_insert) {
					$("#car-items ol").append(_insert).find(".no-items").hide().end().sortable("refresh");
					$("a.featured-thumbs-post-item-ident", _insert).trigger("click");
					$("body").trigger("click");
					$("#car-item-search #car-search-term").val("");
				};
			
				cfct_builder.addModuleSaveCallback("'.$this->id_base.'", function() {
					$("#car-item-search .otypeahead-target").children().remove();
				});
			
				// set up post edit
				$("#car-items li.featured-thumbs-post-item .featured-thumbs-post-item-ident, #car-items li.featured-thumbs-post-item .featured-thumbs-item-img").live("click", function() {
					$(this).closest(".featured-thumbs-post-item").addClass("featured-thumbs-item-edit");
					return false;
				});
								
				// set up post done edit
				$("#car-items li.featured-thumbs-post-item .featured-thumbs-edit-done").live("click", function() {
					$(this).closest(".featured-thumbs-post-item").removeClass("featured-thumbs-item-edit");
					return false;
				});
								
				// set up post remove
				$("#car-items li.featured-thumbs-post-item .featured-thumbs-edit-remove a").live("click", function() {
					if (confirm("Do you really want to remove this item?")) {
						$(this).closest(".featured-thumbs-post-item").remove();
						_parent = $("#car-items ol");
						if (_parent.children().length == 1) {
							$(".no-items", _parent).show();
						}
					}
					return false;
				});
				');
			return $js;
		}
		
		public function js() {
			return '
				/**
				 * Tab Callbacks
				 */
				
				// $(document).ready(function() {
				//	$(".featured-articles ul#featured-articles-navigator").tabs();
				//      });
				
				//$(function() {
				//	
				//	$(".featured-articles ul#featured-articles-navigator").tabs();
				//	$("#loadcover").fadeOut("slow");
				//	$(".featured-articles ul#featured-articles-navigator").tabs("rotate", 4250);
				//	     
				//	$(".featured-articles .tab-content").each(function(i, o){
				//	    $(o).click(function(){
				//	      window.location=$("h2 > a",this).attr("href");  
				//	    });
				//	});
				//});
			';
		}
		
		/**
		 * Formats the data for admin editing 
		 *
		 * @param $postdata - pro-processed post information
		 * @return string HTML
		 */
		protected function get_featured_thumbs_admin_item($postdata) {
			$img = array();
			$img_id = get_post_meta($postdata['id'], '_thumbnail_id', true);
			if (!empty($img_id)) {
				$imgdata = wp_get_attachment_image_src($img_id, 'thumbnail', false);
				$img_style = ' style="background: url('.$imgdata[0].') 0 -52px"';
			}
			else {
				$img_style = null;
			}
						
			$html = '
				<li class="featured-thumbs-post-item">
					<div class="featured-thumbs-item-img"'.$img_style.'></div>
					<a class="featured-thumbs-post-item-ident featured-thumbs-item-title" href="#featured-thumbs-post-'.intval($postdata['id']).'">'.esc_html($postdata['title']).'</a>
					<div class="featured-thumbs-edit-form">
						<input type="hidden" name="'.$this->get_field_name('posts').'['.$postdata['id'].'][id]" value="'.intval($postdata['id']).'" />
						<label>Title</label>
						<input type="text" class="text" name="'.$this->get_field_name('posts').'['.$postdata['id'].'][title]" value="'.esc_attr($postdata['title']).'" />
						<label>Description</label>
						<textarea name="'.$this->get_field_name('posts').'['.$postdata['id'].'][content]">'.esc_textarea($postdata['content']).'</textarea>
						<input type="button" name="done" class="button featured-thumbs-edit-done" value="Done" />
						<span class="featured-thumbs-edit-remove trash"><a href="#remove" class="lnk-remove">remove</a></span>
					</div>
				</li>
				';			
			return $html;
		}
		
// Search Request
		
		public function _handle_featured_thumbs_request() {
			if (!empty($_POST['carousel_action'])) {
				switch($_POST['carousel_action']) {
					case 'do_search':
						$this->_featured_thumbs_do_search();
						break;
				}
				exit;
			}
		}
		
		protected function _featured_thumbs_do_search() {
			// ONLY PULLS POSTS THAT HAVE A FEATURED IMAGE
			$s = new WP_Query(array(
				's' => $_POST['car-search-term'],
				'post_type' => apply_filters('cfct-featured-thumbs-search-in', array_filter(get_post_types(array('public' => 1)), array($this, 'filter_post_types'))),
				'posts_per_page' => 8,
				'meta_key' => '_thumbnail_id'
			));
			
			$ret = array(
				'html' => '',
				'key' => $_POST['key']
			);
			if ($s->have_posts()) {
				$html = '<ul>';
				while ($s->have_posts()) {
					$s->the_post();
					remove_filter('the_content', 'wptexturize');
					$postdata = array(
						'id' => get_the_id(),
						'title' => get_the_title(),
						'link' => get_permalink(),
						'content' => get_the_excerpt()
					);
					add_filter('the_content', 'wptexturize');
					$html .= $this->get_featured_thumbs_admin_item($postdata);
				}
				$html .= '</ul>';
				$ret['html'] = $html;
			}
			else {
				$ret['html'] = '<ul><li class="no-items-found">No items found for search: "'.esc_html($_POST['car-search-term']).'"</li></ul>';
			}
						
			header('content-type: application/javascript');
			echo json_encode($ret);
			exit;
		}
		
		protected function filter_post_types($var) {
			return !in_array($var, array('attachment', 'revision', 'nav_menu_item'));
		}
		
// Content Move Helpers
		
		public function get_referenced_ids($data) {
			$references = array();			
			if (!empty($data[$this->gfn('posts')])) {
				$references['posts'] = array();
				foreach ($data[$this->gfn('posts')] as $post_id => $post_info) {
					$post = get_post($post_id);
					$references['posts'][$post_id] = array(
						'type' => 'post_type',
						'type_name' => $post->post_type,
						'value' => $post_info['id']
					);
				}
			}

			return $references;
		}
		
		public function merge_referenced_ids($data, $reference_data) {
			if (!empty($reference_data['posts']) && !empty($data)) {
				foreach ($reference_data['posts'] as $key => $r_data) {
					// Data here is stored with the post_id in the data as well as being the array key,
					// so we need to nuke the old value with the old post_id key and replace it with 
					// the new post_id as the key and the updated post_info
					$_post_info = $data[$this->gfn('posts')][$key];
					unset($data[$this->gfn('posts')][$key]);
					$_post_info['id'] = $r_data['value'];
					$data[$this->gfn('posts')][$r_data['value']] = $_post_info;
				}
			}

			return $data;
		}
	}
	cfct_build_register_module('cfct_module_featured_thumb_wide');
}
?>
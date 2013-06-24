jQuery(function(){
    
    // Load more 
    jQuery(document).ready(function () {

		if(jQuery(".next-link a").length){
		    jQuery("a.btn-base").show();
	    }
    });	
   	
   	jQuery(function(){
        jQuery(".pager-holder a.btn-base").click(function(e){
            jQuery("#ajax-loader").show();
            if (jQuery(window).width() <  610 ) {
                var findId = 'div.post, div.posts-image-banner';
            } else {
                var findId = 'div.post';
            }

            e.preventDefault();
            if (jQuery(".next-link a").length) {
                jQuery.ajax({
                    url: jQuery(".next-link a").attr('href'),
                    dataType: 'html',
                    success: function(data) {
                    	
                        jQuery('.main-content-preppend').append(
                            jQuery(data).find('.js-responsive-section').find(findId).hide()
                        );
                        jQuery('.main-content-preppend').find(findId).show('slow');
                        if (jQuery(data).find('.next-link a').length) {
                            jQuery(".next-link a").attr({'href': jQuery(data).find('.next-link a').attr('href')});
                        } else {
                            jQuery(".pager-holder a.btn-base").hide();
                        }
                        jQuery("#ajax-loader").hide();
                        //refresh the sticky ad on load more
                        if (jQuery(window).width() >  610 ) {
                        	document.getElementById('sticky-iframe-ad').contentWindow.location.reload();
                        	jQuery(".sidebar.advert").css({
	                        	display: 'block',
								position: 'fixed',
								top: 10
							});
                        }
                        if(jQuery(".next-link a").length){
						    jQuery("a.btn-base").show();
					    }
					}
                });
            }
        });
    });

	// Flash ad z-index pecking order fix
	jQuery(function(){
		FlashHeed.heed();
	});
	
    // jFollow
	jQuery(function(){
		if (jQuery(".advert").length > 0) {
			jQuery('.advert').jfollow('#responderfollow');
		}
	});

    jQuery('.jq-slider').flexslider({
        animation: "slide",
        animationSpeed: 200,
        slideshow: false
      });
      
    jQuery('.jq-ma-slider').flexslider({
        animation: "slide",
        animationSpeed: 200,
        slideshow: true
      });
      
    jQuery('.jq-featured-slider').flexslider({
        animation: "slide",
        animationSpeed: 200,
        slideshow: true
      });
      
    jQuery('.jq-paging-slider').flexslider({
          animation: "slide",
          animationSpeed: 200,
          slideshow: false,
          itemWidth: 312,
          itemMargin: 0,
          minItems: 1,
          maxItems: 3
        });
    
    jQuery('.jq-single-paging-slider').flexslider({
          animation: "slide",
          animationSpeed: 200,
          slideshow: false,
          itemWidth: 340,
          itemMargin: 0,
          minItems: 1,
          maxItems: 1
        });
     
    /*jQuery('.jq-cabela-slider').flexslider({
          animation: "slide",
          animationSpeed: 200,
          slideshow: false,
          itemWidth: 318,
          itemMargin: 0,
        });*/
        
       
    
    jQuery('.jq-custom-form input[type="checkbox"]').ezMark();
    
    // floating banner
    /*var sticky_navigation_offset_top;
    
    sticky_navigation_offset_top = jQuery('.sticky-ads').offset().top;
    
    jQuery(window).on('resize', function(e){
        sticky_navigation_offset_top = jQuery('.sticky-ads').offset().top;
    });
    
    var sticky_navigation = function(){
        var scroll_top = jQuery(window).scrollTop();
        if (scroll_top > sticky_navigation_offset_top) {
            jQuery('.sticky-ads').css({ 'position': 'fixed', 'top':20 }).addClass('fix');
        } else {
            jQuery('.sticky-ads').css({ 'position': 'relative', 'top':0 }).removeClass('fix');
        }
    };
    sticky_navigation();
    jQuery(window).scroll(function() { sticky_navigation(); });
    jQuery(window).scroll(function() {
        footertotop = (jQuery('#footer').position().top);
            // distance user has scrolled from top, adjusted to take in height of sidebar (500 pixels inc. padding)
            scrolltop = jQuery(document).scrollTop() + 500;
            // difference between the two
            difference = scrolltop - footertotop;

            // if user has scrolled further than footer,
            // pull sidebar up using a negative margin

            if (scrolltop > footertotop) {

                jQuery('.sticky-ads').css('margin-top', 0 - difference);
            }

            else {
                jQuery('.sticky-ads').css('margin-top', 0);
            }
    });*/
});

jQuery('.jq-go-top').click(function(){
    jQuery('html, body').animate({scrollTop:0}, 'slow');
    return false;
});

jQuery('.jq-open-search').toggle(function(){
        jQuery('.h-search-form').addClass('h-search-open');
        
    },function(){
        jQuery('.h-search-form').removeClass('h-search-open');
    });

jQuery('.jq-filter-by').toggle(function(){
        jQuery('.filter-by').addClass('filter-open');
        
    },function(){
        jQuery('.filter-by').removeClass('filter-open');
    });
    
// mobile menu
var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
    showLeftPush = document.getElementById( 'showLeftPush' ),
    body = document.body;

    showLeftPush.onclick = function() {
    classie.toggle( this, 'active' );
    classie.toggle( body, 'cbp-spmenu-push-toright' );
    classie.toggle( menuLeft, 'cbp-spmenu-open' );
    jQuery(".header").css("position","");
};

//causing error for selecting text
/*jQuery(window).swipe( {
    swipeLeft:function() {
      jQuery(body).removeClass('cbp-spmenu-push-toright');
      jQuery(menuLeft).removeClass('cbp-spmenu-open');
    }
  });*/
  
jQuery(".swipe-out, .header").swipe( {
    swipeLeft:function() {
      jQuery(body).removeClass('cbp-spmenu-push-toright');
      jQuery(menuLeft).removeClass('cbp-spmenu-open');
    }
});

jQuery('.cbp-spmenu-vertical').on("click", ".menu-main-menu-container .has-drop", function(){
    jQuery(this).parent("li").toggleClass('drop-open');
});
jQuery('.cbp-spmenu-vertical').on("click", ".menu-main-menu-container .has-drop", function(e){
    e.preventDefault();
});

jQuery(window).load(function() {
   jQuery('.onload-hidden, .mobile-orientation .menu-main-menu-container, .mobile-orientation .menu-top-menu-container').show().css('left','0');
   
   
    
});
    
//placeholder
jQuery('input[placeholder], textarea[placeholder]').placeholder();

// iphone scale fix
MBP.scaleFix();

function updateSliderCounter(slider){
    jQuery(slider).find('.slide-count').html((slider.currentSlide + 1) + '/' + slider.count);
}
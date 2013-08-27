jQuery(document).ready(function(){


//*******************************************************
//****************** NEW COMMENT SUBMISSION ****************
//*******************************************************
    $("#comment-form").submit(function(){

        var formDataObject = $("#comment-form").formParams();
        var newPostData = $.extend(formDataObject,userIMO);

        alert("comment?");

        $.post("http://" + document.domain + "/community-api/posts",newPostData,function(data){

            var postData = $.parseJSON(data);

            alert("Comment Added?!")
			$("#replies-list").append('<li>' + postData.body + '</li>').fadeIn();
            //window.location.href = "/photos/" + postData.id;
        });

        return false;

    });


//*************************************************
//***********Animate interface Elements************
//*************************************************

    $('.basic-popup').on("click", ".jq-close-popup .filter-fade-in", function(e){
        $(".basic-popup").removeClass("popup-opened");
        $(".filter-fade-out").removeClass("filter-fade-in");
        $(".layout-frame").removeClass("filter-popup-opened");
        e.preventDefault();
    });

    $('body').on("click", ".jq-open-reg-popup", function(e){
        $(".reg-popup").addClass("popup-opened");
        $(".filter-fade-out").addClass("filter-fade-in");
        $(".layout-frame").addClass("filter-popup-opened");
        $('html, body').animate({scrollTop:0}, 'slow');
        return false;
    });

    $('body').on("click", ".jq-open-cat-popup", function(){
        $(".cat-popup").addClass("popup-opened");
        $(".filter-fade-out").addClass("filter-fade-in");
        $(".layout-frame").addClass("filter-popup-opened");
        $('html, body').animate({scrollTop:0}, 'slow');
        return false;
    });

    $('body').on("click", ".jq-open-state-popup", function(){
        $(".state-popup").addClass("popup-opened");
        $(".filter-fade-out").addClass("filter-fade-in");
        $(".layout-frame").addClass("filter-popup-opened");
        $('html, body').animate({scrollTop:0}, 'slow');
        return false;
    });

    $('body').on("click", ".jq-open-reply-slide", function(){
        $(".post-reply-slide").addClass("slide-opened");
       // $('html, body').animate({scrollTop:0}, 'slow');
        return false;
    });

    $('body').on("click", ".jq-open-login-popup", function(){
        $(".login-popup").addClass("popup-opened");
        $(".filter-fade-out").addClass("filter-fade-in");
        $(".layout-frame").addClass("filter-popup-opened");
        $('html, body').animate({scrollTop:0}, 'slow');
        return false;
    });

    $('.jq-explore-slider').flexslider({
        animation: "slide",
        animationSpeed: 200,
        slideshow: false,
        controlNav: false,
        directionNav: false,
        itemWidth: 123,
        itemMargin: 0,
        minItems: 2,
        maxItems: 4
    });

    $('.jq-custom-form select').zfselect({
        rows:6
    });


});
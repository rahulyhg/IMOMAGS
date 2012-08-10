jQuery(document).ready(function($) {


var displayAtOnce = 6;
var currentDisplayStart = 0;
var displayMode = "tile"; //either "list" or "tile"

var bgcolors = new Array("#403b35","#c65517","#829b40");


//Make sure we should run all of this stuff
if ($("#recon-activity").length > 0){

	//First get any extra term and display type
	var term = $("#recon-activity").attr("term");
	var displayMode = $("#recon-activity").attr("display");
	var widthMode = $("#recon-activity").attr("widthMode");
	
	if (displayMode == "tile") { //then show some tiles
		displayRecon(term);

	} else { //then show the list
		displayReconList(term);
	}
}

//Display the user posts
if ($("#user-activity").length > 0){
	
	var userID = $("#user-activity").attr("user");
	
	displayUserPosts(userID);
}

/* ON ICE
//**************************
//COMMUNITY PAGE ACTIONS
//************************** 
  
  //Show the community posts and hide the list and sidebar
	$('#rut.title a').click(function(){
		$(".community").fadeOut();
		$(".bonus-background").fadeOut();
		$(".super-header").fadeOut();
		$(".back-to-community").fadeIn();
		$("#recon-activity").attr("term","report");
		$("#recon-activity").attr("display","list");
		term = $(this).attr("term");
		displayMode = $(this).attr("display");

		displayAtOnce = 6;
		
		currentDisplayStart = 0;
		

		if (displayMode == "tile") { //then show some tiles
			displayRecon(term);
	
		} else { //then show the list
			displayReconList(term);
		}
		$("ul.post-type-select li.selected").removeClass("selected");
		$("ul.post-type-select li").hasClass("report-nav").addClass("selected");		

	});
	// Show the list and sidebar again and hide the back button
	$('.back-to-community').click(function(){
		$(".community").fadeIn();
		$(".bonus-background").fadeIn();
		$(".super-header").fadeIn();
		$(".back-to-community").fadeOut();
		
		$("#recon-activity").attr("term","all");
		$("#recon-activity").attr("display","tile");
		term = $(this).attr("term");
		displayMode = $(this).attr("display");

		displayAtOnce = 6;
		
		currentDisplayStart = 0;
		

		if (displayMode == "tile") { //then show some tiles
			displayRecon(term);
	
		} else { //then show the list
			displayReconList(term);
		}

	});
*/
//activate Recon Network Controls - tabs
$("ul.post-type-select li.change").click(function(){
	
	var postType = $(this).attr('title');

	currentDisplayStart = 0;

	if (displayMode == "tile") { //then show some tiles
		displayRecon(postType);

	} else { //then show the list
		displayReconList(postType);
	}

	$("ul.post-type-select li.selected").removeClass("selected");
	$(this).addClass("selected");	
});
// recent posts tab on user profile page
$("ul.post-type-select li.user-profile").click(function(){
	
	var userID = $(this).attr('user');
	var display = $(this).attr('display');
	
	currentDisplayStart = 0;
	if (display == "recent") { 
		displayUserPosts(userID);
	}else{ 
		displayUserComments(userID);
	}

	$("ul.post-type-select li.selected").removeClass("selected");
	$(this).addClass("selected");	
});



//activate Recon Network Controls - more button
$("#more-superposts-button").click(function(){
	
	var postType = $("ul.post-type-select li.selected").attr("title");
	currentDisplayStart += displayAtOnce;
	if (displayMode == "tile") { //then show some tiles
		displayRecon(postType);

	} else { //then show the list
		displayReconList(postType);
	}

});

//activate Recon Network Controls - more button for community pages
$("#more-community-button").click(function(){
	
	var postType = $(".page-community #recon-activity").attr("term");
	currentDisplayStart += displayAtOnce;
	
	displayReconList(postType);


});

	

//activate Recon Network Controls - Toggle Display Button
$("#toggle-display-button").click(function(){

	currentDisplayStart = 0;
	var postType = $("ul.post-type-select li.selected").attr("title");

	if (displayMode == "tile") { //then switch to list mode
		displayReconList(postType);
		displayMode = "list";
	} else { //then switch to tile mode
		displayRecon(postType);
		displayMode = "tile";
	}
	
});

//activate Recon Network Controls - Toggle List Button
$("#toggle-list").click(function(){

	currentDisplayStart = 0;
	$("#toggle-tile").removeClass("tile-on").addClass("tile-off");
	$("#toggle-list").removeClass("list-off").addClass("list-on");
	var postType = $("ul.post-type-select li.selected").attr("title");

		displayReconList(postType);
		displayMode = "list";
	
});

//activate Recon Network Controls - Toggle Tile Button
$("#toggle-tile").click(function(){

	currentDisplayStart = 0;
	$("#toggle-tile").removeClass("tile-off").addClass("tile-on");
	$("#toggle-list").removeClass("list-on").addClass("list-off");
	var postType = $("ul.post-type-select li.selected").attr("title");
	
		displayRecon(postType);
		displayMode = "tile";
	
	
});

//Hide popup elements on click
$(document).click(function() {
    $(".user-details-box").fadeOut();
});


//Display the recon!
function displayRecon(type) {

	if (currentDisplayStart == 0) {
		$("#recon-activity").html("");
	}
		
	
	var dataURL = "/slim/api/superpost/type/" + type;  	
	dataURL += "/" + displayAtOnce;
	dataURL += "/" + currentDisplayStart;

    var getdata = $.getJSON(dataURL, function(data) {
    
	    //$(".animal-container").html("");
	    
	    var count = 0;
	    $(data).each(function(index) {
	        count++;
	        //var $avatar $("<img class='recon-gravatar'>").attr("src","http://www.northamericanwhitetail.fox/avatar?uid=" + this.$user_id);
	        var url = "/plus/" + this.post_type + "/" + this.id;
	        var link = $("<a href='" + url + "'>");

	        var randomnumber=Math.floor(Math.random()*3); //Get randomColor
	        var reconBox = $("<div class='recon-box masonry-box' id='recon-box-" + this.id +  "'></div>");
	        var imageBox = $("<div class='recon-image-box'></div>").css("background-color",bgcolors[randomnumber]);;
	        var image = $("<img class='superpost-thumb'>").attr("src",this.img_url);
	        var titleBox = $("<div class='recon-title-box'></div>")
	        var detectorBox = $("<div class='detector-box'></div>")
	        var titleDetailBox = $("<span class='recon-title-detail'></span>").text(this.username + "'s " + this.post_type);
	        var title = $("<h3></h3>").text(this.title);
	        var underBox = $("<div class='under-box'></div>");
	        var gravatar = $("<img class='recon-gravatar'>").attr("src","/avatar?uid=" + this.user_id);
	        var authorInfo = $("<div class='recon-author-info'><span class='author-name'></span><span class='author-action'></span></div>");
	        authorInfo.find(".author-name").text(this.username);
	        authorInfo.find(".author-action").text(" posted a " + capitaliseFirstLetter(this.post_type));
	        var underTitle = $("<div class='under-title'></div>").html("<a href='" + url + "'>" + this.title + "</a>");
	        var date = $("<abbr class='recon-date timeago' title=''></abbr>").attr("title",this.created);
	        var imgUrl =  this.img_url;

	        //Userpopup stuff
	        var userDetailsBox = $("<div class='user-details-box' style='display:none'></div>");
			var nameBox = $("<div class='name-box'></div>").text(this.username);
			var statsBox = $("<div class='stats-box'></div>");
			userDetailsBox.append(nameBox);
			userDetailsBox.append(statsBox);

			//Store some user data so that we can retrieve it later on hover
	        gravatar.data('user_id',this.user_id);
	        gravatar.data('username',this.username);

	        titleBox.append(titleDetailBox);
	        titleBox.append(title);





	        if (this.img_url) {
	   			
	   			link.append(image);
	        	imageBox.append(link);
	        	
	        
	        }

	        
	        underBox.append(userDetailsBox);
	        underBox.append(gravatar);
	        underBox.append(authorInfo);
	        if(this.post_type != "question"){
		        underBox.append(underTitle);
	        }
	        
	        underBox.append(date);

	        detectorBox.hover(function(){
	        	if (imgUrl) {
	        		$(this).parent().parent().find(".recon-title-box").stop().fadeToggle();
	        	}
	        	

	        });


	        if (this.post_type != "photo" && this.post_type != "video") {
	        	link = $("<a href='" + url + "'>");
	        	reconBox.append(link)
	        	link.append(titleBox);

	        	link = $("<a href='" + url + "'>");

	        	reconBox.append(link);
	        	link.append(detectorBox);
	        }

	        if (this.img_url != null && this.title != null) {
	        	titleBox.addClass("cover-pic");
	        }

	      	

	        reconBox.append(imageBox);
	        reconBox.append(underBox);

	        $("#recon-activity").append(reconBox);

	        if ($(data).length == count) {
	            $("#recon-activity").imagesLoaded( function(){

	            	afterImageLoaded();
	                
	            });
	        }
	        
	    });

	});

} //End function displayRecon()


//Display the User Posts!
function displayUserPosts(userID) {

	if (currentDisplayStart == 0) {
		$("#user-activity").html("");
	}
		
	
	var dataURL = "/slim/api/superpost/user/posts/" + userID;  	

    var getdata = $.getJSON(dataURL, function(data) {
    
	    //$(".animal-container").html("");
	    if(data.length < 1){
	    	$("#no-activity").show();
	    }else{
		    $("#no-activity").fadeOut();
	    }
	    var count = 0;
	    
	    $(data).each(function(index) {
	        count++;
	        
	        var url = "/plus/" + this.post_type + "/" + this.id;
	        var link = $("<a href='" + url + "'>");

	        var randomnumber=Math.floor(Math.random()*3); //Get randomColor
	        var reconBox = $("<div class='recon-box masonry-box' id='recon-box-" + this.id +  "'></div>");
	        var imageBox = $("<div class='recon-image-box'></div>").css("background-color",bgcolors[randomnumber]);;
	        var image = $("<img class='superpost-thumb'>").attr("src",this.img_url);
	        var titleBox = $("<div class='recon-title-box'></div>")
	        var detectorBox = $("<div class='detector-box'></div>")
	        var titleDetailBox = $("<span class='recon-title-detail'></span>").text(this.username + "'s " + this.post_type);
	        var title = $("<h3></h3>").text(this.title);
	        var underBox = $("<div class='under-box'></div>");
	        var gravatar = $("<img class='recon-gravatar'>").attr("src","http://www.gravatar.com/avatar/" + this.gravatar_hash + ".jpg?s=50&d=identicon");
	        var authorInfo = $("<div class='recon-author-info'><span class='author-name'></span><span class='author-action'></span></div>");
	        authorInfo.find(".author-name").text(this.username);
	        authorInfo.find(".author-action").text(" posted a " + capitaliseFirstLetter(this.post_type));
	        var underTitle = $("<div class='under-title'></div>").html("<a href='" + url + "'>" + this.title + "</a>");
	        var date = $("<abbr class='recon-date timeago' title=''></abbr>").attr("title",this.created);
	        var imgUrl =  this.img_url;

	        //Userpopup stuff
	        var userDetailsBox = $("<div class='user-details-box' style='display:none'></div>");
			var nameBox = $("<div class='name-box'></div>").text(this.username);
			var statsBox = $("<div class='stats-box'></div>");
			userDetailsBox.append(nameBox);
			userDetailsBox.append(statsBox);

			//Store some user data so that we can retrieve it later on hover
	        gravatar.data('user_id',this.user_id);
	        gravatar.data('username',this.username);

	        titleBox.append(titleDetailBox);
	        titleBox.append(title);





	        if (this.img_url) {
	   			
	   			link.append(image);
	        	imageBox.append(link);
	        	
	        
	        }

	        
	        underBox.append(userDetailsBox);
	        underBox.append(gravatar);
	        underBox.append(authorInfo);
	        if(this.post_type != "question"){
		        underBox.append(underTitle);
	        }
	        
	        underBox.append(date);

	        detectorBox.hover(function(){
	        	if (imgUrl) {
	        		$(this).parent().parent().find(".recon-title-box").stop().fadeToggle();
	        	}
	        	

	        });


	        if (this.post_type != "photo" && this.post_type != "video") {
	        	link = $("<a href='" + url + "'>");
	        	reconBox.append(link)
	        	link.append(titleBox);

	        	link = $("<a href='" + url + "'>");

	        	reconBox.append(link);
	        	link.append(detectorBox);
	        }

	        if (this.img_url != null && this.title != null) {
	        	titleBox.addClass("cover-pic");
	        }

	      	

	        reconBox.append(imageBox);
	        reconBox.append(underBox);

	        $("#user-activity").append(reconBox);

	        if ($(data).length == count) {
	        
	            $("#user-activity").imagesLoaded( function(){

	            	afterImageLoaded();
	                
	            });
	        }
	    });

	});

} //End function displayUserPosts()


function afterImageLoaded() {
	
	//Add relative time
	jQuery("abbr.timeago").timeago();

	var masonryColumnWidth = 338;
	var masonryGutterWidth = 3;
	var masonryItemSelector = ".recon-box";

	if (displayMode == "list") {
		if (widthMode="short"){
			masonryColumnWidth = 636;
		}else{
			masonryColumnWidth = 1000;
		}
		masonryGutterWidth = 0;
		masonryItemSelector = ".recon-row";

	}
    //reset masonry
    if ($('#recon-activity').hasClass("masonry")) {
    	$('#recon-activity').masonry( 'option', { columnWidth: masonryColumnWidth, gutterWidth: masonryGutterWidth, itemSelector:masonryItemSelector } )
    	$('#recon-activity').masonry('reload');
    } else {
    	$('#recon-activity').masonry({
        	columnWidth: masonryColumnWidth,
        	gutterWidth: masonryGutterWidth,
            itemSelector: masonryItemSelector,
            isAnimated: true,
    });
    	
    }
    //reset masonry for user profile
    if ($('#user-activity').hasClass("masonry")) {
    	$('#user-activity').masonry( 'option', { columnWidth: masonryColumnWidth, gutterWidth: masonryGutterWidth, itemSelector:masonryItemSelector } )
    	$('#user-activity').masonry('reload');
    } else {
    	$('#user-activity').masonry({
        	columnWidth: masonryColumnWidth,
        	gutterWidth: masonryGutterWidth,
            itemSelector: masonryItemSelector,
            isAnimated: true,
    });
    	
    }


	//Show user info on avatar hover
	$("img.recon-gravatar").click(function(e){
		e.stopPropagation();
		
		var UnderBox = $(this).closest(".under-box");

		UnderBox.find(".user-details-box").toggle(300);
		UnderBox.find(".stats-box").html("");

		var user_id = $(this).data("user_id");
		var username = $(this).data("username");

		var dataURL = "/slim/api/superpost/user/counts/" + user_id;  	
	    var getdata = $.getJSON(dataURL, function(data) {
	    	
	    	var countData = new Array();

	    	$(data).each(function(){
	    		countData[this.post_type] = this.count;
	    	});


	    	types = new Array("photo","report","tip","video","comment","discussion","question","answer");

	    	$(types).each(function(){
	    		var type = this;

	    		var typeCount = countData[type];
	    		if (typeCount === undefined) {
	    			typeCount = 0;
	    		}

	    		var statBox = $("<div class='stat-box'></div>").text(typeCount + " " + type + "s");
	    		UnderBox.find(".stats-box").append(statBox);

	    	});
		
	    });

		//userDetailsBox.append(nameBox);


	});

}




function displayReconList(type) {

	if (currentDisplayStart == 0) {
		$("#recon-activity").html("");
	}
		

	var dataURL = "/slim/api/superpost/type/" + type;  	
	dataURL += "/" + displayAtOnce;
	dataURL += "/" + currentDisplayStart;



    var getdata = $.getJSON(dataURL, function(data) {
    
	    //$(".animal-container").html("");
	    
	    var count = 0;
	    $(data).each(function(index) {
	        count++;
	        console.log(data);
	        //usables: this.id, this.username, this.img_url, this.post_type,

	        var gravatar = $("<img class='recon-gravatar'>").attr("src","http://www.gravatar.com/avatar/" + this.gravatar_hash + ".jpg?s=50&d=identicon");
	        var authorInfo = $("<div class='recon-author-info'><span class='author-name'></span><span class='author-action'></span></div>");
	        authorInfo.find(".author-name").text(this.username);
	        authorInfo.find(".author-action").text(" posted a " + capitaliseFirstLetter(this.post_type));
	        var underBox = $("<div class='under-box'></div>");
	        var date = $("<abbr class='recon-date timeago' title=''></abbr>").attr("title",this.created);

	        var image = $("<img class='superpost-list-thumb'>").attr("src",this.img_url);
	        var url = "/plus/" + this.post_type + "/" + this.id;


	        //Userpopup stuff
	        var userDetailsBox = $("<div class='user-details-box' style='display:none'></div>");
			var nameBox = $("<div class='name-box'></div>").text(this.username);
			var statsBox = $("<div class='stats-box'></div>");

			var points = parseInt(this.comment_count) + parseInt(this.share_count);
			
			//underBox.append(date);	
			//var $avatar $("<img class='recon-gravatar'>").attr("src","http://www.northamericanwhitetail.fox/avatar?uid=" + this.$user_id);
			var category_type = " in <a href=/question/'>" + this.secondary_post_type + "</a>";
			var reconRow = $("\
				<div class='recon-row masonry-box'>\
					<ul>\
						<li>\
							<div class='row-info'>\
								<div class='row-post-type post-type-" + this.post_type + "'>" + this.post_type + "</div>\
								<div class='row-title'><a href='" + url + "'>" + this.title + "</a></div>\
							</div>\
						</li>\
												<li class='user-avatar'><a href='/profile/" + this.username + "'><img src='http://www.northamericanwhitetail.fox/avatar?uid='" + this.user_id + "' alt='User Avatar' /></a> by <a href='/profile/" + this.username + "'>" + this.username + "</a></li>\
												<li class='count-field'><a href='" + url + "/#comments'>" + this.comment_count + " Comments</a></li>\
						<li class='count-field'><abbr class='timeago'>" + this.created + "</abbr></li>\
						<li class='count-field'>" + this.view_count + " Views</li>\
												<li class='count-field'>" + points + " Points</li>\
												</ul>\
						<div class='list-footer'>\
							<div class='list-answer'><a href='" + url + "'>Reply</a></div>\
							<div class='list-flag'><a href='#'>Flag</a></div>\
						</div>\
				</div>");
			
			
			$("#recon-activity").append(reconRow);

			userDetailsBox.append(nameBox);
			userDetailsBox.append(statsBox);


	        //Store some user data so that we can retrieve it later on hover
	        gravatar.data('user_id',this.user_id);
	        gravatar.data('username',this.username);

	 
	        if (this.img_url) {
	        	//imageBox.append(image);
	        	reconRow.find("ul").prepend($("<li class='row-image'>").append(image.width(90)));
	        	
	        } else {
	        	reconRow.find("div.row-info").addClass("no-image");
	        }



	        if ($(data).length == count) {
	            $("#recon-activity").imagesLoaded( function(){

	            	$(".recon-row:odd").addClass("odd");
	            	afterImageLoaded();
	                
	            });
	        }
	        
	    });

	});

} //End function displayReconList()


function displayUserComments(userID) {

	if (currentDisplayStart == 0) {
		$("#user-activity").html("");
	}
		

	var dataURL = "/slim/api/superpost/user/comments/" + userID;  	

    var getdata = $.getJSON(dataURL, function(data) {
    
	    //$(".animal-container").html("");
	    if(data.length < 1){
	    	$("#no-activity").show();
	    }else{
		    $("#no-activity").fadeOut();
	    }
	    var count = 0;
	    $(data).each(function(index) {
	        count++;

	        //usables: posts.id, comment_body, rent_type, date, shares
	        
	        var gravatar = $("<img class='recon-gravatar'>").attr("src","http://www.gravatar.com/avatar/" + this.gravatar_hash + ".jpg?s=50&d=identicon");
	        var authorInfo = $("<div class='recon-author-info'><span class='author-name'></span><span class='author-action'></span></div>");
	        authorInfo.find(".author-name").text(this.username);
	        authorInfo.find(".author-action").text(" posted a " + capitaliseFirstLetter(this.rent_type));

	        var date = $("<abbr class='recon-date timeago' title=''></abbr>").attr("title",this.created);

	        var image = $("<img class='superpost-list-thumb'>").attr("src",this.img_url);
	        var url = "/plus/" + this.rent_type + "/" + this.id;


	        //Userpopup stuff
	        var userDetailsBox = $("<div class='user-details-box' style='display:none'></div>");
			var nameBox = $("<div class='name-box'></div>").text(this.username);
			var statsBox = $("<div class='stats-box'></div>");

			var points = parseInt(this.comment_count) + parseInt(this.shares);
			if (this.comment_body.length > 160){
				encoded = this.comment_body.substring(0, 160);
				encoded += "...";
			}else{
				encoded = this.comment_body;
			}
			

			var reconRow = $("\
				<div class='recon-row masonry-box'>\
					<ul>\
						<li>\
							<div class='row-info'>\
								<div class='row-post-type post-type-" + this.rent_type + "'>" + this.rent_type + "</div>\
								<div class='row-title'><a href='" + url + "'>" + encoded + "</a></div>\
							</div>\
						</li>\
						<li class='count-field' >Posted on: <abbr class='timeago' title='" + this.created + "'>" + this.created + "</abbr></li>\
					</ul>\
				</div>");


			$("#user-activity").append(reconRow);

			userDetailsBox.append(nameBox);
			userDetailsBox.append(statsBox);


	        //Store some user data so that we can retrieve it later on hover
	        gravatar.data('user_id',this.user_id);
	        gravatar.data('username',this.username);

	 
	        if (this.img_url) {
	        	//imageBox.append(image);
	        	reconRow.find("ul").prepend($("<li class='row-image'>").append(image.width(90)));
	        	
	        } else {
	        	reconRow.find("div.row-info").addClass("no-image");
	        }

	        // Quick fix to make sure it gets displayed correctly on tab click
	        displayMode = "list";
	        if ($(data).length == count) {
	            $("#user-activity").imagesLoaded( function(){

	            	$(".recon-row:odd").addClass("odd");
	            	afterImageLoaded();
	            	//set back to tile for future tab click
	            	displayMode = "tile";
	                
	            });
	        }
	        
	    });

	});

} //End function displayUserComments()




function capitaliseFirstLetter(string)
{
    return string.charAt(0).toUpperCase() + string.slice(1);
}

// Questions display
$(document).ready(function(){
	var type = "question";
	showAtOnce = 10;
	var dataURL = "/slim/api/superpost/type/" + type +"/" + showAtOnce + "/0";  	
	var getdata = $.getJSON(dataURL, function(data) {
		
		var $questionTemplate;
				
		$.each(data, function(index, question) { 
			$questionTemplate = $("ul#slides-questions li").eq(index);
			var url = "/plus/question/" + question.id;
			var gravatar = $questionTemplate.find(".user-info img").attr("src","http://www.gravatar.com/avatar/" + this.gravatar_hash + ".jpg?s=50&d=identicon");

			$questionTemplate.find(".user-info a.username").text(question.username); 
			$questionTemplate.find(".user-info a").attr("href","/profile/" + question.username);
			
			$questionTemplate.find("h4.quote").text(question.title);
			$questionTemplate.find(".answers-count a").attr("href",url + "/#comments");
			$questionTemplate.find("a.answers-link").attr("href",url);
			$questionTemplate.find("span.count").text(question.comment_count);

		});	
					
	$questionTemplate.appendTo(".questions-feed").fadeIn();
	});

}); //End display questions
	
// Sidebar slider display
$(document).ready(function(){
	var type = "all";
	showAtOnce = 36;
	var dataURL = "/slim/api/superpost/photos/" + type +"/" + showAtOnce + "/0";  	
	var getdata = $.getJSON(dataURL, function(data) {
		
		var $questionTemplate;

		$.each(data, function(index, all) { 
				$questionTemplate = $("ul#scroll-widget li").eq(index);
				$questionTemplate.find("a").attr("href","/plus/" + all.post_type + "/" + all.id);
				$questionTemplate.find("img").attr("src",all.img_url);
		});							
	$questionTemplate.appendTo("ul#scroll-widget.scroll").fadeIn();	
	});

}); //End 



// Sidebar grid display
$(document).ready(function(){
	var type = "all";
	showAtOnce = 9;
	var dataURL = "/slim/api/superpost/comment_count/" + type +"/" + showAtOnce + "/0";  	
	var getdata = $.getJSON(dataURL, function(data) {
		
		var $questionTemplate;

		$.each(data, function(index, all) { 
				$questionTemplate = $("ul.thumbs-grid li").eq(index);
				$questionTemplate.find("a").attr("href","/plus/" + all.post_type + "/" + all.id);
				$questionTemplate.find("img").attr("src",all.img_url);
		});							
	$questionTemplate.appendTo("ul#scroll-widget.scroll").fadeIn();	
	});

}); //End 



});//End doc Ready
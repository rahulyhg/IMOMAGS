jQuery(document).ready(function($) {

	var currentPage = 1;
	var currentPosition = 0;
	var showAtOnce = 15;
	var sort = "post_date";
	var feedData;

	//Check to see if cross-site-feed exists:
	if ($(".cross-site-feed").length > 0) {
		//if yes, display some things

		displayCrossSiteFeed(currentPosition);
	}

	//When more button is clicked....
	$(".cross-site-feed-more-button").click(function(){

		currentPosition = currentPosition + showAtOnce;
		displayCrossSiteFeed(currentPosition,sort);

		currentPage++;

		_gaq.push(['_trackPageview',"/" + window.location.pathname + "#" + currentPage]);
		document.getElementById('sticky-iframe-ad').contentWindow.location.reload();
	});

	//When sort button is clicked:
	$(".sort-link").click(function(event){

		event.preventDefault();

		currentPosition = 0;
		$(".cross-site-feed").css("height",800);
		$(".cross-site-feed").html("");

		sort = $(this).attr("sort");
		displayCrossSiteFeed(currentPosition,sort)


	});

	function resetDisplay(slug) {
		$(".cross-site-feed").attr("term",slug);
		$(".cross-site-feed").text("");

		currentPosition = 0;
		displayCrossSiteFeed(currentPosition);

	}

	//Ignore Dropdown Click
	$(".ignore-click").click(function(event){
		event.preventDefault();
	});

	function displayCrossSiteFeed(start,sort) {
		sort = typeof sort !== 'undefined' ? sort : 'post_date'; //If sort is not set, set sort to post_date


		//First get any extra term
		var term = $(".cross-site-feed").attr("term");



		// if (term.length > 0) {
		// 	var fileName = "/wp-content/cache/superloop/naw-plus-" + term + "-" + sort + ".json";
		// } else {
		// 	var fileName = "/wp-content/cache/superloop/naw-plus-" + sort + ".json";
		// }

		var fileName = "/wpdb/shooting-network-json.php?t=ammo";


		$(".load-spinner").show();
		var getdata = $.getJSON(fileName, function(data) {

	    //$(".animal-container").html("");

	    	$(".load-spinner").hide();

		    var count = 0;

		    var end = start + showAtOnce;

		    for (i = start; i < end; i++) {
		        count++;
		        var $articleTemplate = $("article#excerpt-template").clone();

		        $articleTemplate.attr("id","excerpt-" + data[i].post_name + count);
		        $articleTemplate.find("a").attr("href",data[i].post_url);

		        $articleTemplate.find(".entry-category a").text("From " + data[i].brand + " Magazine");
		        $articleTemplate.find(".entry-category a").attr("href","http://" + data[i].domain)

		        if (data[i].domain == document.domain)
		        	$articleTemplate.find(".entry-category a").text("");

		        //console.log(data[i].domain,document.domain);

		        $articleTemplate.find("h2.entry-title a").text(data[i].post_title);

		        $articleTemplate.find(".author").html(data[i].post_nicedate + " by " + data[i].author);
		        $articleTemplate.find("p.excerpt-body").text("");

		        $articleTemplate.find("img.entry-img").attr("src",data[i].img_url);
		        $articleTemplate.find(".comment-count").text(data[i].comment_count);

		        $articleTemplate.find(".entry-content").text(data[i].post_content);


				//If data[i] is from NAW, add the categories

					$articleTemplate.find("a").attr("target","_blank");



		        $articleTemplate.appendTo(".cross-site-feed").fadeIn();

		        $(data[i].terms).each(function(index) {
	        		//Hide featured posts
			        if(this.slug == 'home-featured'){
						$articleTemplate.hide();
						}
					// Place video button on videos
					if(this.slug == 'video'){
						$articleTemplate.find("a.no-olay").addClass("video-excerpt");
					}
				});

		    }



		});

	}






});
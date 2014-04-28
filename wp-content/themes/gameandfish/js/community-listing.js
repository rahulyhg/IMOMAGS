jQuery( document ).ready(function( $ ) {

	var $postTemplateCopy = $(".dif-post").first().clone();

	var querySettings = {};

	querySettings.state = null;
	querySettings.skip = 0;
	querySettings.showAtOnce = 10;
	querySettings.totalCount = 999999;
	querySettings.term = $(".posts-list").attr("slug");

	//alert("ok");

	$("a.filter-menu").click(function(ev){

		$(".posts-list").empty();
		//console.log("clear");

		ev.preventDefault();



		querySettings.state = $(this).attr('state');
		querySettings.skip = 0;



		getPosts();

	});


	$("#community-nav").on("change",function(ev){

		var url = $(this).val();
		window.location.href = url;


	});


	$(".community-pager .more").click(function(ev){

		ev.preventDefault();

		if (querySettings.skip == 0) {

			getTotalCount();
		}

		querySettings.skip += querySettings.showAtOnce;

		getPosts();

		if (querySettings.skip + querySettings.showAtOnce > querySettings.totalCount) {

			$(".community-pager .more").fadeOut();
		}

	});

	function getTotalCount() {

		var url =  "/wpdb/network-feed-cached.php?post_type=reader_photos&domain=www.gameandfishmag.com&thumbnail_size=community-square-retina"

				 + "&term=" + querySettings.term
				 + "&get_count=1";

		if (querySettings.state != null) {
			url += "&state=" + querySettings.state;
		}

		$.getJSON(url,function(countArray){

			var count = countArray[0].count;
			querySettings.totalCount = count;
		});




	}

	function getPosts() {
			
		var url =  "/wpdb/network-feed-cached.php?post_type=reader_photos&domain=www.gameandfishmag.com&thumbnail_size=community-square-retina"

				 + "&term=" + querySettings.term
				 + "&count=" + querySettings.showAtOnce
				 + "&skip=" + querySettings.skip;

		if (querySettings.state != null) {
			url += "&state=" + querySettings.state;
		}



		//console.log(url);
		$.getJSON(url,function(posts){

			if(typeof posts =='object')
			{



				$.each(posts,function(index,post){


					console.log(post);

					$postTemplate = $postTemplateCopy.clone();

					var imgURL = post.img_url;
					imgURL.replace("www.gameandfishmag.com",document.domain);

					var userURL = "/author/" + post.user_nicename + "/";


					$postTemplate.find("div.feat-img img").attr("src",imgURL.replace("www.gameandfishmag.com",document.domain));
					$postTemplate.find("div.feat-img img").attr("alt",post.post_title);
					$postTemplate.find(".dif-post-text h3 a").html(post.post_title);
					$postTemplate.find(".prof-like li").remove();
					$postTemplate.find(".prof-like").append("<li><div addthis:url='" + post.post_url + "' addthis:title='" + post.post_title + "' class='addthis_toolbox addthis_default_style' id='posts-container'><a class='addthis_button_facebook_like'fb:like:layout='button_count'></a></div></li>");
					$postTemplate.find(".profile-data h4 a").html(post.author);
					$postTemplate.find(".profile-photo img").attr("src","/avatar?uid=" + post.user_id);
					$postTemplate.find("ul.replies li a").html(post.comment_count + "replies");

					$postTemplate.find("a").attr("href","/photos/" + post.post_name);
					
					$postTemplate.find("a.author-link").attr("href",userURL);

					$postTemplate.find("ul.prof-tags").html("");



					$.each(post.terms,function(index,term){


						
						$postTemplate.find("ul.prof-tags").append("<li>" + term.name + "</li>");

					});

					
					

					$(".posts-list").append($postTemplate);
					addthis.toolbox('.addthis_toolbox');
				});
				//$(".community-pager .more").fadeIn();

			} else if (querySettings.state != null) {



				var catName = $(".page-title").attr("cat-title");

				var resultsString = "<h2>Sorry, we don't have any " + catName + " photos in " + querySettings.state + ". <br><a href='/photos/new'>Want to post one?</a></h2>";

				$(".posts-list").append(resultsString);

				$(".community-pager .more").fadeOut();


			}




		});


	}



});
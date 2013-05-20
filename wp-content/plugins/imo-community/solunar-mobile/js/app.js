jQuery(document).ready(function($) {


	//renderSpeciesInfo($(".jq-custom-form select").val());

	//Initialize the page
	var d = new Date();
	var currentMonth = d.getMonth() + 1;
	var year = 2013; //This needs to be changed later if we extend our contract

	var months = {1:"January", 2:"February", 3:"March", 4:"April", 5:"May", 6:"June", 7:"July", 8:"August", 9:"September", 10:"October", 11:"November", 12:"December"};






	//set the selected month to the current month
	var selectedMonth = currentMonth;
	$(".jq-view-month").text(months[currentMonth]);


	//Use HTML5 Geolocation to detect location and update calendar
	if (navigator.geolocation)
    {
    	navigator.geolocation.getCurrentPosition(function(position){
	    	//console.log(position);
	    	var lat = position.coords.latitude;
	    	var url = "/wpdb/gps-to-zip.php?lat=" + position.coords.latitude +  "&lon=" + position.coords.longitude ;

	    	$.getJSON(url,function(closestLocation){



		    	$("#solunar-location").val(closestLocation.zip)
		    	updateCalendar(selectedMonth,year,closestLocation.zip);
	    	});
    	});
    } else {
    	//IF NO LOCATION, SHOW THE FORM
    }





	function updateCalendar(month,year,location) {


		//$(".calendar-holder").fadeTo("normal",0.20);
		$(".cal-list").fadeTo("normal",0.20);


		var url = "/wpdb/solunar.php?month=" + month +  "&year=" + year  ;

		if (location)
			url += "&location=" + location;


		$.getJSON(url,function(solunarDays){

			var $calList = $(".cal-list");

			//$(".calendar-holder").fadeTo("normal",1.0);
			$calList.fadeTo("normal",1.0);

			var monthNames = [ "nothing","Jan.", "Feb.", "Mar.", "Apr.", "May", "June",
		    "July", "Aug.", "Sept.", "Oct.", "Nov.", "Dec." ];

		    var weekday = new Array(7);
			weekday[0]="Sun";
			weekday[1]="Mon";
			weekday[2]="Tue";
			weekday[3]="Wed";
			weekday[4]="Thu";
			weekday[5]="Fri";
			weekday[6]="Sat";

			var dayOffset = solunarDays[0].weekdaycode;
			var locationName = solunarDays[0].city + ", " + solunarDays[0].state;

			$(".head-location a").html(locationName);

			var currentDay = 0;
			var currentCell = 0;
			var today = new Date();


			$(".calendar-data td").html("").addClass("other-month");

			$calList.html("");

			$(".calendar-data td").each(function(key,dataCell){
				currentCell++;

				var $dataCell = $(dataCell);

				//dayOffset determines the day fo the week in which we start
				if (currentCell > dayOffset) {

				   var currentDayData = solunarDays[currentDay];

					if (currentDayData) {

						//calculate if day is today
						var currentDate = new Date(currentDayData.year,currentDayData.month - 1,currentDayData.day);

						if (currentDate.toDateString() == today.toDateString()) {
							currentDayData.today = "today";
						} else {
							currentDayData.today = "";
						}

						$dataCell.removeClass("other-month");


						currentDayData.weekday = weekday[currentDayData.weekdaycode];



						//format the sun/moon up down times
						currentDayData.sunrise = currentDayData.sunrise.toUpperCase().replace("A","<span>A</span>").replace("P","<span>P</span>");
						currentDayData.sunset = currentDayData.sunset.toUpperCase().replace("A","<span>A</span>").replace("P","<span>P</span>");
						currentDayData.moonrise = currentDayData.moonrise.toUpperCase().replace("A","<span>A</span>").replace("P","<span>P</span>");
						currentDayData.moonset = currentDayData.moonset.toUpperCase().replace("A","<span>A</span>").replace("P","<span>P</span>");

						//Format the peaktimes
						currentDayData.monthname = monthNames[currentDayData.month];
						currentDayData.ammajorstart = currentDayData.ammajorstart.replace("AM","<span>AM</span>").replace("PM","<span>PM</span>");
						currentDayData.ammajorend = currentDayData.ammajorend.replace("AM","<span>AM</span>").replace("PM","<span>PM</span>");
						currentDayData.amminorstart = currentDayData.amminorstart.replace("AM","<span>AM</span>").replace("PM","<span>PM</span>");
						currentDayData.amminorend = currentDayData.amminorend.replace("AM","<span>AM</span>").replace("PM","<span>PM</span>");
						currentDayData.pmmajorstart = currentDayData.pmmajorstart.replace("AM","<span>AM</span>").replace("PM","<span>PM</span>");
						currentDayData.pmmajorend = currentDayData.pmmajorend.replace("AM","<span>AM</span>").replace("PM","<span>PM</span>");
						currentDayData.pmminorstart = currentDayData.pmminorstart.replace("AM","<span>AM</span>").replace("PM","<span>PM</span>");
						currentDayData.pmminorend = currentDayData.pmminorend.replace("AM","<span>AM</span>").replace("PM","<span>PM</span>");


						//Sometimes a day only has 3 good times. If this is the case, we trash the missing time. if not, we just trash the last one.
						var time1 = {start: currentDayData.ammajorstart, end: currentDayData.ammajorend, official: currentDayData.ammajor};
						var time2 = {start: currentDayData.pmmajorstart, end: currentDayData.pmmajorend, official: currentDayData.pmmajor};
						var time3 = {start: currentDayData.amminorstart, end: currentDayData.amminorend, official: currentDayData.amminor};
						var time4 = {start: currentDayData.pmminorstart, end: currentDayData.pmminorend, official: currentDayData.pmminor};

						var times = [time1,time2,time3,time4];

						//Remove the bad times
						var keyToRemove = null;
						_.each(times,function(time,key){

							if (time.official == "-----") {

								keyToRemove = key;

							}

						});

						//If there are not bad times, scrap the last time.
						if (keyToRemove == null)
							keyToRemove = 3;
						times.splice(keyToRemove,1);

						currentDayData.times = times;

						console.log(currentDayData);

						var miniDayTemplate = _.template($("#mini-day-template").html(),{data:currentDayData});

						var fullDayTemplate = _.template($("#full-day-template").html(),{data:currentDayData});

						$dataCell.append(miniDayTemplate);
						$calList.append(fullDayTemplate);


					}





					currentDay++;
				}//end iff






			}); //end each

			//Attach the events
		   $(".jq-expand-day").click(function() {

		   		console.log($(this));

		        var activeTab = $(this).find("a.jq-expand-link").attr("href");

		        console.log(activeTab);

		        $(activeTab).slideToggle("slow");
		        return false;
		    });




		}).fail(function(){
			alert("Location not found. Please try again.")
		});


	}



});

var renderSpeciesInfo = function(slug) {


	var url = "/wpdb/simple-infish-json.php?t=" + slug;

	var fishName = $("#sel1 option[selected=selected]").html();

	$(".fishing-tips-title").html( fishName + " Fishing Tips");

	if (typeof googletag.pubads === 'function')
		googletag.pubads().refresh([dynamicAdSlot1]);

	//console.log(url);
	$.getJSON(url,function(posts){

		$('#related-fishing-posts').html("");
		$.each(posts,function(index,post){

			//console.log(post);
			var template = _.template($("#slider-template").html(),{data:post});
			$('#related-fishing-posts').append(template);
		});

		$('#related-fishing-posts').carouFredSel({
		    auto: false,
		    prev: '#prev2',
		    next: '#next2',
		    mousewheel: true,
		    swipe: {
		        onMouse: true,
		        onTouch: true
		    }
		});

	}).fail(function( jqxhr, textStatus, error ) {
  var err = textStatus + ', ' + error;
  console.log( "Request Failed: " + err);
  console.log(jqxhr);
});

}


$(".jq-custom-form select").zfselect({
    rows: 30,
    width:250
});

$(".jq-custom-form select").on("change",function(){
	renderSpeciesInfo($(this).val());
});




	var madnessround;
	var popads = [];
			
	jQuery(window).load(function() {
		jQuery('.ga-madness ul.rounds').css("overflow","visible");
	});
	
	jQuery(document).ready(function($) {
		jQuery('.gun-types select').change(function(){
			var value = jQuery(this).val();
			if(value)
				jQuery('html, body').animate({scrollTop: jQuery("h2#" + value).offset().top}, "slow");
		});
		
		jQuery.ajax({
			type: "GET",
			url: "http://apps.imoutdoors.com/bracket/getActiveRound",
			data: {"format": "json", "bracketid": 2},
			dataType: "json",
			
			success: function(resp, status, jqxhr) {
				madnessround = resp[0].activeround;
				jQuery('#madtabs').tabs({active: (madnessround - 3)});
			}

		});
		
		
		
		//jQuery('#madtabs').tabs({selected: (madnessround-1)});
		
	});
	
	function getGAMData(region, round) {
		
		jQuery.ajax({
			type: "GET",
			url: "http://apps.imoutdoors.com/bracket/getMatches",
			data: {"format": "json", "round":round, "region": region, "bracketid": 2},
			dataType: "json",

			success: function(resp, status, jqxhr) {	
					
				if(ismobile) {
					if(resp.type == "finals"){
						var finalone = {};finalone[0] = resp.data[0];
						var finaltwo = {};finaltwo[0] = resp.data[1];
						var finall   = {};finall[0]   = resp.data[2];
	
						jQuery(".match92").html(writeGAMBracket(finalone));
						jQuery(".match93").html(writeGAMBracket(finaltwo));
						jQuery(".match94").html(writeGAMBracket(finall));
					}
					else {
						jQuery("#madtabs-"+(parseInt(round) - 1)+" .mreg"+region).html(writeGAMBracket(resp.data));
					}
				}
				else {
					if(resp.type == "finals"){
						var finalone = {};finalone[0] = resp.data[0];
						var finaltwo = {};finaltwo[0] = resp.data[1];
						var finall   = {};finall[0]   = resp.data[2];
	
						jQuery(".match92").html(writeGAMBracket(finalone));
						jQuery(".match93").html(writeGAMBracket(finaltwo));
						jQuery(".match94").html(writeGAMBracket(finall));
						
					}
					else {
						jQuery(".region"+region+" .column"+(parseInt(round)-1)).html(writeGAMBracket(resp.data));
					}
				}
			},
			fail: function() {
				alert("Communication Failure");
			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert(errorThrown);
			}
			
		});

	}
	
	function getStats() {
		jQuery.ajax({
			type: "GET",
			url: "http://apps.imoutdoors.com/bracket/getTotalVotes",
			data: {"bracketid": 2},
			dataType: "json",

			success: function(resp, status, jqxhr) {
				var seed = 123456;
				resp[0].tvotes = parseInt(resp[0].tvotes);
				var vcount = resp[0].tvotes.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
				jQuery(".ga-madness-votestats").html("<strong>Total Votes:</strong><br />"+vcount+"");
				
			}
		});		
	}
	
	function autoPopup() {
		var location = window.location.href;
		var fullHash = location.split('#')[1];
		//console.log(hash);
		
		if(typeof(fullHash) != 'undefined') {
			//console.log('hash is defined and it is ' + hash);
			//console.log(jQuery("div[data-mid='"+hash+"']").html());
			var hashNumber = fullHash.substring(5);
			
			jQuery("div[data-mid='"+hashNumber+"']").trigger("click");
		}
	}
	
	function writeGAMBracket(data) {
		var outp = "";
		jQuery.each(data, function(i, row) {
			if(row.player1name == null) row.player1name = "&nbsp;";
			if(row.player2name == null) row.player2name = "&nbsp;";
			if(parseInt(row.status) < 1 && row.player1score == "0") row.player1score = "&nbsp;";
			if(parseInt(row.status) < 1 && row.player2score == "0") row.player2score = "&nbsp;";
			if(row.player1seed == null) row.player1seed = "&nbsp;";
			if(row.player2seed == null) row.player2seed = "&nbsp;";
			var winner = 0;
			if(parseInt(row.status) > 1) {
				winner = (parseInt(row.player1score)>parseInt(row.player2score))? 1:2;
			}
			var matchclass = "";
			if(parseInt(row.status) == 1) matchclass = "activem";
			if(parseInt(row.status) == 2) matchclass = "closedm";
			
			outp+='<div class="matchup '+matchclass
				+'" data-mid="'+row.id+'" data-region="'+row.region+'" data-idx="'+i+'" data-round="'+row.round+'">'
				+ '<div class="contender votepop">'
				if(row.status==1) outp+='<div class="action-arrow"></div>';
				if(row.status==2) outp+='<div class="action-closed"></div>';
				
			outp+='<div class="rank rank-top '
				+ ((row.status==2)? ((winner==1)?"matchwinner":"matchloser"):"")+'">'
				+ '<span>'+row.player1seed+'</span>'
				+ '<div>'+row.player1name+'</div>'
				//+ row.player1score+'</span>'
				+ '</div>'
				+ '<div class="rank rank-bottom '
				+ ((row.status==2)? ((winner==2)?"matchwinner":"matchloser"):"")+'">'
				+ '<span>'+row.player2seed+'</span>'
				+ '<div>'+row.player2name+'</div>'
				//+ row.player2score+'</span></div>'
				+ '</div>'
				+ '</div>'
				+ '</div>';
		});
		
		return outp;
	}
	
	navigator.sayswho= (function(){
    	var ua= navigator.userAgent, tem, 
		M= ua.match(/(opera|chrome|safari|firefox|msie|trident(?=\/))\/?\s*([\d\.]+)/i) || [];
		if(/trident/i.test(M[1])){
        	tem=  /\brv[ :]+(\d+(\.\d+)?)/g.exec(ua) || [];
			return 'IE '+(tem[1] || '');
	    }
		M= M[2]? [M[1], M[2]]:[navigator.appName, navigator.appVersion, '-?'];
		if((tem= ua.match(/version\/([\.\d]+)/i))!= null) M[2]= tem[1];
		return M.join(' ');
	})();
	
	
	
	function makeGAMPopup() {
		
		 jQuery(".closedm").on("click", function() {
			
			var pdata;
		 	var region = jQuery(this).data("region");
		 	var mid = jQuery(this).data("mid");
		 	var round = jQuery(this).data("round");
		 	
		 	
		 	jQuery.ajax({
				type: "GET",
				url: "http://apps.imoutdoors.com/bracket/getMatches",
				data: {"format": "json", "round":jQuery(this).data("mid"), "region": "0", "bracketid": 2},
				//data: {"format": "json", "round": "2", "region": region},
				dataType: "json",

				success: function(resp, status, jqxhr) {		
				//console.log(region); // returns ints 1, 2, 3 or 4			
					pdata = resp.data[0];
					pdata.mid_data_mid = pdata.id;
					pdata.player1image_img = pdata.player1image;
					pdata.player2image_img = pdata.player2image;
					pdata.player1link_href = pdata.player1link;
					pdata.player2link_href = pdata.player2link;
					delete pdata.player1link;
					delete pdata.player2link;
					
					var randomInt = Math.floor((Math.random() * 4) + 0);
					var randomPopad = popads[randomInt];
					
					var regions = {'1':'Compound A', '2':'Compound B', '3':'Crossbows A', '4':'Crossbows B'}
					var roundtitles = {/*'2':'First Round', */'3':'First Round', '4':'Sweet Sixteen', '5':'Elite Eight', '6':'Final Four', '7':'Championship','8':'Championship'}
					
					var campaigns = new Array('handgunsmadness', 'riflesmadness', 'arsmadness', 'shotgunsmadness', 'zeiss');
					pdata.campaign = campaigns[parseInt(pdata.region)-1];
					
					jQuery.magnificPopup.open({
								
						items: pdata,
						inline: {
		            		markup: jQuery('#tmplGAMpopup').html()
						},
						closeBtnInside: true,
						prependTo: jQuery("#page"),
						alignTop: true,
						fixedContentPos: false,
						fixedBgPos: true,
						gallery: {
							enabled: false
						},
						callbacks: {
							markupParse: function(template, values, item) {
								region = parseInt(item.data.region);
								round = parseInt(item.data.round);
								campaign = campaigns[region-1];
								//campimg = "/wp-content/plugins/bowmadness/ads/"+popads[campaign];
								campimg = "/wp-content/plugins/bowmadness/ads/" + randomPopad;
								
								template.find("#popupsponsor a").html('<img src="'+campimg+'" />');
								
								//template.find("#div-bob_region_1_medium_rectangle").html('<img src="'+campimg+'" />');
																
								var roundtitle = roundtitles[round];
								var regiontitle = (round<6)? (regions[region]+": "):"";
								template.find("#popuptitle").html(regiontitle+roundtitle);
								template.find(".next-matchup").hide();
								template.find(".vote-again").hide();
								
								var score1 = parseInt(pdata.player1score);
								var score2 = parseInt(pdata.player2score);
								var scoretot = score1 + score2;
								var per1 = ((score1/scoretot)*100).toFixed(0);
								var per2 = ((score2/scoretot)*100).toFixed(0);
								pwin = ((score1>score2)? "1":"2");
								if(pwin=="1") template.find(".guntwo img, .guntwo h2").fadeTo("fast", "0.5");
								if(pwin=="2") template.find(".gunone img, .gunone h2").fadeTo("fast", "0.5");
								
								template.find("#popvoteon1").html('<div class="popvoted '+((pwin=="2")? "popvoted-no":"")+'">'+per1+"% ("+score1+' Votes)</div>');
								template.find("#popvoteon2").html('<div class="popvoted '+((pwin=="1")? "popvoted-no":"")+'">'+per2+"% ("+score2+' Votes)</div>');
							},
							open: function() {
								
								popads[0] = 'maps-BoB-popup-358x90.jpg';
								popads[1] = 'rage-BoB-popup-358x90.jpg';
								popads[2] = 'scent-lok-BoB-popup-358x90.jpg';
								popads[3] = 'trail-cam-BoB-popup-358x90.jpg';
								popads[4] = 'zeiss-BoB-popup-358x90.jpg';
								
								//var randomInt = Math.floor((Math.random() * 4) + 0);
								
								//var randomPopad = popads[randomInt];
								jQuery("#popupAdRight .popupad").remove();
								
								jQuery("#popupAdRight").append('<div id="div-bob_region_'+ region +'_medium_rectangle" class="popupad"><iframe id="bracket-iframe-ad" width="300" height="250" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no" src="/iframe-ad-bracket.php?ad_code=imo.bowhunting&bracket=battle_of_the_bows&size=bob_region_'+ region +'_medium_rectangle"></iframe></div>');
									
								
								
								_gaq.push(['_trackPageview',"/" + window.location.pathname + "/match"+pdata.mid_data_mid]);
								
							}
						}
					});
				}
			 });
		 });
		 
		 		 
		 jQuery(".activem").on("click", function() {
		 	
		 	var finalRound = jQuery(this).parent().hasClass("final-modal");
		 	console.log(finalRound);
		 	var pdata;
		 	var region = jQuery(this).data("region");
		 	var mid = jQuery(this).data("mid");
		 	var round = jQuery(this).data("round");
		 	var slide = jQuery(this).data("idx");
		 	var slidecnt = 0;
		 	var yourBrowser = navigator.sayswho;
		 	if(yourBrowser.substring(0,6)=="MSIE 8") {
			 	var msg = "Unfortunately, bracket voting requires a modern web browser.\r\n\r\n"
			 			+ "You need to upgrade your browser in order to continue.";
			 	alert(msg);	
		 	}
		 	
		 	jQuery.ajax({
				type: "GET",
				url: "http://apps.imoutdoors.com/bracket/getMatches",
				//data: {"format": "json", "round":jQuery(this).data("mid"), "region": "0"},
				data: {"format": "json", "round": round, "region": region, "bracketid":2},
				dataType: "json",

				success: function(resp, status, jqxhr) {					
					pdata = resp.data;
					
					jQuery.each(pdata, function(i, row) {
						pdata[i].mid_data_mid = pdata[i].id;
						pdata[i].player1image_img = pdata[i].player1image;
						pdata[i].player2image_img = pdata[i].player2image;
						pdata[i].player1link_href = pdata[i].player1link;
						pdata[i].player2link_href = pdata[i].player2link;
						delete pdata[i].player1link;
						delete pdata[i].player2link;
						
					});
					
					popads[0] = 'maps-BoB-popup-358x90.jpg';
					popads[1] = 'rage-BoB-popup-358x90.jpg';
					popads[2] = 'scent-lok-BoB-popup-358x90.jpg';
					popads[3] = 'trail-cam-BoB-popup-358x90.jpg';
					popads[4] = 'zeiss-BoB-popup-358x90.jpg';
					var randomInt = Math.floor((Math.random() * 4) + 0);
					var randomPopad = popads[randomInt];
					
					var regions = {'1':'Compound A', '2':'Compound B', '3':'Crossbows A', '4':'Crossbows B'}
					var roundtitles = {/*'2':'First Round', */'3':'First Round', '4':'Sweet Sixteen', '5':'Elite Eight', '6':'Final Four', '7':'Championship'}
					
					var campaigns = new Array('handgunsmadness', 'riflesmadness', 'arsmadness', 'shotgunsmadness');
					if(parseInt(pdata[0].region) == 5) {
						var fregion = (Math.random() < 0.5)? 1 : 2;
						pdata[0].campaign = campaigns[fregion-1];
					}
					else if(parseInt(pdata[0].region) == 6) {
						var fregion = (Math.random() < 0.5)? 3 : 4;
						pdata[0].campaign = campaigns[fregion-1];
					}
					else if(parseInt(pdata[0].region) == 7) {
						var fregion = 0;
						var rand = Math.random();
						if(rand < 0.25) fregion = 1;
						else if(rand < 0.5) fregion = 2;
						else if(rand < 0.75) fregion = 3;
						else fregion = 4;
						pdata[0].campaign = campaigns[fregion-1];
					}
					else
						pdata[0].campaign = campaigns[parseInt(pdata[0].region)-1];
					
					jQuery.magnificPopup.open({
						items: pdata,
						inline: {
		            		markup: jQuery('#tmplGAMpopup').html()
						},
						closeBtnInside: true,
						prependTo: jQuery("#page"),
						alignTop: true,
						fixedContentPos: false,
						fixedBgPos: true,
						gallery: {
							enabled: true,
							preload: [0,0],
							navigateByImgClick: false,
							arrowMarkup: '',
							tPrev: '',
							tNext: '',
							tCounter: '%curr% of %total% '
						},
						callbacks: {
							markupParse: function(template, values, item) {
								region = parseInt(item.data.region);
								round = parseInt(item.data.round);
								//campaign = campaigns[region-1];
								campaign = item.data.campaign;
								
								//campimg = "/wp-content/themes/gunsandammo/images/ga-madness/"+popads[campaign];
								campimg = "/wp-content/plugins/bowmadness/ads/" + randomPopad;
								template.find("#popupsponsor a").html('<img src="'+campimg+'" />');
																
								var roundtitle = roundtitles[round];
								var regiontitle = (round<6)? (regions[region]+": "):"";
								template.find("#popuptitle").html(regiontitle+roundtitle);
							},
							open: function() {
								slidecnt--;
								jQuery.magnificPopup.instance.goTo(slide);
								
								//googletag.cmd.push(function() {
								//	googletag.display('div-gpt-ad-1386782139095-3');
								//});
									
								//var bidadtag = '<script src=http://ad.doubleclick.net/adj/imo.gunsandammo/bracket;'
								//+'camp='+pdata[0].campaign+';sect=;manf=;pos=;page=ga_madness;subs=;sz=300x250;'
								//+'dcopt=;tile=1;ord='+(Math.floor((Math.random()) * 100000000))+'></script>';
								//postscribe('#div-gpt-ad-1386782139095-3',bidadtag);
								
								jQuery(".next-matchup").on("click", function() {
									if(region==6) {
										jQuery("div[data-region='5'][data-idx='0'][data-round='6']").trigger("click");
									}
									else if(slidecnt<(16/(Math.pow(2,(round-1)))))
										jQuery.magnificPopup.instance.next();
									else {
										slidecnt = 0;
										var nextRegion = parseInt(region)+1;
										if(nextRegion == 5) nextRegion = 1;
										
										region = nextRegion.toString();
										jQuery("div[data-region='"+region+"'][data-idx='0'][data-round='"+round+"']").trigger("click");				
									}
								});
								jQuery(".vote-again").on("click", function() {
									jQuery("div[data-mid='63']").trigger("click");
								});

								
							},
							change: function() {
								var item = jQuery.magnificPopup.instance.currItem;
								slidecnt++;
																
								if(item.data.region != region) {
								}
								
								region = parseInt(item.data.region);
								
								campaign = campaigns[region-1];
								
								_gaq.push(['_trackPageview',"/" + window.location.pathname + "/match"+item.data.id]);
								
								setTimeout(function() {
									jQuery(".gunone img, .guntwo img, .gunone h2, .guntwo h2").css({ opacity: 1 });
									var btn1 = '<div class="popup-vote-btn" data-mid="'+item.data.id+'" data-pnum="1">VOTE</div>';
									jQuery("#popvoteon1").html(btn1);
									var btn2 = '<div class="popup-vote-btn" data-mid="'+item.data.id+'" data-pnum="2">VOTE</div>';
									jQuery("#popvoteon2").html(btn2);
									
									jQuery(".popup-vote-btn").on("click", function() {
										logVote(jQuery(this).data("mid"),jQuery(this).data("pnum"));
									});
									jQuery(".next-matchup").hide();
									jQuery(".vote-again").hide();
									
									//jQuery('#gpt-ad-1386782139095-3').empty();
									//var bidadtag = '<script src=http:ad.doubleclick.net/adj/imo.gunsandammo/bracket;'
									//+'camp='+campaign+';sect=;manf=;pos=;page=ga_madness;subs=;sz=300x250;'
									//+'dcopt=;tile=1;ord='+(Math.floor((Math.random()) * 100000000))+'></script>';
									//postscribe('#gpt-ad-1386782139095-3',bidadtag);

									jQuery("#popupAdRight .popupad").remove();
									jQuery("#popupAdRight").append('<div id="div-bob_championship_medium_rectangle" class="popupad"><iframe id="bracket-iframe-ad" width="300" height="250" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no" src="/iframe-ad-bracket.php?ad_code=imo.bowhunting&bracket=battle_of_the_bows&size=bob_championship_medium_rectangle"></iframe></div>');									
								}, 200);
							}
						}
					});	
				}
		 	});
		 	
		});
	}
	
	function logVote(match, pnum) {

		jQuery.ajax({
			type: "GET",
			url: "http://apps.imoutdoors.com/bracket/matchVote",
			data: {"format": "json", "id":match, "voted": pnum},
			dataType: "json",
			success: function(data) {
				var score1 = parseInt(data[0].player1score);
				var score2 = parseInt(data[0].player2score);

				if(pnum=="1") jQuery(".guntwo img, .guntwo h2").fadeTo("fast", "0.5");
				if(pnum=="2") jQuery(".gunone img, .gunone h2").fadeTo("fast", "0.5");
				
				jQuery("#popvoteon1").html('<div class="popvoted '+((pnum=="2")? "popvoted-no":"")+'">'+score1+' Votes</div>');
				jQuery("#popvoteon2").html('<div class="popvoted '+((pnum=="1")? "popvoted-no":"")+'">'+score2+' Votes</div>');
				
				if(match=="63") {
					jQuery(".vote-again").show();
				}
				else {
					jQuery(".next-matchup").show();
				}
			}
		});
	}

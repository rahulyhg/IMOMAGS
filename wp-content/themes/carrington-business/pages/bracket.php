<?php

/**
 * @package carrington-business
 *
 * This file is part of the Carrington Business Theme for WordPress
 * http://crowdfavorite.com/wordpress/themes/carrington-business/
 *
 * Copyright (c) 2008-2011 Crowd Favorite, Ltd. All rights reserved.
 * http://crowdfavorite.com
 *
 * **********************************************************************
 * This program is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. 
 * **********************************************************************
 */

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }
	
get_header();

the_post();
?>
<header>
	<ul id="ga-madness-nav">
		<li><a href="/ga-madness">Gun Bracket</a></li>
		<li><a href="/ga-madness/enter">Enter Now</a></li>
		<li style="width:270px;"></li>
		<li><a href="/ga-madness/prizes">Prizes & Rules</a></li>
		<li><a href="/ga-madness/how-it-works">How it Works</a></li>
	</ul>
	<div class="ga-madness-nav-logo"></div>
	
	<h1><?php the_title(); ?></h1>
	<?php edit_post_link(__('Edit', 'carrington-business')); ?>
</header><!-- #masthead -->
<div class="col-abc">
	<div <?php post_class('entry entry-full clearfix'); ?>>
		<div class="entry-content">
			
			<div id="content-wrapper">
				  <div id="table">
				
				<!-- Table Dates -->
				    <table class="gridtable">
				      <tr>
				        <th class="round_1 current"> 1st ROUND </th>
				        <th class="round_2 "> 2nd ROUND </th>
				        <th class="round_3"> SWEET 16 </th>
				        <th class="round_4"> ELITE EIGHT </th>
				        <th class="round5"> FINAL FOUR </th>
				        <th class="round_6"> CHAMPION </th>
				        <th class="round_5"> FINAL FOUR </th>
				        <th class="round_4"> ELITE EIGHT </th>
				        <th class="round_3"> SWEET 16 </th>
				        <th class="round_2"> 2nd ROUND </th>
				        <th class="round_1 current"> 1st ROUND </th>
				      </tr>
				      <tr>
				        <td class="current"> March 18-19 </td>
				        <td> March 20-21 </td>
				        <td> March 25-26 </td>
				        <td> March 27-28 </td>
				        <td> April 3 </td>
				        <td> April 5 </td>
				        <td> April 3 </td>
				        <td> March 27-28 </td>
				        <td> March 25-26 </td>
				        <td> March 20-21 </td>
				        <td class="current"> March 18-19 </td>
				      </tr>
				    </table>
				  </div>
				
				<!-- Bracket -->
				  <div id="bracket">
				    <div id="round1" class="round">
				      <h3>
				        Round One (2012 NCAA Men's Basketball Tournament) 
				      </h3>
				
				<!-- start region1 -->
				      <div class="region region1">
				        <h4 class="region1 first_region">
				         Handguns
				        </h4>
				        <div id="match18" class="open-poll match m1" poll="smith-wesson-mp-shield-vs-beretta-nano">
				          <p class="slot slot1"><!--<strike>--><span class="seed">1</span>S&W M&P Shield<!--</strike>--></p>
				          <p class="slot slot2"><!--<strong>--><span class="seed">16</span>Beretta Nano<!--</strong>--></p>
				          <a class="vote" style="display:none;">Vote</a>
				        </div>
				
				<!-- /#match18 -->
				        <div id="match19" class="open-poll match m2" poll="kimber-solo-9mm-vs-kahr-p380">
				          <p class="slot slot1"><span class="seed">8</span>Kimber Solo 9mm </p>
				          <p class="slot slot2"><span class="seed">9</span>Kahr P380</p>
				          <a class="vote" style="display:none;">Vote</a>
				        </div>
				
				<!-- /#match19 -->
				        <div id="match20" class="open-poll match m3" poll="sw-performance-center-1911-vs-taurus-raging-judge-magnum">
				          <p class="slot slot1"><span class="seed">5</span>S&W Performance Center 1911</p>
				          <p class="slot slot2"><span class="seed">12</span>Taurus Raging Judge Magnum</p>
				          <a class="vote" style="display:none;">Vote</a>
				        </div>
				
				<!-- /#match20 -->
				        <div id="match21" class="open-poll match m4" poll="springfield-xds-vs-colt-mustang-pocketlite">
				          <p class="slot slot1"><span class="seed">4</span>Springfield XDs</p>
				          <p class="slot slot2"><span class="seed">13</span>Colt Mustang Pocketlite</p>
				          <a class="vote" style="display:none;">Vote</a>
				        </div>
				
				<!-- /#match21 -->
				        <div id="match22" class="open-poll match m5" poll="ruger-sr22-vs-remington-r1-carry">
				          <p class="slot slot1"><span class="seed">6</span>Ruger SR22</p>
				          <p class="slot slot2"><span class="seed">11</span>Remington R1 Carry</p>
				          <a class="vote" style="display:none;">Vote</a>
				        </div>
				        <div id="match23" class="open-poll match m6" poll="cz-p-09-duty-vs-taurus-millenium-g2">
				          <p class="slot slot1"><span class="seed">3</span>CZ P-09 Duty</p>
				          <p class="slot slot2"><span class="seed">14</span>Taurus Millenium G2 </p>
				          <a class="vote" style="display:none;">Vote</a>
				        </div>
				
				<!-- /#match23 -->
				        <div id="match24" class="open-poll match m7" poll="walther-ppq-vs-sig-p938">
				          <p class="slot slot1"><span class="seed">7</span>Walther PPQ</p>
				          <p class="slot slot2"><span class="seed">10</span>Sig P938</p>
				          <a class="vote" style="display:none;">Vote</a>
				        </div>
				
				<!-- /#match24 -->
				        <div id="match25" class="open-poll match m8" poll="glock-17-gen4-vs-ruger-single-nine">
				          <p class="slot slot1"><span class="seed">2</span>Glock 17 Gen4</p>
				          <p class="slot slot2"><span class="seed">15</span>Ruger Single-Nine</p>
				          <a class="vote" style="display:none;">Vote</a>
				        </div>
				
				<!-- /#match25 -->
				      </div>
				<!-- /.region1 -->
				<!-- start region2 -->
				      <div class="region region2">
				        <h4 class="region2 first_region">
				          Rifles
				        </h4>
				        <div id="match26" class="match m1">
				          <p class="slot slot1">
				            <span class="seed">1</span> UConn  
				          </p>
				          <p class="slot slot2">
				            <span class="seed">16</span> Chatt.  
				          </p>
				        </div>
				
				<!-- /#match26 -->
				        <div id="match27" class="match m2">
				          <p class="slot slot1">
				            <span class="seed">8</span> BYU  
				          </p>
				          <p class="slot slot2">
				            <span class="seed">9</span> Texas A&amp;M  
				          </p>
				        </div>
				
				<!-- #/match27 -->
				        <div id="match28" class="match m3">
				          <p class="slot slot1">
				            <span class="seed">5</span> Purdue  
				          </p>
				          <p class="slot slot2">
				            <span class="seed">12</span> N. Iowa  
				          </p>
				        </div>
				
				<!-- #/match28 -->
				        <div id="match29" class="match m4">
				          <p class="slot slot1">
				            <span class="seed">4</span> Washington  
				          </p>
				          <p class="slot slot2">
				            <span class="seed">13</span> Miss. St.  
				          </p>
				        </div>
				
				<!-- #/match29 -->
				        <div id="match30" class="match m5">
				          <p class="slot slot1">
				            <span class="seed">6</span> Marquette  
				          </p>
				          <p class="slot slot2">
				            <span class="seed">11</span> Utah St.  
				          </p>
				        </div>
				
				<!-- /#match30 -->
				        <div id="match31" class="match m6">
				          <p class="slot slot1">
				            <span class="seed">3</span> Missouri  
				          </p>
				          <p class="slot slot2">
				            <span class="seed">14</span> Cornell  
				          </p>
				        </div>
				
				<!--/#match31-->
				        <div id="match32" class="match m7">
				          <p class="slot slot1">
				            <span class="seed">7</span> Cal  
				          </p>
				          <p class="slot slot2">
				            <span class="seed">10</span> Maryland  
				          </p>
				        </div>
				
				<!--/#match32-->
				        <div id="match33" class="match m8">
				          <p class="slot slot1">
				            <span class="seed">2</span> Memphis  
				          </p>
				          <p class="slot slot2">
				            <span class="seed">15</span> CS North  
				          </p>
				        </div>
				
				<!-- /#match33 -->
				      </div>
				<!-- /.region2 -->
				<!-- start region3 -->
				      <div class="region region3">
				        <h4 class="region3 first_region">
				          Shotguns
				        </h4>
				        <div id="match65" class="match m1">
				          <p class="slot slot1">
				            <span class="seed">1</span> Pitt  
				          </p>
				          <p class="slot slot2">
				            <span class="seed">16</span> E. Tenn. St. 
				          </p>
				        </div>
				
				<!--#/match65-->
				        <div id="match66" class="match m2">
				          <p class="slot slot1">
				            <span class="seed">8</span> Okla. St.  
				          </p>
				          <p class="slot slot2">
				            <span class="seed">9</span> Tennessee  
				          </p>
				        </div>
				
				<!-- #/match66 -->
				        <div id="match4" class="match m3">
				          <p class="slot slot1">
				            <span class="seed">5</span> FSU  
				          </p>
				          <p class="slot slot2">
				            <span class="seed">12</span> Wisconsin  
				          </p>
				        </div>
				
				<!--/#match4 -->
				        <div id="match5" class="match m4">
				          <p class="slot slot1">
				            <span class="seed">4</span> Xavier  
				          </p>
				          <p class="slot slot2">
				            <span class="seed">13</span> Portland St.  
				          </p>
				        </div>
				
				<!-- /#match5 -->
				        <div id="match6" class="match m5">
				          <p class="slot slot1">
				            <span class="seed">6</span> UCLA  
				          </p>
				          <p class="slot slot2">
				            <span class="seed">11</span> VCU  
				          </p>
				        </div>
				
				<!-- /#match6 -->
				        <div id="match7" class="match m6">
				          <p class="slot slot1">
				            <span class="seed">3</span> Villanova  
				          </p>
				          <p class="slot slot2">
				            <span class="seed">14</span> American  
				          </p>
				        </div>
				
				<!-- /#match7 -->
				        <div id="match8" class="match m7">
				          <p class="slot slot1">
				            <span class="seed">7</span> Texas  
				          </p>
				          <p class="slot slot2">
				            <span class="seed">10</span> Minnesota  
				          </p>
				        </div>
				
				<!-- /#match8 -->
				        <div id="match9" class="match m8">
				          <p class="slot slot1">
				            <span class="seed">2</span> Duke  
				          </p>
				          <p class="slot slot2">
				            <span class="seed">15</span> Binghamton  
				          </p>
				        </div>
				
				<!-- /#match9 -->
				      </div>
				<!-- /.region3 -->
				<!-- start region4 -->
				      <div class="region region4">
				        <h4 class="region4 first_region">
				          AR-15 
				        </h4>
				        <div id="match10" class="match m1">
				          <p class="slot slot1">
				            <span class="seed">1</span> UNC  
				          </p>
				          <p class="slot slot2">
				            <span class="seed">16</span> Radford  
				          </p>
				        </div>
				
				<!-- /#match10 -->
				        <div id="match11" class="match m2">
				          <p class="slot slot1">
				            <span class="seed">8</span> LSU  
				          </p>
				          <p class="slot slot2">
				            <span class="seed">9</span> Butler  
				          </p>
				        </div>
				
				<!-- /#match11 -->
				        <div id="match12" class="match m3">
				          <p class="slot slot1">
				            <span class="seed">5</span> Illinois  
				          </p>
				          <p class="slot slot2">
				            <span class="seed">12</span> Kentucky  
				          </p>
				        </div>
				
				<!-- /#match12 -->
				        <div id="match13" class="match m4">
				          <p class="slot slot1">
				            <span class="seed">4</span> Gonzaga  
				          </p>
				          <p class="slot slot2">
				            <span class="seed">13</span> Akron  
				          </p>
				        </div>
				
				<!-- /#match13 -->
				        <div id="match14" class="match m5">
				          <p class="slot slot1">
				            <span class="seed">6</span> Arizona St.  
				          </p>
				          <p class="slot slot2">
				            <span class="seed">11</span> Temple  
				          </p>
				        </div>
				
				<!-- /#match14 -->
				        <div id="match15" class="match m6">
				          <p class="slot slot1">
				            <span class="seed">3</span> Syracuse  
				          </p>
				          <p class="slot slot2">
				            <span class="seed">14</span> S.F. Austin  
				          </p>
				        </div>
				        <div id="match16" class="match m7">
				          <p class="slot slot1">
				            <span class="seed">7</span> Clemson  
				          </p>
				          <p class="slot slot2">
				            <span class="seed">10</span> Michigan  
				          </p>
				        </div>
				
				<!-- /#match16 -->
				        <div id="match17" class="match m8">
				          <p class="slot slot1">
				            <span class="seed">2</span> Oklahoma  
				          </p>
				          <p class="slot slot2">
				            <span class="seed">15</span> State  
				          </p>
				        </div>
				
				<!-- /#match17 -->
				      </div>
				<!-- /.region4 -->
				    </div>
				<!-- /#round1 -->
				    <div id="round2" class="round">
				      <h3>
				        Round Two (2010 NCAA Men's Basketball Tournament) 
				      </h3>
				      <div class="region region1">
				        <h4 class="region1">
				          MIDWEST 
				        </h4>
				        <div id="match41" class="match m1">
				          <p rel="match18" class="slot slot1">
				            <span class="seed">1</span> TEAM 
				          </p>
				          <p rel="match19" class="slot slot2">
				            <span class="seed">9</span> TEAM 
				          </p>
				        </div>
				
				<!-- /#match41 -->
				        <div id="match42" class="match m2">
				          <p rel="match20" class="slot slot1">
				          </p>
				          <p rel="match21" class="slot slot2">
				          </p>
				        </div>
				<!-- /#match42 -->
				        <div id="match43" class="match m3">
				          <p class="slot slot1">
				          </p>
				          <p class="slot slot2">
				          </p>
				        </div>
				<!-- /#match43 -->
				        <div id="match44" class="match m4">
				          <p class="slot slot1">
				          </p>
				          <p class="slot slot2">
				          </p>
				        </div>
				<!-- /#match44 -->
				      </div>
				<!-- /.region1 -->
				      <div class="region region2">
				        <h4 class="region2">
				          WEST 
				        </h4>
				        <div id="match45" class="match m1">
				          <p class="slot slot1">
				          </p>
				          <p class="slot slot2">
				          </p>
				        </div>
				        <div id="match46" class="match m2">
				          <p class="slot slot1">
				          </p>
				          <p class="slot slot2">
				          </p>
				        </div>
				
				<!-- /#match46 -->
				        <div id="match47" class="match m3">
				          <p class="slot slot1">
				          </p>
				          <p class="slot slot2">
				          </p>
				        </div>
				        <div id="match48" class="match m4">
				          <p class="slot slot1">
				          </p>
				          <p class="slot slot2">
				          </p>
				        </div>
				<!-- /#match48 -->
				      </div>
				      <div class="region region3">
				        <h4 class="region3">
				          East 
				        </h4>
				        <div id="match3" class="match m1">
				          <p class="slot slot1">
				          </p>
				          <p class="slot slot2">
				          </p>
				        </div>
				
				<!--/match3-->
				        <div id="match34" class="match m2">
				          <p class="slot slot1">
				          </p>
				          <p class="slot slot2">
				          </p>
				        </div>
				<!-- #/match34 -->
				        <div id="match35" class="match m3">
				          <p class="slot slot1">
				          </p>
				          <p class="slot slot2">
				          </p>
				        </div>
				<!-- #/match35 -->
				        <div id="match36" class="match m4">
				          <p class="slot slot1">
				          </p>
				          <p class="slot slot2">
				          </p>
				        </div>
				<!-- #/match36 -->
				      </div>
				<!--/.region3-->
				      <div class="region region4">
				        <h4 class="region4">
				          South 
				        </h4>
				        <div id="match37" class="match m1">
				          <p class="slot slot1">
				          </p>
				          <p class="slot slot2">
				          </p>
				        </div>
				
				<!--/#match37-->
				        <div id="match38" class="match m2">
				          <p class="slot slot1">
				          </p>
				          <p class="slot slot2">
				          </p>
				        </div>
				<!--/#match38-->
				        <div id="match39" class="match m3">
				          <p class="slot slot1">
				          </p>
				          <p class="slot slot2">
				          </p>
				        </div>
				<!--/#match39-->
				        <div id="match40" class="match m4">
				          <p class="slot slot1">
				          </p>
				          <p class="slot slot2">
				          </p>
				        </div>
				<!--/#match40-->
				      </div>
				<!--/.region4-->
				    </div>
				    <div id="round3" class="round">
				      <h3>
				        Round Three (2010 NCAA Men's Basketball Tournament) 
				      </h3>
				      <div class="region region1">
				        <h4 class="region1">
				          Midwest 
				        </h4>
				        <div id="match53" class="match m1">
				          <p class="slot slot1">
				          </p>
				          <p class="slot slot2">
				          </p>
				        </div>
				        <div id="match54" class="match m2">
				          <p class="slot slot1">
				          </p>
				          <p class="slot slot2">
				          </p>
				        </div>
				      </div>
				
				<!-- /.region1 -->
				      <div class="region region2">
				        <h4 class="region2">
				          West 
				        </h4>
				        <div id="match55" class="match m1">
				          <p class="slot slot1">
				          </p>
				          <p class="slot slot2">
				          </p>
				        </div>
				        <div id="match56" class="match m2">
				          <p class="slot slot1">
				          </p>
				          <p class="slot slot2">
				          </p>
				        </div>
				
				<!--/#match56-->
				      </div>
				      <div class="region region3">
				        <h4 class="region3">
				          East 
				        </h4>
				        <div id="match49" class="match m1">
				          <p class="slot slot1">
				          </p>
				          <p class="slot slot2">
				          </p>
				        </div>
				
				<!--/#match49-->
				        <div id="match50" class="match m2">
				          <p class="slot slot1">
				          </p>
				          <p class="slot slot2">
				          </p>
				        </div>
				<!--/#match50-->
				      </div>
				<!-- /.region3 -->
				      <div class="region region4">
				        <h4 class="region4">
				          South 
				        </h4>
				        <div id="match51" class="match m1">
				          <p class="slot slot1">
				          </p>
				          <p class="slot slot2">
				          </p>
				        </div>
				
				<!--/#match51-->
				        <div id="match52" class="match m2">
				          <p class="slot slot1">
				          </p>
				          <p class="slot slot2">
				          </p>
				        </div>
				<!--/#match52-->
				      </div>
				<!-- /.region4 -->
				    </div>
				    <div id="round4" class="round">
				      <h3>
				        Round Four (2010 NCAA Men's Basketball Tournament) 
				      </h3>
				      <div class="region region1">
				        <h4 class="region1">
				          Midwest 
				        </h4>
				        <div id="match60" class="match m1">
				          <p class="slot slot1">
				          </p>
				          <p class="slot slot2">
				          </p>
				        </div>
				
				<!-- /#match60 -->
				      </div>
				<!-- /.region1 -->
				      <div class="region region2">
				        <h4 class="region2">
				          West 
				        </h4>
				        <div id="match61" class="match m1">
				          <p class="slot slot1">
				          </p>
				          <p class="slot slot2">
				          </p>
				        </div>
				
				<!-- /#match61 -->
				      </div>
				<!-- /.region2 -->
				      <div class="region region3">
				        <h4 class="region3">
				          East 
				        </h4>
				        <div id="match58" class="match m1">
				          <p class="slot slot1">
				          </p>
				          <p class="slot slot2">
				          </p>
				        </div>
				
				<!-- /#match58 -->
				      </div>
				<!--/.region3-->
				      <div class="region region4">
				        <h4 class="region4">
				          South 
				        </h4>
				        <div id="match59" class="match m1">
				          <p class="slot slot1">
				          </p>
				          <p class="slot slot2">
				          </p>
				        </div>
				
				<!--/#match59-->
				      </div>
				<!--/#match59-->
				    </div>
				    <div id="round5" class="round">
				      <h3>
				        Round Five (2010 NCAA Men's Basketball Tournament) 
				      </h3>
				      <div class="region">
				        <div id="match63" class="match m1">
				          <p class="slot slot1">
				          </p>
				          <p class="slot slot2">
				          </p>
				        </div>
				        <div id="match62" class="match m2">
				          <p class="slot slot1">
				          </p>
				          <p class="slot slot2">
				          </p>
				        </div>
				      </div>
				    </div>
				    <div id="round6" class="round">
				      <h3>
				        Round Six (2010 NCAA Men's Basketball Tournament) 
				      </h3>
				      <div class="region">
				        <div id="match64" class="match m1">
				          <p class="slot slot1" id="slot127">
				            <strong><span class="seed">0</span> Winner <em class="score">65</em></strong>
				<!-- winner -->
				          </p>
				          <p class="slot slot2" id="slot128">
				            <strike><span class="seed">4</span> Loser <em class="score">60</em></strike>
				<!-- loser -->
				          </p>
				        </div>
				      </div>
				    </div>
				  </div>
				</div>

			<?php			
			the_content(__('Continued&hellip;', 'carrington-business'));
			wp_link_pages();
			?>
		</div>
	</div><!-- .entry -->
</div><!-- .col-abc -->

<div id="bracket-modal" class="new-superpost-modal-container new-superpost-box" style="display:none;width:740px;background-color:white;">
	<div class="ga-madness-logo"></div>
	<div class="poll-area"></div>
	<div class="extra-poll-content" style="display:none;">
		<div class="vote-thumb" style="display:none;"></div>
		<div class="vs">vs.</div>
	</div>
	<div class="voted" style="display:none;"><h4>You have already voted for this poll.</h4></div>
</div>

<?php get_footer(); ?>
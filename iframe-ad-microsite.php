<?php 
$dartDomain = $_GET['ad_code'];
$term = $_GET['term'];
?>
<html>
<head>
<script type='text/javascript'>
  (function() {
    var useSSL = 'https:' == document.location.protocol;
    var src = (useSSL ? 'https:' : 'http:') +
        '//www.googletagservices.com/tag/js/gpt.js';
    document.write('<scr' + 'ipt src="' + src + '"></scr' + 'ipt>');
  })();
</script>

<script type='text/javascript'>
  googletag.cmd.push(function() {

    googletag.defineSlot('/4930/<?php echo $dartDomain; ?>', [300, 250], 'microsite_ATF_300x250').addService(googletag.pubads());

    googletag.pubads().enableSingleRequest();
    googletag.pubads().setTargeting('sect', ['<?php echo $term; ?>']);
    googletag.pubads().collapseEmptyDivs(); 
    googletag.pubads().enableSyncRendering();
    googletag.enableServices();
  });
</script>

</head>
<body>
<div id='microsite_ATF_300x250'>
		<script type='text/javascript'>
			googletag.cmd.push(function() { googletag.display('microsite_ATF_300x250'); });
		</script>
	</div>

</body>
</html>
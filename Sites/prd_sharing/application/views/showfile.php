<html>
<head>
	<title>TEST FILE</title>
	<script src="<?php echo base_url();?>assets/build/jquery.js"></script>	
	<script src="<?php echo base_url();?>assets/build/mediaelement-and-player.min.js"></script>
	<link rel="stylesheet" href="<?php echo base_url();?>assets/build/mediaelementplayer.min.css" />
</head>
<body>
	<video width="640" height="360" id="player2" poster="<?php echo base_url();?>assets/media/echo-hereweare.jpg" controls="controls" preload="none">
		<!-- MP4 source must come first for iOS -->
		<source type="video/wmv" src="<?php echo base_url();?>assets/media/1234.wmv" />
		<!-- WebM for Firefox 4 and Opera -->
		<source type="video/webm" src="<?php echo base_url();?>assets/media/echo-hereweare.webm" />
		<!-- OGG for Firefox 3 -->
		<source type="video/ogg" src="<?php echo base_url();?>assets/media/echo-hereweare.ogv" />
		<!-- Fallback flash player for no-HTML5 browsers with JavaScript turned off -->
		<object width="640" height="360" type="application/x-shockwave-flash" data="<?php echo base_url();?>assets/build/flashmediaelement.swf"> 		
			<param name="movie" value="<?php echo base_url();?>assets/build/flashmediaelement.swf" /> 
			<param name="flashvars" value="controls=true&poster=<?php echo base_url();?>assets/media/echo-hereweare.jpg&file=<?php echo base_url();?>assets/media/echo-hereweare.mp4" /> 		
			<!-- Image fall back for non-HTML5 browser with JavaScript turned off and no Flash player installed -->
			<img src="<?php echo base_url();?>assets/media/echo-hereweare.jpg" width="640" height="360" alt="Here we are" 
				title="No video playback capabilities" />
		</object> 	
	</video>


<script>
$('audio,video').mediaelementplayer({
	mode: 'shim',
	success: function(player, node) {
		$('#' + node.id + '-mode').html('mode: ' + player.pluginType);
	}
});

</script>

<input type="button" id="stopall" value="Stop all">

<script>
$('#stopall').click(function() {
    $('video, audio').each(function() {
          $(this)[0].player.pause();		  
    });
});
</script>
</body>
</html>
<script>
	head.js("http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js", "http://cdn.jquerytools.org/1.2.6/all/jquery.tools.min.js", "http://releases.flowplayer.org/js/flowplayer-3.2.13.min.js", function() {
	});
	head.ready(function() {
		// install flowplayer into container
		$f("mb", "http://releases.flowplayer.org/swf/flowplayer-3.2.18.swf", {

			// fullscreen button not needed here
			plugins : {
				controls : {
					fullscreen : false,
					height : 30,
					autoHide : false
				}
			},

			clip : {
				autoPlay : false,
				// optional: when playback starts close the first audio playback
				onBeforeBegin : function() {
					$f("player").close();
				}
			}

		});

	}); 
</script>
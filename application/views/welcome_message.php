<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Instagram Live Feed</title>


	<link rel="stylesheet" href="/livestagram/css/style.css">
	

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
	<script src="/livestagram/js/slides.jquery.js"></script>
	<script src="/livestagram/js/jquery.fullscreen-min.js"></script>

	<script >
		
		function goFullscreen()
		{
			$(document).fullScreen(true);
			
		}

		$(document).bind("fullscreenchange", function(e) {
      		
     		  if( $(document).fullScreen() )
     		  {
     		  	$("#fullscreen").hide();
     		  }
     		  else
     		  {
     		  	$("#fullscreen").show();
     		  }
  		 });
		
		var timestamp = <?php echo "'".time()."'"; ?>;

		function waitForNewData( ){
			
			$.ajax({
				type: 'POST',
				url: "<?php echo base_url(); ?>poll/get_new_photos",
				data: { time: timestamp },
				async: true,
				cache: false,

				success: function( data )
				{

					var json = eval('(' + data + ')');

					if( json['photos'] != '')
					{
						//console.log("new photo");
						timestamp = json['timestamp'];

						$("#slides").slides("stop");
						
						var children = $('#slides .slidesControl').children();
				        var newContainer = $('#slides .slidesControl');
				        var slides = $('#slides');
				        
				        $.each(json['photos'], function(i, item) {
			                newContainer.append('<div class="slide" style="position: absolute; top: 0px; left: 0px; z-index: 0; display: block;"><img width="700" height="700" src="' + item.url + '">'+
								'<div class="caption"><img width="100" height="100" src="' + item.user_pic + '" /> <p><span class="credit">Photo by</span> @' + item.user + '</p></div></div>');
			            });

				        $("#slides").slides("update");

				        // wait a second before playing again...
					    setTimeout(function(){
					    	$("#slides").slides("play");	
					    }, 1000);
					}
					setTimeout('waitForNewData()', 10000);
				},
				error: function(XMLHTTPRequest, textStatus, errorThrown){
					setTimeout('waitForNewData()', 25000);
				}
			});
		}

		$(document).ready(function(){
			waitForNewData();
		});

		$(function(){
			$("#slides").slides({
				width: 700,
	   			height:700,
	   			playInterval: 5000,
      			pauseInterval: 5000
			});

			setTimeout(function(){
				$("#slides").slides("play");
			}, 5000);
			

			

		});

	</script>
</head>
<body id='livefeed'>

	<button onclick="goFullscreen(); return false" id='fullscreen'>Fullscreen</button>
	<h1 id='title'>Tag your Instagram<br/>photos with <span style='color:yellow'>#<?php echo $hashtag;?></span></h1>

	<div id="container">
		 <div id="slides">
					<?php foreach ($photos as $item):?>
					<div class='slide'>
						<img width='700' height='700' src="<?php echo $item['url'];?>">
						<div class="caption">
							<img width='100' height='100' src="<?php echo $item['user_pic'];?>" /> 
							<p><span class="credit">Photo by</span> @<?php echo $item['user'];?></p>
						</div>
					</div>
					<?php endforeach;?>
	        </div>
	</div>

</body>
</html>
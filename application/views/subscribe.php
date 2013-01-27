<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Instagram Live Feed</title>

	<link rel="stylesheet" href="/livestagram/css/style.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
	
</head>
<body>


<div id="container">

	<?php
		if( $results )
			echo $results;
	?>
	 
	 <form method='post' action='/livestagram/subscribe/'>
	 	<p style='font-size:20px;color:white;'>Enter a hashtag to subscribe to</p>
	 	<span style='font-size:20px;color:white;'>#</span><input style='font-size:17px;color:black;height:20px;' type='text' name='hashtag' id='hashtag'/>
	 	<br/>
	 	<input style='font-size:20px;color:black;height:20px;margin-top:10px;' type='submit' name='submit' value='Submit' />
	 </form>
	
</div>

</body>
</html>
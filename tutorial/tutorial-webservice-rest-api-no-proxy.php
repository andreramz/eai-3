<?php
    $maps_url = 'http://api.openweathermap.org/data/2.5/weather?q=depok&appid=db63bcc6eaf9506caa86043d81e4f627';
	$maps_json = file_get_contents($maps_url);
	$maps_array = json_decode($maps_json, true);
	$temp = $maps_array['weather'];
	
	print_r($maps_array);
	
	echo "<br>";
	$temp = $temp[0];
	print_r($temp);
	
	echo "<br>";
	$temp = implode(" ", $temp);
	print_r($temp);
?>
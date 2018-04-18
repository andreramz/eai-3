<?php
	if(!isset($_SERVER['PHP_AUTH_USER'])){
		header('WWW-Authenticate: Basic realm="My Realm"');
		header('HTTP/1.0 401 Unauthorized');
		echo 'Text to send if user hits Cancel button'
		exit;
	} else{
		echo "<p>Hello ".$_SERVER['PHP_AUTH_USER']."</p>";
		echo "<p>You have entered your password</p>";
	}
	
	$username = 'PHP_AUTH_USER';
	$password = 'PHP_AUTH_PW';
	
	$auth = base64_encode($username.':'.$password);
	
	$aContext= array(
		'http' => array(
			'proxy' => 'tcp://152.118.24.10:8080',
			'request_fulluri' => true,
			'header' => "Proxy-Authorization: Basic $auth"),
		),
	);
	$cxContext = stream_context_create($aContext);
	
	$maps_url = 'http://api.openweathermap.org/data/2.5/weather?q=depok&appid=db63bcc6eaf9506caa86043d81e4f627';
	$maps_json = file_get_contents($maps_url, false, $cxContext);
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
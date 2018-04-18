<?php
	require_once('nusoap-0.9.5/lib/nusoap.php');
	$client = new nusoap_client('http://localhost/eai-3/tutorial/webservice/server.php');
	
	$data = array(
		'ID'=>"1",
		'first_name'=>"Hermione",
		'last_name'=>"Granger",
		'email'=>"hermione@hogwarts.com"
	);
	
	$response = $client->call('reformat_contact', array('contact'=>$data));
	echo "<pre>";
	print_r($response);
	echo "</pre>";
	
	// $response = $client->call('get_message', array("name"=>"Harry"));
	// echo $response;
	
	echo("<br/>");
	$response = $client->call('get_product', array("category"=>"books"));
	echo $response;
?>
<?php

function getIP() {
	$client  = @$_SERVER['HTTP_CLIENT_IP'];
	$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
	$remote  = @$_SERVER['REMOTE_ADDR'];
	 
	if(filter_var($client, FILTER_VALIDATE_IP)) $ip = $client;
	elseif(filter_var($forward, FILTER_VALIDATE_IP)) $ip = $forward;
	else $ip = $remote;
	 
	return $ip;
}

$city = "Unknown";
$country = "Unknown";
$countryCode = "UN";

$ip = getIP();

$ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));
if($ip_data != null && $ip_data->geoplugin_countryName != null)
{
	$city = $ip_data->geoplugin_city;
	$country = $ip_data->geoplugin_countryName;
	$countryCode = $ip_data->geoplugin_countryCode;
}

echo $ip."?".$city."?".$country."?".$countryCode;

?>
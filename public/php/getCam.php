<?php
$camera_url = "http://192.168.100.15:80/ISAPI/Streaming/channels/1/picture";

$url = $camera_url;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($ch, CURLOPT_USERPWD, "admin:akehpisan07");
$result = curl_exec($ch);
$info = curl_getinfo($ch);
curl_close($ch);
header('content-type: image/jpeg');
readfile($result);
// echo $result;
?>

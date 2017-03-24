<?php
$url = 'url_josn.php';
$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, 'http://172.20.0.14/Ztree/XA/'.$url);
$result = curl_exec($ch);
curl_close($ch);

$obj = json_decode($result);
$A =  $obj->stringA;
print_r($A);
?>
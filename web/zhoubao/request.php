<?php 
require "jssdk.php";
$jssdk = new JSSDK("wx80c487097b512789", "422d3a86338493d2f7b0e56507e5ac19");//你的appid,appsecret
$signPackage = $jssdk->GetSignPackage();
print_r($signPackage);die;


 ?>
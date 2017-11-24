<?php
require_once "jssdk.php";
// $jssdk = new JSSDK("wx80c487097b512789", "422d3a86338493d2f7b0e56507e5ac19",$_POST['url']);
$jssdk = new JSSDK("wx80c487097b512789", "422d3a86338493d2f7b0e56507e5ac19",'http://i2137.com/php/index.html');
$signPackage = $jssdk->GetSignPackage();
/*$signPackage['jsApiList'] = array('onMenuShareTimeline','onMenuShareAppMessage');
$signPackage['debug'] = false;*/
exit(json_encode(array('code'=>'200','result'=>$signPackage)));
?>
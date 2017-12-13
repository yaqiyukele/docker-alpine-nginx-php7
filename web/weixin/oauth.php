<?php 

include('class_weixin_adv.php');
var $appid = "wx80c487097b512789";
var $secret = "422d3a86338493d2f7b0e56507e5ac19";
$weixin=new class_weixin_adv($appid, $secret);
if (isset($_GET['code'])){
$url="https://api.weixin.qq.com/sns/oauth2/access_token?appid=appid&secret=secret&code=".$_GET['code']."&grant_type=authorization_code";
$res = $weixin->https_request($url);
print_r($res);die;
$res=(json_decode($res, true));
$row=$weixin->get_user_info($res['openid']);
if ($row['openid']) {
  //这里写上逻辑,存入cookie,数据库等操作
  cookie('weixin',$row['openid'],25920);
}else{
  $this->error('授权出错,请重新授权!');
}
}else{
echo "NO CODE";
}

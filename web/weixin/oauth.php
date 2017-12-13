<?php 
include('class_weixin_adv.php');
include('request.php');
$appid = "wx80c487097b512789";
$secret = "422d3a86338493d2f7b0e56507e5ac19";
$weixin=new class_weixin_adv($appid, $secret);
if (isset($_GET['code'])){
	$url="https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$appid."&secret=".$secret."&code=".$_GET['code']."&grant_type=authorization_code";
	$res = $weixin->https_request($url);
	$res=json_decode($res, true);
	$row=$weixin->get_user_info($res['openid']);
	if ($row['openid']) {
	  // 入库操作(连接数据库)
	  $mydabase=new DB("172.26.249.246","md","maida6868","zhoubao");
	  $sql = "INSERT INTO users (wx_openid,operation,nickname,headimgurl) VALUES (".$row['openid'].",".$row['operation'].",".$row['nickname'].",".$row['headimgurl'].")";
	  $result = $mydabase->actionsql($sql);
	  if ($result) {
	  	echo $result."1";
	  }else{
	  	echo 0;
	  }
	}else{
	  $this->error('授权出错,请重新授权!');
	}
}else{
	echo "NO CODE";
}
/*{"access_token":"4_yoUV9erbREDRuxOL-ZCAcDPOpMUlkDu7uh1uwFouQN52LHZctMgxWiTLzln7_M84se3K9tTSHAl5GMH19LfAaw","expires_in":7200,"refresh_token":"4_GhxklBbixUHq-yX6SdElNG7UB4gJxednygvat3ORWA4i_bL_XiTZoaTSV5YoXZLFfuJNG-18VoPO-68f_eP4rw","openid":"o_y2j1ag9a1pf97NAXCjyyn2Wv5A","scope":"snsapi_userinfo"}Array
(
    [access_token] => 4_yoUV9erbREDRuxOL-ZCAcDPOpMUlkDu7uh1uwFouQN52LHZctMgxWiTLzln7_M84se3K9tTSHAl5GMH19LfAaw
    [expires_in] => 7200
    [refresh_token] => 4_GhxklBbixUHq-yX6SdElNG7UB4gJxednygvat3ORWA4i_bL_XiTZoaTSV5YoXZLFfuJNG-18VoPO-68f_eP4rw
    [openid] => o_y2j1ag9a1pf97NAXCjyyn2Wv5A
    [scope] => snsapi_userinfo
)
Array
(
    [subscribe] => 1
    [openid] => o_y2j1ag9a1pf97NAXCjyyn2Wv5A
    [nickname] => 雅琪与可乐
    [sex] => 2
    [language] => zh_CN
    [city] => 
    [province] => 
    [country] => 安提瓜岛和巴布达
    [headimgurl] => http://wx.qlogo.cn/mmopen/A2ljRpaBXE0AbU3JpcLiay75J57WcFZniaCmiaCUx3rNnOuGXS4Hu4SwmSwuk31o9iacz4n5mrdjaYfc1iawdo5BCic46zGF7dSf0Z/0
    [subscribe_time] => 1512820516
    [remark] => 
    [groupid] => 0
    [tagid_list] => Array
        (
        )

)*/

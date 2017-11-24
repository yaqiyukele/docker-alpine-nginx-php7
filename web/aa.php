<?php 
include_once 'request.php';

/*$mydabase=new DB("172.26.249.246","md","maida6868","zhoubao");
// $mydabase=new DB("localhost","md","maida6868","zhoubao");


$sql = "SELECT access_token,expire_time_access_token,jsapi_ticket,expire_time_jsapi_ticket FROM cache";
$result = $mydabase->mysql_query_rest($sql); 
print_r($result);

$sql = "UPDATE cache SET access_token='uwCIQMi2DW1teKeeMfGimLrXrsTTgAkXipjIalYv334H6AutZnzt5A', expire_time_access_token=3333  WHERE id=1";
// echo $sql;die;
   // 修改后存入数据库
    $res = $mydabase->actionsql($sql);

    print_r($res);die;*/



// 将access_token 存入到数据库中，先查一下库里是否有access_token ,
      $mydabase=new DB("172.26.249.246","md","maida6868","zhoubao");
     // $mydabase=new DB("localhost","md","maida6868","zhoubao");      
      
      $sql = "SELECT access_token,expire_time_access_token,jsapi_ticket,expire_time_jsapi_ticket FROM cache";
      $result = $mydabase->mysql_query_rest($sql);

      if ($result['expire_time_access_token']  <  time()) {

          $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$this->appId."&secret=".$this->appSecret;
          $res = json_decode($this->httpGet($url));
          $access_token = $res->access_token;
          // echo $access_token;
          if ($access_token) {
            $arr['expire_time_access_token'] = time() + 7000;//
            $arr['access_token'] = $access_token;
            // 修改后存入数据库
            $sql = "UPDATE cache SET access_token='".$arr['access_token']."', expire_time_access_token=".$arr['expire_time_access_token']." WHERE id=1";
            // echo $sql;die;
           // 修改后存入数据库
            $res = $mydabase->actionsql($sql);
            if ($res==0) {
              echo "access_token修改出错";die;
            }
          }

      }else{

        $access_token = $result['access_token'];
      }

      return $access_token;

 ?>

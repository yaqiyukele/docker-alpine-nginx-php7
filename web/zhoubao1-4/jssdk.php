<?php
include 'request.php';

class JSSDK {
  private $appId;
  private $appSecret;
  private $url;
   
 
  public function __construct($appId, $appSecret,$url) {
    $this->appId = $appId;
    $this->appSecret = $appSecret;
    $this->url = $url;
  }
 
  public function getSignPackage() {
    $jsapiTicket = $this->getJsApiTicket();
    $url = $this->url;
 
    $timestamp = time();
    $nonceStr = $this->createNonceStr();
 
    // 这里参数的顺序要按照 key 值 ASCII 码升序排序
    $string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";
 
    $signature = sha1($string);
 
    $signPackage = array(
      "appId"     => $this->appId,
      "nonceStr"  => $nonceStr,
      "timestamp" => $timestamp,
      "url"       => $url,
      "signature" => $signature,
      "rawString" => $string
    );
    return $signPackage;
  }
 
  private function createNonceStr($length = 16) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $str = "";
    for ($i = 0; $i < $length; $i++) {
      $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
    }
    return $str;
  }

  private function getJsApiTicket() {

      // 将JsApiTicket 存入到数据库中
      // 先查一下库里是否有access_token ,
      $mydabase=new DB("172.26.249.246","md","maida6868","zhoubao");

      // $mydabase=new DB("localhost","md","maida6868","zhoubao");

      
      $sql = "SELECT access_token,expire_time_access_token,jsapi_ticket,expire_time_jsapi_ticket FROM cache";
      $result = $mydabase->mysql_query_rest($sql);  
      // print_r($result);die;

      if ($result['expire_time_jsapi_ticket'] <  time()) {

          $accessToken = $this->getAccessToken(); 
          $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=".$accessToken;
          $res = json_decode($this->httpGet($url));
          $ticket = $res->ticket;
          if ($ticket) {
            $arr['expire_time_jsapi_ticket'] = time() + 7000;//
            $arr['jsapi_ticket'] = $ticket;
            $sql = "UPDATE cache SET jsapi_ticket='".$arr['jsapi_ticket']."', expire_time_jsapi_ticket=".$arr['expire_time_jsapi_ticket']." WHERE id=1";
            // echo $sql;die;
           // 修改后存入数据库
            $res = $mydabase->actionsql($sql);

          }

      }else{

        $ticket = $result['jsapi_ticket'];
      }

      return $ticket;
  }


  private function getAccessToken() {
      // 将access_token 存入到数据库中，先查一下库里是否有access_token ,
      $mydabase=new DB("172.26.249.246","md","maida6868","zhoubao");
     // $mydabase=new DB("localhost","md","maida6868","zhoubao");      
      
      $sql = "SELECT access_token,expire_time_access_token,jsapi_ticket,expire_time_jsapi_ticket FROM cache";
      $result = $mydabase->mysql_query_rest($sql);

      if ($result['expire_time_access_token']  <  time()) {

          $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$this->appId."&secret=".$this->appSecret;
          $res = json_decode(file_get_contents($url));
          // return $res;
          $access_token = $res->access_token;
          if ($access_token) {
            $arr['expire_time_access_token'] = time() + 7000;//
            $arr['access_token'] = $access_token;
            // 修改后存入数据库
            $sql = "UPDATE cache SET access_token='".$arr['access_token']."', expire_time_access_token=".$arr['expire_time_access_token']." WHERE id=1";
            // echo $sql;die;
           // 修改后存入数据库
            $res = $mydabase->actionsql($sql);

          }

      }else{

        $access_token = $result['access_token'];
      }

      return $access_token;

    }

 
  private function httpGet($url) {

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_TIMEOUT, 500);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_URL, $url);
 
    $res = curl_exec($curl);
    curl_close($curl);
 
    return $res;

  }
  


}
<?php 
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
header("Content-type:text/html;charset=utf8");
/**
 * Index controller
 */
class HomeController extends Controller
{
	
	// 关闭csrf
	public $enableCsrfValidation = false;
	public $layout = false;

	// 进行第三方授权
	public function actionIndex(){

		$nonce = $this->rand(10);
		$timestamp = time();

		$client_id = "1106673362";
		$redirect_uri = "http://i2137.com/php/home/home";

		$url = "https://developers.e.qq.com/oauth/authorize?client_id=".$client_id."&redirect_uri=".$redirect_uri."&state=maida";
		// echo $url;die;
        return $this->render('index',array('url'=>$url));


	}

	public function actionHome(){
        /*$authorization_code = Yii::$app->request->get('authorization_code')?Yii::$app->request->get('authorization_code') : '';*/
        $authorization_code = Yii::$app->request->get('authorization_code');

        if (!empty($authorization_code)) {
            $file = 'test.txt';
            $result = $this->put_to_file($file,$authorization_code);
            print_r($result);
            $res = $this->get_to_file();
            print_r($res); 
        }

        if (!empty($res[0])) {
            $client_id = "1106673362";
            $client_secret = "k0m0gbJZj46nEFVU";
            $redirect_uri = "http://i2137.com/php/home/home";

            $url = "https://api.e.qq.com/oauth/token&client_id=".$client_id."&client_secret=".$client_secret."&grant_type=authorization_code&authorization_code=".$res[0]."&redirect_uri=".$redirect_uri;

            $result = $this->curl_request($url);
            print_r($result);die;

        }else{

            echo "获取不到authorization_code";

        }

            

	}

    function get_to_file(){
        $str = file_get_contents('test.txt');//将整个文件内容读入到一个字符串中
        $str_encoding = mb_convert_encoding($str, 'UTF-8', 'UTF-8,GBK,GB2312,BIG5');//转换字符集（编码）
        $arr = explode("\r\n", $str_encoding);//转换成数组

        //去除值中的空格
        foreach ($arr as &$row) {
            $row = trim($row);
        }

        unset($row);
        //得到后的数组
        return $arr;
    }
    

    //写入文件
    function put_to_file($file, $content) {
        $fopen = fopen($file, 'wb');
        if (!$fopen) {
            return false;
        }
        fwrite($fopen, $content);
        fclose($fopen);
        return true;
    }
    


	// 生成签名
	public function rand($len)
    {
        $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
        $string=time();
        for(;$len>=1;$len--)
        {
            $position=rand()%strlen($chars);
            $position2=rand()%strlen($string);
            $string=substr_replace($string,substr($chars,$position,1),$position2,0);
        }
        return $string;
    }



	// curl请求
	public  function curl_request($url,$post='',$cookie='', $returnCookie=0){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)');
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_AUTOREFERER, 1);
        curl_setopt($curl, CURLOPT_REFERER, "http://XXX");
        if($post) {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post));
        }
        if($cookie) {
            curl_setopt($curl, CURLOPT_COOKIE, $cookie);
        }
        curl_setopt($curl, CURLOPT_HEADER, $returnCookie);
        curl_setopt($curl, CURLOPT_TIMEOUT, 10);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($curl);
        if (curl_errno($curl)) {
            return curl_error($curl);
        }
        curl_close($curl);
        if($returnCookie){
            list($header, $body) = explode("\r\n\r\n", $data, 2);
            preg_match_all("/Set\-Cookie:([^;]*);/", $header, $matches);
            $info['cookie']  = substr($matches[1][0], 1);
            $info['content'] = $body;
            return $info;
        }else{
            return $data;
        }
	}




}


<?php 
/*$port = 3306;         //刚才输入的本地将要使用的端口
$userName = 'md';        //在服务器B上连接服务器Amysql，使用的mysql用户名
$passwd = 'maida6868';        //改用户名对应的密码
$con = new PDO("mysql:host=172.26.249.246:{$port}", $userName, $passwd);
if($con){
echo "success";die;
}*/
include 'database.class.php';
include 'test.class.php';

// $mydabase=new PDO($dsn, $user, $password);
// $mydabase=new PDOEE("172.26.249.246","md","maida6868","zhoubao");
$mydabase=new PDOEE();
$sql = "SELECT access_token,expire_time_access_token,jsapi_ticket,expire_time_jsapi_ticket FROM cache";
$result = $mydabase->mysql_query_rest($sql); 
print_r($result);


?>

<?php 
/*$port = 3306;         //刚才输入的本地将要使用的端口
$userName = 'md';        //在服务器B上连接服务器Amysql，使用的mysql用户名
$passwd = 'maida6868';        //改用户名对应的密码
$con = new PDO("mysql:host=172.26.249.246:{$port}", $userName, $passwd);
if($con){
echo "success";die;
}*/
include 'database.class.php';
echo 666666666;die;
include 'test.class.php';

$test = new Test();
$aa = $test->index();
print_r($aa);

$port = "13306";
$dsn = "mysql:dbname=zhoubao;host=localhost:{$port}";
$user = 'md';
$password = 'maida6868';

// $mydabase=new PDO($dsn, $user, $password);
// $mydabase=new PDOEE("172.26.249.246","md","maida6868","zhoubao");
$mydabase=new PDOEE();
$aa = $mydabase->aa();
print_r($aa);die;

$sql = "SELECT access_token,expire_time_access_token,jsapi_ticket,expire_time_jsapi_ticket FROM cache";
$result = $mydabase->mysql_query_rest($sql); 
print_r($result);


?>

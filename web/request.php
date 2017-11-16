<?php 
/*$port = 3306;         //刚才输入的本地将要使用的端口
$userName = 'md';        //在服务器B上连接服务器Amysql，使用的mysql用户名
$passwd = 'maida6868';        //改用户名对应的密码
$con = new PDO("mysql:host=172.26.249.246:{$port}", $userName, $passwd);
if($con){
echo "success";die;
}*/
include 'database.class.php';
$mydabase=new linkMysql("127.0.0.1","md","maida6868","zhoubao");
/*$sql = "SELECT access_token,expire_time_access_token,jsapi_ticket,expire_time_jsapi_ticket FROM cache";
$result = $mydabase->mysql_query_rest($sql); 
print_r($result);die;*/
$sql = "UPDATE cache SET access_token='9fQ9yCPJVA7IASWde9lb4k1_GYJauNIb02IHVqxrAdVgV5pweD3GKRVMZPFMHsMBFYLMgACABOP', expire_time_access_token='uwCIQMi2DW1teKeeMfGimLrXrsTTgAkXipjIalYv334H6AutZnzt5A' WHERE id=1";
// 修改后存入数据库
$res = $mydabase->actionsql($sql);
print_r($res);die;
?>
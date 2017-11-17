<?php 
include_once 'request.php';

// $mydabase=new DB("172.26.249.246","md","maida6868","zhoubao");
$mydabase=new DB("localhost","md","maida6868","zhoubao");


/*$sql = "SELECT access_token,expire_time_access_token,jsapi_ticket,expire_time_jsapi_ticket FROM cache";
$result = $mydabase->mysql_query_rest($sql); 
print_r($result);*/

$sql = "UPDATE cache SET access_token='uwCIQMi2DW1teKeeMfGimLrXrsTTgAkXipjIalYv334H6AutZnzt5A', expire_time_access_token=3333  WHERE id=1";
// echo $sql;die;
   // 修改后存入数据库
    $res = $mydabase->actionsql($sql);

    print_r($res);die;

 ?>
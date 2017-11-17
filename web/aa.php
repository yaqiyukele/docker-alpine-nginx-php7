<?php 
include_once 'request.php';

$mydabase=new DB("172.26.249.246","md","maida6868","zhoubao");

$sql = "SELECT access_token,expire_time_access_token,jsapi_ticket,expire_time_jsapi_ticket FROM cache";
$result = $mydabase->mysql_query_rest($sql); 
print_r($result);



 ?>
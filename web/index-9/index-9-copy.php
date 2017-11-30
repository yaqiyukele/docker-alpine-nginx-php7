<?php 
error_reporting(0);
define('IN_QY',true);
session_start();
include("./include/common.inc.php");
include("./include/pdo.class.php");
$mydabase=new DB("172.26.249.246","md","maida6868","zhoubao");
// $mydabase=new DB("127.0.0.1","root","root","zhoubao");

// 查询出最后一条的id
$sql1 = "SELECT * FROM essential_information WHERE weekly_newspaper_ctime=(SELECT MAX(weekly_newspaper_ctime) FROM essential_information)";
$result1=$mydabase->mysql_query_rest($sql1);
// print_r($result1);die;
// $_GET['essen_id']=12;
// 往主表中添加数据
$sql2 = "SELECT * FROM essential_information WHERE essen_id=".$_GET['essen_id'];
$result2 = $mydabase->mysql_query_rest($sql2);
$result2['essen_id'] = $result1['essen_id']+1;
$result2['weekly_newspaper_ctime'] = time();
$result2['weekly_newspaper_mtime'] = time();
$result3 = $mydabase->insert('essential_information',$result2);
// print_r($result3);die;
// 往关联表中添加数据
$sql4 = "SELECT relevance_id,title,content,page FROM content WHERE relevance_id=".$_GET['essen_id'];
$result4 = $mydabase->mysql_query_fetchAll($sql4);
// print_r($result4);die;
foreach ($result4 as $key => $value) {

	$result4[$key]['relevance_id'] = $result1['essen_id']+1;
	$result5 = $mydabase->insert('content',$result4[$key]);

}
// print_r($result5);die;

if ($result1&&$result3&&$result5) {
	// 如果复制成功则进入到复制的页面中来进行修改,同时把id传过去
	$url = "http://i2137.com/php/index-9/index-9-show.php?essen_id=".$result2['essen_id'];  
	header( "Location: $url" );
	

}


?>
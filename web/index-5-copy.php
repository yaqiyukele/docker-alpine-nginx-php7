<?php 
error_reporting(0);
define('IN_QY',true);
session_start();
require("include/common.inc.php");

$db=\ConnectMysqli::getIntance();
// 查询出最后一条的id
$sql1 = "SELECT * FROM essential_information WHERE weekly_newspaper_ctime=(SELECT MAX(weekly_newspaper_ctime) FROM essential_information)";
$result1=$db->getRow($sql1);


// 往主表中添加数据
$sql2 = "SELECT * FROM essential_information WHERE essen_id=".$_GET['essen_id'];
$result2 = $db->getRow($sql2);
$result2['essen_id'] = $result1['essen_id']+1;
$result2['weekly_newspaper_ctime'] = time();
$result2['weekly_newspaper_mtime'] = time();
$result3 = $db->insert('essential_information',$result2);


// 往关联表中添加数据
$sql4 = "SELECT relevance_id,title,content,page FROM content WHERE relevance_id=".$_GET['essen_id'];
$result4 = $db->getAll($sql4);
// $db->p($result4);
foreach ($result4 as $key => $value) {

	$result4[$key]['relevance_id'] = $result1['essen_id']+1;
	$result5 = $db->insert('content',$result4[$key]);

}


if ($result1&&$result3&&$result5) {
	// 如果复制成功则进入到复制的页面中来进行修改,同时把id传过去
	$url = "http://i2137.com/php/index-5-show.php?essen_id=".$result3;  
	header( "Location: $url" );

}


?>
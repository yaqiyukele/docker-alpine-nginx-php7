<?php 
define('IN_QY',true);
require("../include/common.inc.php");
include("../include/pdo.class.php");


// 接收大标题
$arr['pageT1']=$_POST['pageT1'];
$arr['pageT2']=$_POST['pageT2'];
$arr['pageT3']=$_POST['pageT3'];
$arr['pageT4']=$_POST['pageT4'];
$arr['pageT5']=$_POST['pageT5'];


//接收小标题内容
$arr['pageST2']=$_POST['pageST2'];
$arr['pageST3']=$_POST['pageST3'];
$arr['pageST4']=$_POST['pageST4'];

//接收各标题下的内容
$arr['pageC1']=$_POST['pageC1'];
$arr['pageC2']=$_POST['pageC2'];
$arr['pageC3']=$_POST['pageC3'];
$arr['pageC4']=$_POST['pageC4'];
$arr['pageC5']=$_POST['pageC5'];

// print_r($arr);die;
// 将正文内容中的字符串分割成数组
$pageC1_result = preg_replace("/[\s]+/is"," ",$arr['pageC1']);
$pageC1_res = explode(' ',$pageC1_result);
$result['pageC1'] = implode("@#$",$pageC1_res);


$pageC2_result = preg_replace("/[\s]+/is"," ",$arr['pageC2']);
$pageC2_res = explode(' ',$pageC2_result);
$pageC2_str = implode("@#$",$pageC2_res);
$result['pageC2']  = $arr['pageST2']."@#$%".$pageC2_str;


$pageC3_result = preg_replace("/[\s]+/is"," ",$arr['pageC3']);
$pageC3_res = explode(' ',$pageC3_result);
$pageC3_str = implode("@#$",$pageC3_res);
$result['pageC3']  = $arr['pageST3']."@#$%".$pageC3_str;


$pageC4_result = preg_replace("/[\s]+/is"," ",$arr['pageC4']);
$pageC4_res = explode(' ',$pageC4_result);
$pageC4_str = implode("@#$",$pageC4_res);
$result['pageC4']  = $arr['pageST4']."@#$%".$pageC4_str;


$pageC5_result = preg_replace("/[\s]+/is"," ",$arr['pageC5']);
$pageC5_res = explode(' ',$pageC5_result);
$result['pageC5'] = implode("@#$",$pageC5_res);

// 接受文章id
$infoid=$_POST['q_infoid'];
// print_r($result);die;

$mydabase=new DB("172.26.249.246","md","maida6868","zhoubao");
// $mydabase=new DB("127.0.0.1","root","root","zhoubao");

$WHERE1 = "relevance_id='".$infoid."' AND page=1";
$WHERE2 = "relevance_id='".$infoid."' AND page=2";
$WHERE3 = "relevance_id='".$infoid."' AND page=3";
$WHERE4 = "relevance_id='".$infoid."' AND page=4";
$WHERE5 = "relevance_id='".$infoid."' AND page=5";

$sql1 = "UPDATE content SET title='".$arr['pageT1']."' , content='".$result['pageC1']."' WHERE ".$WHERE1;
$sql2 = "UPDATE content SET title='".$arr['pageT2']."' , content='".$result['pageC2']."' WHERE ".$WHERE2;
$sql3 = "UPDATE content SET title='".$arr['pageT3']."' , content='".$result['pageC3']."' WHERE ".$WHERE3;
$sql4 = "UPDATE content SET title='".$arr['pageT4']."' , content='".$result['pageC4']."' WHERE ".$WHERE4;
$sql5 = "UPDATE content SET title='".$arr['pageT5']."' , content='".$result['pageC5']."' WHERE ".$WHERE5;


$res1 = $mydabase->actionsql($sql1);
$res2 = $mydabase->actionsql($sql2);
$res3 = $mydabase->actionsql($sql3);
$res4 = $mydabase->actionsql($sql4);
$res5 = $mydabase->actionsql($sql5);

exit(json_encode(array("code"=>200,"msg"=>"修改成功")));



?>

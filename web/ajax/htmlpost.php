<?php 
define('IN_QY',true);
require("../include/common.inc.php");

$arr['page0']=$_POST['page0'];
$arr['pageT1']=$_POST['pageT1'];
$arr['pageT2']=$_POST['pageT2'];
$arr['pageT3']=$_POST['pageT3'];
$arr['pageT4']=$_POST['pageT4'];
$arr['pageT5']=$_POST['pageT5'];
$arr['pageT6']=$_POST['pageT6'];
$arr['pageT7']=$_POST['pageT7'];
// $arr['pageT8']=$_POST['pageT8'];
$arr['pageST2']=$_POST['pageST2'];
$arr['pageST3']=$_POST['pageST3'];
$arr['pageST4']=$_POST['pageST4'];
$arr['pageST5']=$_POST['pageST5'];
$arr['pageST6']=$_POST['pageST6'];
$arr['pageC1']=$_POST['pageC1'];
$arr['pageC2']=$_POST['pageC2'];
$arr['pageC3']=$_POST['pageC3'];
$arr['pageC4']=$_POST['pageC4'];
$arr['pageC5']=$_POST['pageC5'];
$arr['pageC6']=$_POST['pageC6'];
$arr['pageC7']=$_POST['pageC7'];

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
$pageC5_str = implode("@#$",$pageC5_res);
$result['pageC5']  = $arr['pageST5']."@#$%".$pageC5_str;


$pageC6_result = preg_replace("/[\s]+/is"," ",$arr['pageC6']);
$pageC6_res = explode(' ',$pageC6_result);
$pageC6_str = implode("@#$",$pageC6_res);
$result['pageC6'] = $arr['pageST6']."@#$%".$pageC6_str;

$pageC7_result = preg_replace("/[\s]+/is"," ",$arr['pageC7']);
$pageC7_res = explode(' ',$pageC7_result);
$result['pageC7'] = implode("@#$",$pageC7_res);

// 接受文章id
$infoid=$_POST['q_infoid'];
// print_r($result);die;


// 修改文章标题




/*// 开始修改
$sql1 ="UPDATE content SET title='".$arr['pageT1']."', content='".$result['pageC1']."' WHERE relevance_id='".$infoid."' AND page=1"; 
$sql2 ="UPDATE content SET title='".$arr['pageT2']."', content='".$result['pageC2']."' WHERE relevance_id='".$infoid."' AND page=2"; 
$sql3 ="UPDATE content SET title='".$arr['pageT3']."', content='".$result['pageC3']."' WHERE relevance_id='".$infoid."' AND page=3"; 
$sql4 ="UPDATE content SET title='".$arr['pageT4']."', content='".$result['pageC4']."' WHERE relevance_id='".$infoid."' AND page=4"; 
$sql5 ="UPDATE content SET title='".$arr['pageT5']."', content='".$result['pageC5']."' WHERE relevance_id='".$infoid."' AND page=5"; 
$sql6 ="UPDATE content SET title='".$arr['pageT6']."', content='".$result['pageC6']."' WHERE relevance_id='".$infoid."' AND page=6"; 
echo $sql1;die;*/
$data0 = array('weekly_newspaper_date'=>$arr['page0']);
$data1 = array('title'=>$arr['pageT1'],'content'=>$result['pageC1']);
$data2 = array('title'=>$arr['pageT2'],'content'=>$result['pageC2']);
$data3 = array('title'=>$arr['pageT3'],'content'=>$result['pageC3']);
$data4 = array('title'=>$arr['pageT4'],'content'=>$result['pageC4']);
$data5 = array('title'=>$arr['pageT5'],'content'=>$result['pageC5']);
$data6 = array('title'=>$arr['pageT6'],'content'=>$result['pageC6']);
$data7 = array('title'=>$arr['pageT7'],'content'=>$result['pageC7']);



$WHERE0 = "essen_id='".$infoid."'";
$WHERE1 = "relevance_id='".$infoid."' AND page=1";
$WHERE2 = "relevance_id='".$infoid."' AND page=2";
$WHERE3 = "relevance_id='".$infoid."' AND page=3";
$WHERE4 = "relevance_id='".$infoid."' AND page=4";
$WHERE5 = "relevance_id='".$infoid."' AND page=5";
$WHERE6 = "relevance_id='".$infoid."' AND page=6";
$WHERE7 = "relevance_id='".$infoid."' AND page=7";


$db=\ConnectMysqli::getIntance();
$res0 = $db->update('essential_information',$data0,$WHERE0);
$res1 = $db->update('content',$data1,$WHERE1);
$res2 = $db->update('content',$data2,$WHERE2);
$res3 = $db->update('content',$data3,$WHERE3);
$res4 = $db->update('content',$data4,$WHERE4);
$res5 = $db->update('content',$data5,$WHERE5);
$res6 = $db->update('content',$data6,$WHERE6);
$res7 = $db->update('content',$data7,$WHERE7);


if($res0&$res1&$res2&$res3&$res4&$res5&$res6&$res7){
	
	header("Content-type:text/html;charset=utf-8");
	echo "<script>('编辑成功')</script>";exit;

}

//mysql_query("insert into test1(title,infoid) values ('".$title."',".$infoid)");


//file_put_contents('gyplog.txt',var_export($_POST,true));
//file_put_contents('gyplog.txt',$sql);

header("Content-type:text/html;charset=utf-8");
echo "编辑成功";exit;



//file_put_contents('gyplog.txt',"abc");
//file_put_contents('/data/wwwroot/web.weizhiru.com/ajax/gyplog.txt',var_export($_POST,true));
//不会终止程序的执行，会将每次获取的$_POST输出到当前目录的log.txt文件中


//echo 'save{{}}alert{}修改成功！'.$sql.'{}'.$aid.'|'.$ad_type.'|'.$ad_flowtype.'{{}}ok';
//echo 'save{{}}alert{}修改成功！';
//echo "<script type='text/javascript'>alert('".$sql."');</script>";
?>

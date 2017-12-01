<?php 
// error_reporting(0);
define('IN_QY',true);
session_start();
include("./include/common.inc.php");
include("./include/pdo.class.php");
$mydabase=new DB("172.26.249.246","md","maida6868","zhoubao");
// $mydabase=new DB("127.0.0.1","root","root","zhoubao");
$sql = "SELECT weekly_newspaper_date, essen_id FROM essential_information WHERE weekly_newspaper_type=3";
$result=$mydabase->mysql_query_fetchAll($sql);

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>列表页</title>
</head>
<body>
<?php  foreach ($result as $key => $value) { ?>
	<?=$value['weekly_newspaper_date']?><a href="index-9-copy.php?essen_id=<?=$value['essen_id'] ?>">复制</a><br>
<?php }?>


</body>
</html>
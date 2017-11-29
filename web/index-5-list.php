<?php 
error_reporting(0);
define('IN_QY',true);
session_start();
require("include/common.inc.php");
$db=\ConnectMysqli::getIntance();
$sql = "SELECT weekly_newspaper_date, essen_id FROM essential_information WHERE weekly_newspaper_type=1";
$result=$db->getAll($sql);
// $db->p($result);


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
	<?=$value['weekly_newspaper_date']?><a href="index-5-copy.php?essen_id=<?=$value['essen_id'] ?>">复制</a><br>
<?php }?>


</body>
</html>
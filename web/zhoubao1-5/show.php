<?php 
// error_reporting(0);
define('IN_QY',true);
session_start();

include("./include/common.inc.php");
include("./include/pdo.class.php");

// $mydabase=new DB("172.26.249.246","md","maida6868","zhoubao");
$mydabase=new DB("127.0.0.1","root","root","zhoubao");

 if (empty($_GET['essen_id'])) {
   $sql = "SELECT * FROM essential_information WHERE weekly_newspaper_ctime=(SELECT MAX(weekly_newspaper_ctime) FROM  essential_information WHERE weekly_newspaper_type=1)";
   $result=$mydabase->mysql_query_rest($sql);
}else{
    $sql = "SELECT * FROM essential_information WHERE essen_id=".$_GET['essen_id'];
    $result=$mydabase->mysql_query_rest($sql);
}

// print_r($result);die;
$sql = "SELECT * FROM content WHERE relevance_id=".$result['essen_id'];
$res=$mydabase->mysql_query_fetchAll($sql);
// print_r($res);die;
// 循环处理数组
foreach ($res as $key => $value) {
     // 键值为0的是正文第一页的内容
    $Title0 = $res[0]['title'];
    $Content0 = explode('@#$',$res[0]['content']);
    $page0 = $res[0]['page'];

    // 键值为1的是分项进展总结的第一条
    $Title2 = $res[1]['title'];
    $Content2 = explode('@#$%', $res[1]['content']);
    // print_r($Content2);die; 
    $Title2_1 = $Content2[0];
    $Content2_1 = explode('@#$', $Content2[1]);
    $page2 = $res[1]['page'];
    // print_r($Content2_1);die;

    // 键值为2的是分项进展总结的第二条
    $Title3 = $res[2]['title'];
    $Content3 = explode('@#$%', $res[2]['content']);
    // print_r($Content3);die;
    $Title3_1 = $Content3[0];
    $Content3_1 = explode('@#$', $Content3[1]);
    $page3 = $res[2]['page'];
    // print_r($Content3_1);die;


    // 键值为3的是分项进展总结的第三条
    $Title4 = $res[3]['title'];
    $Content4 = explode('@#$%', $res[3]['content']);
    // print_r($Content4);die;
    $Title4_1 = $Content4[0];
    $Content4_1 = explode('@#$', $Content4[1]);
    $page4 = $res[3]['page'];
    
}
// print_r($res);die;
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>麦达数字技术部工作周报</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0,user-scalable=no">

    <script src="js/flexible_css.js"></script>
    <script src="js/flexible.js"></script>

    <link rel="stylesheet" href="css/normalize.min.css">
    <link rel="stylesheet" href="css/page/index.css">
</head>
<body>
    <div class="containers">
        <div class="page page-home" id="page0">
            <!--首页-->
            <img src="http://i2137.com/php/zhoubao1-5/images/edit.jpg" style="float: right;width: 10%;height: 10%;margin:0 auto;">
        </div>
        <div class="page" id="page1">
            <div class="title">
                <div class="title-content">
                    <span class="title-1"></span>
                    <h3><?=$Title0;?></h3>
                    <p class="title-line"></p>
                </div>
            </div>
            <div class="list-border">
                <p></p>
                <ul class="part">
                    <?php for ($i=0; $i <count($Content0); $i++) { ?>
                        <li><?=$Content0[$i];?></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div class="page" id="page2">
            <div class="title">
                <div class="title-content">
                    <span class="title-2"></span><h3><?=$Title2;?></h3><p class="title-line"></p>
                </div>
            </div>
            <div class="list-border">
                <h4><?=$Title2_1;?></h4>
                <ul class="small">
                    <?php for ($i=0; $i <count($Content2_1); $i++) { ?>
                        <li><?=$Content2_1[$i];?></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div class="page" id="page3"> 
            <div class="title">
                <div class="title-content">
                    <span class="title-2"></span>
                    <h3><?=$Title3;?></h3>
                    <p class="title-line"></p>
                </div>
            </div>
            <div class="list-border">
                <h4><?=$Title3_1;?></h4>
                <ul class="small">
                    <?php for ($i=0; $i <count($Content3_1); $i++) { ?>
                        <li><?=$Content3_1[$i];?></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div class="page" id="page4">
            <div class="title">
                <div class="title-content">
                    <span class="title-2"></span>
                    <h3><?=$Title4;?></h3>
                    <p class="title-line"></p>
                </div>
            </div>
            <div class="list-border">
                <h4><?=$Title4_1;?></h4>
                <ul class="small">
                    <?php for ($i=0; $i <count($Content4_1); $i++) { ?>
                        <li><?=$Content4_1[$i];?></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div class="page" id="page5">
            <div class="title">
                <div class="title-content">
                    <span class="title-3"></span><h3>团队人员情况</h3><p class="title-line"></p>
                </div>
            </div>
            <div class="list">
                <ul>
                    <li><span class="list-icon"></span><p>目前在职：<span>14</span>人</p></li>
                    <li><span class="list-icon"></span><p>本周入职：<span>1</span>人</p></li>
                    <li><span class="list-icon"></span><p>本周面试：<span>10</span>人</p></li>
                    <li><span class="list-icon"></span><p>人员缺口：算法和数据、爬虫采集、前端开发</p></li>
                </ul>
            </div>
        </div>
        <div class="page" id="page6">
            <div class="title">
                <div class="title-content">
                    <span class="title-4"></span><h3>总体阶段进展</h3><p class="title-line"></p>
                </div>
            </div>
            <div class="progress"></div>
            <div class="charts" style="height: 7.8rem;">
                <div class="chart-title">整体阶段进展</div>
                <div class="chart" id="chart-total" style="width: 9.6rem;height: 6.8rem;"></div>
            </div>
        </div>
        <div class="page" id="page7">
            <div class="title">
                <div class="title-content">
                    <span class="title-5"></span><h3>关键子项目进展</h3><p class="title-line"></p>
                </div>
            </div>
            <div class="images">
                <p><span class="icon"></span>EC数据和模型合作项目</p>
                <img src="temp/1.png">
            </div>
            <div class="images">
                <p><span class="icon"></span>营销线索平台迭代</p>
                <img src="temp/2.png">
            </div>
        </div>
    </div>
    <!--script-->
    <script src="js/jquery-1.11.3.min.js"></script>
    <script src="js/islider.min.js"></script>
    <script src="js/echarts.min.js"></script>
    <script src="js/echarts-map-china.min.js"></script>
    <script src="js/page/index.js"></script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script type="text/javascript">
        $.ajax({
                type: 'POST',
                url:'http://i2137.com/php/zhoubao1-4/sign.php',
                data:{
                     'url': window.location.href.split('#')[0]
                },
                dataType: 'json',
                success: function(data){ 
                    // 获取信息成功
                    console.log(data)
                     wx.config({
                        debug: false,
                        appId: data.result.appId,
                        timestamp: data.result.timestamp,
                        nonceStr: data.result.nonceStr,
                        signature: data.result.signature,
                        jsApiList: [
                            // 所有要调用的 API 都要加到这个列表中
                            'checkJsApi',
                            'onMenuShareTimeline',
                            'onMenuShareAppMessage',
                            'onMenuShareQQ'
                        ]
                    });

                window.share_config = {
                        "share": {
                            "imgUrl": "http://i2137.com/php/zhoubao1-6/images/share.jpg",//分享图，默认当相对路径处理，所以使用绝对路径的的话，“http://”协议  前缀必须在。
                            "desc" : "麦达数字技术部2018年1月第四周工作周报",//摘要,如果分享到朋友圈的话，不显示摘要。
                            "title" : '麦达数字技术部工作周报',//分享卡片标题
                            "link": window.location.href,//分享出去后的链接，这里可以将链接设置为另一个页面。
                            "success":function(){//分享成功后的回调函数
                                // alert('已分享');
                            },
                            'cancel': function () { 
                                // 用户取消分享后执行的回调函数
                                // alerat('已取消');
                            }
                        }
                    };  
                    wx.ready(function () {
                            wx.onMenuShareAppMessage(share_config.share);//分享给好友
                            wx.onMenuShareTimeline(share_config.share);//分享到朋友圈
                            wx.onMenuShareQQ(share_config.share);//分享给手机QQ
                    });
                    wx.error(function(res){
                        // config信息验证失败会执行error函数，如签名过期导致验证失败，
                        // 具体错误信息可以打开config的debug模式查看，也可以在返回的res参数中查看，
                        //对于SPA可以在这里更新签名。
                        // alert("好像出错了！！");
                        // alert("errorMSG:"+res);
                        // console.log(res);                    
                    });

                    
                },
                error: function(xhr){
                    alert("请求失败，请联系管理员")
                   // console.log(xhr);
                }
            });
    </script>
    <script type="text/javascript">
        $("#page0 img").bind("click",function(){
            // alert(1111);
           window.location.href="index.php?essen_id=<?php echo $result['essen_id'];?>";
        })
    </script>

</body>
</html>

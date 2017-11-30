<?php
// error_reporting(0);
define('IN_QY',true);
session_start();

include("./include/common.inc.php");
include("./include/pdo.class.php");

$mydabase=new DB("172.26.249.246","md","maida6868","zhoubao");
// $mydabase=new DB("127.0.0.1","root","root","zhoubao");
$sql = "SELECT * FROM essential_information WHERE weekly_newspaper_ctime=(SELECT MAX(weekly_newspaper_ctime) FROM essential_information WHERE weekly_newspaper_type=1)";
$result=$mydabase->mysql_query_rest($sql);
// print_r($result);die;
$sql = "SELECT * FROM content WHERE relevance_id=".$result['essen_id'];
$res=$mydabase->mysql_query_fetchAll($sql);
// print_r($res);die;
// 循环处理数组
foreach ($res as $key => $value) {
    // 键值为0的是正文第一页的内容
    $Title1 = $res[0]['title'];
    $Content1 = explode('@#$',$res[0]['content']);
    $page1 = $res[0]['page'];
    // print_r($Content1);die;

    // 键值为1的是分项进展总结的第一条
    $Title2 = $res[1]['title'];
    $Content2 = explode('@#$%',$res[1]['content']);
    // print_r($Content2);die;
    $Title2_1 = $Content2[0];
    $Content2_1 = explode('@#$', $Content2[1]);
    $page2 = $res[1]['page'];
    // print_r($content2_1);die;

    // 键值为2的是分项进展总结的第二条
    $Title3 = $res[2]['title'];
    $Content3 = explode('@#$%',$res[2]['content']);
    // print_r($Content3);die;
    $Title3_1 = $Content3[0];
    $Content3_1 = explode('@#$', $Content3[1]);
    $page3 = $res[2]['page'];
    // print_r($content2_1);die;


    // 键值为3的是分项进展总结的第三条
    $Title4 = $res[3]['title'];
    $Content4 = explode('@#$%',$res[3]['content']);
    // print_r($Content3);die;
    $Title4_1 = $Content4[0];
    $Content4_1 = explode('@#$', $Content4[1]);
    $page4 = $res[3]['page'];
    // print_r($content2_1);die;



    // 键值为4的是分项进展总结的第四条
    $Title5 = $res[4]['title'];
    $Content5 = explode('@#$%',$res[4]['content']);
    // print_r($Content3);die;
    $Title5_1 = $Content5[0];
    $Content5_1 = explode('@#$', $Content5[1]);
    $page5 = $res[4]['page'];
    // print_r($content2_1);die;


    // 键值为5的是分项进展总结的第五条
    $Title6 = $res[5]['title'];
    $Content6 = explode('@#$%',$res[5]['content']);
    // print_r($Content6);die;
    $Title6_1 = $Content6[0];
    $content6_1 = $Content6[1];
    $page6 = $res[5]['page'];


    // 键值为6的是团队情况
    $Title7 = $res[6]['title'];
    $Content7 = explode('@#$',$res[6]['content']);
    $page7 = $res[6]['page'];


    // 键值为7的是分项进展总结的第八条
    // $Title8 = $res[7]['title'];


}
// $db->p($res);
// die;
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>麦达数字技术部工作周报</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0,user-scalable=no" name="viewport" id="viewport" />
    <link rel="stylesheet" href="css/normalize.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/page/index-7.css">
    <!--javascript-->
    <script src="js/jquery-1.11.3.min.js"></script>
    <script src="libs/echarts/echarts.min.js"></script>

    <script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script src="js/wx/sha1.js"></script>

    <script type="text/javascript">
    $.ajax({
            type: 'POST',
            // url: 'http://127.0.0.1/share/index.php',
            url:'http://i2137.com/php/sign.php',
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
                        "imgUrl": "http://i2137.com/php/progress-2.png",//分享图，默认当相对路径处理，所以使用绝对路径的的话，“http://”协议  前缀必须在。
                        "desc" : "麦达数字技术部2017年11月第三周工作周报",//摘要,如果分享到朋友圈的话，不显示摘要。
                        "title" : '麦达数字技术部工作周报',//分享卡片标题
                        "link": window.location.href,//分享出去后的链接，这里可以将链接设置为另一个页面。
                        "success":function(){//分享成功后的回调函数
                            alert('已分享');
                        },
                        'cancel': function () { 
                            // 用户取消分享后执行的回调函数
                            alert('已取消');
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
                    alert("好像出错了！！");
                    alert("errorMSG:"+res);
                    // console.log(res);                    
                });

                
            },
            error: function(xhr){
                alert("请求失败，请联系管理员")
               // console.log(xhr);
            }
        });
</script>

</head>
<body onmousewheel="return false;">
    <div class="container">
        <!--首页-->
        <div class="page page0 cur" id="page0">
            <!--<button type="button" onclick="GetInitInfo()">获取基本信息</button>-->
            <img src="http://i2137.com/php/images/edit.jpg" style="float: right;width: 10%;height: 10%;margin:0 auto;">
        </div>
        <div class="page page1 group" id="page1">
            <div class="title title1">
                 <h3><?=$Title1; ?></h3>
            </div>
            <div class="info">
                <div class="part" style="padding-left: 0.5em;padding-right: 0.5em;">
                    <ul class="small">
                        <?php  for ($i=0; $i < count($Content1) ; $i++) {  ?>
                        
                            <li><?=$Content1[$i]; ?></li>
                        
                        <?php  } ?>
                        <!-- <li>1）和EC合作项目，本周就EC侧数据提供达成一致意见，初步算法选型已经确定，为后续项目迅速开展数据保障方面更进了一步，并和恺思睿思在爬虫和EC外围工具开发等方面做了深入交流；</li>
                        <li>2）营销DB的线索数据优化工作，销售工作强度、工作效率、数据质量等指标baseline已经初步制定，并已经通过服务接口导入一批线索数据给销售部试用，并将自动收集EC销售工作数据和跟踪指标验证；</li>
                        <li>3）投资DB，本周重点还是对国内外投融资相关产品及网站进行分析调研，并对数据进行分析和业务属性总结；</li>
                        <li>4）平台研发工作第一阶段已基本完成，由于功能需求的调整，剩营销数据检索功能在进行这阶段最后一些适配开发，其他部分第二阶段已经开始；</li> -->
                    </ul>
                </div>
            </div>
        </div>
        <div class="page page2 group" id="page2">
            <div class="title title2">
                <h3><?=$Title2;?></h3>
            </div>
            <div class="info">
                <div class="part">
                    <h4 id="title"><?=$Title2_1;?></h4>
                    <ul class="small">
                        <?php  for ($i=0; $i < count($Content2_1) ; $i++) {  ?>
                        
                            <li><?=$Content2_1[$i]; ?></li>
                        
                        <?php  } ?>
                       <!--  <li>1）与EC高明对营销线索建模相关事宜进行沟通，熟悉EC数据库结构，分析其中与建模相关的数据特征；</li>
                        <li>2）对营销建模工作进行时间计划安排，并对资源和人员需求进行规划；</li>
                        <li>3）标的数据库，对企业、投资机构、融资历史数据、投资人等相关数据进行详细分析和业务属性总结，并继续对国内外投融资相关产品及网站进行调研；</li>
                        <li>4）以销售团队6、7月的营销数据为基准，对工作强度、工作效率、数据质量等指标baseline进行分析总结，为后续评估体系提供参考标准；</li> -->
                    </ul>
                </div>
            </div>
        </div>
        <div class="page page2 group" id="page3">
            <div class="title title2">
                <h3><?=$Title3;?></h3>
            </div>
            <div class="info">
                <div class="part">
                    <h4 id="title"><?=$Title3_1?></h4>
                    <ul class="small">
                        <?php  for ($i=0; $i < count($Content3_1) ; $i++) {  ?>
                        
                            <li><?=$Content3_1[$i]; ?></li>
                        
                        <?php  } ?>
                        <!-- <li>1）爬虫系统平台优化，包括调整任务生成器，简化生成任务配置，自动化生成全量数据采集；入库模块系统BUG处理和优化；</li>
                        <li>2）增加数据加工服务，将数据收集的销售线索进行加工编码后提供给ec导入接口；</li>
                        <li>3）拓展EC营销线索收集数据源，包括智联和前程无忧，并修复58非首页链接指向首页导致的无限循环bug；</li>
                        <li>4）标的数据，企查查网站信息抓取和解析， 离线自动重复处理失败任务实现,已经抓取2w个公司。对企业ICP备案网站进行抓取解析；</li> -->
                    </ul>
                </div>
            </div>
        </div>
        <div class="page page2 group" id="page4">
            <div class="title title2">
               <h3><?= $Title4;?></h3>
            </div>
            <div class="info">
                <div class="part">
                   <h4 id="title"><?=$Title4_1?></h4>
                    <ul class="small">
                        <?php  for ($i=0; $i < count($Content4_1) ; $i++) {  ?>
                        
                            <li><?=$Content4_1[$i]; ?></li>
                        
                        <?php  } ?>
                        <!-- <li>1）营销服务中心，EC线索检索系统相关业务需求，已完成如下:<br>
                              a）公司信息各条件组合查询<br>
                              b）和EC系统通信的网络请求模块及token、推送、获取公司信息等功能<br>
                              c）项目全局日志<br>
                              d）项目全局异常处理<br>
                              e）用户登录、权限控制、菜单管理、添加客户信息（50%）</li>
                        <li>2）为长远平台高可用和可扩展性等方面规划需要，服务层平台采用docker容器技术和微服务架构融合，需要将目前阿里云服务器升级最新操作系统镜像，计划下周实施；</li> -->
                    </ul>
                </div>
            </div>
        </div>
        <div class="page page2 group" id="page5">
            <div class="title title2">
                <h3><?=$Title5?></h3>
            </div>
            <div class="info">
                <div class="part">
                    <h4 id="title"><?=$Title5_1?></h4>
                    <ul class="small">
                        <?php  for ($i=0; $i < count($Content5_1) ; $i++) {  ?>
                        
                            <li><?=$Content5_1[$i]; ?></li>
                        
                        <?php  } ?>
                       <!--  <li>1）完成营销线索平台个人\团队\组织的营销数据统计、销售经理和企业管理者两个角色的首页、系统爬取数据统计等功能的原型图设计；</li>
                        <li>2）按照功能详细梳理了营销线索平台功能开发的优先级，与UI设计和后台服务层沟通开发接口等内容，并讨论商定了第一阶段和第二阶段的开发时间和任务分工；</li>
                        <li>3）准备营销线索平台前端开发的相关内容；</li>
                        <li>4）完成了营销线索平台第一阶段登录页的两个版本的设计，并构思了整体设计效果，理清了相关业务流程，准备后续的页面设计等内容；</li> -->
                    </ul>
                </div>
            </div>
        </div>
        <div class="page page2 group" id="page6">
            <div class="title title2">
                <h3><?=$Title6?></h3>
            </div>
            <div class="info">
                <div class="part">
                    <h4 id="title"><?=$Title6_1?></h4>
                    <img src="http://127.0.0.1/zhoubao_test/upload/<?php echo $content6_1 ;?>" alt="web-login" style="width: 90%;display: block;margin: 0 auto;">
                    <div class="img-info">营销线索平台登录页UI设计</div>
                </div>
            </div>
        </div>
        <div class="page page3 group" id="page7">
            <div class="title title3">
                <h3><?=$Title7?></h3>
            </div>
            <div class="table">
                <ul class="small">
                    <?php  for ($i=0; $i < count($Content7) ; $i++) {  ?>
                        
                            <li><?=$Content7[$i]; ?></li>
                        
                    <?php  } ?>
                    <!-- <li>目前在职:<span>8</span>人</li>
                    <li>计划入职:<span>4</span>人</li>
                    <li>本周面试:<span>10</span>人</li>
                    <li>本周离职：<span>1</span>人</li>
                    <li>人员缺口:数据分析工程师、python爬虫、JAVA开发</li> -->
                </ul>
            </div>
        </div>
        <div class="page page4 group" id="page8">
            <div class="title title4">
                <h3>研发进展情况</h3>
            </div>
            <div class="my-progress">
                <img src="temp/progress-2.png">
                <p class="img-info">整体阶段进展</p>
            </div>
            <div class="charts" id="chart-2"></div>
            <p class="img-info">一阶段计划进展</p>
        </div>
    </div>
    <script src="js/jquery.touchSwipe.min.js"></script>
    <script src="js/page/index-7.js"></script>
    <script src="js/page/index-7-echarts-config.js"></script>
    <script type="text/javascript">
        $("#page0 img").bind("click",function(){
           window.location.href='index-7.php?essen_id=<?php echo $result['essen_id'];?>';
        })
    </script>
</body>
</html>
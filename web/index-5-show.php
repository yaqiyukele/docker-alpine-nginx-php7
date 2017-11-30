<?php
error_reporting(0);
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
    $page1 = $res['page'];
    // print_r($Content1);die;

    // 键值为1的是分项进展总结的第一条
    $Title2 = $res[1]['title'];
    $Content2 = explode('@#$%',$res[1]['content']);
    // print_r($Content2);die;
    $Title2_1 = $Content2[0];
    $Content2_1 = explode('@#$', $Content2[1]);
    $page2 = $res['page'];
    // print_r($content2_1);die;

    // 键值为2的是分项进展总结的第二条
    $Title3 = $res[2]['title'];
    $Content3 = explode('@#$%',$res[2]['content']);
    // print_r($Content3);die;
    $Title3_1 = $Content3[0];
    $Content3_1 = explode('@#$', $Content3[1]);
    $page3 = $res['page'];
    // print_r($content2_1);die;


    // 键值为3的是分项进展总结的第三条
    $Title4 = $res[3]['title'];
    $Content4 = explode('@#$%',$res[3]['content']);
    // print_r($Content3);die;
    $Title4_1 = $Content4[0];
    $Content4_1 = explode('@#$', $Content4[1]);
    $page4 = $res['page'];
    // print_r($content2_1);die;



    // 键值为4的是分项进展总结的第四条
    $Title5 = $res[4]['title'];
    $Content5 = explode('@#$%',$res[4]['content']);
    // print_r($Content3);die;
    $Title5_1 = $Content5[0];
    $Content5_1 = explode('@#$', $Content5[1]);
    $page5 = $res['page'];
    // print_r($content2_1);die;


    // 键值为5的是分项进展总结的第五条
    $Title6 = $res[5]['title'];
    $Content6 = explode('@#$%',$res[5]['content']);
    // print_r($Content6);die;
    $Title6_1 = $Content6[0];
    $content6_1 = $Content6[1];
    $page6 = $res['page'];


    // 键值为6的是团队情况
    $Title7 = $res[6]['title'];
    $Content7 = explode('@#$',$res[6]['content']);
    $page7 = $res['page'];


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
    <link rel="stylesheet" href="css/page/index-5.css">
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
            <a href="" style="float: right;width: 10%;height: 10%;margin:0 auto;">编辑</a>
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
                        <!-- <li>一，确定和EC关于数据合作的基本意向，这为实现麦达SaaS的核心价值奠定基础，可完成8000万家企业画像的积累，并可以基于该数据，将来与其他类似EC的产品公司的展开合作；</li>
                        <li>二，开始了投资DB的确定，包括数据源爬虫、数据模型以及分析特征值等，并以IT桔子进行了的测试验证，为下一步的深入分析打下基础；</li>
                        <li>三，营销DB的线索数据，经过销售团队使用并对结果跟踪分析后，发现缺乏量化指数，于是完成可持续的量化方案，并讨论后基于反馈开始相关优化工作；</li>
                        <li>四，对机器学习、情感分析以及微服务架构等专题开展学习和研究，进行技术积累。</li> -->
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
                        <!-- <li>1）对IT橘子的标的数据进行分析，并调整标的评估模型的五力的特征字段；</li>
                        <li>2）对IT橘子的y值针对有融资记录的标的，根据融资次数、融资总额、最后融资轮次等维度进行计算，得到y值的连续值；</li>
                        <li>3）对新闻舆情的情感分析，使用波森语料库，建立了情感字典的极性值分析模型，可以实现对一篇新闻的正负情感进行分类。当前代码已完成，尚需进行样本的实际验证，以获得模型的准确率；</li>
                        <li>4）营销线索模型的建模工作：当前开始整理己方所有的数据，并细化各模块工作任务（可拆解并分配给执行人），规划工作的时间计划；</li> -->
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
                        <!-- <li>1）进行it桔子相关数据检索和抓取，包括公司详情页67341个、公司雷达页67215个、公司投资页面67518个、公司成员页面67501个；</li>
                        <li>2）完成公司和机构详情相关信息解析和入库：<br>
                            --公司详情信息包括：投资信息、成员信息、竞品信息、新闻信息、里程碑信息、对外投资、产品信息、工商信息、股东信息、备案信息等；<br>
                            --机构详情信息包括：机构基本信息、机构成员、机构投资信息、机构新闻；
                        </li>
                        <li>3）爬虫系统配置化工程完成并试运行，增加异常处理以解决起始页下载失败后任务中断问题；</li>
                        <li>4）根据营销线索客户画像总结信息，进行数据模型补充完善，并对相关维度信息进行抓取策略规划，增加爬取来源以充实数据库；</li>
                    </ul> -->
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
                       <!--  <li>1）完善了基于SpringCloud的微服务架构结构图：<a href="https://www.processon.com/view/link/59d8652fe4b0ef561378a1ee">点击查看详情</a> ；</li>
                        <li>2）实现了几个微服务单组件的技术准备，并实现了DEMO，包括：<br>
                            （a）springboot多数据源使用；<br>
                            （b）根据数据库表生成相应的model类，基于hibernate；<br>
                            （c）深入研究了eureka服务注册中心，并配置了eureka服务中心集群；eureka服务端单点宕机后，其他节点继续提供服务；监听各服务状态，客户端宕机后，eureka发出邮件提醒；eureka服务端全部宕机后，客户端维持最后一次服务发现的状态继续工作；<br>
                            （d）邮件服务的demo；
                        </li>
                        <li>3）完成EC提供的API接口的验证调试，对调用相关接口的公共方法和导入客户数据功能进行开发；</li> -->
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
                       <!--  <li>1）完成前台登录、首页、数据检索及后台接口等的调测，进行营销线索平台推送信息统计接口对接；</li>
                        <li>2）研究微信公众号JSSDK开发，准备后续微信端产品功能开发事宜；成功调通了微信分享接口的相关开发内容；</li>
                        <li>3）细分了营销线索平台的使用角色，初步分为系统管理员、企业管理者、销售经理及普通销售人员四种角色，并根据不同角色细化角色的权限及功能情况；</li> -->
                    </ul>
                </div>
            </div>
        </div>
        <div class="page page3 group" id="page6">
            <div class="title title3">
                <h3><?=$Title7?></h3>
            </div>
            <div class="table">
                <ul class="small">
                    <?php  for ($i=0; $i < count($Content7) ; $i++) {  ?>
                        
                            <li><?=$Content7[$i]; ?></li>
                        
                    <?php  } ?>
                    <!-- <li>目前在职:<span>9</span>人</li>
                    <li>本周面试:<span>6</span>人</li>
                    <li>待入职:<span>0</span>人</li>
                    <li>阶段人员缺口:<span>3</span>人</li> -->
                </ul>
                <table>
                    <thead>
                    <tr>
                        <td style="width: 18%;">人员</td><td style="width: 18%;">角色</td><td style="width:22%;">营销数据库</td><td style="width: 22%;">标的数据库</td><td style="width: 20%;">营销工具</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>1人</td><td>数据科学家</td><td>✔</td><td>✔</td><td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>1人</td><td>PHP/前端</td><td>✔</td><td>✔</td><td>✔</td>
                    </tr>
                    <tr>
                        <td>1人</td><td>PYTHON爬虫</td><td>✔</td><td>✔</td><td>&nbsp;</td>
                    </tr>
                    </tbody>
                </table>
                <p class="img-info">人员招聘计划</p>
            </div>
        </div>
        <div class="page page4 group" id="page7">
            <div class="title title4">
                <h3>研发进展情况</h3>
            </div>
            <div class="my-progress">
                <img src="temp/progress.png">
                <p class="img-info">整体阶段进展</p>
            </div>
            <div class="charts" id="chart-2"></div>
            <p class="img-info">一阶段计划进展</p>
        </div>
    </div>
    <script src="js/jquery.touchSwipe.min.js"></script>
    <script src="js/page/index-5.js"></script>
    <script src="js/page/index-5-echarts-config.js"></script>
    <script type="text/javascript">
        $("#page0 img").bind("click",function(){
           window.location.href='index-5.php?essen_id=<?php echo $essen_id;?>';
        })
    </script>
</body>
</html>
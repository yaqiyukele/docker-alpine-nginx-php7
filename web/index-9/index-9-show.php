<?php
// error_reporting(0);
define('IN_QY',true);
session_start();

include("./include/common.inc.php");
include("./include/pdo.class.php");

$mydabase=new DB("172.26.249.246","md","maida6868","zhoubao");
// $mydabase=new DB("127.0.0.1","root","root","zhoubao");
if (empty($_GET)) {
   $sql = "SELECT * FROM essential_information WHERE weekly_newspaper_ctime=(SELECT MAX(weekly_newspaper_ctime) FROM essential_information WHERE weekly_newspaper_type=3)";
   $result=$mydabase->mysql_query_rest($sql);
}else{
    $sql = "SELECT * FROM essential_information WHERE essen_id=".$_GET['essen_id'];
    $result=$mydabase->mysql_query_rest($sql);
}

// print_r($result);die;
$sql = "SELECT * FROM content WHERE relevance_id=".$result['essen_id']." ORDER BY page";
$res=$mydabase->mysql_query_fetchAll($sql);
// print_r($res);die;
foreach ($res as $key => $value) {
    // 键值为0的是正文第一页的内容
    $Title1 = $res[0]['title'];
    $Content1 = explode('@#$',$res[0]['content']);
    $page1 = $res[0]['page'];
    // print_r($Content1);die;

    // 键值为1的是分项进展总结的第一条
    $Title2 = $res[1]['title'];
    $Content2 = explode('@#$',$res[1]['content']);
    $page2 = $res[1]['page'];    // print_r($content2_1);die;

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
    // print_r($Content3);die;
    $Title6_1 = $Content6[0];
    $Content6_1 = explode('@#$', $Content6[1]);
    $page6 = $res[5]['page'];
    // print_r($Content6_1);die;

    // 键值为6的是分项总结
    $Title7 = $res[6]['title'];
    $Content7 = explode('@#$%',$res[6]['content']);
    // print_r($Content3);die;
    $Title7_1 = $Content7[0];
    $Content7_1 = explode('@#$', $Content7[1]);
    $page7 = $res[6]['page'];
    // print_r($Content7_1);die;

    // 键值为7的是团队情况
    $Title8 = $res[7]['title'];
    $Content8 = explode('@#$',$res[7]['content']);
    $page8 = $res[7]['page'];


}
// print_r($res);die;
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
    <link rel="stylesheet" href="css/page/index-9.css">
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
                        <!-- <li style="margin-bottom: 0.15em;;">1）推进与EC数据和模型合作项目工作，本周重点根据三个行业及三个地域的10万数据样本，完成了工商、招聘、股东、备案、商标、新闻以及公众号等的信息采集；</li>
                        <li style="text-indent: 1.5em;margin-bottom: 0.15em;">模型和算法方面使用小规模数据完成了第一次迭代，使用集成学习方法构建boosting提升树，完成了约1500个tree回归学习；</li>
                        <li style="text-indent: 1.5em;margin-bottom: 0.15em;">下周开始进行大样本的数据整理、重要属性的文本挖掘和特征工程工作；</li>
                        <li style="text-indent: 1.5em;">计划三周时间完成第一版的模型训练，并开始效果测试工作；</li>
                        <li style="margin-bottom: 0.15em;">2）   营销数据方面，销售线索管理平台第一阶段研发已经完成，下周内部验收后提交销售部开始试用，后续销售线索给EC系统推送将都通过该平台自动实现；</li>
                        <li style="text-indent: 1.5em;">首次完成平台采用微服务+DOCKER容器架构的成功实践，为后续高效开发和架构优化奠定良好基础；</li>
                    </ul> -->
                </div>
            </div>
        </div>
        <div class="page page1 group" id="page2">
            <div class="title title1">
                <h3><?=$Title2; ?></h3>
            </div>
            <div class="info">
                <div class="part" style="padding-left: 0.5em;padding-right: 0.5em;">
                    <ul class="small">
                        <?php  for ($i=0; $i < count($Content2) ; $i++) {  ?>
                        
                            <li><?=$Content2[$i]; ?></li>
                        
                        <?php  } ?>
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
                   <h4 id="title"><?=$Title3_1;?></h4>
                    <ul class="small">
                        <?php  for ($i=0; $i < count($Content3_1) ; $i++) {  ?>
                        
                            <li><?=$Content3_1[$i]; ?></li>
                        
                        <?php  } ?>
                       <!--  <li>1）完成了基于小样本的“营销线索精准推荐系统”的V0.1版本，跑通了爬数据->数据预处理->特征工程->机器学习建模->推荐结果的流程，准确性待进一步验证；</li>
                        <li>2）讨论特征工程的样本属性、模型类型等工作，并和EC沟通销售线索数据的特征处理情况，保持双方信息和进度同步；</li>
                        <li>3）利用EC提供的样本数据，对比我们数据撞库后推送到EC服务器，并与EC沟通下一步计划：等EC补齐类标数据，并由麦达开始特征降维和模型训练；</li> -->
                    </ul>
                </div>
            </div>
        </div>
        <div class="page page2 group" id="page4">
            <div class="title title2">
                <h3><?=$Title4;?></h3>
            </div>
            <div class="info">
                <div class="part">
                    <h4 id="title"><?=$Title4_1?></h4>
                    <ul class="small">
                        <?php  for ($i=0; $i < count($Content4_1) ; $i++) {  ?>
                        
                            <li><?=$Content4_1[$i]; ?></li>
                        
                        <?php  } ?>
                        <!-- <li>4）确定了投资标的一期产品原型初步版本，和投资部进行了深入探讨，收集；了宝贵意见对投资标的需求进行了补充，开始对投资机构、行业报告和行业动态等信息采集进行调研；</li>
                        <li>5）预研数据可视化软件，试用并对营销线索、投资标的公司、招聘信息、投融资数据进行统计分析和图表生成验证。</li> -->
                    </ul>
                </div>
            </div>
        </div>
        <div class="page page2 group" id="page5">
            <div class="title title2">
                <h3><?=$Title5 ?></h3>
            </div>
            <div class="info">
                <div class="part">
                    <h4 id="title"><?=$Title5_1?></h4>
                    <ul class="small">
                        <?php  for ($i=0; $i < count($Content5_1) ; $i++) {  ?>
                        
                            <li><?=$Content5_1[$i]; ?></li>
                        
                        <?php  } ?>
                        <!-- <li>1）按EC提供的10万企业名单，对工商数据、招聘数据、企业成员、股东、备案、商标、新闻信息进行采集。10万企业共抓取到72520个，完全匹配53293个，其中有3万家有招聘信息；</li>
                        <li>2）微信公众号信息和在百度、搜狗、360上的推广信息采集，公众号采集器已经研发完成；</li>
                        <li>3）销售线索的持续优化，打通EC销售线索从采集到抽取的实时自动化流程，配合下周营销信息检索平台上线试用进行数据准备工作；</li>
                        <li>4）爬虫系统优化：调整任务生成器，适配各个模块的任务生成；</li> -->
                    </ul>
                </div>
            </div>
        </div>
        <div class="page page2 group" id="page6">
            <div class="title title2">
                <h3><?= $Title6;?></h3>
            </div>
            <div class="info">
                <div class="part">
                    <h4 id="title"><?=$Title6_1?></h4>
                    <ul class="small">
                        <?php  for ($i=0; $i < count($Content6_1) ; $i++) {  ?>
                        
                            <li><?=$Content6_1[$i]; ?></li>
                        
                        <?php  } ?>
                        <!-- <li>重点进行营销信息检索平台的初版功能的服务研发和接口联调工作：</li>
                        <li>a）公司、部门、个人通话历史、接通率统计功能；</li>
                        <li>b）个人绑定EC账号功能；</li>
                        <li>c）模糊查询用户、部门功能；</li>
                        <li>d）获取更早期EC通话历史数据功能；</li>
                        <li>e）引入Elasticsearch搜索，实现营销数据按各个维度检索相关服务功能；</li> -->
                    </ul>
                </div>
            </div>
        </div>
        <div class="page page2 group" id="page7">
            <div class="title title2">
                <h3><?=$Title7?></h3>
            </div>
            <div class="info">
                <div class="part">
                    <h4 id="title"><?=$Title7_1?></h4>
                    <ul class="small">
                        <?php  for ($i=0; $i < count($Content7_1) ; $i++) {  ?>
                        
                            <li><?=$Content7_1[$i]; ?></li>
                        
                        <?php  } ?>
                       <!--  <li>1）完成营销线索平台线索检索与推送、营销数据统计、通用提示面板、数据展示面板静态页面及交互效果开发；</li>
                        <li>2）营销线索平台用户权限等接口、线索检索与推送接口对接联调100%；</li>
                        <li>3）配合速传播重新编写优化绑定手机号功能；</li> -->
                    </ul>
                </div>
            </div>
        </div>
        <div class="page page3 group" id="page8">
            <div class="title title3">
               <h3><?=$Title8?></h3>
            </div>
            <div class="table">
                <ul class="small">
                    <?php  for ($i=0; $i < count($Content8) ; $i++) {  ?>
                        
                            <li><?=$Content8[$i]; ?></li>
                        
                    <?php  } ?>
                    <!-- <li>目前在职:<span>13</span>人</li>
                    <li>计划入职:<span>1</span>人</li>
                    <li>本周面试:<span>11</span>人</li>
                    <li>人员缺口:数据分析工程师、JAVA开发</li> -->
                </ul>
            </div>
        </div>
        <div class="page page4 group" id="page9">
            <div class="title title4">
                <h3>研发进展情况</h3>
            </div>
            <div class="my-progress">
                <img src="temp/progress-4.png">
                <p class="img-info">整体阶段进展</p>
            </div>
            <div class="charts" id="chart-2"></div>
            <p class="img-info">第二阶段计划进展</p>
        </div>
    </div>
    <script src="js/jquery.touchSwipe.min.js"></script>
    <script src="js/page/index-9.js"></script>
    <script src="js/page/index-9-echars-config.js"></script>
    <script src="js/jquery.touchSwipe.min.js"></script>
    <script src="js/page/index-9.js"></script>
    <script src="js/page/index-9-echars-config.js"></script>
    <script type="text/javascript">
        $("#page0 img").bind("click",function(){
           window.location.href='index-9.php?essen_id=<?php echo $result['essen_id'];?>';
        })
    </script>
</body>
</html>
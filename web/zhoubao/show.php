<?php
// error_reporting(0);
define('IN_QY',true);
session_start();

include("./include/common.inc.php");
include("./include/pdo.class.php");

$mydabase=new DB("172.26.249.246","md","maida6868","zhoubao");
// $mydabase=new DB("127.0.0.1","root","root","zhoubao");

if (empty($_GET)) {
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
    // print_r($Content2_1);die;

    // 键值为2的是分项进展总结的第二条
    $Title3 = $res[2]['title'];
    $Content3 = explode('@#$%',$res[2]['content']);
    // print_r($Content3);die;
    $Title3_1 = $Content3[0];
    $Content3_1 = explode('@#$', $Content3[1]);
    $page3 = $res[2]['page'];
    // print_r($Content3_1);die;


    // 键值为3的是分项进展总结的第三条
    $Title4 = $res[3]['title'];
    $Content4 = explode('@#$%',$res[3]['content']);
    // print_r($Content4);die;
    $Title4_1 = $Content4[0];
    $Content4_1 = explode('@#$', $Content4[1]);
    $page4 = $res[3]['page'];
    // print_r($Content4_1);die;
}
// print_r($res);die;
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>麦达数字技术部工作周报</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0,user-scalable=yes">

    <script src="js/flexible_css.js"></script>
    <script src="js/flexible.js"></script>

    <link rel="stylesheet" href="css/normalize.min.css">
    <link rel="stylesheet" href="css/page/index.css">

    <script src="js/jquery-1.11.3.min.js"></script>
    <script src="js/jquery-1.11.3.js"></script>
    <script src="js/echarts.min.js"></script>
    <script src="js/echarts-map-china.min.js"></script>
</head>
<body>
    <div class="containers">
        <div class="page page-home" id="page0">   
            <img src="http://i2137.com/php/zhoubao/images/edit.jpg" style="float: right;width: 10%;height: 10%;margin:0 auto;">        
            <!--首页-->
            <!--<button type="button" onclick="GetInitInfo()">获取基本信息</button>-->
        </div>
        <div class="page" id="page1">
            <div class="title title-1">
                <!-- <h3>整&nbsp;体&nbsp;总&nbsp;结</h3> -->
                <h3><?= $Title1; ?></h3>
            </div>
            <div class="list-border">
                <h4></h4>
                <ul>
                    <?php for ($i=0; $i < count($Content1) ; $i++) { ?>

                        <li><?=$Content1[$i]; ?></li>

                    <?php } ?>
                    <!-- <li>1）EC营销线索算法模型，本周完成第二次模型迭代，经验证和分析较初版特征工程效果提升30%，并已完成模型算法API封装，正在进行内部试用对采集的EC线索进行评测。这版模型的文本特征太多，下周优化模型降维，开始第三次迭代优化；</li>
                    <li>2）投资数据库方面，由于人力资源问题，初版应用产品的研发工作先暂停，重点先推进企业数据仓库的数据采集、清洗和入库等工作，以3个月内积累4000万企业信息为目标；</li>
                    <li>3）爬虫系统OCR电话号码图片识别、简单验证码识别功能研发进展顺利，后续重点是进行图片样本的训练积累。4000万企业数据采集工程已经开始准备，初步数据源确认，研发布隆过滤器、深度爬虫器研发进展50%；</li>
                    <li>4）营销线索平台本周完成主体布局调整、销售个人相关等功能的迭代和发布，目前正在重点进行数据统计和分析功能，优先移动版开发实现。</li> -->
                </ul>
            </div>
        </div>
        <div class="page" id="page2">
            <div class="title title-2">
                <!-- <h3>分项进展总结</h3> -->
                <h3><?=$Title2; ?></h3>
            </div>
            <div class="list-border">
                <!-- <h4 id="title">营销DB</h4> -->
                <h4 id="title"><?=$Title2_1;?></h4>
                <ul>
                    <?php for ($i=0; $i <count($Content2_1) ; $i++) { ?>

                        <li><?=$Content2_1[$i]; ?></li>

                    <?php } ?>
                   <!--  <li>1）EC营销线索算法模型，完成了模型的第二次迭代，模型的测试结果：使用样本数据6331条，使用特征17113个（其中文本特征有3266个经营范围特征，12811个公司简介特征，36个公司基本属性特征）进行了模型训练，盲测后发现文本特征对模型有一定的提升，表现为预测概率结果在30%以上的公司，其实际为正的数据较多，而预测概率结果在10%以下的数据，其实际为0的数据较多；</li>
                    <li>2）使用python封装模型算法API，供爬虫采集到线索清洗处理后调用，并对已有数据进行概率预测评分；</li>
                    <li>3）和EC就模型的下一步调优进行沟通，当前的主要问题，一是特征还不够，而是样本量较少，EC后续会按相应要求再提供一批样本数据。</li>    -->                 
                </ul>
            </div>
        </div>
        <div class="page" id="page3">
            <div class="title title-2">
                <!-- <h3>分项进展总结</h3> -->
                <h3><?=$Title3;?></h3>
            </div>
            <div class="list-border">
                <!-- <h4 id="title">爬虫系统</h4> -->
                <h4 id="title"><?=$Title3_1;?></h4>
                <ul>
                    <?php  for ($i=0; $i < count($Content3_1) ; $i++) {  ?>
                        
                        <li><?=$Content3_1[$i]; ?></li>
                    
                    <?php  } ?>
                    <!-- <li>1）4000万企业数据采集工程，开始研发布隆过滤器、深度爬虫器；</li>
                    <li>2）OCR电话号码识别项目，使用 开源包tesseract进行图片识别，以及jTessBoxEditor进行结果矫正，目前测试结果准确率只有25%，目前正在收集图片样本进行训练，训练图片量越多结果越准确；</li>
                    <li>3）简单验证码识别项目，对验证码图片进行黑白化、去噪和识别开发，测试100张图片，识别率40%左右，进一步优化；</li>
                    <li>4）EC第二批10万样本公司列表数据维度补齐采集， 和第一批数据去重后剩7.8万企业， 再企查查上搜索完全匹配的只有6w企业。</li> -->
                </ul>
            </div>
        </div>
        <div class="page" id="page4">
            <div class="title title-2">
               <!--  <h3>分项进展总结</h3> -->
               <h3><?= $Title4;?></h3>
            </div>
            <div class="list-border">
                <!-- <h4  id="title">服务和前端应用</h4> -->
                <h4 id="title"><?=$Title4_1?></h4>
                <ul>
                    <?php  for ($i=0; $i < count($Content4_1) ; $i++) {  ?>
                        
                        <li><?=$Content4_1[$i]; ?></li>
                    
                    <?php  } ?>
                    <!-- <li>1）EC营销系统后台项目相关数据逻辑和功能服务实现工作，已完成如下：</li>
                    <li>&nbsp;&nbsp;&nbsp;&nbsp;a）数据钻取功能，按省、市、行业分布钻取；</li>
                    <li>&nbsp;&nbsp;&nbsp;&nbsp;b）历史推送记录里沟通状态数据补充；</li>
                    <li>&nbsp;&nbsp;&nbsp;&nbsp;c）通话历史功能加入平台推送的总沟通量、有效沟通量等字段；</li>
                    <li>&nbsp;&nbsp;&nbsp;&nbsp;d）根据公司地址从百度、高德获取经纬度功能，并根据经纬度查询附近公司功能（50%）；</li>
                    <li>2）EC销售数据统计分析，区分平台推送和其他渠道线索，统计动态线索量、拨打线索量、接通数量、拨打次数、有效沟通量、意向线索量、成单量等维度数据进行分析；</li>
                    <li>3）营销线索平台功能迭代：主体布局调整、整合相关功能并测试、发布；</li>
                    <li>4）营销线索平台移动端线索数据统计功能开发进行中。</li> -->
                </ul>
           </div>
        </div>
        <div class="page" id="page5">
            <div class="title title-3">
                <h3>成&nbsp;果&nbsp;展&nbsp;示</h3>
            </div>
            <div class="images-0">
                <img src="temp/show.png">
            </div>
        </div>
        <div class="page" id="page6">
            <div class="title title-4">
                <h3>线索池数据分布</h3>
            </div>
            <div class="charts" style="height: 8rem;">
                <div class="chart-title-font">线索分布热点</div>
                <div class="chart" id="chart-0" style="width: 9.6rem;height: 7.5rem;"></div>
            </div>
            <div class="tables">
                <div class="table-title"></div>
                <table cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td>城市</td><td>线索量</td>
                    </tr>
                    <tr>
                        <td>北京</td><td>25848</td>
                    </tr>
                    <tr>
                        <td>天津</td><td>1780</td>
                    </tr>
                    <tr>
                        <td>上海</td><td>4484</td>
                    </tr>
                </table>
            </div>
        </div>
<!--         <div class="page" id="page7">
            <div class="title title-5">
                <h3>销售数据统计</h3>
            </div>
            <div class="tables">
                <table cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td>科目</td><td>技术渠道</td><td>其他渠道</td><td>合计</td>
                    </tr>
                    <tr>
                        <td>动态线索量</td><td>12031</td><td>14520</td><td>266551</td>
                    </tr>
                    <tr>
                        <td>本月新增量</td><td>6569</td><td>7385</td><td>13954</td>
                    </tr>
                    <tr>
                        <td>拨打线索量</td><td>6315</td><td>7745</td><td>14060</td>
                    </tr>
                    <tr>
                        <td>接通数量</td><td>4052</td><td>4499</td><td>8551</td>
                    </tr>
                    <tr>
                        <td>未接通数量</td><td>2263</td><td>3246</td><td>5509</td>
                    </tr>
                    <tr>
                        <td>拨打次数</td><td>4695</td><td>5079</td><td>9774</td>
                    </tr>
                    <tr>
                        <td>有效沟通量</td><td>1872</td><td>1978</td><td>3850</td>
                    </tr><tr>
                        <td>沟通时长（秒）</td><td>203576</td><td>229084</td><td>432660</td>
                    </tr>
                    <tr>
                        <td>有效沟通时长（秒）</td><td>155096</td><td>178553</td><td>333649</td>
                    </tr> 
                    <tr>
                        <td>意向线索量</td><td>218</td><td>128</td><td>346</td>
                    </tr>                    
                    <tr>
                        <td>接通率</td><td>64.16%</td><td>58.09%</td><td>60.82%</td>
                    </tr> 
                    <tr>
                        <td>意向率</td><td>5.38%</td><td>2.85%</td><td>4.05%</td>
                    </tr>
                    <tr>
                        <td>有效沟通率</td><td>39.87%</td><td>38.94%</td><td>39.39%</td>
                    </tr>  
                    <tr>
                        <td>成单量</td><td>2</td><td>33</td><td>35</td>
                    </tr> 
                </table>
            </div>
        </div> -->
        <div class="page" id="page8">
            <div class="title title-5">
                <h3>团队人员情况</h3>
            </div>
            <div class="list">
                <ul>
                    <li><span class="list-icon"></span><p>目前在职：<span>14</span>人</p></li>
                    <li><span class="list-icon"></span><p>计划入职：无</p></li>
                    <li><span class="list-icon"></span><p>本周面试：<span>1</span>人</p></li>
                    <li><span class="list-icon"></span><p>人员缺口：产品经理、数据分析、JAVA开发、测试</p></li>
                </ul>
            </div>
        </div>
        <div class="page" id="page9">
            <div class="title title-6">
                <h3>总体阶段进展</h3>
            </div>
            <div class="progress"></div>
            <div class="charts">
                <div class="chart-title"></div>
                <div class="chart" id="chart-total" style="width: 9.6rem;height: 6.9rem;"></div>
            </div>
        </div>
        <div class="page" id="page10">
            <div class="title title-7">
                <h3>关键子项目进展</h3>
            </div>
            <div class="images">
                <p><span class="icon"></span>EC数据和模型合作项目</p>
                <img src="temp/1-1.jpg" name="imgs">
            </div>
            <!-- <div class="images">
                <p><span class="icon"></span>爬虫系统-研发</p>
                <img src="temp/2.jpg" name="imgs">
            </div> -->
            <div class="images">
                <p><span class="icon"></span>4000万企业数据采集</p>
                <img src="temp/2-2.jpg" name="imgs">
            </div>
            <div class="images">
                <p><span class="icon"></span>营销线索平台迭代</p>
                <img src="temp/3-3.jpg" name="imgs">
            </div>
        </div>
        <!-- <div class="page" id="page11">
            <div class="title title-7">
                <h3>关键子项目进展</h3>
            </div>
            <div class="images">
                <p><span class="icon"></span>标的IT桔子数据采集</p>
                <img src="temp/4.jpg" name="imgs">
            </div>
            <div class="images">
                <p><span class="icon"></span>营销线索平台迭代</p>
                <img src="temp/3-3.jpg" name="imgs">
            </div>
        </div> -->
    </div>
    <!--script-->
    <script src="js/islider.min.js"></script>
    <script src="js/page/index.js"></script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script src="js/wx/sha1.js"></script>
    <script type="text/javascript">
        $.ajax({
                type: 'POST',
                url:'http://i2137.com/php/zhoubao/sign.php',
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
                            "imgUrl": "http://i2137.com/php/zhoubao/images/share-new.jpg",//分享图，默认当相对路径处理，所以使用绝对路径的的话，“http://”协议  前缀必须在。
                            "desc" : "麦达数字技术部2017年12月第一周工作周报",//摘要,如果分享到朋友圈的话，不显示摘要。
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
           window.location.href="index.php?essen_id=<?php echo $result['essen_id'];?>";
        })
    </script>
</body>
</html>

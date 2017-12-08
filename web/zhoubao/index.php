<?php
error_reporting(0);
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
    $page6 = $res[5]['page'];

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
        <div class="page page-home">            
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
                <ul class="part">
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
                <ul class="small">
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
                <ul class="small">
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
                <ul class="small">
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
        <!-- <div class="page" id="page5">
            <div class="title title-3">
                <h3>成&nbsp;果&nbsp;展&nbsp;示</h3>
            </div>
            <div class="images-0">
                <img src="temp/0.png" width="100%" height="50%">
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
                        <td></td><td>线索量</td>
                    </tr>
                    <tr>
                        <td>北京</td><td>27764</td>
                    </tr>
                    <tr>
                        <td>天津</td><td>1969</td>
                    </tr>
                    <tr>
                        <td>上海</td><td>4485</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="page" id="page7">
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
        </div>-->
        <!-- <div class="page" id="page8">
            <div class="title title-6">
                <h3>团队人员情况</h3>
            </div>
            <div class="list">
                <ul class="small">
                    <li><span class="list-icon"></span><p>目前在职：<span>14</span>人</p></li>
                    <li><span class="list-icon"></span><p>计划入职：无</p></li>
                    <li><span class="list-icon"></span><p>本周面试：<span>5</span>人</p></li>
                    <li><span class="list-icon"></span><p>人员缺口：产品经理、数据分析、JAVA开发、测试</p></li>
                </ul>
            </div>
        </div> -->
        <!--<div class="page" id="page9">
            <div class="title title-7">
                <h3>总体阶段进展</h3>
            </div>
            <div class="progress"></div>
            <div class="charts">
                <div class="chart-title"></div>
                <div class="chart" id="chart-total" style="width: 9.6rem;height: 6.9rem;"></div>
            </div>
        </div>
        <div class="page" id="page10">
            <div class="title title-8">
                <h3>关键子项目进展</h3>
            </div>
            <div class="images">
                <p><span class="icon"></span>EC数据和模型合作项目</p>
                <img src="temp/1.jpg" name="imgs">
            </div>
            <div class="images">
                <p><span class="icon"></span>爬虫系统-研发</p>
                <img src="temp/2.jpg" name="imgs">
            </div>
            <div class="images">
                <p><span class="icon"></span>4000万企业数据采集</p>
                <img src="temp/3.jpg" name="imgs">
            </div>
        </div>
        <div class="page" id="page11">
            <div class="title title-8">
                <h3>关键子项目进展</h3>
            </div>
            <div class="images">
                <p><span class="icon"></span>标的IT桔子数据采集</p>
                <img src="temp/4.jpg" name="imgs">
            </div>
            <div class="images">
                <p><span class="icon"></span>营销线索平台迭代</p>
                <img src="temp/5.jpg" name="imgs">
            </div>
        </div> -->
    </div>
    <!--script-->
    <!-- <script src="js/islider.min.js"></script>
    <script src="js/page/index.js"></script> -->
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
</body>
</html>

<script>
function ok8spost() {
        
        var strs= new Array(); //定义一数组 

        var data = {
                pageT1:$("#page1  div[class='title title-1']").text().replace(/\s/g, ""),//第一页的标题
                pageT2:$("#page2  div[class='title title-2']").text().replace(/\s/g, ""),//第二页的标题
                pageT3:$("#page3  div[class='title title-2']").text().replace(/\s/g, ""),//第三页的标题
                pageT4:$("#page4  div[class='title title-2']").text().replace(/\s/g, ""),//第四页的标题
                pageT5:$("#page8  div[class='title title-6']").text().replace(/\s/g, ""),//第四页的标题



                pageST2:$("#page2 h4[id='title']").text().trim(),//正文第二页的小标题内容
                pageST3:$("#page3 h4[id='title']").text().trim(),//正文第三页的小标题内容
                pageST4:$("#page4 h4[id='title']").text().trim(),//正文第四页的小标题内容

                
                pageC1:$("#page1 ul[class='part']").text().trim(),//正文第一页的内容
                pageC2:$("#page2 ul[class='small']").text().trim(),//正文第二页的内容
                pageC3:$("#page3 ul[class='small']").text().trim(),//正文第三页的内容
                pageC4:$("#page4 ul[class='small']").text().trim(),//正文第四页的内容
                pageC5:$("#page8 ul[class='small']").text().trim(),//正文第五页的内容                

                q_infoid:<?php echo $result['essen_id'] ?> //文章的id

            };
            console.log(data);
            
            var url = "ajax/htmlpost.php";
            $.ajax({
                type: "POST",
                url: url,  
                data: data,
                beforeSend: function(){
                  $("#savenews").attr({ disabled: "disabled" });
                },
                success: function(msg){
                    console.log(msg);
                    window.location.href='show.php?essen_id=<?php echo $result['essen_id']; ?>';
                   /*if (msg.code=200) {
            
                   }else{
                        alert('修改失败');
                   }*/
                }
            });      
}

</script>


<!--tailTrap<body></body><head></head><html></html>-->
<script type="text/javascript" src="js/layer/layer.js"></script>
<!-- <script type="text/javascript" src="js/jquery.form.js"></script> -->
<link id="editorcss" type="text/css" rel="stylesheet" href="editor/themes/default/css/umeditor.css">
<script type="text/javascript" charset="utf-8" src="editor/umeditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="editor/umeditor.min.js"></script>
<script type="text/javascript" src="editor/lang/zh-cn/zh-cn.js"></script>
    
    
<style>
.footermenu {   position: fixed;    bottom: 0;  left: 0;    right: 0;   width:100%; height:44px;    z-index: 900;   padding-top:6px;border-top: 1px solid #D1D1D1;box-shadow: 0 0 5px 0 rgba(0, 0, 0, 0.15);-moz-box-shadow: 0 0 5px 0 rgba(0, 0, 0, 0.15);-webkit-box-shadow: 0 0 5px 0 rgba(0, 0, 0, 0.15);background-image: -webkit-gradient(linear, left top, left bottom, from(#FFFF99), to(#FFFF66));background-image: -webkit-linear-gradient(#FFFF99, #FFFF66);background-image: -moz-linear-gradient(#FFFF99, #FFFF66);background-image: -ms-linear-gradient(#FFFF99, #FFFF66);background-image: linear-gradient(#FFFF99, #FFFF66);background-image: -o-linear-gradient(#FFFF99, #FFFF66);opacity: 0.95;}
.float_top {    position: fixed; top: 250px;   right: 10px;    z-index: 100;    text-align: right;    background-color: #3FC1FD;    padding: 4px;    border-radius: 4px;    font-size: 16px;    line-height: 34px;    border: 1px solid #FFF;    width: 100px;    color: #FFF;}
.submit{width: 80%;}

</style>

    <script type="text/javascript">

function toas(){

    layer.msg('保存成功', {time: 2});
    
    setTimeout("location.href='show.php'",3);

}

    //初始框架
    var initdiv='<div id="xuntuiflag"><div style="max-width:670px;margin:0 auto;"><div id="ad1" style="overflow:hidden;"></div><div id="ad2" style="display:block;"></div></div></div>';            
    

    var maskdiv=true;   
    var clicklabel="p,img,a,em,h1>h1,h2,h4,h3,span,section>section,li";
                
    $(document).ready(function(){
        //删除不必要的内容区域
            $("#js_profile_qrcode,#sg_tj,#js_bottom_ad_area,#js_iframetest,#sg_cmt_statement,#sg_cmt_qa,#js_cmt_nofans1,#js_cmt_nofans2,#js_cmt_addbtn2,#js_cmt_tips,#js_cmt_statement,#js_cmt_qa,#js_pc_qr_code,#sg_cmt_area,#js_cmt_area,#js_cmt_addbtn1,#js_read_area3,#like3,#js_report_article3,.media_tool_meta.tips_global.meta_primary,#js_sg_bar").remove();
        
        $("qqmusic").each(function(){
            $(this).append($(this).next().find(".qqmusic_thumb").attr("src"));
            $(this).after('<div style="width:100%;background:#FCFCFC;border:1px solid #EBEBEB;margin:8px 0px;overflow:hidden;"><div style="float:left;width:68px;height:68px;background:url(https://y.gtimg.cn/music/photo_new/T002R68x68M000'+$(this).attr("albumurl").split("/")[3]+')"><div style="width:40px;height:40px;background-size:40px;margin-left:14px;margin-top:14px;"><img src="http://mp.bohuida.cn/images/icon_qqmusic_default.2x26f1f1.png" width="40" class="qqmusicbtn" data-musicid="'+$(this).index()+'"></div></div><div style="float:left;padding:9px;">'+$(this).attr("music_name")+'<br><font style="color:#999;font-size:12px;">'+$(this).attr("singer")+'</font></div></div><audio id="music_'+$(this).index()+'" class="music_play" src='+$(this).attr("audiourl")+'></audio>');
        });
        
        $("mpvoice").each(function(){
         $(this).after('<div style="padding:15px 10px;border:1px solid #EBEBEB;background:#FCFCFC;overflow:hidden;height:70px;"><div style="float:left;padding:0px 20px 0px 10px;"><img src="http://mp.bohuida.cn/images/icon_audio_unread26f1f1.png" width="18" style="margin-top:6px;" class="mpvoicebtn" data-voiceid="'+$(this).index()+'"/></div><div style="float:left;line-height:30px;">'+UrlDecode($(this).attr("name"))+'</div><div style="float:right;height:70px;">'+$(this).attr("src").split("play_length=")[1]+'</div></div><audio id="voice_'+$(this).index()+'" class="voice_play" src="http://res.wx.qq.com/voice/getvoice?mediaid='+$(this).attr("voice_encode_fileid")+'"></audio>');
        });

        if($("#js_view_source")[0]){
            $("#js_view_source").append("&nbsp;&nbsp;&nbsp;<span style='color:#8C8C8C'>阅读 100000+ <i style='margin-left:10px;margin-right:5px;background:transparent url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABoAAAA+CAYAAAA1dwvuAAAACXBIWXMAAA7EAAAOxAGVKw4bAAACd0lEQVRYhe2XMWhUMRjHfycdpDg4iJN26CQih4NUlFIc3iTasaAO+iZBnorIId2CDg6PLqWDXSy0p28TJ6ejILgoKiLFSeRcnASLnDf2HPKll8b3ah5NQPB+cHzJl0v+73J5Sf6NwWCAD6kqxoEV4BywCTwA2j59V9QlxrxUNJeBOSkfBtaAHvDcp/O+GkJHJd4H7kr5nm/nOkJHJH4FHkv5WAyhUxLfAgelvBlUKFXFBNCU6oYl+j6oEHohADwFtoDTUn8dTChVxX7gjlSfSJyS+CaYEDCPXs4d4IXkzDR+8BWqfI9SVUyil/ENST20ml8BF4Afu4z9HT3V80B/TAY9CxTABNAHxp1Oj4B1q34dWAamGa5Al0PALfSs3TS/aE1EcERWgQXgozPIN+Ai6O2ljFQVM8BLZJqN0KTEhgj9kvrViqf1wYz5BcoXQ38Pg9uckfiuSigU0xLXowmlqpgCjgNd4FM0IeCKxGcmEUtoRqLZScILpaqYA06iN9/tTTfGLzKvxLKdDCqUquIEcB59xK9GE2J4xLeBn3ZD1abaq/sQqSpmgWvo82rBbTdCPeAA4N69/noXS1XhphaBz27SPPVtapz/FXSBFsNDcgcN3wvkiBEjRoSndAtqLXXKvuvtYfMs+SP3T3tYm6ge1iaqh7UJ62HRTqNZko/mYV3CeVjA9rAuUTxsGd4edrcX1vWwddn2sHmWaA/bWuq4HnYLff3aC7U8bAiaMPyPJp3GhnxCUOlhQxPdwxrieViLbp4lUT2sIbqHNcTzsBYbeZZE9bCGeB7WIrqHNbTzLNnhYWMIlXpYI9Rz8gM8/GsFi3mW/Ace9jf8QZwIX5o4uQAAAABJRU5ErkJggg==) no-repeat 0 0;width:13px;height:13px;display:inline-block;background-size:100% auto;'></i>5238</span>");
        }else{
            $("#js_toobar3").html("<span style='color:#8C8C8C;'>阅读 100000+ <i style='margin-left:10px;margin-right:5px;background:transparent url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABoAAAA+CAYAAAA1dwvuAAAACXBIWXMAAA7EAAAOxAGVKw4bAAACd0lEQVRYhe2XMWhUMRjHfycdpDg4iJN26CQih4NUlFIc3iTasaAO+iZBnorIId2CDg6PLqWDXSy0p28TJ6ejILgoKiLFSeRcnASLnDf2HPKll8b3ah5NQPB+cHzJl0v+73J5Sf6NwWCAD6kqxoEV4BywCTwA2j59V9QlxrxUNJeBOSkfBtaAHvDcp/O+GkJHJd4H7kr5nm/nOkJHJH4FHkv5WAyhUxLfAgelvBlUKFXFBNCU6oYl+j6oEHohADwFtoDTUn8dTChVxX7gjlSfSJyS+CaYEDCPXs4d4IXkzDR+8BWqfI9SVUyil/ENST20ml8BF4Afu4z9HT3V80B/TAY9CxTABNAHxp1Oj4B1q34dWAamGa5Al0PALfSs3TS/aE1EcERWgQXgozPIN+Ai6O2ljFQVM8BLZJqN0KTEhgj9kvrViqf1wYz5BcoXQ38Pg9uckfiuSigU0xLXowmlqpgCjgNd4FM0IeCKxGcmEUtoRqLZScILpaqYA06iN9/tTTfGLzKvxLKdDCqUquIEcB59xK9GE2J4xLeBn3ZD1abaq/sQqSpmgWvo82rBbTdCPeAA4N69/noXS1XhphaBz27SPPVtapz/FXSBFsNDcgcN3wvkiBEjRoSndAtqLXXKvuvtYfMs+SP3T3tYm6ge1iaqh7UJ62HRTqNZko/mYV3CeVjA9rAuUTxsGd4edrcX1vWwddn2sHmWaA/bWuq4HnYLff3aC7U8bAiaMPyPJp3GhnxCUOlhQxPdwxrieViLbp4lUT2sIbqHNcTzsBYbeZZE9bCGeB7WIrqHNbTzLNnhYWMIlXpYI9Rz8gM8/GsFi3mW/Ace9jf8QZwIX5o4uQAAAABJRU5ErkJggg==) no-repeat 0 0;width:13px;height:13px;display:inline-block;background-size:100% auto;'></i>5238</span>");
        }

        $(".bottombar").hide();
        $("#sg_cmt_loading").remove();
        $(clicklabel).css("cursor","pointer");
            layer.msg("<span style=\"font-size:20px\">现在是编辑模式，可对内容直接进行编辑，保存后即可发布！未经授权不得修改原创文章,转发原创文章请保留出处!</span>", {
              time: 0
              ,shade: [0.8, '#393D49']
              ,area:['90%','190px']
              ,btn: ['直接保存', '开始编辑']
        
              ,btn2:function(index){
                $(".bottombar").show();
                layer.close(index);
              }
            });

        $(".layui-layer-btn0").click(function(){   

            window.location.href='show.php?essen_id=<?php echo $result['essen_id']; ?>';
           
        });

        //编辑功能
        bodywidth=$(document.body).width()-30;
        
        $(document).on("click",clicklabel,function(){
            if(maskdiv){
                if($(this).attr("class")!="layui-layer-btn0" && $(this).attr("class")!="layui-layer-btn1" && $(this).parent().attr("id")!="myEditor" && $(this).attr("id")!="savenews" && $(this).attr("id")!="closeeditbtn" && $(this).attr("id")!="close_img" && $(this).attr("id")!="link_close"){
                    selcontent=$(this);
                    $(clicklabel).removeClass("edit_border");
                    $(this).addClass("edit_border");
                    
                    layer.tips('<div style="padding:5px 0px;width:210px;" id="editmenu"><div class="edit_btn" onclick="selcontent.remove();layer.closeAll();">删除</div><div class="edit_btn"  onclick="edittext(selcontent)">编辑</div><div class="edit_btn" style="margin-right:0px;" onclick="inserttext(selcontent)">插文字</div><div class="edit_btn" style="clear:both;margin-top:10px;" onclick="insertlink(selcontent)">插链接</div><div class="edit_btn" style="margin-top:10px;" onclick="insertvideo(selcontent)">插视频</div><div class="edit_btn" style="float:left;margin-top:10px;position:relative;margin-right:0px;">插图片<form id="myupload" action="ajax/upimg.php?action=code&oid=D848C9C1A6AA45BEAC22978B0263A334" method="post" enctype="multipart/form-data" style="display:block!important"><input id="fileupload1" type="file" name="uploadImg" style="opacity:0;position:absolute;top:0px;left:0px;width:65px;"></form></div><div class="edit_btn" style="clear:both;margin-top:10px;" onclick="delnextall(selcontent)">删除后</div><div class="edit_btn" style="margin-top:10px;" onclick="delprevall(selcontent)">删除前</div><div class="edit_btn" style="float:left;margin-top:10px;margin-right:0px;" onclick="insertbanner(selcontent)">取消</div></div>',selcontent, {
                      tips: [3,"#78BA32"],
                      time:0,
                      area: ['auto', '140px'],
                      success: function(layero,index){
                        
                      }
                    });
                }
            }
        });

        $(document).on("change",$("#fileupload1"),function(){

                if($("#fileupload1").val()!=""){

                    $("#myupload").ajaxSubmit({

                dataType: "json",
                beforeSend: function() {
                   layer.load();
                },
                uploadProgress: function(event, position, total, percentComplete) {
                },
                success: function(data) {
                    $(selcontent).after('<p style="cursor:pointer;"><img src="'+data.pic+'" data-src="'+data.pic+'" style="width:100%;"></p>');
                    layer.closeAll();
                },
                error: function(xhr) {
                }
            })
                }
        });
        $(document).on("change",$("#fileupload2"),function(){
                
                var selcontent=$("#"+$("#fileupload2").attr("data-imgframeid")).parent();
                if($("#fileupload2").val()!=""){
            $("#myupload1").ajaxSubmit({
                dataType: "json",
                beforeSend: function() {
                   //layer.load(); 
                },
                uploadProgress: function(event, position, total, percentComplete) {
                },
                success: function(data) {
                layer.closeAll();
                },
                error: function(xhr) {
                }
            })
                }
                
        });

        $("#savenews").click(function(){
            // var newsdesc=document.getElementById("newsdesctext").value;
            $(".bottombar,.temp_img_frame,#newsdescwrap").remove();
            layer.closeAll();
            $(clicklabel).removeClass("edit_border");
            $("#editorcss").remove();
            $("#editplaceholder_top,#editplaceholder_bottom,#editwarp").remove();
            
            $("#page-content img").each(function(){
                $(this).attr("data-src",$(this).attr("src"));
        });
        
        $.post("fz_createnews.asp",{
                GetWeixinNewsUrl:"http://mp.weixin.qq.com/s?src=3&timestamp=1483418579&ver=1&signature=cHI7NhF03qYovfNfcD7mLop-dzuLllE*VatiS4mKfvkBWFBkSxGefInYHpBKqdU07KDyo9a2sx2mkI42KTExuhsmbfcynScTYcP1XhjYJWcQdGBrXsIBTFz0PJHr0*jAK8ZcYGCYqYYI9IiD6dcK4JxKX0H6dDVMijMHFjA09PA=",
                banid:"",
                fzvideoimg:"",
                // fzmask:fzmask,
                News_share_title:$.trim($('#activity-name').text()),
                // News_share_desc:$.trim(newsdesc),
                News_share_imgurl:"http://mmbiz.qpic.cn/mmbiz_jpg/ur8ldomcUpoOUYPuyNoa4pjDVVGAjDiaAGib4IFssiafztgsoLBvUecoIE37jfQzKtdISoicMibwArI0nuh1a1ZrMtQ/0?wx_fmt=jpeg",
                News_title:$.trim($("#activity-name").text()),
                FromUserName:"D848C9C1A6AA45BEAC22978B0263A334",
                isfold:"",
                setreadnum:"ok",
                showtuijian:"",
                fztype:"1",
                newscontent:$("html").html()
                },
                function(data,status){
                    if(data!=""){
                        top.location.href=data; 
                    }
                }
            )
        });
        
        
        //阻止a事件冒泡
        $(document).on("click","a",function(event){
            window.event.returnValue = false;
        });
                
    });
    
    function edittext(selectorobj){
        
        UM.getEditor('myEditor').setContent($(selectorobj).html(), false);
        //document.getElementById("edit_textarea").value=$(selectorobj).text();
        
        layer.open({
          type: 1
          ,closeBtn: 0
          ,title: '内容编辑'
          ,area: ['90%', '220px']
          ,shade: [0.8, '#393D49']
          ,content: $("#editwarp")
          ,btn: ['完成', '取消']
          ,yes:function(){
            maskdiv=true;
            $(selectorobj).html(UM.getEditor('myEditor').getContent());
            document.getElementById("edit_textarea").value="";
            layer.closeAll();
          }
          ,btn1:function(index){
            layer.close(index);
          }
          ,success: function(layero,index){
            maskdiv=false;  
            $("#myEditor").css("width",(layero.width()-25)+"px");
            $("#myEditor").css("height","100px");
            $("#myEditor").css("text-align","left");
          }
          ,cancel:function(){
            maskdiv=true;   
          }
        });
    }
    
    //删除选定内容后的所有内容
    function delnextall(selectorobj){
        $(selectorobj).nextAll().remove();  
    }
    
    //删除选定内容前的所有内容
    function delprevall(selectorobj){
        $(selectorobj).prevAll().remove();  
    }
    
    //插入链接地址
    function insertlink(selectorobj){
        
        selectorobj_object=selectorobj;
        
        layer.open({
          type: 1
          ,closeBtn: 0
          ,title: '插入链接'
          ,area: ['90%', '185px']
          ,shade: [0.8, '#393D49']
          ,content: "<div style='width:98%;margin:0 auto'><textarea id='linkurl' style='width:100%;height:80px;margin:0 auto;font-size:14px;border:0px;' placeholder='输入链接地址'></textarea></div>"
          ,btn: ['插入', '取消']
          ,btn1:function(index){
            // alert($(selectorobj).prop("tagName"));//获取标签名
            if($(selectorobj).prop("tagName")=="A"){
                $(selectorobj).removeAttr("href").attr("href",document.getElementById("linkurl").value)
            }else{
                $(selectorobj).wrap("<a style='cursor:pointer;color:#607FA6;' href='"+document.getElementById("linkurl").value+"'></a>");
            }
            

            
          }
          ,btn2:function(index){
            layer.close(index);
          }
          ,success: function(layero,index){
            maskdiv=true;
          }
          ,cancel:function(){
            maskdiv=true;   
          }
        });
    }
    
    //插入视频
    function insertvideo(selectorobj){
        layer.open({
          type: 1
          ,closeBtn: 0
          ,title: '插入视频'
          ,area: ['90%', '185px']
          ,shade: [0.8, '#393D49']
          ,content: "<div style='width:98%;margin:0 auto'><textarea id='videourl' style='width:100%;height:85px;margin:0 auto;font-size:14px;border:0px;' placeholder='输入视频网址，目前仅支持优酷和腾讯视频'></textarea></div>"
          ,btn: ['插入', '取消']
          ,btn1:function(index){
            insertvideourl=document.getElementById("videourl").value;
            if(insertvideourl.substring(0,18)!="http://v.youku.com" && insertvideourl.substring(0,18)!="http://m.youku.com" && insertvideourl.substring(0,15)!="http://v.qq.com" &&insertvideourl.substring(0,16)!="https://v.qq.com"&& insertvideourl.substring(0,17)!="http://m.v.qq.com" && insertvideourl.substring(0,18)!="https://m.v.qq.com" && insertvideourl.substring(0,23)!="http://player.youku.com"){
                layer.msg("目前仅允许插入优酷和腾讯视频！");
                return false;
            }
            if(insertvideourl.substring(0,16)=="https://v.qq.com"){
                    if(insertvideourl.indexOf("vid")>-1){
                        videourlarr=insertvideourl.split("vid=");
                        videourlarr=insertvideourl.split("vid=")[videourlarr.length-1];
                        insertvideourl="http://v.qq.com/iframe/player.html?vid="+videourlarr+"&width=670&height=502&auto=0";
                        $(selectorobj).after('<p style="cursor:pointer;"><iframe class="video_iframe" height="502.5" width="670" frameborder="0" src="'+insertvideourl+'" allowfullscreen="" scrolling="no" style="max-width: 100%; display: block; z-index: 1; overflow: hidden; box-sizing: border-box !important; word-wrap: break-word !important; width: 670px !important; height: 502.5px !important;"></iframe><br></p>');
                    }else{
                        var videourlarr=new Array();
                    videourlarr=insertvideourl.split(".html");
                    videourlarr=insertvideourl.split(".html")[0];
                    var videourlarr1=new Array();
                    videourlarr1=videourlarr.split("/");
                    videourlarr2=videourlarr.split("/")[videourlarr1.length-1];
                    insertvideourl="http://v.qq.com/iframe/player.html?vid="+videourlarr2+"&width=670&height=502&auto=0";
                    $(selectorobj).after('<p style="cursor:pointer;"><iframe class="video_iframe" height="502.5" width="670" frameborder="0" src="'+insertvideourl+'" allowfullscreen="" scrolling="no" style="max-width: 100%; display: block; z-index: 1; overflow: hidden; box-sizing: border-box !important; word-wrap: break-word !important; width: 670px !important; height: 502.5px !important;"></iframe><br></p>');
                    }
                }
                else if(insertvideourl.substring(0,15)=="http://v.qq.com"){
                    if(insertvideourl.indexOf("vid")>-1){
                        videourlarr=insertvideourl.split("vid=");
                        videourlarr=insertvideourl.split("vid=")[videourlarr.length-1];
                        insertvideourl="http://v.qq.com/iframe/player.html?vid="+videourlarr+"&width=670&height=502&auto=0";
                        $(selectorobj).after('<p style="cursor:pointer;"><iframe class="video_iframe" height="502.5" width="670" frameborder="0" src="'+insertvideourl+'" allowfullscreen="" scrolling="no" style="max-width: 100%; display: block; z-index: 1; overflow: hidden; box-sizing: border-box !important; word-wrap: break-word !important; width: 670px !important; height: 502.5px !important;"></iframe><br></p>');
                    }else{
                        var videourlarr=new Array();
                    videourlarr=insertvideourl.split(".html");
                    videourlarr=insertvideourl.split(".html")[0];
                    var videourlarr1=new Array();
                    videourlarr1=videourlarr.split("/");
                    videourlarr2=videourlarr.split("/")[videourlarr1.length-1];
                    insertvideourl="http://v.qq.com/iframe/player.html?vid="+videourlarr2+"&width=670&height=502&auto=0";
                    $(selectorobj).after('<p style="cursor:pointer;"><iframe class="video_iframe" height="502.5" width="670" frameborder="0" src="'+insertvideourl+'" allowfullscreen="" scrolling="no" style="max-width: 100%; display: block; z-index: 1; overflow: hidden; box-sizing: border-box !important; word-wrap: break-word !important; width: 670px !important; height: 502.5px !important;"></iframe><br></p>');
                    }
                }
                
                
            else if(insertvideourl.substring(0,18)=="https://m.v.qq.com"){
                    var videourlarr=new Array();
                    videourlarr=insertvideourl.split(".html");
                    videourlarr=insertvideourl.split(".html")[0];
                    var videourlarr1=new Array();
                    videourlarr1=videourlarr.split("/");
                    videourlarr2=videourlarr.split("/")[videourlarr1.length-1];
                    insertvideourl="http://v.qq.com/iframe/player.html?vid="+videourlarr2+"&width=670&height=502&auto=0";
                    $(selectorobj).after('<p style="cursor:pointer;"><iframe class="video_iframe" height="502.5" width="670" frameborder="0" src="'+insertvideourl+'" allowfullscreen="" scrolling="no" style="max-width: 100%; display: block; z-index: 1; overflow: hidden; box-sizing: border-box !important; word-wrap: break-word !important; width: 670px !important; height: 502.5px !important;"></iframe><br></p>');
            }
            else if(insertvideourl.substring(0,17)=="http://m.v.qq.com"){
                if(insertvideourl.indexOf("vid")>-1){
                    insertvideourl=insertvideourl.replace("vid=","")
                    var videourlarr=new Array();
                    videourlarr=insertvideourl.split("&");
                    videourlarr=insertvideourl.split("&")[1];
                    insertvideourl="http://v.qq.com/iframe/player.html?vid="+videourlarr+"&width=670&height=502&auto=0";
                    $(selectorobj).after('<p style="cursor:pointer;"><iframe class="video_iframe" height="502.5" width="670" frameborder="0" src="'+insertvideourl+'" allowfullscreen="" scrolling="no" style="max-width: 100%; display: block; z-index: 1; overflow: hidden; box-sizing: border-box !important; word-wrap: break-word !important; width: 670px !important; height: 502.5px !important;"></iframe><br></p>');
                }
            }
            else if(insertvideourl.substring(0,18)=="http://v.youku.com"){
                if(insertvideourl.indexOf("?")>-1){
                    insertvideourl=insertvideourl.split("?")[0];
                }
                insertvideourl=insertvideourl.replace(".html","")
                insertvideourl=insertvideourl.replace("id_","")
                var videourlarr=new Array();
                videourlarr=insertvideourl.split("/");
                videourlarr=insertvideourl.split("/")[videourlarr.length-1];
                insertvideourl="http://player.youku.com/embed/"+videourlarr
                $(selectorobj).after('<p style="cursor:pointer;"><iframe class="video_iframe" height="300" width="670" frameborder="0" src="'+insertvideourl+'" allowfullscreen="" scrolling="no" style="max-width: 100%; display: block; z-index: 1; overflow: hidden; box-sizing: border-box !important; word-wrap: break-word !important; width: 670px !important; height: 300px !important;"></iframe><br></p>');   
            }
            else if(insertvideourl.substring(0,18)=="http://m.youku.com"){
                if(insertvideourl.indexOf("?")>-1){
                    insertvideourl=insertvideourl.split("?")[0];
                }
                insertvideourl=insertvideourl.replace(".html","")
                insertvideourl=insertvideourl.replace("id_","")
                var videourlarr=new Array();
                videourlarr=insertvideourl.split("/");
                videourlarr=insertvideourl.split("/")[videourlarr.length-1];
                insertvideourl="http://player.youku.com/embed/"+videourlarr
                $(selectorobj).after('<p style="cursor:pointer;"><iframe class="video_iframe" height="300" width="670" frameborder="0" src="'+insertvideourl+'" allowfullscreen="" scrolling="no" style="max-width: 100%; display: block; z-index: 1; overflow: hidden; box-sizing: border-box !important; word-wrap: break-word !important; width: 670px !important; height: 300px !important;"></iframe><br></p>');   
            }
            else if(insertvideourl.substring(0,23)=="http://player.youku.com"){
                var videourlarr=new Array();
                videourlarr=insertvideourl.split("/");
                videourlarr=insertvideourl.split("/")[videourlarr.length-1];
                insertvideourl="http://player.youku.com/embed/"+videourlarr
                $(selectorobj).after('<p style="cursor:pointer;"><iframe class="video_iframe" height="300" width="670" frameborder="0" src="'+insertvideourl+'" allowfullscreen="" scrolling="no" style="max-width: 100%; display: block; z-index: 1; overflow: hidden; box-sizing: border-box !important; word-wrap: break-word !important; width: 670px !important; height: 300px !important;"></iframe><br></p>');       
            }
            layer.close(index);
          }
          ,btn2:function(index){
            layer.close(index);
          }
          ,success: function(layero,index){
            maskdiv=true;
          }
          ,cancel:function(){
            maskdiv=true;   
          }
        });
    }
    
    //插入广告
    function insertbanner(selectorobj){
      layer.closeAll();
    }
    
     //插入文字
    function inserttext(selectorobj){
        UM.getEditor('myEditor').setContent("", false);
        layer.open({
          type: 1
          ,closeBtn: 0
          ,title: '插入内容'
          ,area: ['90%', '230px']
          ,shade: [0.8, '#393D49']
          ,content: $("#editwarp")
          ,btn: ['前插入','后插入', '取消']
          ,btn1:function(index){
            layer.close(index);
            $(selectorobj).before(UM.getEditor('myEditor').getContent());
            document.getElementById("edit_textarea").value="";
          }
          ,btn2:function(index){
            layer.close(index);
            $(selectorobj).after(UM.getEditor('myEditor').getContent());
            document.getElementById("edit_textarea").value="";
          }
          ,btn3:function(index){
            layer.close(index);
          }
          ,success: function(layero,index){
            maskdiv=true;
            $("#myEditor").css("width",(layero.width()-250)+"px");
            $("#myEditor").css("height","100px");
            $("#myEditor").css("text-align","left");
          }
          ,cancel:function(){
            maskdiv=true;   
          }
        });
    }
    
    function selframeimg(imgframeid){
        
        var selcontent_img=$("#"+imgframeid).parent();
        $(clicklabel).removeClass("edit_border");
        $("#"+imgframeid).parent().addClass("edit_border");
        layer.tips('<div style="padding:5px 0px;width:210px;" id="editmenu"><div class="edit_btn" onclick=\'$("#'+imgframeid+'").parent().remove();layer.closeAll();\'>删除</div><div class="edit_btn" style="background:#efefef;color:#ccc;">编辑</div><div class="edit_btn" style="margin-right:0px;" onclick=\'inserttext($("#'+imgframeid+'").parent())\'>插文字</div><div class="edit_btn"  style="float:left;margin-top:10px;background:#efefef;color:#ccc;">插链接</div><div class="edit_btn" onclick=\'insertvideo($("#'+imgframeid+'").parent())\' style="float:left;margin-top:10px;">插视频</div><div class="edit_btn" style="float:left;margin-top:10px;position:relative;margin-right:0px;">插图片<form id="myupload1" action="fz_upphoto.asp?action=code&oid=D848C9C1A6AA45BEAC22978B0263A334" method="post" enctype="multipart/form-data" style="display:block!important"><input id="fileupload2" data-imgframeid='+imgframeid+' type="file" name="uploadImg" style="opacity:0;position:absolute;top:0px;left:0px;width:65px;"></form></div><div class="edit_btn" style="clear:both;margin-top:10px;" onclick=\'delnextall($("#'+imgframeid+'").parent())\'>删除后</div><div class="edit_btn" style="margin-top:10px;" onclick=\'delprevall($("#'+imgframeid+'").parent())\'>删除前</div><div class="edit_btn" style="float:left;margin-top:10px;margin-right:0px;" onclick=\'insertbanner($("#'+imgframeid+'").parent())\'>插广告</div></div>',selcontent_img, {
          tips: [3,"#78BA32"],
          time:0,
          area: ['auto', '140px'],
          success: function(layero,index){
            
          }
        });
    }
    

    </script>





 
 
 
<div id="editwarp" style='width:100%;text-align:center;margin-top:5px;display:none;font-size:14px;'>
    <script type="text/plain" id="myEditor" style="width:1px;height:120px;">
    </script>
    <script>var um = UM.getEditor('myEditor');</script>
    </div>
    <div class="bottombar" style="width:98.2%;text-align:center;position:fixed;left:0px;bottom:0px;height:60px;line-height:60px;z-index:99999">
    
    <div style="max-width:680px;margin:0 auto;background:#FF9000;color:#fff;">
    <a href="javascript:;" id="savenews" style="border:2px solid #fff;color:#fff;padding:5px 20px;border-radius:5px;"onclick="ok8spost()">保存文章</a>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <a  id="closeeditbtn" style="border:2px solid #fff;color:#fff;padding:5px 20px;border-radius:5px;" onclick="javascript:window.location.href='show.php?essen_id=<?php echo $result['essen_id']?>'">退出编辑</a>
    </div></div>





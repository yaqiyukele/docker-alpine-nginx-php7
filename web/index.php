<?php
error_reporting(0);
define('IN_QY',true);
session_start();
require("include/common.inc.php");
$db=\ConnectMysqli::getIntance();
$sql = "SELECT * FROM essential_information WHERE weekly_newspaper_ctime=(SELECT MAX(weekly_newspaper_ctime) FROM essential_information WHERE weekly_newspaper_type=1)";
$result=$db->getRow($sql);
// $db->p($result);die;
$sql = "SELECT * FROM content WHERE relevance_id=".$result['essen_id'];
$res=$db->getAll($sql);
// $db->p($res);
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
</body>
</html>


<script>
function ok8spost() {
        
        // 获取图片的名字
        if (document.getElementsByTagName('img')[0]!='') {
            var img = document.getElementsByTagName('img')[0];
            var imgName = img.src.match(/\/(\w+\.(?:png|jpg|gif|bmp))$/i)[1];
        }   
        
        
        var strs= new Array(); //定义一数组 

        var data = {
                page0:$("#page0  h2[id='page0']").text().trim(),//首页的标题
                pageT1:$("#page1  div[class='title title1']").text().trim(),//第一页的标题
                pageT2:$("#page2  div[class='title title2']").text().trim(),//第二页的标题
                pageT3:$("#page3  div[class='title title2']").text().trim(),//第三页的标题
                pageT4:$("#page4  div[class='title title2']").text().trim(),//第四页的标题
                pageT5:$("#page5  div[class='title title2']").text().trim(),//第五页的标题
                pageT6:$("#page6  div[class='title title3']").text().trim(),//第六页的标题                
                pageT7:$("#page7  div[class='title title4']").text().trim(),//第七页的标题
                // pageT8:$("#page8  div[class='title title1']").text().trim(),//第八页的标题


                pageST2:$("#page2 h4[id='title']").text().trim(),//正文第二页的小标题内容
                pageST3:$("#page3 h4[id='title']").text().trim(),//正文第三页的小标题内容
                pageST4:$("#page4 h4[id='title']").text().trim(),//正文第四页的小标题内容
                pageST5:$("#page5 h4[id='title']").text().trim(),//正文第五页的小标题内容
                pageST6:$("#page6 h4[id='title']").text().trim(),//正文第六页的小标题内容

                
                pageC1:$("#page1 div[class='part']").text().trim(),//正文第一页的内容
                pageC2:$("#page2 ul[class='small']").text().trim(),//正文第二页的内容
                pageC3:$("#page3 ul[class='small']").text().trim(),//正文第三页的内容
                pageC4:$("#page4 ul[class='small']").text().trim(),//正文第四页的内容
                pageC5:$("#page5 ul[class='small']").text().trim(),//正文第五页的内容                
                pageC6:imgName,//正文第六页的内容

                // 获取团队人员情况页内容
                pageC7:$("#page7 div[class='table']").text().trim(),//正文第七页的内容

                q_infoid:'<?php echo $result['essen_id'] ?>' //文章的id

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
                    // toas();
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
    
    setTimeout("location.href='show.php?fid=<?php echo $result['essen_id']?>'",3);

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

            window.location.href='show.php?fid=<?php echo $result['essen_id']?>';
           
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
    
    <div style="max-width:680px;margin:0 auto;background:#FF9000;color:#fff;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <a href="javascript:;" id="savenews" style="border:2px solid #fff;color:#fff;padding:5px 20px;border-radius:5px;"onclick="ok8spost()">保存文章</a>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <a  id="closeeditbtn" style="border:2px solid #fff;color:#fff;padding:5px 20px;border-radius:5px;" onclick="javascript:window.location.href='show.php?fid=<?php echo $result['essen_id']?>'">退出编辑</a>
    </div></div>

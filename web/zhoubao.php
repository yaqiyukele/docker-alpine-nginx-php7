<?php 
require "jssdk.php";
$jssdk = new JSSDK("wx80c487097b512789", "422d3a86338493d2f7b0e56507e5ac19");//你的appid,appsecret
$signPackage = $jssdk->GetSignPackage();
// $Getpicture = $jssdk->Getpicture();
// print_r($signPackage);die;

$news = array("Title" =>"微信公众平台开发实践", "Description"=>"本书共分10章，案例程序采用广泛流行的PHP、MySQL、XML、CSS、JavaScript、HTML5等程序语言及数据库实现。", "PicUrl" =>'http://images.cnitblog.com/i/340216/201404/301756448922305.jpg', "Url" =>'http://www.cnblogs.com/txw1958/p/weixin-development-best-practice.html'); 

?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>maidashuzi技术部工作周报</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0,user-scalable=no" name="viewport" id="viewport" />
    <link rel="stylesheet" href="css/normalize.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/page/index-6.css">
    <!--javascript-->
    <script src="js/jquery-1.11.3.min.js"></script>
    <script src="libs/echarts/echarts.min.js"></script>

    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script src="js/wx/sha1.js"></script>
    <script>
        wx.config({
            debug: false,
            appId: '<?php echo $signPackage['appId']; ?>',
            timestamp: '<?php echo $signPackage['timestamp'];  ?>',
            nonceStr: '<?php echo $signPackage['nonceStr'];  ?>',
            signature: '<?php echo $signPackage['signature'];  ?>',
            jsApiList: [
                // 所有要调用的 API 都要加到这个列表中
                'checkJsApi',
                'onMenuShareTimeline',
                'onMenuShareAppMessage'
            ]
        });

        /*wx.checkJsApi({
            jsApiList: [
                'getLocation',
                'onMenuShareTimeline',
                'onMenuShareAppMessage'
            ],
            success: function (res) {
                alert("失败");
                alert(JSON.stringify(res));
            }
        });*/

        wx.onMenuShareAppMessage({
          title: '<?php echo $news['Title'];?>',
          desc: '<?php echo $news['Description'];?>',
          link: '<?php echo $signPackage['url'];?>',
          imgUrl: '<?php echo $news['PicUrl'];?>',
          trigger: function (res) {
            // 不要尝试在trigger中使用ajax异步请求修改本次分享的内容，因为客户端分享操作是一个同步操作，这时候使用ajax的回包会还没有返回
            alert('用户点击发送给朋友');
          },
          success: function (res) {
            alert('已分享');
          },
          cancel: function (res) {
            alert('已取消');
          },
          fail: function (res) {
            alert("失败");
            // alert(JSON.stringify(res));
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
                <h3>工作总结</h3>
            </div>
            <div class="info">
                <div class="part" style="padding-left: 0.5em;padding-right: 0.5em;">
                    <ul>
                        <li>1）和EC数据合作项目推进，就数据模型结构、正负样本界定、算法选型、EC数据提供等事项进行了深入交流和讨论，EC方数据提供还未确定，待进一步商讨；</li>
                        <li>2）营销DB的线索数据优化工作，依据上周制定方案稳步进行，依托我们的配置化爬虫平台，对数据维度和数据源的拓展工作进行顺利，和EC的自动化导入接口也已准备完成，下周开始尝试和EC自动对接；</li>
                        <li>3）投资DB，持续进行数据爬取和完善工作，并为下一步平台功能设计、数据源积累等目标，开始对国内外投融资相关产品及网站进行分析调研；</li>
                        <li>4）爬虫系统优化、情感分析和服务层架构等平台研发和技术积累工作稳步进行，进行18年预算工作；</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="page page2 group" id="page2">
            <div class="title title2">
                <h3>分项进展总结</h3>
            </div>
            <div class="info">
                <div class="part">
                    <p>数据平台</p>
                    <ul>
                        <li>1）以酒店评论数据作为样本，使用word2vec、svm等算法建立文本的情感分析模型，测验模型准确度达80%，后续计划使用该模型进行企业舆情分析，获取相应的新闻舆情样本数据，套入模型代码并调整参数即可；</li>
                        <li>2）进行营销线索模型的建模工作，并进行工程的计划的制定，重点与高明沟通并整理双方的数据情况，统一双方的建模工作思路；</li>
                        <li>3）调研国内外投融资相关产品及网站，分析相关产品功能；</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="page page2 group" id="page3">
            <div class="title title2">
                <h3>分项进展总结</h3>
            </div>
            <div class="info">
                <div class="part">
                    <p>爬虫系统</p>
                    <ul>
                        <li>1）继续营销线索的获取以及优化工作，已完成数据模型完善和抓取策略确定，并对爬取数据源进行了拓展，包括智联、前程等网站；</li>
                        <li>2）继续进行IT桔子投资数据的分析和获取工作，并依托天眼查、企查查等对数据进行补充，重点分析和解决天眼查的反爬处理；</li>
                        <li>3）爬虫系统配置化工程，完成异常处理和入库的开发工作，进行全流程（配置、下载、解析、二次下载，二次解析，入库）的配置和调试，并对发现bug修复，实现配置化增量下载OK；</li>
                        <li>4）爬虫系统相关指标体系设计并开发，区分数据源和时间戳等多维度，包括任务数、成功数据量、失败数据量、线索信息量，系统运行情况等等；</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="page page2 group" id="page4">
            <div class="title title2">
                <h3>分项进展总结</h3>
            </div>
            <div class="info">
                <div class="part">
                    <p>服务中心</p>
                    <ul>
                        <li>1）完成营销线索数据导入EC批量创建客户、标签设置的调用开发工作，重点解决分批次导入以及反馈crmid等数据记录功能；</li>
                        <li>2）搭建分布式配置中心——Disconf的环境，及各环境的docker化，及springboot项目与Disconf的集成；
                            <span style="display: inline-block;padding-top: .2em;font-style: italic;">Disconf是百度开源分布式配置中心，能在项目运行时动态修改其中的变量值和配置文件，并提供相应的回调功能，属于在线不停机热发布和集中管理配置文件的利器</span>
                        </li>
                        <li>3）Springboot集成OAuth2认证功能，已完成客户端的配置功能：<a href="http://blog.csdn.net/tianyaleixiaowu/article/details/78281392">点击查看详情</a>；</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="page page2 group" id="page5">
            <div class="title title2">
                <h3>分项进展总结</h3>
            </div>
            <div class="info">
                <div class="part">
                    <p>前端展现</p>
                    <ul>
                        <li>1）完成对营销线索平台功能优化以及模型和方案设计工作，梳理平台分角色（企业管理者、销售经理、销售员工、平台管理）的细分功能和权限，并和销售团队进行了需求和体验沟通；</li>
                        <li>2）完成营销线索平台角色管理、组织管理、团队管理、成员管理等基础管理，营销线索的检索及推送，历史数据查询等部分的原型设计，待UI界面风格和样式设计；</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="page page3 group" id="page6">
            <div class="title title3">
                <h3>团队人员情况</h3>
            </div>
            <div class="table">
                <ul>
                    <li>目前在职:<span>9</span>人</li>
                    <li>待入职:<span>0</span>人</li>
                    <li>本周面试:<span>16</span>人</li>
                    <li>准备招聘：<span>1</span>人</li>
                    <li>计划复试：<span>3</span>人</li>
                    <li>人员缺口:数据科学家、数据分析工程师、python爬虫、JAVA开发、PHP开发</li>
                </ul>
            </div>
        </div>
        <div class="page page4 group" id="page7">
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
    <script src="js/page/index-6.js"></script>
    <script src="js/page/index-6-echarts-config.js"></script>
</body>
</html>
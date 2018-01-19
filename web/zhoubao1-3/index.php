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
        </div>
        <div class="page" id="page1">
            <div class="title">
                <div class="title-content">
                    <span class="title-1"></span><h3><?=$Title0; ?></h3><p class="title-line"></p>
                </div>
            </div>
            <div class="list-border">
                <p></p>
                <ul class="small">
                  <?php for ($i=0; $i <count($Content0); $i++) { ?>
                    <li><?=$Content0[$i]; ?></li>      
                  <?php } ?>
                </ul>
            </div>
        </div>
        <div class="page" id="page2">
            <div class="title">
                <div class="title-content">
                    <span class="title-2"></span><h3><?=$Title2; ?></h3><p class="title-line"></p>
                </div>
            </div>
            <div class="list-border">
                <h4 id="title"><?=$Title2_1; ?></h4>
                <ul class="small">
                  <?php for ($i=0; $i <count($Content2_1); $i++) { ?>
                    <li><?=$Content2_1[$i]; ?></li>      
                  <?php } ?>
                </ul>
            </div>
        </div>
        <div class="page" id="page3">
            <div class="title">
                <div class="title-content">
                    <span class="title-2"></span><h3><?=$Title3; ?></h3><p class="title-line"></p>
                </div>
            </div>
            <div class="list-border">
                <h4 id="title"><?=$Title3_1; ?></h4>
                <ul class="small">
                  <?php for ($i=0; $i <count($Content3_1); $i++) { ?>
                    <li><?=$Content3_1[$i]; ?></li>      
                  <?php } ?>
                </ul>
            </div>
        </div>
        <div class="page" id="page4">
            <div class="title">
                <div class="title-content">
                    <span class="title-2"></span><h3><?=$Title4; ?></h3><p class="title-line"></p>
                </div>
            </div>
            <div class="list-border">
                <h4 id="title"><?=$Title4_1; ?></h4>
                <ul class="small">
                  <?php for ($i=0; $i <count($Content4_1); $i++) { ?>
                    <li><?=$Content4_1[$i]; ?></li>      
                  <?php } ?>
                </ul>
            </div>
        </div>
    </div>
    <!--script-->
    <script src="js/jquery-1.11.3.min.js"></script>
    <!-- <script src="js/islider.min.js"></script> -->
    <script src="js/echarts.min.js"></script>
    <script src="js/echarts-map-china.min.js"></script>
    <!-- <script src="js/page/index.js"></script> -->
</body>
</html>

<script>
function ok8spost() {
        
        var strs= new Array(); //定义一数组 

        var data = {
                 pageT1:$("#page1  div[class='title']").text().replace(/\s/g, ""),//第一页的标题
                pageT2:$("#page2  div[class='title']").text().replace(/\s/g, ""),//第二页的标题
                pageT3:$("#page3  div[class='title']").text().replace(/\s/g, ""),//第三页的标题
                pageT4:$("#page4  div[class='title']").text().replace(/\s/g, ""),//第四页的标题
                // pageT5:$("#page5  div[class='title']").text().replace(/\s/g, ""),//第四页的标题


                pageST2:$("#page2 h4[id='title']").text().trim(),//正文第二页的小标题内容
                pageST3:$("#page3 h4[id='title']").text().trim(),//正文第三页的小标题内容
                pageST4:$("#page4 h4[id='title']").text().trim(),//正文第四页的小标题内容

                
                pageC1:$("#page1 ul[class='part']").text().trim(),//正文第一页的内容
                pageC2:$("#page2 ul[class='small']").text().trim(),//正文第一页的内容
                pageC3:$("#page3 ul[class='small']").text().trim(),//正文第二页的内容
                pageC4:$("#page4 ul[class='small']").text().trim(),//正文第三页的内容
                // pageC5:$("#page5 ul[class='small']").text().trim(),//正文第四页的内容
                // pageC5:$("#page8 ul[class='small']").text().trim(),//正文第五页的内容                

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

            window.location.href='show.php?essen_id=<?php echo $result['essen_id'];?>';
           
        });

        //编辑功能
        bodywidth=$(document.body).width()-30;
        
        $(document).on("click",clicklabel,function(){
            if(maskdiv){
                if($(this).attr("class")!="layui-layer-btn0" && $(this).attr("class")!="layui-layer-btn1" && $(this).parent().attr("id")!="myEditor" && $(this).attr("id")!="savenews" && $(this).attr("id")!="closeeditbtn" && $(this).attr("id")!="close_img" && $(this).attr("id")!="link_close"){
                    selcontent=$(this);
                    $(clicklabel).removeClass("edit_border");
                    $(this).addClass("edit_border");
                    
                    layer.tips('<div style="padding:5px 0px;width:210px;" id="editmenu"><div class="edit_btn" onclick="selcontent.remove();layer.closeAll();">删除</div><div class="edit_btn"  onclick="edittext(selcontent)">编辑</div><div class="edit_btn" style="margin-right:0px;" onclick="inserttext(selcontent)">插文字</div><div class="edit_btn" style="clear:both;margin-top:10px;" onclick="delnextall(selcontent)">删除后</div><div class="edit_btn" style="margin-top:10px;" onclick="delprevall(selcontent)">删除前</div><div class="edit_btn" style="float:left;margin-top:10px;margin-right:0px;" onclick="insertbanner(selcontent)">取消</div></div>',selcontent, {
                      tips: [3,"#78BA32"],
                      time:0,
                      area: ['auto', '100px'],
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
    <div class="bottombar" style="width:100%;text-align:center;position:fixed;left:0px;bottom:0px;height:60px;line-height:60px;z-index:99999">
    
    <div style="max-width:680px;margin:0 auto;background:#FF9000;color:#fff;">
    <a href="javascript:;" id="savenews" style="border:2px solid #fff;color:#fff;padding:5px 20px;border-radius:5px;"onclick="ok8spost()">保存文章</a>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <a  id="closeeditbtn" style="border:2px solid #fff;color:#fff;padding:5px 20px;border-radius:5px;" onclick="javascript:window.location.href='show.php?essen_id=<?php echo $result['essen_id']?>'">退出编辑</a>
    </div></div>
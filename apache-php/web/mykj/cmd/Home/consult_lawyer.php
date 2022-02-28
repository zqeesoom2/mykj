<!--header start-->
<!DOCTYPE html>
<html>
  <head>
    <title>法律平台</title>
    <meta charset="gbk">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    
    <link rel="stylesheet" href="../css/weui.min.css">
    <link rel="stylesheet" href="../css/jquery-weui.min.css">
    <link rel="stylesheet" href="../css/index.css">
    <style>
	.tr{text-align:right;}
	.border-bottom{border-bottom: 1px solid #ccc;}
	.pt03{padding-top:0.3rem;}.pt01{padding-top:0.1rem;}.pl03{padding-left:0.3rem;}.pr03{padding-right:0.3rem;} .pb03{padding-bottom:0.3rem;}
	.fgray{color:#ccc;}
	.evaluate{ border-bottom:1px solid #ccc;border-top:1px solid #ccc;}
	.green-f{color:#093}
	.org-f{color:#FD901B}
	.border-red{border:2px solid #900; color:#900}
	.l{margin-left:0.5rem;margin-top:0.3rem;}
	.bg-gray{background:#eee}
    </style>
</head>
<body ontouchstart>
<div class="ub white-bg mt0-1 border-bottom">
	<div class="red-f">&nbsp;<?php if($expire){ ?>
            已结束
        <?php }else{ ?>
            进行中
        <?php } ?></div>
	<div>&nbsp;|&nbsp;</div>
	<div><span id="replyNum">1</span>人回复</div>
	<div class="ub-f1 tr"><?php echo date('Y-m-d H:s',$arr['newstime']);?>&nbsp;</div>
</div>
<div class="white-bg pt03">

        &nbsp;<?php echo $arr['quiz'];?>

        <?php if ($arr['imgs']){ $imgs = explode('|',$arr['imgs']);foreach ($imgs as $val) { ?>
           <img class="w100" onclick="openImg('<?php echo $val ?>')" src="<?php echo $val; ?> "/>
        <?php }} ?>

	<a class="open-popup  pl03 pr03 pt03 border-red l pb03" href="javascript:;" data-target="#questionAnswer">
         回答问题
    </a>
</div>

<!--展示补充问题-->
<?php foreach ($arrSupplement as $item){  ?>
    <div class="white-bg pall0-5">

        <div class="bg-gray pall0-5">&nbsp;<?php echo $item['supplement']; ?> </div>

        <?php if ($item['imgs']){ $imgs = explode('|',$item['imgs']);foreach ($imgs as $val) { ?>
            <img class="w100" onclick="openImg('<?php echo $val ?>')" src="<?php echo $val; ?> "/>
        <?php }} ?>

    </div>
<?php } ?>
<!--end-->



<!--顾问回复-->
<div class="weui-flex useravatar">
	 <!--一个顾问开始-->
      <div class="weui-flex__item mt0-5">
     	 <a href="javascript:void(0);" class="weui-media-box weui-media-box_appmsg white-bg" id="fristuser">
                    <div class="weui-media-box__hd">
                      <img class="weui-media-box__thumb circular" src="<?php echo $Lawyer['avatar']; ?>" >
                    </div>
                    <div class="weui-media-box__bd ub" >
                          <div class="ub-f1" >
                             <h4 class="weui-media-box__title"><?php echo $Lawyer['username']; ?></h4>
                             <p class="weui-media-box__desc"><?php echo $Lawyer['company']; ?></p><!--工作单位-->
                          
                          </div>
                          <div class="pos-rel mt0-5">
                         	 <img src="../images/win.jpg" style="width:2rem">
                          </div>
                    </div>
            </a>
            <table border="0" width=100% class="white-bg">

                <!--回复-->
                <?php foreach($arrAnswer as $val){?>
            	<tr>
                	<td><img src="../images/chat.jpg" style="width:1rem" /></td>
                    <td>
                        <?php echo $val['answer'];?>
                        <?php if($val['imgs']){$imgs = explode('|',$val['imgs']);foreach ($imgs as $src) { ?>
                            <img class="w100" onclick="openImg('<?php echo $src ?>')" src="<?php echo $src; ?> "/>
                        <?php }} ?>
                    </td>
                    <td ><span class="fgray"><?php echo date('Y-m-d H:s',$val['newstime']);?>&nbsp;</span></td>
                </tr>
                    <!--追问-->
                    <?php $arrQuest = $this->Questing->getQuestionById($val['id']); foreach($arrQuest as $row){?>
                        <tr>
                            <td><img src="../images/questing.png" style="width:1rem" /></td>
                            <td>
                                <?php echo $row['question'];?>
                                <?php if($row['imgs']){$imgs = explode('|',$row['imgs']);foreach ($imgs as $src) { ?>
                                    <img class="w100" onclick="openImg('<?php echo $src ?>')" src="<?php echo $src; ?> "/>
                                <?php }} ?>
                            </td>
                            <td >
                                <span class="fgray"><?php echo date('Y-m-d H:s',$val['newstime']);?>&nbsp;</span>
                                <input type="hidden" class="lastAnswer<?php echo $userid;?>" value="<?php echo $val['id'];?>">
                            </td>
                        </tr>
                    <?php }?>
                    <!--追问end-->
                <?php } ?>
                <!--end-->

            </table>
            
             <table border="0" width=100% class="white-bg evaluate">
            	<tr align="center">
                	<td class="org-f" width="36%"><img style="width:1rem" class="fl" src="../images/chat.jpg"><a data-target="#questionAnswer" class="fl open-popup">回答问题</a></td>
                </tr>
            </table>
      </div>
      <!--一个顾问结束-->
</div>
<!--end-->

<!--回答问题-->
<div id="questionAnswer" class="weui-popup__container popup-bottom">
    <div class="weui-popup__overlay"></div>
    <div class="weui-popup__modal">
        <!--内容...-->
        <div class="toolbar">
            <div class="toolbar-inner">
                <a href="javascript:;" class="picker-button close-popup">关闭</a>
                <h1 class="title">回答问题</h1>
            </div>
        </div>
        <div class="modal-content">
            <table width="100%" border="0" cellpadding="0" cellspacing="10">
                <tr>
                    <td colspan="3">
                        <textarea class="weui-textarea" id="textarea" placeholder="请输入内容..." rows="8"></textarea>
                        <div class="w100" id="previewImage"></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a class="weui-navbar__item" href="javascript:;" id="upimg">
                            <img src="../images/update.png " height="22">

                        </a>
                    </td>
                    <td>
                        <a class="weui-navbar__item" href="javascript:;" id="startRecord">
                            <img src="../images/sound.png" height="22">语音转文字
                        </a>
                    </td>
                    <td>
                        <a href="javascript:;" id="submit" class="weui-btn bule-bg w85">提&nbsp;交</a>
                    </td>
                </tr>

            </table>
        </div>

        <!--end-->
    </div>
</div>
<!--end-->
<script src="http://res.wx.qq.com/open/js/jweixin-1.6.0.js"></script>
<script src="../js/jquery-2.1.4.js"></script>
<script src="../js/fastclick.js"></script>
<script src="../js/jquery-weui.min.js"></script>
<script src="../js/wx-lawyer.js"></script>
<script type='text/javascript' src='../js/swiper.min.js' charset='gbk'></script>
<script>
    wx.config({
        debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
        appId: '<?php echo $this->jssdk->appid; ?>', // 必填，公众号的唯一标识
        timestamp: <?php echo $this->jssdk->time ?>, // 必填，生成签名的时间戳
        nonceStr: 'Wm3WZYTPz0wzccnW', // 必填，生成签名的随机串
        signature: '<?php echo $this->jssdk->signature; ?>',// 必填，签名
        jsApiList:['chooseImage','uploadImage','downloadImage','startRecord','stopRecord','translateVoice']  // 必填，需要使用的JS接口列表
    });

    $(function() {
        FastClick.attach(document.body);
    });

    function openImg($src){
        var pb1 = $.photoBrowser({
            items: [$src]
        });

        pb1.open();
    }


</script>



</body>
</html>
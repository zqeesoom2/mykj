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
	.l{right:1rem;top:1rem;}
	.bg-gray{background:#eee}
    </style>
</head>
<body ontouchstart>
<div class="ub white-bg mt0-1 border-bottom">
	<div class="red-f">&nbsp;
        <?php if($expire){ ?>
            已结束
        <?php }else{ ?>
             进行中
        <?php } ?>
    </div>
	<div>&nbsp;|&nbsp;</div>
    <div><span id="replyNum"></span>人回复</div>
	<div class="ub-f1 tr"><?php echo date('Y-m-d H:s',$arr['newstime']);?>&nbsp;</div>
</div>
<div class="white-bg pt03">&nbsp;
    &nbsp;<?php echo $arr['quiz'];?>

    <?php if ($arr['imgs']){ $imgs = explode('|',$arr['imgs']);foreach ($imgs as $val) { ?>
        <img class="w100" onclick="openImg('<?php echo $val ?>')" src="<?php echo $val; ?> "/>
    <?php }} ?>

	<a class="open-popup pos-abs pl03 pr03 border-red l pb03" href="javascript:;" data-target="#Supplementary">
      补充问题
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


<!--补充的问题-->
<div id="Supplementary" class="weui-popup__container">
    <div class="weui-popup__overlay"> </div>
    <div class="weui-popup__modal" id="popup_modal">
        <!--你的内容放在这里...-->
        <div class="ub">
            <h4 class="tc ub-f1">补充的问题</h4>
            <a href="javascript:;" class="close-popup">取消</a></div>

        <div class="weui-cells weui-cells_form">
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <textarea class="weui-textarea" id="textarea" placeholder="请输入文本" rows="8"></textarea>
                    <div class="weui-textarea-counter">最少输入2个字符</div>
                </div>
            </div>
        </div>

        <div class="w100">
            <!--预览图片--><ul class="weui-uploader__files" id="preview"></ul>
        </div>

        <div class="weui-uploader__input-box">
            <form method="post" action="../Common/UploadImgs.html" enctype="multipart/form-data" name="img_form" target="uploadImg" id="img_form">
                <input id="uploaderInput" name="FileImgs[]" class="weui-uploader__input" onchange="fileUpImgs()" type="file" accept="image/*" multiple="">
            </form>
            <iframe  name="uploadImg" width="0" height="0" marginwidth="0" frameborder="0" src="about:blank"></iframe>
        </div>

        <div class="demos-content-padded mt0-5">
            <a href="javascript:;" id="submit" class="weui-btn bule-bg w85">提&nbsp;交</a>
        </div>
        <!--end-->
    </div>
</div>
<!--补充问题end-->

<!--回复list $userid代表谁回复的-->
<?php if(!empty($arrUsers)){ foreach ($arrUsers as $userid ){  $Lawyer = $UserModel->getUserById($userid); ?>
<div class="weui-flex useravatar">
	 <!--一个顾问开始-->
      <div class="weui-flex__item mt0-5">
     	 <a href="javascript:void(0);" class="weui-media-box weui-media-box_appmsg white-bg">
                    <div class="weui-media-box__hd">
                      <img class="weui-media-box__thumb circular" src="<?php echo $Lawyer['avatar']; ?>" >
                    </div>
                    <div class="weui-media-box__bd ub" >
                          <div class="ub-f1" >
                             <h4 class="weui-media-box__title"><?php echo $Lawyer['username']; ?></h4>
                             <p class="weui-media-box__desc"><?php echo $Lawyer['company']; ?></p>
                          </div>
                          <!--获取评价，中标-->
                          <?php $arrValuat = $this->valuat->getByIds($id,$this->uid,$userid);  if( isset($arrValuat['win']) && $arrValuat['win'] ){ ?>
                          <div class="pos-rel mt0-5">
                                <img src="../images/win.jpg" style="width:2rem">
                          </div>
                          <?php  } ?>
                    </div>
            </a>
            <table border="0" width=100% class="white-bg">
                <!--回复-->
                <?php foreach($arrAnswer as $val){ if($val['uid']==$userid) { ?>
                    <tr>
                        <td><img src="../images/chat.jpg" style="width:1rem" /></td>
                        <td>
                            <?php echo $val['answer'];?>
                            <?php if($val['imgs']){$imgs = explode('|',$val['imgs']);foreach ($imgs as $src) { ?>
                                <img class="w100" onclick="openImg('<?php echo $src ?>')" src="<?php echo $src; ?> "/>
                            <?php }} ?>
                        </td>
                        <td >
                            <span class="fgray"><?php echo date('Y-m-d H:s',$val['newstime']);?>&nbsp;</span>
                            <input type="hidden" class="lastAnswer<?php echo $userid;?>" value="<?php echo $val['id'];?>">
                        </td>
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
                <?php }}  ?>
                <!--end-->
            </table>
                <!--咨询的评价 -->
                <table border="0" width=100% class="white-bg evaluate">
                    <tr align="center">
                        <?php  if($expire){ ?>
                            <!-- 过期的咨询，评价否start-->
                            <td  width="36%"><img style="width:1rem" class="fl" src="../images/reply.png">
                                <?php
                                if(isset($arrValuat['valuation']) && $arrValuat['valuation']  ){ ?>
                                   <a class="fl org-f">已评价</a>
                                <?php }else{?>
                                    <!--评价页面-->
                                <a  href="../appraisal_lawyer.html?byuid=<?php echo $userid; ?>&uid=<?php echo $arr['uid'];?>&id=<?php echo $id;?>" class="fl org-f">未评价</a>
                                <?php }?>
                            </td>

                        <?php }else{ ?><!--没有过期-进行中的咨询-->

                            <td class="org-f">
                                <img style="width:1rem" class="fl" src="../images/reply.png"><a href="javascript:Questioning('<?php echo $Lawyer['username']; ?>',<?php echo $userid;?>);" class="fl">追问</a>
                            </td>
                            <?php  if( isset($arrValuat['win']) &&  !$arrValuat['win'] ){ ?>
                                <td  ><img style="width:1rem" class="fl" src="../images/Winning.png"><a id="Winning<?php echo $userid; ?>"  href="javascript:valuat(<?php echo $userid; ?>,<?php echo $arr['uid'];?>,<?php echo $id;?>,'Winning');" class="fl">中标</a></td>
                            <?php  } ?>

                        <?php } ?>

                            <td  width="30%"><img style="width:1rem" class="fl" src="../images/thumbs-up.png">
                                 <?php  if(isset($arrValuat['like']) && $arrValuat['like'] ){ ?>
                                     <a class="fl green-f">已赞</a>
                                 <?php  }else{ ?>
                                     <a id="ThumbsUp<?php echo $userid; ?>" href="javascript:valuat(<?php echo $userid; ?>,<?php echo $arr['uid'];?>,<?php echo $id;?>,'ThumbsUp');" class="fl green-f">赞</a>
                                 <?php  } ?>
                            </td>

                            <td class="red-f" width="33%" ><img style="width:1rem"  class="fl" src="../images/money.png"><span class="fl">送红包</span></td>
                    </tr>
                </table>

                <!--end -->


      </div>
      <!--一个顾问结束-->
</div>
<?php }} ?>


<!--追问-->
<div id="Questioning" class="weui-popup__container popup-bottom">
    <div class="weui-popup__overlay"></div>
    <div class="weui-popup__modal">
        <!--内容...-->
        <div class="toolbar">
            <div class="toolbar-inner">
                <a href="javascript:;" class="picker-button close-popup">关闭</a>
                <h1 class="title" id="title">标题</h1>
            </div>
        </div>
        <div class="modal-content">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td colspan="3">
                        <textarea class="weui-textarea" id="Questing" placeholder="请输入内容..." rows="8"></textarea>
                        <input type="hidden" value="" id="lastAnswerId"/>
                        <input type="hidden" value="" id="toUserid"/>

                        <div class="w100" id="previewImage"></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a class="weui-navbar__item" href="javascript:;" id="WxUpimg">
                            <img src="../images/update.png " height="22">
                        </a>
                    </td>
                    <td>
                        <a class="weui-navbar__item" href="javascript:;" id="startRecord">
                            <img src="../images/sound.png" height="22">语音转文字
                        </a>
                    </td>
                    <td>
                        <a href="javascript:;" id="submitQuesting" class="weui-btn bule-bg w85">提&nbsp;交</a>
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
<script src="../js/wx-user.js"></script>
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

    //被评价的用户，评价的用户，评价的咨询ID,是点赞还是中标
    function valuat(byuid,uid,qid,type){
        data = {'byuid':byuid,'uid':uid,'qid':qid};

        $.ajax({
            cache:false,
            async: false,//同步加载数据，锁定用户交互。 默认是true异步方式
            url:'../Valuation/'+type+'.html',
            type:'post',
            datatype:'text',
            data:{param:JSON.stringify(data)},
            beforeSend:function(){
                $.showLoading();
                //这个样式是遮罩层：避免重复提交按钮
                div = $('<div id="lasts" class="weui-mask_transparent"></div>');
                $('body').append(div);
            },
            success:function(res){
                $.hideLoading();
                div.remove();

                if(res=='OK'){

                    if(type=='Winning'){
                        $('#'+type+byuid).text('已中');
                    }else{
                       $('#'+type+byuid).text('已赞');

                    }


                }

            }
        });
    }

    $(function() {
        FastClick.attach(document.body);

        //有多少人回复
       $("#replyNum").html( $(".useravatar").length );


    });

    //浏览图片
    function openImg($src){
        var pb1 = $.photoBrowser({
            items: [$src]
        });

        pb1.open();
    }

    //异步上传图片
    function fileUpImgs(){
        var form = $('#img_form');
        form.submit();
    }

    //提交补充的问题
    $("#submit").click(function(){
        var text = $('#textarea').val();
        var style = '', result = '',imgs = '',div;

        $('#preview > li').each(function (index, domEle) {
            style = $(domEle).attr('style');
            result = /.*\((.*\.jpg)\)/.exec(style);
            if(result.length > 1){
                if(index){
                    imgs += '|'+result[1];
                }else{
                    imgs = result[1];
                }
            }else{
                console.log('图片提交失败');
            }

        });

        //type 补充类型
        data = {'quiz':text,'imgs':imgs,'type':'supplement'};

        if(text.length>2){
            $.ajax({
                cache:false,
                async: false,//同步加载数据，锁定用户交互。 默认是true异步方式
                url:'',
                type:'post',
                datatype:'text',
                data:{param:JSON.stringify(data)},
                beforeSend:function(){
                    $.showLoading();
                    //这个样式是遮罩层：避免重复提交按钮
                     div = $('<div id="lasts" class="weui-mask_transparent"></div>');
                    $('body').append(div);
                },
                success:function(res){
                    $.hideLoading();
                    div.remove();
                    var info = '提交失败！';
                    if(res=='OK'){
                        info = '提交成功！';
                        $.closePopup();
                        $('#textarea').val('');
                        $('#preview').empty();//清空预览的图片

                    }
                    $.alert(info);
                }
            });
        }
    });

    //打开追问界面
    function Questioning(lawyer,userid){
        $('#title').html(lawyer);
        //是那个用户，最后的回答的ID是
        var lastAnswerId = $(".lastAnswer"+userid+":last").val();
        $("#lastAnswerId").val(lastAnswerId);
        $("#toUserid").val(userid);//向谁发送通知

        $("#Questioning").popup();
    }

</script>
</body>
</html>
<!--header start-->
<!DOCTYPE html>
<html>
  <head>
    <title><?php echo '法律平台123'; ?></title>
    <meta charset="gb2312">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

<meta name="description" content="Write an awesome description for your new site here. You can edit this line in _config.yml. It will appear in your document head meta (for Google search results) and in your feed.xml site description.
">

<link rel="stylesheet" href="./Home/css/weui.min.css">
<link rel="stylesheet" href="./Home/css/jquery-weui.min.css">
<link rel="stylesheet" href="./Home/css/index.css">
<style>
      .placeholder {
        margin: 5px;
        padding: 0 10px;
        background-color: #ebebeb;
        height: 2.3rem;
        line-height: 2.3rem;
        text-align: center;
        color: #999;
      }
    </style>
  </head>
<body ontouchstart>
<!--header end-->
<!--content-->
	<div class="wrap  white-bg m-c">
    	<!--幻灯片-->
    	<div class="Banner">
            <div class="swiper-container" id="swiper">
                  <!-- Additional required wrapper -->
                  <div class="swiper-wrapper">
                    <!-- Slides 自适应随图片高度变化-->
                    <!--640 * 480 
                      <div class="swiper-slide"><img src="./Home/images/swiper-1.jpg" /></div>
                      <div class="swiper-slide"><img src="./Home/images/swiper-2.jpg"/></div>
                      <div class="swiper-slide"><img src="./Home/images/swiper-3.jpg"/></div>
                    -->
                    <!--640 * 300 
                      <div class="swiper-slide"><img src="./Home/images/banner1.jpg" /></div>
                      <div class="swiper-slide"><img src="./Home/images/banner2.jpg" /></div>
                     -->
                     <!--1126 * 938 -->
                      <div class="swiper-slide"><img src="./Home/images/0.jpg" width="100%"/></div>
                  </div>
                 
                  <!-- If we need pagination -->
                  <div class="swiper-pagination"></div>
            </div>
           
         </div>
         <!--幻灯片 end-->
         
         <div class="NavMain">
         
         	<!--文字切换-->
            <ul id="pics" class="hidden">
            	<li class="pos-abs lh0">张**....提交了咨询问题</li>
                <li class="pos-abs lh0">***选择顾问中标</li>
                <li class="pos-abs lh0">崔**给律师点赞</li>
            </ul>
         	<div class="weui-cell weui-cell_access weui-cell_link white-bg br10gray of">
         		<div class="weui-cell__bd pos-rel" id="dopics"></div>
                <span ><img src="./Home/images/wenhao.png" height="22"></span>
            </div>
         
            <div class="weui-cells weui-cells_form mt0">
              <div class="weui-cell">
                <div class="weui-cell__bd">
                  <textarea class="weui-textarea" placeholder="请输入咨询内容..." id="textarea" rows="8"></textarea>
                    <div class="w100" id="previewImage"></div>
                </div>
              </div>
            </div>
            
            <div class="weui-tab navbar_bg zi1">
                      <div class="weui-navbar">
                        <a class="weui-navbar__item" id="startRecord">
                          <img src="./Home/images/sound.png" height="22">语音转文字
                        </a>
                        <a class="weui-navbar__item" href="#tab2" id="upimg">
                         <img src="./Home/images/update.png " height="22">上传图片
                        </a>
                       
                      </div>
             </div>
             
             <div class="weui-cell white-bg mt0-5">
                <div class="weui-cell__bd ">
                  <input class="weui-input" id="mobile" type="text" placeholder="请输入手机号（选填）">
                </div>
     		 </div>
             
             <div class="demos-content-padded mt0-5">
      				<a href="javascript:;" id="submit" class="weui-btn bule-bg w85">提交问题</a>
  			  </div>
                
              <center class="mt0-5">1589名本地法律顾问在线支撑</center>
              
              <!--顾问-->
              <div class="w100 of">
                      <div class="weui-flex white-bg of-x-scroll of-y">
                            <!--4个一组-->
                          <div class="weui-flex__item white-bg w4-6 pr1">
                            <div class="placeholder2 ub ub-ver">
                                <div> <img class="circular" src="./Home/images/avatar.jpg" > </div>
                                <div class="fs0-5">用户名</div>
                            </div>
                          </div>
                          
                          <div class="weui-flex__item white-bg w4-6 pr1">
                            <div class="placeholder2 ub ub-ver">
                                <div> <img class="circular" src="./Home/images/avatar.jpg" > </div>
                                <div class="fs0-5">用户名</div>
                            </div>
                          </div>
                          
                          <div class="weui-flex__item white-bg w4-6 pr1">
                            <div class="placeholder2 ub ub-ver">
                                <div> <img class="circular" src="./Home/images/avatar.jpg" > </div>
                                <div class="fs0-5">用户名</div>
                            </div>
                          </div>
                          
                          <div class="weui-flex__item white-bg w4-6 pr1">
                            <div class="placeholder2 ub ub-ver">
                                <div> <img class="circular" src="./Home/images/avatar.jpg" > </div>
                                <div class="fs0-5">用户名</div>
                            </div>
                          </div>
                          
                          <div class="weui-flex__item white-bg w4-6 pr1">
                            <div class="placeholder2 ub ub-ver">
                                <div> <img class="circular" src="./Home/images/avatar.jpg" > </div>
                                <div class="fs0-5">用户名</div>
                            </div>
                          </div>
                          
                          <div class="weui-flex__item white-bg w4-6 pr1">
                            <div class="placeholder2 ub ub-ver">
                                <div> <img class="circular" src="./Home/images/avatar.jpg" > </div>
                                <div class="fs0-5">用户名</div>
                            </div>
                          </div>
                          
                           
                          <div class="weui-flex__item white-bg w4-6 pr1">
                            <div class="placeholder2 ub ub-ver">
                                <div> <img class="circular" src="./Home/images/avatar.jpg" > </div>
                                <div class="fs0-5">用户名</div>
                            </div>
                          </div>
                          
                          <div class="weui-flex__item white-bg w4-6 pr1">
                            <div class="placeholder2 ub ub-ver">
                                <div> <img class="circular" src="./Home/images/avatar.jpg" > </div>
                                <div class="fs0-5">用户名</div>
                            </div>
                          </div>
                          
                          <div class="weui-flex__item white-bg w4-6 pr1">
                            <div class="placeholder2 ub ub-ver">
                                <div> <img class="circular" src="./Home/images/avatar.jpg" > </div>
                                <div class="fs0-5">用户名</div>
                            </div>
                          </div>
                         
                     </div>
                </div>
              <!--end-->
              
              <div class="weui-cells__title bule-f">咨询说明</div>
              <div class="weui-cells__title block-f">1、您提交咨询的问题，10分钟之内就有法律顾问回复，至少匹配3名法律顾问为您免费解答，而且可以不限次数免费追问，直到满意为止。</div>
               <div class="weui-cells__title block-f">2、您提交咨询的问题，10分钟之内就有法律顾问回复，至少匹配3名法律顾问为您免费解答，而且可以不限次数免费追问，直到满意为止。</div>
              
 <!--用户评论-->
   <div id="list">
       <div class="weui-panel weui-panel_access mt0-5">
              
                <div class="weui-panel__bd  mt0-5">
                 <center>
               		 <h3 class="block6-f">用户心声</h3>
                 	 <div class="block9-f">已为<font color="#FF9900">800</font>个用户解答法律问题</div>
                  </center>
                  <a href="javascript:void(0);" class="weui-media-box weui-media-box_appmsg" id="fristuser">
                    <div class="weui-media-box__hd">
                      <img class="weui-media-box__thumb circular" src="./Home/images/avatar.jpg" >
                    </div>
                    <div class="weui-media-box__bd ub" >
                          <div class="ub-f1" >
                             <h4 class="weui-media-box__title">用户名</h4>
                             <p class="weui-media-box__desc">非常满意</p>
                              <p class="weui-media-box__desc mt0-5">2021-05-01</p>
                          </div>
                          <div class="pos-rel mt1">
                          	
                         	 <img src="./Home/images/start.png"><img src="./Home/images/start.png"><img src="./Home/images/start.png"><img src="./Home/images/start.png">
                               
                          </div>
                    </div>
                  </a>
                </div>
                <div class="weui-panel__ft">
                  <a href="javascript:void(0);" class="weui-cell weui-cell_access weui-cell_link">
                    <center class="weui-cell__bd">查看更多</center>
                   
                  </a>    
                </div>
      </div>
  </div>
<!--用户评论end-->
<!--滚动加载start-->
             <div class="weui-loadmore hidden" id="loadmore">
                 <i class="weui-loading"></i>
                 <span class="weui-loadmore__tips">正在加载</span>
             </div>
<!--滚动加载end-->

                
              
                 
      <div class="both"></div>
               
          
     </div>
   
     </div>
   <div class="weui-flex__item">

       <div class="placeholder">咨询电话：0743-8</div>


   </div>
 <!--content end-->
 <!--footer start-->
<script src="http://res.wx.qq.com/open/js/jweixin-1.6.0.js"></script>
<script>

    wx.config({
        debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
        appId: '<?php echo $jssdk->appid; ?>', // 必填，公众号的唯一标识
        timestamp: <?php echo $jssdk->time ?>, // 必填，生成签名的时间戳
        nonceStr: 'Wm3WZYTPz0wzccnW', // 必填，生成签名的随机串
        signature: '<?php echo $jssdk->signature; ?>',// 必填，签名
        jsApiList:['chooseImage','uploadImage','downloadImage','startRecord','stopRecord','translateVoice']  // 必填，需要使用的JS接口列表
    });
</script>


<script src="./Home/js/jquery-2.1.4.js"></script>
<script src="./Home/js/fastclick.js"></script>
<script>
  $(function() {
    FastClick.attach(document.body);

  });
</script>
<script src="./Home/js/jquery-weui.min.js"></script>
<script src="./Home/js/swiper.min.js"></script>
 
<script>
  /*幻灯片$("#swiper").swiper({
	loop: true,
	autoplay: 3000
  });*/
  
  /*文字切换*/
  /*思路原理：
  1.最顶层的父元素肯定是要overflow:hidden的；
  2.移动的原子元素是position:absolute, 动画left,top属性
  3.移动的原子元素的上层父元素是position:relative，叫动画容器
  4.数据源放到隐藏的ul中，通过setInterval，把遍历ul数据源到动画容器中实现效果。
  */
var time1;
var n=0;
var ul=$("#pics");
var for_num = ul.children().length;
var scroll_con = $('#dopics');
var con_height = scroll_con.height();

//在动画容器中切换数据源
 function run(){
	
	if(n>for_num){
		n=0;
	}
	
	var scroll_li = scroll_con.children('li:first');
	
	if (scroll_li.length>0){
		
		//这里的动画是异步操作，回调函数在整个run的生命周期结束后执行
		scroll_li.animate({top: '-2rem'}, "normal",'linear',function(){
		
				scroll_con.empty();
				//添加文字进切换容器
				
				ul.find(':eq('+n+')').clone().appendTo(scroll_con);
				++n;
			
			});
	}else{
		
		ul.find(':eq('+n+')').clone().appendTo(scroll_con);
		++n;
	}
	
	//这里在动画调用前之执行，导致切换顺序不一致，所以这里要注释，放到动画里面去
	//++n;
	
	
 }
 
 //如果只有一个元素就不要切了
 if(for_num>1){
	  //5秒钟进行交替切片
      time1=setInterval("run()",5000);
}else{
	run();
}


  //滚动加载事件，距离底部50px触发,这里的作用是调用JS初始化滚动加载插件
  $(document.body).infinite();

  //在 body 上触发 infinite 事件。监听此事件
  var loading = false;  //infinite 事件可能会触发多次。需要自己来控制不要同时进行多个加载。通过一个 loading 标记位状态来控制。
  $(document.body).infinite().on("infinite", function() {
      if(loading) return;
      $('#loadmore').show();
      loading = true;

      setTimeout(function() {
          $("#list").append("<p> 我是新加载的内容 </p>");
          loading = false;
          $('#loadmore').hide();
         // $(document.body).infinite();
          /*
          * 调用 $(document.body).destroyInfinite() 可以销毁插件。之后可以再次调用 $(document.body).infinite() 来重新初始化.
            不过即使销毁插件，也不会把加载指示器的HTML代码删除，所以需要隐藏或者删除它。
          * */
      }, 1500);   //模拟延迟
  });
 
</script>
<script src="./Home/js/wx.js"></script>

  </body>
</html>
<!--footer end-->

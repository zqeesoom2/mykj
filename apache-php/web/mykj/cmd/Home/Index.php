<!--header start-->
<!DOCTYPE html>
<html>
  <head>
    <title><?php echo '����ƽ̨123'; ?></title>
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
    	<!--�õ�Ƭ-->
    	<div class="Banner">
            <div class="swiper-container" id="swiper">
                  <!-- Additional required wrapper -->
                  <div class="swiper-wrapper">
                    <!-- Slides ����Ӧ��ͼƬ�߶ȱ仯-->
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
         <!--�õ�Ƭ end-->
         
         <div class="NavMain">
         
         	<!--�����л�-->
            <ul id="pics" class="hidden">
            	<li class="pos-abs lh0">��**....�ύ����ѯ����</li>
                <li class="pos-abs lh0">***ѡ������б�</li>
                <li class="pos-abs lh0">��**����ʦ����</li>
            </ul>
         	<div class="weui-cell weui-cell_access weui-cell_link white-bg br10gray of">
         		<div class="weui-cell__bd pos-rel" id="dopics"></div>
                <span ><img src="./Home/images/wenhao.png" height="22"></span>
            </div>
         
            <div class="weui-cells weui-cells_form mt0">
              <div class="weui-cell">
                <div class="weui-cell__bd">
                  <textarea class="weui-textarea" placeholder="��������ѯ����..." id="textarea" rows="8"></textarea>
                    <div class="w100" id="previewImage"></div>
                </div>
              </div>
            </div>
            
            <div class="weui-tab navbar_bg zi1">
                      <div class="weui-navbar">
                        <a class="weui-navbar__item" id="startRecord">
                          <img src="./Home/images/sound.png" height="22">����ת����
                        </a>
                        <a class="weui-navbar__item" href="#tab2" id="upimg">
                         <img src="./Home/images/update.png " height="22">�ϴ�ͼƬ
                        </a>
                       
                      </div>
             </div>
             
             <div class="weui-cell white-bg mt0-5">
                <div class="weui-cell__bd ">
                  <input class="weui-input" id="mobile" type="text" placeholder="�������ֻ��ţ�ѡ�">
                </div>
     		 </div>
             
             <div class="demos-content-padded mt0-5">
      				<a href="javascript:;" id="submit" class="weui-btn bule-bg w85">�ύ����</a>
  			  </div>
                
              <center class="mt0-5">1589�����ط��ɹ�������֧��</center>
              
              <!--����-->
              <div class="w100 of">
                      <div class="weui-flex white-bg of-x-scroll of-y">
                            <!--4��һ��-->
                          <div class="weui-flex__item white-bg w4-6 pr1">
                            <div class="placeholder2 ub ub-ver">
                                <div> <img class="circular" src="./Home/images/avatar.jpg" > </div>
                                <div class="fs0-5">�û���</div>
                            </div>
                          </div>
                          
                          <div class="weui-flex__item white-bg w4-6 pr1">
                            <div class="placeholder2 ub ub-ver">
                                <div> <img class="circular" src="./Home/images/avatar.jpg" > </div>
                                <div class="fs0-5">�û���</div>
                            </div>
                          </div>
                          
                          <div class="weui-flex__item white-bg w4-6 pr1">
                            <div class="placeholder2 ub ub-ver">
                                <div> <img class="circular" src="./Home/images/avatar.jpg" > </div>
                                <div class="fs0-5">�û���</div>
                            </div>
                          </div>
                          
                          <div class="weui-flex__item white-bg w4-6 pr1">
                            <div class="placeholder2 ub ub-ver">
                                <div> <img class="circular" src="./Home/images/avatar.jpg" > </div>
                                <div class="fs0-5">�û���</div>
                            </div>
                          </div>
                          
                          <div class="weui-flex__item white-bg w4-6 pr1">
                            <div class="placeholder2 ub ub-ver">
                                <div> <img class="circular" src="./Home/images/avatar.jpg" > </div>
                                <div class="fs0-5">�û���</div>
                            </div>
                          </div>
                          
                          <div class="weui-flex__item white-bg w4-6 pr1">
                            <div class="placeholder2 ub ub-ver">
                                <div> <img class="circular" src="./Home/images/avatar.jpg" > </div>
                                <div class="fs0-5">�û���</div>
                            </div>
                          </div>
                          
                           
                          <div class="weui-flex__item white-bg w4-6 pr1">
                            <div class="placeholder2 ub ub-ver">
                                <div> <img class="circular" src="./Home/images/avatar.jpg" > </div>
                                <div class="fs0-5">�û���</div>
                            </div>
                          </div>
                          
                          <div class="weui-flex__item white-bg w4-6 pr1">
                            <div class="placeholder2 ub ub-ver">
                                <div> <img class="circular" src="./Home/images/avatar.jpg" > </div>
                                <div class="fs0-5">�û���</div>
                            </div>
                          </div>
                          
                          <div class="weui-flex__item white-bg w4-6 pr1">
                            <div class="placeholder2 ub ub-ver">
                                <div> <img class="circular" src="./Home/images/avatar.jpg" > </div>
                                <div class="fs0-5">�û���</div>
                            </div>
                          </div>
                         
                     </div>
                </div>
              <!--end-->
              
              <div class="weui-cells__title bule-f">��ѯ˵��</div>
              <div class="weui-cells__title block-f">1�����ύ��ѯ�����⣬10����֮�ھ��з��ɹ��ʻظ�������ƥ��3�����ɹ���Ϊ����ѽ�𣬶��ҿ��Բ��޴������׷�ʣ�ֱ������Ϊֹ��</div>
               <div class="weui-cells__title block-f">2�����ύ��ѯ�����⣬10����֮�ھ��з��ɹ��ʻظ�������ƥ��3�����ɹ���Ϊ����ѽ�𣬶��ҿ��Բ��޴������׷�ʣ�ֱ������Ϊֹ��</div>
              
 <!--�û�����-->
   <div id="list">
       <div class="weui-panel weui-panel_access mt0-5">
              
                <div class="weui-panel__bd  mt0-5">
                 <center>
               		 <h3 class="block6-f">�û�����</h3>
                 	 <div class="block9-f">��Ϊ<font color="#FF9900">800</font>���û����������</div>
                  </center>
                  <a href="javascript:void(0);" class="weui-media-box weui-media-box_appmsg" id="fristuser">
                    <div class="weui-media-box__hd">
                      <img class="weui-media-box__thumb circular" src="./Home/images/avatar.jpg" >
                    </div>
                    <div class="weui-media-box__bd ub" >
                          <div class="ub-f1" >
                             <h4 class="weui-media-box__title">�û���</h4>
                             <p class="weui-media-box__desc">�ǳ�����</p>
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
                    <center class="weui-cell__bd">�鿴����</center>
                   
                  </a>    
                </div>
      </div>
  </div>
<!--�û�����end-->
<!--��������start-->
             <div class="weui-loadmore hidden" id="loadmore">
                 <i class="weui-loading"></i>
                 <span class="weui-loadmore__tips">���ڼ���</span>
             </div>
<!--��������end-->

                
              
                 
      <div class="both"></div>
               
          
     </div>
   
     </div>
   <div class="weui-flex__item">

       <div class="placeholder">��ѯ�绰��0743-8</div>


   </div>
 <!--content end-->
 <!--footer start-->
<script src="http://res.wx.qq.com/open/js/jweixin-1.6.0.js"></script>
<script>

    wx.config({
        debug: false, // ��������ģʽ,���õ�����api�ķ���ֵ���ڿͻ���alert��������Ҫ�鿴����Ĳ�����������pc�˴򿪣�������Ϣ��ͨ��log���������pc��ʱ�Ż��ӡ��
        appId: '<?php echo $jssdk->appid; ?>', // ������ںŵ�Ψһ��ʶ
        timestamp: <?php echo $jssdk->time ?>, // �������ǩ����ʱ���
        nonceStr: 'Wm3WZYTPz0wzccnW', // �������ǩ���������
        signature: '<?php echo $jssdk->signature; ?>',// ���ǩ��
        jsApiList:['chooseImage','uploadImage','downloadImage','startRecord','stopRecord','translateVoice']  // �����Ҫʹ�õ�JS�ӿ��б�
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
  /*�õ�Ƭ$("#swiper").swiper({
	loop: true,
	autoplay: 3000
  });*/
  
  /*�����л�*/
  /*˼·ԭ��
  1.���ĸ�Ԫ�ؿ϶���Ҫoverflow:hidden�ģ�
  2.�ƶ���ԭ��Ԫ����position:absolute, ����left,top����
  3.�ƶ���ԭ��Ԫ�ص��ϲ㸸Ԫ����position:relative���ж�������
  4.����Դ�ŵ����ص�ul�У�ͨ��setInterval���ѱ���ul����Դ������������ʵ��Ч����
  */
var time1;
var n=0;
var ul=$("#pics");
var for_num = ul.children().length;
var scroll_con = $('#dopics');
var con_height = scroll_con.height();

//�ڶ����������л�����Դ
 function run(){
	
	if(n>for_num){
		n=0;
	}
	
	var scroll_li = scroll_con.children('li:first');
	
	if (scroll_li.length>0){
		
		//����Ķ������첽�������ص�����������run���������ڽ�����ִ��
		scroll_li.animate({top: '-2rem'}, "normal",'linear',function(){
		
				scroll_con.empty();
				//������ֽ��л�����
				
				ul.find(':eq('+n+')').clone().appendTo(scroll_con);
				++n;
			
			});
	}else{
		
		ul.find(':eq('+n+')').clone().appendTo(scroll_con);
		++n;
	}
	
	//�����ڶ�������ǰִ֮�У������л�˳��һ�£���������Ҫע�ͣ��ŵ���������ȥ
	//++n;
	
	
 }
 
 //���ֻ��һ��Ԫ�ؾͲ�Ҫ����
 if(for_num>1){
	  //5���ӽ��н�����Ƭ
      time1=setInterval("run()",5000);
}else{
	run();
}


  //���������¼�������ײ�50px����,����������ǵ���JS��ʼ���������ز��
  $(document.body).infinite();

  //�� body �ϴ��� infinite �¼����������¼�
  var loading = false;  //infinite �¼����ܻᴥ����Ρ���Ҫ�Լ������Ʋ�Ҫͬʱ���ж�����ء�ͨ��һ�� loading ���λ״̬�����ơ�
  $(document.body).infinite().on("infinite", function() {
      if(loading) return;
      $('#loadmore').show();
      loading = true;

      setTimeout(function() {
          $("#list").append("<p> �����¼��ص����� </p>");
          loading = false;
          $('#loadmore').hide();
         // $(document.body).infinite();
          /*
          * ���� $(document.body).destroyInfinite() �������ٲ����֮������ٴε��� $(document.body).infinite() �����³�ʼ��.
            ������ʹ���ٲ����Ҳ����Ѽ���ָʾ����HTML����ɾ����������Ҫ���ػ���ɾ������
          * */
      }, 1500);   //ģ���ӳ�
  });
 
</script>
<script src="./Home/js/wx.js"></script>

  </body>
</html>
<!--footer end-->

<!--header start-->
<!DOCTYPE html>
<html>
  <head>
    <title>用户注册</title>
    <meta charset="gbk">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    
    <link rel="stylesheet" href="../css/weui.min.css">
    <link rel="stylesheet" href="../css/jquery-weui.min.css">
    <link rel="stylesheet" href="../css/index.css">
    <style>
	body{background:#fff;}
	.org1{color:#B5731F}
	td{font-size:0.8rem;}
	.gray-bg{background:#CCC;color:#333;}
	.gray{background:#ccc}
	.line{border-bottom:1px solid #ccc;}
	.w90{widht:90%; margin:0 auto;}
	#letter{right:0.6rem;top:2rem; position:absolute}
    </style>
</head>
<body ontouchstart>
<br/>
<center><h3 class="org1">注册</h3></center>
<hr/>
 <div class="weui-cells weui-cells_form">
      <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">*姓名</label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" value="<?php echo $user['username']?>" id="username" name="username" placeholder="请输入姓名">
            <input  type="hidden" value="<?php echo $user['uid']?>" id="uid" >
        </div>
      </div>
      
      <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">*所在社区</label></div>
        <div class="weui-cell__bd">
         <a href="javascript:;" class="open-popup" data-target="#community"> <input class="weui-input"  type="text" id="area" name="area" placeholder="请输入所在社区"  ></a>
        </div>
      </div>
      
      <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">*联系电话</label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="number" pattern="[0-9]*" name="tell" id="contact" placeholder="请输入联系电话">
        </div>
       
      </div>
 </div>
        <p class="fs0-5">* 请输入您的联系电话，以便工作人员联系您</p>
	<br/>
	<div class="demos-content-padded mt0-5">
      	<a href="javascript:subimt();" class="weui-btn bule-bg w85">提&nbsp;交</a>
	</div>
   
	<div id="community" class="weui-popup__container">
         <div class="weui-popup__overlay"></div>
         <div class="weui-popup__modal" id="popup_modal">
         	<!--你的内容放在这里...-->
            <a href="javascript:;" class="weui-btn gray-bg  close-popup">取消</a>
            <div class="w90">
            	 <a name="A">&nbsp;A</a>
            	 <div class="line"></div>
           		 <div class="bule-f pall0-5" onClick="getArea(this)">&nbsp;&nbsp;阿拉地区</div>
                 <div class="line"></div>
                 <div class="bule-f pall0-5">&nbsp;&nbsp;阿拉地区</div>
            </div>
            
              <div class="w90">
            	 <a name="B">&nbsp;B</a>
            	 <div class="line"></div>
           		 <div class="bule-f pall0-5">&nbsp;&nbsp;阿拉地区</div>
                 <div class="line"></div>
                 <div class="bule-f pall0-5">&nbsp;&nbsp;阿拉地区</div>
            </div>
            
              <div class="w90">
            	 <a name="C">&nbsp;C</a>
            	 <div class="line"></div>
           		 <div class="bule-f pall0-5">&nbsp;&nbsp;阿拉地区</div>
                 <div class="line"></div>
                 <div class="bule-f pall0-5">&nbsp;&nbsp;阿拉地区</div>
            </div>
            
              <div class="w90">
            	 <a name="D">&nbsp;D</a>
            	 <div class="line"></div>
           		 <div class="bule-f pall0-5">&nbsp;&nbsp;阿拉地区</div>
                 <div class="line"></div>
                 <div class="bule-f pall0-5">&nbsp;&nbsp;阿拉地区</div>
            </div>
            
            <div class="w90">
            	 <a name="E">&nbsp;E</a>
            	 <div class="line"></div>
           		 <div class="bule-f pall0-5">&nbsp;&nbsp;阿拉地区</div>
                 <div class="line"></div>
                 <div class="bule-f pall0-5">&nbsp;&nbsp;阿拉地区</div>
            </div>
            
              <div class="w90">
            	 <a name="F">&nbsp;F</a>
            	 <div class="line"></div>
           		 <div class="bule-f pall0-5">&nbsp;&nbsp;阿拉地区</div>
                 <div class="line"></div>
                 <div class="bule-f pall0-5">&nbsp;&nbsp;阿拉地区</div>
            </div>
            
              <div class="w90">
            	 <a name="G">&nbsp;G</a>
            	 <div class="line"></div>
           		 <div class="bule-f pall0-5">&nbsp;&nbsp;阿拉地区</div>
                 <div class="line"></div>
                 <div class="bule-f pall0-5">&nbsp;&nbsp;阿拉地区</div>
            </div>
            
              <div class="w90">
            	 <a name="H">&nbsp;H</a>
            	 <div class="line"></div>
           		 <div class="bule-f pall0-5">&nbsp;&nbsp;阿拉地区</div>
                 <div class="line"></div>
                 <div class="bule-f pall0-5">&nbsp;&nbsp;阿拉地区</div>
            </div>
            
            <div class="w90">
            	 <a name="I">&nbsp;I</a>
            	 <div class="line"></div>
           		 <div class="bule-f pall0-5">&nbsp;&nbsp;阿拉地区</div>
                 <div class="line"></div>
                 <div class="bule-f pall0-5">&nbsp;&nbsp;阿拉地区</div>
            </div>
            
             <div class="w90">
            	 <a name="J">&nbsp;J</a>
            	 <div class="line"></div>
           		 <div class="bule-f pall0-5">&nbsp;&nbsp;阿拉地区</div>
                 <div class="line"></div>
                 <div class="bule-f pall0-5">&nbsp;&nbsp;阿拉地区</div>
            </div>
            
             <div class="w90">
            	 <a name="K">&nbsp;K</a>
            	 <div class="line"></div>
           		 <div class="bule-f pall0-5">&nbsp;&nbsp;阿拉地区</div>
                 <div class="line"></div>
                 <div class="bule-f pall0-5">&nbsp;&nbsp;阿拉地区</div>
            </div>
            
             <div class="w90">
            	 <a name="L">&nbsp;L</a>
            	 <div class="line"></div>
           		 <div class="bule-f pall0-5">&nbsp;&nbsp;阿拉地区</div>
                 <div class="line"></div>
                 <div class="bule-f pall0-5">&nbsp;&nbsp;阿拉地区</div>
            </div>
            
             <div class="w90">
            	 <a name="M">&nbsp;M</a>
            	 <div class="line"></div>
           		 <div class="bule-f pall0-5">&nbsp;&nbsp;阿拉地区</div>
                 <div class="line"></div>
                 <div class="bule-f pall0-5">&nbsp;&nbsp;阿拉地区</div>
            </div>
            
             <div class="w90">
            	 <a name="N">&nbsp;N</a>
            	 <div class="line"></div>
           		 <div class="bule-f pall0-5">&nbsp;&nbsp;阿拉地区</div>
                 <div class="line"></div>
                 <div class="bule-f pall0-5">&nbsp;&nbsp;阿拉地区</div>
            </div>
            
             <div class="w90">
            	 <a name="O">&nbsp;O</a>
            	 <div class="line"></div>
           		 <div class="bule-f pall0-5">&nbsp;&nbsp;阿拉地区</div>
                 <div class="line"></div>
                 <div class="bule-f pall0-5">&nbsp;&nbsp;阿拉地区</div>
            </div>
            
              <div class="w90">
            	 <a name="P">&nbsp;P</a>
            	 <div class="line"></div>
           		 <div class="bule-f pall0-5">&nbsp;&nbsp;阿拉地区</div>
                 <div class="line"></div>
                 <div class="bule-f pall0-5">&nbsp;&nbsp;阿拉地区</div>
            </div>
            
            
              <div class="w90">
            	 <a name="Q">&nbsp;Q</a>
            	 <div class="line"></div>
           		 <div class="bule-f pall0-5">&nbsp;&nbsp;阿拉地区</div>
                 <div class="line"></div>
                 <div class="bule-f pall0-5">&nbsp;&nbsp;阿拉地区</div>
            </div>
            
              <div class="w90">
            	 <a name="R">&nbsp;R</a>
            	 <div class="line"></div>
           		 <div class="bule-f pall0-5">&nbsp;&nbsp;阿拉地区</div>
                 <div class="line"></div>
                 <div class="bule-f pall0-5">&nbsp;&nbsp;阿拉地区</div>
            </div>
            
            
              <div class="w90">
            	 <a name="S">&nbsp;S</a>
            	 <div class="line"></div>
           		 <div class="bule-f pall0-5">&nbsp;&nbsp;阿拉地区</div>
                 <div class="line"></div>
                 <div class="bule-f pall0-5">&nbsp;&nbsp;阿拉地区</div>
            </div>
            
              <div class="w90">
            	 <a name="T">&nbsp;T</a>
            	 <div class="line"></div>
           		 <div class="bule-f pall0-5">&nbsp;&nbsp;阿拉地区</div>
                 <div class="line"></div>
                 <div class="bule-f pall0-5">&nbsp;&nbsp;阿拉地区</div>
            </div>
            
              <div class="w90">
            	 <a name="U">&nbsp;U</a>
            	 <div class="line"></div>
           		 <div class="bule-f pall0-5">&nbsp;&nbsp;阿拉地区</div>
                 <div class="line"></div>
                 <div class="bule-f pall0-5">&nbsp;&nbsp;阿拉地区</div>
            </div>
            
              <div class="w90">
            	 <a name="V">&nbsp;V</a>
            	 <div class="line"></div>
           		 <div class="bule-f pall0-5">&nbsp;&nbsp;阿拉地区</div>
                 <div class="line"></div>
                 <div class="bule-f pall0-5">&nbsp;&nbsp;阿拉地区</div>
            </div>
            
              <div class="w90">
            	 <a name="W">&nbsp;W</a>
            	 <div class="line"></div>
           		 <div class="bule-f pall0-5">&nbsp;&nbsp;阿拉地区</div>
                 <div class="line"></div>
                 <div class="bule-f pall0-5">&nbsp;&nbsp;阿拉地区</div>
            </div>
           
            <div class="w90">
            	 <a name="X">&nbsp;X</a>
            	 <div class="line"></div>
           		 <div class="bule-f pall0-5">&nbsp;&nbsp;阿拉地区</div>
                 <div class="line"></div>
                 <div class="bule-f pall0-5">&nbsp;&nbsp;阿拉地区</div>
            </div>
            
              <div class="w90">
            	 <a name="Y">&nbsp;Y</a>
            	 <div class="line"></div>
           		 <div class="bule-f pall0-5">&nbsp;&nbsp;阿拉地区</div>
                 <div class="line"></div>
                 <div class="bule-f pall0-5">&nbsp;&nbsp;阿拉地区</div>
            </div>
              
              <div class="w90">
            	 <a name="Z">&nbsp;Z</a>
            	 <div class="line"></div>
           		 <div class="bule-f pall0-5">&nbsp;&nbsp;阿拉地区</div>
                 <div class="line"></div>
                 <div class="bule-f pall0-5">&nbsp;&nbsp;阿拉地区</div>
            </div>
            
        	 <div  id="letter">
             	<table>
                	<tr><td><a href="#A" onClick="oneclic(this)">A</a></td></tr>
                    <tr><td><a href="#B" onClick="oneclic(this)">B</a></td></tr>
                    <tr><td><a href="#C" onClick="oneclic(this)">C</a></td></tr>
                    <tr><td><a href="#D" onClick="oneclic(this)">D</a></td></tr>
                    <tr><td><a href="#E" onClick="oneclic(this)">E</a></td></tr>
                    <tr><td><a href="#F" onClick="oneclic(this)">F</a></td></tr>
                    <tr><td><a href="#G" onClick="oneclic(this)">G</a></td></tr>
                    <tr><td><a href="#H" onClick="oneclic(this)">H</a></td></tr>
                    <tr><td><a href="#I" onClick="oneclic(this)">I</a></td></tr>
                    <tr><td><a href="#J" onClick="oneclic(this)">J</a></td></tr>
                    <tr><td><a href="#K" onClick="oneclic(this)">K</a></td></tr>
                    <tr><td><a href="#L" onClick="oneclic(this)">L</a></td></tr>
                    <tr><td><a href="#M" onClick="oneclic(this)">M</a></td></tr>
                    <tr><td><a href="#N" onClick="oneclic(this)">N</a></td></tr>
                    <tr><td><a href="#O" onClick="oneclic(this)">O</a></td></tr>
                    <tr><td><a href="#P" onClick="oneclic(this)">P</a></td></tr>
                    <tr><td><a href="#Q" onClick="oneclic(this)">Q</a></td></tr>
                    <tr><td><a href="#R" onClick="oneclic(this)">R</a></td></tr>
                    <tr><td><a href="#S" onClick="oneclic(this)">S</a></td></tr>
                    <tr><td><a href="#T" onClick="oneclic(this)">T</a></td></tr>
                    <tr><td><a href="#U" onClick="oneclic(this)">U</a></td></tr>
                    <tr><td><a href="#V" onClick="oneclic(this)">V</a></td></tr>
                    <tr><td><a href="#W" onClick="oneclic(this)">W</a></td></tr>
                    <tr><td><a href="#X" onClick="oneclic(this)">X</a></td></tr>
                    <tr><td><a href="#Y" onClick="oneclic(this)">Y</a></td></tr>
                    <tr><td><a name="#Z">Z</a></td></tr>
                </table>
             </div>
             
            
         	<!--end-->
 	 	</div>
	</div>

<div id="footer"></div>

<script src="../js/jquery-2.1.4.js"></script>
<script src="../js/fastclick.js"></script>
<script src="../js/jquery-weui.min.js"></script>
<script>
    $(function() {
        FastClick.attach(document.body);
        $("#footer").load("../public/loading.html");
    });




     function oneclic(t){
		var s = $(t).html();
		$.toast("&nbsp;"+s+"&nbsp;",'text');
	
	}
	
	function getArea(t){
		var s = $(t).text();
		 s = $.trim(s);
		 $('#area').val(s);
		 $.closePopup();
	}
	
	var letter = $('#letter');

	
	
	$('#popup_modal').scroll(function(){
		
		  var top =  $(this).scrollTop(); 
	
		 letter[0].style.top = top+'px';
		// console.log(letter[0].style.top);
		 if(letter[0].style.top=='0px'){
			letter[0].style.top = 2+'rem';
			
			}
		});

function subimt(){
    var contact = $("#contact").val();
    var address = $("#area").val();
    var username = $("#username").val();
    var data = {'contact':contact,'address':address,'username':username,'id':$("#uid").val()};
    $.ajax({
        cache:false,
        async: false,//同步加载数据，锁定用户交互
        url:'Register.html',
        type:'post',
        datatype:'json',
        data:{
            param:JSON.stringify(data)
        },
        beforeSend:function(){

            $("#loading").popup();
        },
        success:function(okstr){
            $.closePopup();
            if(!okstr.error){
                $.alert('提交成功');
            }else {
                $.alert('提交失败');
            }
        }
    });
}

	
 </script>
</body>
</html>
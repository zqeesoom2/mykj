// JavaScript Document
function movediv(m,c,g){
	$(g).click(function(){
		  $(m).remove();
		});
	var MOUSEDOWN_FLG = false;
	var _x, _y;
	$(c).mousedown(function(event){
		MOUSEDOWN_FLG = true;
		var offset = $(m).offset();
		_x = event.pageX - offset.left;
		_y = event.pageY - offset.top;
		$(m).css({left:event.pageX-_x, top:event.pageY-_y,curosr:'pointer'});
	});
	
	$(document).mousemove(function(event){
		if(MOUSEDOWN_FLG){
			
			var width   = $(m).parent("body").width();
			var w = $(m).width();
			var top = event.pageY-_y;
			var l 	= event.pageX-_x;
			if( l+w >=width-10 ){
				$(m).css({left:width-w, top:top});
				return;
			}
			
			var top = event.pageY-_y;
			if(top >0){
				var wh = $(window).height();var mh = wh-35;
					
				if( top > mh ){
					$(m).css({left:event.pageX-_x, top:mh});
				}else
				$(m).css({left:event.pageX-_x, top:top});
			}
			else//不超出浏览器顶部
			 $(m).css({left:event.pageX-_x, top:0});
		}
	}).mouseup(function(event){
		MOUSEDOWN_FLG=false;
	});	
}

function QueryString(fieldName){  
   var urlString = document.location.search;
   if(urlString != null){
       var typeQu = fieldName+"=";
       var urlEnd = urlString.indexOf(typeQu);
       if(urlEnd != -1){
           var paramsUrl = urlString.substring(urlEnd+typeQu.length);
           var isEnd =  paramsUrl.indexOf('&');
           if(isEnd != -1){
              return paramsUrl.substring(0, isEnd);
           }else{
              return paramsUrl;
           }
        }else 
          return null;
    }else
      	  return null;
} 

function close_message_info(callback){
		$("#tool-close_x").unbind("click").click(function(){
				$("#confirmModalOverlay").remove();
				$("#panel_window_x").remove();
				eval(callback+'()');
		});
		
	}
function remove_showmessage(id){
	var x = document.getElementById(id);
	if($(x).is("div")){
		 x.parentNode.removeChild(x);
	}
		
	$("#confirmModalOverlay").remove();
}

function remove_showmessage(id){
	var x = document.getElementById(id);
	if($(x).is("div")){
		 x.parentNode.removeChild(x);
	}
		
	$("#confirmModalOverlay").remove();
}

/*ok error warn*/
function show_message_info(message,type,fun,fun2){
	if($("#panel_window_x").is("div")){
		return false;
	}
	var w  = $(window).width();
	var h  = $(window).height();
	$("body").append("<div id='confirmModalOverlay'></div>");
	$("#confirmModalOverlay").css({'width':w+'px','height':h+'px'});
	
	if( typeof fun !='undefined'){
			if( fun.lastIndexOf(")")==-1){
				 fun = fun + '()';
			}else{
				if(fun.lastIndexOf("'")==-1){
					var reg = /(.*)\((\w+)\)/;
					fun =fun.replace(reg,"$1('$2')");
				}
			}
	}
	
	if( typeof fun2 !='undefined'){	
		if( fun2.lastIndexOf(")")==-1)
			fun2 = fun2 + '()';
		else{
			if(fun2.lastIndexOf("'")==-1){
				var reg2 = /(.*)\((\w+)\)/;
				fun2 =fun2.replace(reg2,"$1('$2')");
			}
		}
	}
	
	if( !fun ){
		var fun = '' ;
		var a = '<a id="cmrfiy2" href="javascript:remove_showmessage(\'panel_window_x\');'+fun+';" style="margin:0 auto;" class="cmrfi">确定</a>';
	}else{
		if(!fun2){
			if(type=='question'){
				var a =  '<a id="cmrfiy" href=javascript:remove_showmessage(\'panel_window_x\');'+fun+'; class="cmrfi" style="float:left;margin-right:7px;">确 定</a><a id="cmrfiy2" href="javascript:remove_showmessage(\'panel_window_x\');" style="float:left;" class="cmrfi">取消</a>';
			}else{
				var a = '<a id="cmrfiy2" href="javascript:remove_showmessage(\'panel_window_x\');'+fun+';" style="margin:0 auto;" class="cmrfi">确定</a>';			
			}
		}	
		else
			var a = '<a id="cmrfiy" href=javascript:remove_showmessage(\'panel_window_x\');'+fun+'; class="cmrfi" style="float:left;margin-right:7px;">确 定</a><a id="cmrfiy2" href="javascript:remove_showmessage(\'panel_window_x\');'+fun2+';" style="float:left;" class="cmrfi">取消</a>';
	}
	if(!fun2)
		fun2='';
	
	if(type=='loading'){
		var a = '';
		var tools = '';
	}else{
		var tools = '<a id="tool-close_x" class="panel-tool-closex2" href="javascript:void(0)"></a>'; 
	}
	
	var html = '<div class="panelx2 windowx2" id="panel_window_x" style="display: block; width: 250px; left: 45%; top: 35%; z-index: 9048; position:fixed;_position:absolute;"><div id="panel-header_x" class="panel-headerx2" style="width: 250px;">  <div class="panel-titlex2" style="">消息提示</div><div class="panel-toolx2">'+tools+'</div> </div><div  closed="true" class="easyui-windowx2 panel-bodyx2 panel-body-noborderx2 window-bodyx2" style="padding: 5px; overflow:hidden; height: 90px;" >  <div class="xxbox"><div class="msg_content '+type+'"></div><span style="line-height: 20px;margin-top: 2px;display: inherit;">'+message+'</span></div><div  class="clear" style="margin:0px auto 0;width:180px;">'+a+'</div></div>  </div>';
	$("body").append(html);
	
	$("#tool-close_x").click(function(){
			$("#panel_window_x").remove();
			$("#confirmModalOverlay").remove();
		});
	
	$(document).bind("keydown",function(event){
			var e = event || window.event;
			if(event.keyCode==13){
				e.preventDefault(); 
				$("#panel_window_x").remove();
				$("#confirmModalOverlay").remove();
				return false;
			}
		})
}
/**/
var clearSlct= "getSelection" in window ? function(){
            window.getSelection().removeAllRanges();
        } : function(){
            document.selection.empty();
        };
$(function(){
	if(!document.getElementById('ttres'))
	 return false;
	$('#ttres').tree();
				var h = $(window).height();			
				$("#r-c").height(h);
				flag = false;
				 $(".cmiddle").mousedown(function(){
						flag = true;
						$("body").attr("style","cursor:e-resize");
						$(".overflow").show();
					}).toggle(function(){
					 $('#ttres').hide();
					 $("#r-c").attr("width","100%");
					 $("#tdtreebox").width("1px");
					 	},function(){
						 $('#ttres').show();
					   $("#tdtreebox").width("200px");
					   $("#r-c").attr("width","88%");
					 });
				 $(document).mousemove(function(event){
					 	
						if(flag){
							$(".cmiddle").attr("style","cursor:e-resize");
							var x = event.pageX;
							var obj = $(".cmiddle").offset();
							var lw = $("#tdtreebox").width();
							var objx = obj.left;
							var jw = objx-x-6;
							if (jw > 0){
								$("#tdtreebox").width(lw-jw);
								
								var rw = $("#r-c").width();
								$("#r-c").width(rw+jw);
							}else{
								var yw = lw+Math.abs(jw)
								$("#tdtreebox").width(yw);
							}
						}
				 }).mouseup(function(){
							flag = false;
							 $("body").removeAttr("style");
							 $(".cmiddle").removeAttr("style");
							 $(".overflow").hide();
							 
				});
			
	});
function remove_showmessage(id){
	var x = document.getElementById(id);
	if($(x).is("div")){
		 x.parentNode.removeChild(x);	
	}
	$("#confirmModalOverlay").remove();
}
				

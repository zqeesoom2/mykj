function createMenu(arr){
	this.title = arr;
	var threeItem , items  ;
	var  arrMenu = new Array();
	this.list = "";
						
	this.td = $("#menus");
	this.headCode = $("<div class=\"w180 h35 \"></div>");
	this.head2Code = $("<div class=\"overhide  hide\"></div>");
	this.ListFather = $("<div class=\"title-menu bggray3 w176 fl\"></div>");
	this.ThreeListFather = $("<div class=\"threeMeun\"></div>");
						 
	for(var i=0; i < this.title.length;i++){
	    this.ThreeListFather.html("");
	    this.ListFather.html("");
	    this.head2Code.html("");
	    items = "";
	    threeItem = "";
	    this.list = "";
	    this.headCode.html("<div class=\"nav-title w176 bggray h33 curpoin border-top-withe border-bot-gray fl bggray-hover\"><span class=\"inline "+this.title[i].img+" h20 w22 relative top3\"></span><span class=\"text-l inline font13 bold color-gray w127 line-h33 \" style=\"font-size:14px \">"+this.title[i].name+"</span> <span class=\"icon_expand relative top3 inline w16 h16 \"></span></div><div style=\"width:4px;\" class=\"h35 fl bggray2 bggray1\"></div>"); 
	    if(typeof(this.title[i].children)!='undefined'){
	        this.list = this.title[i].children;			
	    }
	    
	    for(var j = 0 ; j<this.list.length; j++){
			if(typeof(this.list[j].children)!= 'undefined'){
			   items += "<a href=\"javascript:;\" class=\"nav_nohover inline\" onclick=\"threeMeun(this)\"><span class=\"icon_jiantou relative  inline w6 h6 mr12\"></span><span class=\" menutext\">"+this.list[j].name+"</span></a>";
			   for(var k =0 ; k< this.list[j].children.length; k++){
				 threeItem += "<a href=\"javascript:;\" class=\"nav_nohover inline\" onclick=\"addTab('"+this.list[j].children[k].name+"','"+this.list[j].children[k].url+"',this)\"><span class=\"icon_jiantou relative  inline w6 h6 mr12\"></span><span class=\" menutext\">"+this.list[j].children[k].name+"</span></a>";					
			   }
			   items = items+this.ThreeListFather.html(threeItem).get(0).outerHTML;
		    }else{
			    items += "<a href=\"javascript:;\" class=\"nav_nohover inline\" onclick=\"addTab('"+this.list[j].name+"','"+this.list[j].url+"',this)\"><span class=\"icon_jiantou relative  inline w6 h6 mr12\"></span><span class=\" menutext\">"+this.list[j].name+"</span></a>";
			}
				threeItem = "";
			}
			this.ListFather.html(items);
			this.head2Code.html(this.ListFather.get(0).outerHTML+"<div style=\";\" class=\"w4 relative fr bggray2\"></div>");
			arrMenu.push(this.headCode.get(0).outerHTML+this.head2Code.get(0).outerHTML);			
    }
						
	this.td.html(arrMenu.join("")+"<div class=\"w180 h35 \"><div class=\" w176 h33 border-top-withe fl\"></div> <div style=\"width:4px;\" class=\"h35 fl bggray2\"></div></div><div style=\" height:1000px;\" class=\"w4 relative fr bggray2\"></div>");		
}				
	createMenu(arr);
							            
   function updateTab(url) {
	  var tab = $('#tt').tabs('getSelected');
      var ifram = $(tab).find("iframe");
      ifram=ifram[0];
      ifram.src=url;
   }
   
   function threeMeun(obj){
	  var menu = $(obj).next();
	  var shuline = menu.parent().next();
		$('.nav_hover').removeClass('nav_hover');
			if($(obj).hasClass("nav_hover2")){
				$(obj).addClass('nav_nohover2').removeClass("nav_hover2");
								
    			menu.slideUp('fast',function(){
			     	shuline.height(shuline.height()-menu.height());
				   $(obj).removeClass("nav_nohover2").addClass('nav_nohover');
			    });
		    }else{
				if(menu.is(":hidden")){
					$(obj).addClass('nav_hover2').removeClass("nav_nohover2");;
					shuline.height(shuline.height()+menu.height());
					menu.slideDown();
				}else{
					$(obj).addClass('nav_nohover2');
    				menu.slideUp('fast',function(){
					shuline.height(shuline.height()-menu.height());
					$(obj).removeClass("nav_nohover2").addClass('nav_nohover');
					});
				}
			}
		}
		var index =  0;
		function addTab(title,url,obj){
			if(!$(obj).parent().hasClass("threeMeun")){
				$('.nav_hover2').removeClass('nav_hover2').addClass("nav_nohover2");
			}else{
				$(".nav_hover2").removeClass("nav_hover2").addClass("nav_nohover2");
				$(obj).parent().prev().addClass("nav_hover2").removeClass("nav_nohover2");
			}

			$('.nav_hover').removeClass('nav_hover');
			$(obj).addClass('nav_hover');
						
				if ($('#tt').tabs('exists', title)){  
					$('#tt').tabs('select', title); 
					updateTab(url);
				}else{  
					index++;
				if($.browser.msie&&($.browser.version == "6.0")&&!$.support.style){
					setTimeout("document.getElementById('www"+index+"').contentWindow.location.reload(true);",1000);
			    }		  
				$('#tt').tabs('add',{
					title:title,
					content:'<iframe scrolling="yes" frameborder="0" id="www'+index+'" src="'+url+'" style="width:100%;height:100%;"></iframe>',
					closable:true
				});
			} 
		}
	var wh = $(window).height();
		$("#ead-contq").height(wh - 145);
		$("#left-h2").height(wh-100);
	$(function(){
		var w =$("#ead-contq").width();
		var h =$("#ead-contq").height();
		var w2 = $(window).width();
		if( w2 > 1350 ){
			$("#tt").width(w+3);
		}else if( w2 < 1350  ){
			$("#tt").width(w+19);
		}
		
		$("#tt").height(h+40);
		$(".tabs-inner:first").trigger("click");
   });
   function remove_ie6(id){
	 $("#"+id).remove();
   }
   
  $(function(){
		function ie(){
			var v = 3, div = document.createElement('div'), all = div.getElementsByTagName('i');
			while(
				div.innerHTML = '<!--[if gt IE ' + (++v) + ']><i></i><![endif]-->',
				all[0]
			);
			return v > 4 ? v : false ;	
		}
		
	    var v = ie();
			if(v==6 || v==7){
				var t2 = 0;
				$('<div class="spring" id="springs"><div class="wrapper">您使用的浏览器版本过低，影响网页性能，建议您<a href="http://www.skycn.com/soft/appid/880.html" target="_blank">升级IE浏览器</a>、或换用<a href="http://www.skycn.com/soft/appid/896.html">火狐</a>浏览器。<a href=javascript:remove_ie6("springs");>关闭 </a></div></div>').prependTo('body').fadeIn();
				$(window).bind("scroll",function(){
					var t =	$(this).scrollTop();
					if(t>t2){
					  $(".spring").animate({"margin-top":"+="+t},500);t2= t
					 }else{ 
						 $(".spring").animate({"margin-top":"-="+t2},500);t2=0;
					}
				});
			}	
		$(".nav-title").each(function(index,item){	
			$(item).click(function(){	
				$(".bggray-hover").each(function(j,i){
					$(i).removeClass('bggray-hover');
					$(i).next().removeClass("bggray1");
					$(i).parent().next().hide();
			});
								
			var o = $(this);
			o.addClass('bggray-hover');
			o.next().addClass("bggray1");
			
			var t = o.parent().next();
			if(t.is(":hidden")){
			   t.children(":last").height(t.height());
			   t.slideDown("fast");
			}else{
			   t.slideUp("fast");
			   o.removeClass('bggray-hover');
			   o.next().removeClass("bggray1");
			}	
		});
     });	
});
	$("#footer").load("./public/footer.html");		
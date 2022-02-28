var TZSystem = {NS:
  function(ns){
    if (!ns || !ns.length){
      return null;
    } 
    var levels = ns.split(".");
    var nsobj = TZSystem;
	  
    for (var i=(levels[0] == "TZSystem") ? 1:0; i<levels.length; ++i){	 
      nsobj[levels[i]] = nsobj[levels[i]] || {};
      nsobj = nsobj[levels[i]];
    }
    return nsobj;
  }
} 
var ageFilters = [{ text: '大于', value: '>' }, { text: '小于', value: '<' }, { text: '等于', value: '='}];
var Genders = [{ id: 1, text: '男' }, { id: 2, text: '女'}];
function getParTile(){
	if(typeof parent.getTitles !='undefined'){
		return	parent.getTitles();
		}
	}
function responsive(){
   if($('body').width()>700 && ($('body').width() < 960 || $("body").width()< 1100 )){
	   $('html').addClass('w960');
   }else{
	   $('html').removeClass('w960');
   }
}
function cancelRow(type) {
   if(typeof type!== 'undefined'){
	  grid2.reload();
	  editWindow2.hide();
   }else{
	  grid.reload();
	  editWindow.hide();
   }
}
function getUrlParam(j){
   var h = [];
   str = window.location.href, arr = str.substr(str.indexOf("?") + 1, str.length).split("&");
	
   for(var i = 0, g = arr.length; i < g; i++){
	   var f = [];
	   f = arr[i].split("=");
	   h[f[0]] = f[1];
   }
   return h;
}
			
function public_openWindow(){
   form.clear();
	
   var title = $("#editWindowTitle").val();
   if(title){
	  editWindow.setTitle(title);
   }
   editWindow.setTitle(editWindow.getTitle().replace("修改","添加"));
   editWindow.show();
}	

function guanli(){
	var editWindow3 = mini.get("editWindow3");
	editWindow3.show();
	mini.get("tree2").reload();
}

function qiyeGuanLi(){
   var editWindow3 = mini.get("editWindow3");
   editWindow3.show();
   mini.get("tree2").reload();
}

function hideDangWindow(){
   var win = mini.get("editWindow3"); win.hide();
   mini.get("tree1").reload();
}
	
function search(type) {	
	var gridObj = grid;	
	if( typeof type !== "undefined" && type == 2 ){
		 gridObj = grid2;
		 rs = true;
	}
	var d_start = "",filter_key_1 = "" , filter_key_2 = "" ,key="";
	var d_end ="",json = "";
	
	var keyobj = mini.get("key");
	var d1 = mini.get("start_time");
	var d2 = mini.get("end_time");
	
	if (typeof keyobj!="undefined" ){
	   key = keyobj.getValue();
	}
	
	if (typeof d1!= "undefined"){
	   d_start = mini.formatDate(d1.value, "yyyy-MM-dd");
	}
	
	if (typeof d2!= "undefined" ){
	   d_end = mini.formatDate(d2.value, "yyyy-MM-dd");
	}
		
	var combo1 = mini.get("combo1");
	var combo2 = mini.get("combo2");
	
	if (typeof combo1 !="undefined"){
	   filter_key_1 = combo1.getValue();
	}
	if (typeof combo2 !="undefined"){
	   filter_key_2 = combo2.getValue();
	}	

	gridObj.load({key: key ,'d_start':d_start,'d_end':d_end,"filter_val_1":filter_key_1.trim(),"filter_val_2":filter_key_2.trim()});
}
function ExportExcel(url,type) {
	var gridObj = grid;
	if( typeof type !="undefined" && type == 2  ){
		gridObj = grid2;
	}
	var columns = gridObj.getBottomColumns();
	function getColumns(columns) {
		columns = columns.clone();
		for (var i = columns.length - 1; i >= 0; i--) {
		  	 var column = columns[i];
		     if (!column.field) {
			    columns.removeAt(i);
			 }else{
			    var c = { header: column.header, field: column.field };
			    columns[i] = c;
			 }
		}
		return columns;
	}		
    var columns = getColumns(columns);
    var json = mini.encode(columns);     
	
	document.getElementById("excelData").value = json;
    var excelForm = document.getElementById("excelForm");
	var combo1 = mini.get("combo1"),combo2 = mini.get("combo2");
	
    if (typeof combo1 != "undefined"){
  	    var fliter_val = combo1.getValue().trim();
		if ( fliter_val != "" ){
		   url += "&fliter_type="+fliter_val;
		   $("#fliter_type_text").val();
		}
	}
	if (typeof combo2 != "undefined"){
		 var fliter_val2 = combo2.getValue().trim();
		 if ( fliter_val2 != "" ){
			url += "&fliter_type2="+fliter_val2;
		 }
	}
	var  key = "";
	var keyobj = mini.get("key");
	if (typeof keyobj!="undefined"){
		 key = keyobj.getValue();
	}
	if(key){
		url+="&key="+key;
	}
	excelForm.action = url;
	excelForm.submit(); 
}										
function onGenderRenderer(e) {
	for (var i = 0, l = Genders.length; i < l; i++) {
		var g = Genders[i];
		if (g.id == e.value) return g.text;
	}
	return "";
}

function saveDangOrg(url,node) {
	var json = mini.encode([node]);
    var msgid = mini.loading("数据保存中，请稍后......", "保存数据");
    $.ajax({
         url:url,
         data:{data:json},
         type: "post",
         success: function (text) {
           mini.hideMessageBox(msgid);
		   mini.get("tree2").reload();
         },
         error: function(jqXHR, textStatus, errorThrown){
           mini.hideMessageBox(msgid);
         }
    });
}
		
function onAddAfter(nodeName) {
	var textStr = "请输入信息";
	if( typeof nodeName !="undefined" ){
		textStr =  nodeName;
	}
	
    var tree2 = mini.get("tree2");
    var node = tree2.getSelectedNode();
	var newNode = {name:textStr,pid:0};
	if(node){
	   newNode.pid = node.pid;
	}
    tree2.addNode(newNode, "after", node);
    tree2.beginEdit(newNode);
}

function onAddNode(nodeName) {
	var textStr = "请输入子级";
	if( typeof nodeName !="undefined" ){
		textStr =  nodeName;
	}
    var tree2 = mini.get("tree2");
    var node = tree2.getSelectedNode();
	if(node){
		var newNode = {name:textStr,pid:node.pid};
		tree2.addNode(newNode, "add", node);
		tree2.beginEdit(newNode);
	}else{
		mini.alert("请选择上级！");
	}
}

function onRemoveNode(url) {
   if (url){
   }
   var tree2 = mini.get("tree2");
   var node = tree2.getSelectedNode();
   if (node){
       if (confirm("确定删除选中节点?")){
           tree2.removeNode(node);
		   $.ajax({
              url: url,
              data:{id: node.id},
              type:"post",
              success:function(text){
			    mini.get("tree2").reload();
              }
           });
       }
   }
}
		
function onEditNode() {
   var tree2 = mini.get("tree2");
   var node = tree2.getSelectedNode();     
   tree2.beginEdit(node);
}

var public_bar = {
   "set_changed_filterVal":function(e){
		var obj = e.sender;
		if(e.filter_type == "select_1" ){
			if(obj.getText()==""){
				var columns =  obj.data.clone();						
					columns.length = columns.length;
				$("#fliter_type_text").val(mini.encode(columns));
			}else{
				var c = [{ "id": obj.getValue(), "text": obj.getText() }];
				$("#fliter_type_text").val( mini.encode(c) );
			}
		}else if(e.filter_type == "select_2" ){
			if(obj.getText()==""){
				var columns =  obj.data.clone();
				columns.length = columns.length;
				$("#fliter_type2_text2").val(mini.encode(columns));				
			}else{
				var c = [{ "id": obj.getValue(), "text": obj.getText() }];
				$("#fliter_type2_text2").val( mini.encode(c) );				
			}
		}
	},
    "int":function(e){
		if(e.fns==2){
			search(2);
		}else{
			search();
		}
		this.set_changed_filterVal(e);
    }
}
function NewPublicObjec(aclass,aprams){
	function new_(){
	 // aclass.int.apply(this,aprams);
	}
	new_.prototype = aclass;
	return new new_();
}

function CloseWindow(action) {
    if (window.CloseOwnerWindow) return window.CloseOwnerWindow(action);
    else window.close();
}

function onFilterChanged(e) {
	var sexbox = mini.get("sexFilter");
	var agebox = mini.get("ageFilter");
	var dangPaibox = mini.get("dangPaiFilter");
	var namebox = mini.get("nameFilter");
	var ji_guanbox = mini.get("ji_guanFilter");
	var min_zubox = mini.get("min_zuFilter");
	var workbox = mini.get("workFilter");
	var remarkbox = mini.get("remarkFilter");
	var tellbox = mini.get("tellFilter");
	var xue_weibox = mini.get("xue_weiFilter");
	var zhi_wubox = mini.get("zhi_wuFilter");

	if(sexbox){
		var sex = sexbox.getValue().toLowerCase();
	}
	if(agebox){
		if(agebox.getValue() != ''){
			var age = parseInt(agebox.getValue().toLowerCase());
		}
		var ageFilter = agebox.getFilterValue().toLowerCase();
	}
	if(dangPaibox){
	  var dangPai = dangPaibox.getValue().toLowerCase();
	}
	if(namebox){
		var name = namebox.getValue().toLowerCase();
	}
	if(ji_guanbox){
		var ji_guan = ji_guanbox.getValue().toLowerCase();
	}
	if(min_zubox){
		var min_zu = min_zubox.getValue().toLowerCase();
	}
	if(workbox){
		var work = workbox.getValue().toLowerCase();
	}
	if(remarkbox){
		var remark = remarkbox.getValue().toLowerCase();
	}
	if(tellbox){
		var tell = tellbox.getValue().toLowerCase();
	}
	if(xue_weibox){
		var xue_wei = xue_weibox.getValue().toLowerCase();
	}
	if(zhi_wubox){
		var zhi_wu = zhi_wubox.getValue().toLowerCase();
	}
	grid.load({ name: name, sex: sex, dang_pai: dangPai, ji_guan: ji_guan,
	            min_zu: min_zu, work: work,work_dan_wei:work, remark: remark, tell: tell,
	            xue_wei: xue_wei,xue_li:xue_wei,zhi_wu: zhi_wu,zi_wu:zhi_wu,birthday:age,ageFilter:ageFilter});
}

function dateToAge(prams){
   var y = new Date().getFullYear();
   if (prams == null )
      return "";
   
   var year = mini.formatDate ( prams, "yyyy" );
		
   var age = parseInt(y) - parseInt(year);
   if(age < 0){
	  age = "";
   }
   return age;
}

function onYearToAge(e){
   return dateToAge(e.value);
}	

function getIframeDocument(element) {  
   return element.contentWindow||element.contentDocument;  
};

function SaveTrees(url){
   var tree2 = mini.get("tree2");
   if (tree2){
	   tree2.on("endedit",function(e){
	     var n = e.node;
		 if(n){
			 if(n.name == "" || n.name == "请输入信息" || n.name == "请输入子级信息" )
			 return ;
		 }
		 saveDangOrg( url,n );
	  });
   }
}
function notify(text,id) {
   mini.showMessageBox({
     showModal: false,
     width: 250,
     title: "消息提示",
     iconCls: "mini-messagebox-warning",
     message: text,
     timeout: 60000,
     x: 'right',
     y: 'bottom',
     callback: function(action){
       if (action=="close"){
           $.post("../huiyiAction.do?method=read",{id:id},function(e){
           });
       }
     }
   });
}

$(function(){
	var urlkey2 =  getUrlParam();
	if( urlkey2.tableId && urlkey2.flag=="true" ){ 
		editRow(urlkey2.tableId,2);
	 }
    responsive();
    TZSystem.NS("bar");
    if($(".htmlboor").length>0){
		$(".htmlboor[type=1]").load("../public/search_tool_1.html",function(){
		    $("#combo1").attr("url",$(this).attr("url"));
		    onloadDo();
	 	 });
		 
		$(".htmlboor[type=2]").load("../public/search_tool_2.html",function(){
		    $("#combo1").attr("url",$(this).attr("url"));
		    $("#combo2").attr("url",$(this).attr("url2"));
		    onloadDo();
	  	});
	  
		$(".htmlboor[type=3]").load("../public/search_tool_3.html",function(){
		    onloadDo();
		 });
	  
	  	$(".htmlboor[type=4]").load("../public/search_tool_4.html",function(){
		    onloadDo();
	 	 });
	  
	    $(".htmlboor[type=5]").load("../public/search_tool_5.html",function(){
		    $("#combo1").attr("url",$(this).attr("url"));
			onloadDo();
	 	});
	}else{
	   onloadDo();
	}
 
   function onloadDo(){
	   if(typeof mini !="undefined" ){
		   mini.parse();
	   }else{
		   return ;
	   }
 	
	 TZSystem.bar.addData = mini.get("addData");	
	 if(TZSystem.bar.addData){
		TZSystem.bar.addData.on("click",function(){
		   public_openWindow();	
		});
	 }	
	 if(typeof grid != 'undefined'){
		 grid.on("load",function(){
			 $(".mini-pager-size").siblings().filter("a").each(function(index,items){
			   	  var txt = $(items).attr('title');
				  if(txt){
					 $(items).find("span").html(txt);
				  }
				});
				grid.showVGridLines = false;
		 });
		 
         if(typeof grid2 !="undefined"){
		    grid2.on("load",function(){
		    $(".mini-pager-size").siblings().filter("a").each(function(index,items){
			   var txt = $(items).attr('title');
		  	   if(txt){
		  		  $(items).find("span").html(txt);
			   }
		    });
		  });
	    }
	 }
	 //导出
     $("#ExportExcel").click(function(){
	   var url = $("#exportIFrame").attr("url");
		
	   if(url)
		 ExportExcel(url);
     });	
 
	 var d1 = mini.get("combo1");
	 var d2 = mini.get("combo2");
	 if(d1){
		$("#fliter_type_text").val( mini.encode(d1.data) );
	 }
	 if(d2){
		$("#fliter_type2_text2").val( mini.encode(d2.data) );
	 }
  }
  window.alert = function (e) { return false ;}
 
});

/**
 * 日期格式化函数
 * @param {Object} format
 * @memberOf {TypeName} 
 * @return {TypeName} 
 */
Date.prototype.format =function(format){
    var o = {
	    "M+" : this.getMonth()+1,
		"d+" : this.getDate(),
		"h+" : this.getHours(),
		"m+" : this.getMinutes(),
		"s+" : this.getSeconds(),
		"q+" : Math.floor((this.getMonth()+3)/3),
		"S" : this.getMilliseconds()
    }
    if(/(y+)/.test(format)) format=format.replace(RegExp.$1,
    (this.getFullYear()+"").substr(4- RegExp.$1.length));
    for(var k in o)if(new RegExp("("+ k +")").test(format))
    format = format.replace(RegExp.$1,
    RegExp.$1.length==1? o[k] :
    ("00"+ o[k]).substr((""+ o[k]).length));
    return format;
}

/**
 * 打印列表数据功能
 */
function printExcel(){
	var LODOP=getLodop();
    LODOP.PRINT_INIT("打印列表数据");//打印初始化,并设定打印任务名
	LODOP.SET_PRINT_PAGESIZE(0,0,0,"A4");//设定纸张大小
	var htmlStr = printExcelPreview('12px',false,10);//参数注释详见printExcelPreview函数
	LODOP.ADD_PRINT_TABLE(0, 0, "100%", "100%", htmlStr);//表格打印项
	LODOP.SET_PRINT_MODE("FULL_WIDTH_FOR_OVERFLOW",true);//设置宽度方向上的内容溢出自动缩小
	LODOP.PREVIEW();//打印预览
}

/*
 * fontSize:字体大小
 * nowrap:是否允许td内容换行
 * maxLength:td内容最大长度
 */
function printExcelPreview(fontSize,nowrap,maxLength){
	if( typeof fontSize == "undefined"){
		fontSize = "14px";
	}
	if( typeof nowrap == "undefined"){
		nowrap = false;
	}
	if( typeof maxLength == "undefined"){
		maxLength = 10;
	}
	if(nowrap){
		maxLength = 100;
	}
	var htmlStr = '<table cellpadding="0" cellspacing="0">';
	var columns = grid.getBottomColumns();
	function getColumns(columns) {
		columns = columns.clone();
		for (var i = columns.length - 1; i >= 0; i--) {
		  	 var column = columns[i];
		     if (!column.field) {
			    columns.removeAt(i);
			 }else{
			 	var c = new Object();
			 	c.header = column.header;
			    c.field = column.field;
			    if(typeof column.dateFormat !="undefined" ){
			    	c.dateFormat = column.dateFormat;
			    }
			    if(typeof column.renderer !="undefined" ){
			    	c.renderer = column.renderer;
			    }
			    if(typeof column.visible !="undefined" ){
				    if(column.field != 'id' && !column.visible){
				    	columns.removeAt(i);
	   		    	}else{
	   		    		columns[i] = c;
	   		    	}
			    }else{
			    	columns[i] = c;
			    }
			 }
		}
		return columns;
	}	
	var columns = getColumns(columns);
	htmlStr += '<thead>';
	htmlStr += '<tr bgcolor="#F8F8FF"><th colspan="'+columns.length+'" tindex="1">第<font tdata="PageNO" color="blue" format="0">####</font>页' +
			   '/共<font tdata="PageCount" format="0" color="blue">####</font>页&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' +
			   '本页<font tdata="SubCount" format="0" color="blue">###</font>条,共<font color="blue" tdata="AllCount" format="0">#####</font>条</th></tr>';
	htmlStr += '<tr bgcolor="#F8F8FF">';
	for(var i=0;i<columns.length;i++){
	   	var header = columns[i].header;
	   	if(columns[i].field == 'id'){
	   		header = '序号';
		}else if(header.length > maxLength){
	    	header = header.substring(0,maxLength);
	    }
   		htmlStr += '<td style="font-weight:bold;">'+header+'</td>';
	}
	htmlStr += '</tr></thead>';
	
	htmlStr += '<tbody>';
	var resultObj;
	if(grid.totalCount > grid.pageSize && grid.pageIndex == 0){
		var filter_key_1 = "" , filter_key_2 = "" ,key="";
		var keyobj = mini.get("key");
		var combo1 = mini.get("combo1");
		var combo2 = mini.get("combo2");
		if (typeof keyobj!="undefined" ){
		   key = keyobj.getValue();
		}
		if (typeof combo1 !="undefined"){
		   filter_key_1 = combo1.getValue();
		}
		if (typeof combo2 !="undefined"){
		   filter_key_2 = combo2.getValue();
		}
		$.ajax({
		    url: grid.url,
		    async:false,
		    type: 'post',
		    data: {	
		    		key: key,
		    		filter_val_1:filter_key_1.trim(),
		    		filter_val_2:filter_key_2.trim(),
		    		pageIndex:0,
		    		pageSize:grid.totalCount,
		    		sortField:grid.sortField,
		    		sortOrder:grid.sortOrder
		    	  },
		    cache: false,
		    success: function (jsonData) {
		        resultObj = mini.decode(jsonData);
		    }
		});
	}else{
		resultObj = grid.getResultObject();
	}
	for(var i=0;i<resultObj.data.length;i++){
	    htmlStr += '<tr>';
		for(var j=0;j<columns.length;j++){
		    var field = columns[j].field;
		    if(field == 'id'){
    			fieldValue = i+1;
    		}else{
	    		var fieldValue = (resultObj.data[i])[field];
    		    if(fieldValue == null){
    		    	fieldValue = '';
    		    }
    		    if(typeof columns[j].dateFormat !="undefined" ){
    		        if(fieldValue != '' && (columns[j].header.indexOf('年龄') == -1)){
    		        	fieldValue=new Date(fieldValue).format(columns[j].dateFormat);
    		        }
    		    }
    		    if(typeof columns[j].renderer !="undefined" ){
    		        if(fieldValue != ''){
    		        	var e = new Object();
    		        	e.value = fieldValue;
		        		fieldValue = eval(columns[j].renderer+'(e)');
    		        }
    		    }
    		    if(fieldValue.length > maxLength && (typeof columns[j].dateFormat =="undefined")){
    		    	fieldValue = fieldValue.substring(0,maxLength);
    		    }
    		}
			htmlStr += '<td>'+fieldValue+'</td>';
    	}
    	htmlStr += '</tr>';
	}
	htmlStr += '</tbody></table>';
	var strBodyStyle="<style>table{ width:100%;border: 1px solid #000;border-collapse:collapse;font-size:"+fontSize+"; }";
	strBodyStyle += " tr{ height:24}";
	strBodyStyle += " td{ border:1px dotted #000;text-align : center;white-space: "+(!nowrap ? "nowrap" : "normal")+"; }";
	strBodyStyle += "</style>";
	return strBodyStyle+"<body>"+htmlStr+"</body>";
}

/**
 * 打印表单数据功能
 */
function printForm(){
	var LODOP=getLodop();
	var formTitle = getParTile();
	if( typeof formTitle == "undefined"){
		formTitle = "空标题单据";
	}else{
		formTitle += "单据";
	}
	var printStyleContent;
	$.ajax({
	    url: "../printStyleAction.do?method=detailJson",
	    async:false,
	    type: 'post',
	    data: {task_name:formTitle},
	    cache: false,
	    success: function (text) {
	        printStyleContent = text;
	    }
	});
	if(printStyleContent != ''){
		eval(printStyleContent);
		var formArr = new Array();
		getFormArrayData(formArr);
		for(var i = 0;i < formArr.length;i++){
			var fieldObj = formArr[i];
			var strContent = fieldObj.label+"：";
			if(fieldObj.text != '' && (typeof fieldObj.text != "undefined")){
			    strContent+=fieldObj.text;
			}else{
				if(fieldObj.type == 'radiobuttonlist'){
					var e = new Object();
				    e.value = fieldObj.value;
					if(fieldObj.url == '../data/yn.txt'){
				    	strContent+=onYNRenderer(e);
					}else if(fieldObj.url == '../data/genders.txt'){
				    	strContent+=onGenderRenderer(e);
					}
				}else{
					strContent+=fieldObj.value;
				}
			}
			LODOP.SET_PRINT_STYLEA(fieldObj.name,'Content',strContent);
		}
	}else{
		LODOP.PRINT_INIT(formTitle);//打印初始化,并设定打印任务名
		LODOP.SET_PRINT_PAGESIZE(0,0,0,"A4");//设定纸张大小
		printFormDesign(LODOP,formTitle,editWindow.getHeight());
	}
	LODOP.SET_PRINT_MODE("FULL_HEIGHT_FOR_OVERFLOW",true);//设置高度方向上的内容溢出自动缩小
	var	lodopResult=LODOP.PRINT_DESIGN();
	if(lodopResult != ''){
		$.ajax({
            url: '../printStyleAction.do?method=save',
			type: 'post',
            data: {task_name:formTitle,content:lodopResult},
            cache: false,
            success: function (text) {}
        });
	}
}

/**
 * 获取表单数组数据
 */
function getFormArrayData(formArr){
	var fields = form.getFields();
	for (var i = 0, l = fields.length; i < l; i++) {
        var c = fields[i];
        var fieldObj = new Object();
        fieldObj.name = c.name;
        fieldObj.value = c.value;
        fieldObj.text = c.text;
        fieldObj.type = c.type;
        fieldObj.url = c.url;
        if(c.type != 'hidden'){
        	formArr.push(fieldObj);
        }
    }
    var tableObj=$("#editform").find("table")[0];
    for(var i=0 ,k = 0;i<tableObj.rows.length;i++){
        for(var j=0;j<tableObj.rows[i].cells.length;j++){
            var cellHtml = tableObj.rows[i].cells[j].innerHTML;
        	if(cellHtml.indexOf("INPUT") == -1 && cellHtml.indexOf("button") == -1 && cellHtml.indexOf("span") == -1){
        		formArr[k].label = cellHtml.replace("：","");
        		k++;
        	}
        }
    }
}

/**
 * 打印表单数据设计排版
 */
function printFormDesign(LODOP,formTitle,rectHeight){
	var cellHeight = 40,cellWidth = 240,rowsNumber = 0,columnsNumber = 0;
	if( typeof rectHeight == "undefined"){
		rectHeight = 350;
	}
	LODOP.ADD_PRINT_RECT(20,20,720,rectHeight,0,1);//增加矩形线
	LODOP.ADD_PRINT_TEXT(35,230,300,30,formTitle);//增加纯文本打印项
	LODOP.SET_PRINT_STYLEA(0,"FontSize",14);
	LODOP.SET_PRINT_STYLEA(0,"Alignment",2);
	LODOP.SET_PRINT_STYLEA(0,"Bold",1);
	LODOP.ADD_PRINT_LINE(71,20,70,740,2,1);//增加直线
	LODOP.SET_PRINT_STYLE("FontSize",12);
	
	var formArr = new Array();
	getFormArrayData(formArr);
	for(var i = 0;i < formArr.length;i++){
		var fieldObj = formArr[i];
		var strContent = fieldObj.label+"：";
		if(fieldObj.text != '' && (typeof fieldObj.text != "undefined")){
		    strContent+=fieldObj.text;
		}else{
			if(fieldObj.type == 'radiobuttonlist'){
				var e = new Object();
			    e.value = fieldObj.value;
				if(fieldObj.url == '../data/yn.txt'){
			    	strContent+=onYNRenderer(e);
				}else if(fieldObj.url == '../data/genders.txt'){
			    	strContent+=onGenderRenderer(e);
				}
			}else{
				strContent+=fieldObj.value;
			}
		}
		if((i+1)%3 == 1){//换行
			rowsNumber ++ ;
		}
		columnsNumber = (i+1)%3;
		if(columnsNumber == 0){
			columnsNumber = 3;
		}
		LODOP.ADD_PRINT_TEXTA(fieldObj.name,(80+cellHeight*(rowsNumber-1)),(30+cellWidth*(columnsNumber-1)),220,30,strContent);
		if(columnsNumber != 3){
			LODOP.ADD_PRINT_LINE((110+cellHeight*(rowsNumber-1)),(260+cellWidth*(columnsNumber-1)),(70+cellHeight*(rowsNumber-1)),(261+cellWidth*(columnsNumber-1)),2,1);//增加竖线
			if((i+1) == formArr.length){
				LODOP.ADD_PRINT_LINE(71+cellHeight*rowsNumber,20,(70+cellHeight*rowsNumber),740,2,1);//增加直线
			}
		}else{
			LODOP.ADD_PRINT_LINE(71+cellHeight*rowsNumber,20,(70+cellHeight*rowsNumber),740,2,1);//增加直线
		}
	}
}

/**
 * 另存为Excel文件
 */
function saveAsExcelFile(){
	var LODOP=getLodop();
	LODOP.PRINT_INIT("");
	var htmlStr = printExcelPreview('12px',false,100);//参数注释详见printExcelPreview函数
	LODOP.ADD_PRINT_TABLE(0, 0, "100%", "100%", htmlStr);//表格打印项
	LODOP.SET_SAVE_MODE("Orientation",2); //Excel文件的页面设置：横向打印   1-纵向,2-横向;
	LODOP.SET_SAVE_MODE("PaperSize",9);  //Excel文件的页面设置：纸张大小   9-对应A4
	LODOP.SET_SAVE_MODE("Zoom",90);       //Excel文件的页面设置：缩放比例
	LODOP.SET_SAVE_MODE("CenterHorizontally",true);//Excel文件的页面设置：页面水平居中
	LODOP.SET_SAVE_MODE("CenterVertically",true); //Excel文件的页面设置：页面垂直居中
	var messageId = mini.showMessageBox({
        title: "请您选择导出模式",
        iconCls: "mini-messagebox-question",
        buttons: ["默认", "快速"],
        message: "选择：默认模式(带表格样式)，快速模式(无表格样式)。",
        callback: function (action) {
			mini.hideMessageBox(messageId);
            if(action == '快速'){
            	LODOP.SET_SAVE_MODE("QUICK_SAVE",true);//快速生成（无表格样式,数据量较大时或许用到）
            }
            LODOP.SAVE_TO_FILE(getParTile() + ".xls");
        }
    });
}

	/**
	 * 连续打印单据
	 */
	function printExcelForm(){
		var LODOP=getLodop();
		var formListArr = new Array();
		getFormListArrayData(formListArr);
		if(formListArr.length > 0){
			var formTitle = getParTile();
			if( typeof formTitle == "undefined"){
				formTitle = "空标题单据";
			}else{
				formTitle += "单据";
			}
			var printStyleContent;
			$.ajax({
			    url: "../printStyleAction.do?method=detailJson",
			    async:false,
			    type: 'post',
			    data: {task_name:formTitle},
			    cache: false,
			    success: function (text) {
			        printStyleContent = text;
			    }
			});
			if(printStyleContent != ''){
				LODOP.PRINT_INIT(formTitle);
				LODOP.SET_PRINT_PAGESIZE(2,0,0,"A4");
				printStyleContent = printStyleContent.replace('LODOP.PRINT_INIT("'+formTitle+'");','');
				printStyleContent = printStyleContent.replace('LODOP.SET_PRINT_PAGESIZE(0,0,0,"A4");','');
				var printStyleContentArr = new Array();
				for(var i = 0;i<formListArr.length;i++){
					printStyleContentArr.push(printStyleContent);
				}
				var formArrTemp = new Array();
				getFormArrayData(formArrTemp);
				for(var i = 0;i < formArrTemp.length;i++){
					var fieldObj = formArrTemp[i];
					for(var k=0;k<printStyleContentArr.length;k++){
						printStyleContentArr[k] = printStyleContentArr[k].replace("\""+fieldObj.name+"\"","\""+fieldObj.name+k+"\"");
					}
				}
				for(var k = 0;k < formListArr.length;k++){
					var formArr = formListArr[k];
					var recordIndex = k%4+1;//本页第几条记录
					if(recordIndex == 1){
						LODOP.SET_PRINT_STYLE('HOrient',0);//左边距锁定
						LODOP.SET_PRINT_STYLE('VOrient',0);//上边距锁定
					}else if(recordIndex == 2){
						LODOP.SET_PRINT_STYLE('HOrient',0);//左边距锁定
						LODOP.SET_PRINT_STYLE('VOrient',1);//下边距锁定
					}else if(recordIndex == 3){
						LODOP.SET_PRINT_STYLE('HOrient',1);//右边距锁定
						LODOP.SET_PRINT_STYLE('VOrient',0);//上边距锁定
					}else if(recordIndex == 4){
						LODOP.SET_PRINT_STYLE('HOrient',1);//右边距锁定
						LODOP.SET_PRINT_STYLE('VOrient',1);//下边距锁定
					}
					eval(printStyleContentArr[k]);
					for(var i = 0;i < formArr.length;i++){
						var fieldObj = formArr[i];
						var strContent = fieldObj.label+"：";
						if(fieldObj.text != '' && (typeof fieldObj.text != "undefined")){
						    strContent+=fieldObj.text;
						}else{
							if(fieldObj.type == 'radiobuttonlist'){
								var e = new Object();
							    e.value = fieldObj.value;
								if(fieldObj.url == '../data/yn.txt'){
							    	strContent+=onYNRenderer(e);
								}else if(fieldObj.url == '../data/genders.txt'){
							    	strContent+=onGenderRenderer(e);
								}
							}else{
								strContent+=fieldObj.value;
							}
						}
						LODOP.SET_PRINT_STYLEA(fieldObj.name+k,'Content',strContent);
					}
					if(recordIndex == 4){
						LODOP.NewPage();
					}
				}
				LODOP.SET_PRINT_MODE("PRINT_PAGE_PERCENT","Width:73%;Height:82%");
				LODOP.SET_PRINT_MODE("FULL_HEIGHT_FOR_OVERFLOW",true);//设置高度方向上的内容溢出自动缩小
				LODOP.PREVIEW();
			}else{
				mini.alert('请先设置单个单据的打印样式!');
			}
		}
	}

	/**
	 * 获取已选中的记录表单数据
	 */
	function getFormListArrayData(formListArr){
		var rows = grid.getSelecteds();
        if (rows.length > 0) {
            for (var i = 0; i < rows.length; i++) {
            	form.clear();
	            $.ajax({
	                url: grid.url.replace('getPageData','detailJson') + "&id=" + rows[i].id,
	                async:false,
			    	type: 'post',
	                success: function (text) {
	                    form.unmask();
	                    var o = mini.decode(text);
	                    form.setData(o);
	                }
	            });
	            var formArr = new Array();
				getFormArrayData(formArr);
				formListArr.push(formArr);
            }
        } else {
            mini.alert("请至少选中一条记录!");
        }
	}
	
	/**
	 * 获取当前页面按钮权限
	 */
	function getButtonPower(){
		$.ajax({
		    url: "../userInfoAction.do?method=getButtonPower",
		    type: 'post',
		    data: {id:get_TabsId()},
		    cache: false,
		    success: function (text) {
		    	if(text.indexOf('view') == -1){
		    	}
		    	if(text.indexOf('add') == -1){
		    		$("#addData").hide();
		    	}
		    	if(text.indexOf('edit') == -1){
		    		$("a.Edit_Button").each(function(index,obj){
		    			if(text.indexOf('add') == -1){
		    				$(this).text('查看');
							$("#editWindowButton").hide();
		    			}else{
		    				$(this).hide();
		    			}
					});
		    	}
		    	if(text.indexOf('delete') == -1){
		    		$("a.Delete_Button").each(function(index,obj){
						$(this).hide();
					});
		    	}
		    }
		});
	}

function md5(psd){var hexcase=1;var chrsz=8;var mode=32;function md5(s){return hex_md5(s);}function hex_md5(s){return binl2hex(core_md5(str2binl(s),s.length*chrsz))}function bit_rol(num,cnt){return (num<<cnt)|(num>>>(32-cnt))}function binl2hex(binarray){var hex_tab=hexcase?
		"0123456789ABCDEF":"0123456789abcdef";var str="";for(var i=0;i<binarray.length*4;i++){str+=hex_tab.charAt((binarray[i>>2]>>((i%4)*8+4))&15)+hex_tab.charAt((binarray[i>>2]>>((i%4)*8))&15)}return str}function str2binl(str){var bin=Array();var mask=(1<<chrsz)-1;for(var i=0;i<str.length*chrsz;i+=chrsz){bin[i>>5]|=(str.charCodeAt(i/chrsz)&mask)<<(i%32)}return bin}function core_md5(x,len){x[len>>5]|=128<<((len)%32);x[(((len+64)>>>9)<<4)+14]=len;var a=1732584193;var b=-271733879;var c=-1732584194;var d=271733878;for(var i=0;i<x.length;i+=16){var olda=a;var oldb=b;var oldc=c;var oldd=d;a=md5_ff(a,b,c,d,x[i+0],7,-680876936);d=md5_ff(d,a,b,c,x[i+1],12,-389564586);c=md5_ff(c,d,a,b,x[i+2],17,606105819);b=md5_ff(b,c,d,a,x[i+3],22,-1044525330);a=md5_ff(a,b,c,d,x[i+4],7,-176418897);d=md5_ff(d,a,b,c,x[i+5],12,1200080426);c=md5_ff(c,d,a,b,x[i+6],17,-1473231341);b=md5_ff(b,c,d,a,x[i+7],22,-45705983);a=md5_ff(a,b,c,d,x[i+8],7,1770035416);d=md5_ff(d,a,b,c,x[i+9],12,-1958414417);c=md5_ff(c,d,a,b,x[i+10],17,-42063);b=md5_ff(b,c,d,a,x[i+11],22,-1990404162);a=md5_ff(a,b,c,d,x[i+12],7,1804603682);d=md5_ff(d,a,b,c,x[i+13],12,-40341101);c=md5_ff(c,d,a,b,x[i+14],17,-1502002290);b=md5_ff(b,c,d,a,x[i+15],22,1236535329);a=md5_gg(a,b,c,d,x[i+1],5,-165796510);d=md5_gg(d,a,b,c,x[i+6],9,-1069501632);c=md5_gg(c,d,a,b,x[i+11],14,643717713);b=md5_gg(b,c,d,a,x[i+0],20,-373897302);a=md5_gg(a,b,c,d,x[i+5],5,-701558691);d=md5_gg(d,a,b,c,x[i+10],9,38016083);c=md5_gg(c,d,a,b,x[i+15],14,-660478335);b=md5_gg(b,c,d,a,x[i+4],20,-405537848);a=md5_gg(a,b,c,d,x[i+9],5,568446438);d=md5_gg(d,a,b,c,x[i+14],9,-1019803690);c=md5_gg(c,d,a,b,x[i+3],14,-187363961);b=md5_gg(b,c,d,a,x[i+8],20,1163531501);a=md5_gg(a,b,c,d,x[i+13],5,-1444681467);d=md5_gg(d,a,b,c,x[i+2],9,-51403784);c=md5_gg(c,d,a,b,x[i+7],14,1735328473);b=md5_gg(b,c,d,a,x[i+12],20,-1926607734);a=md5_hh(a,b,c,d,x[i+5],4,-378558);d=md5_hh(d,a,b,c,x[i+8],11,-2022574463);c=md5_hh(c,d,a,b,x[i+11],16,1839030562);b=md5_hh(b,c,d,a,x[i+14],23,-35309556);a=md5_hh(a,b,c,d,x[i+1],4,-1530992060);d=md5_hh(d,a,b,c,x[i+4],11,1272893353);c=md5_hh(c,d,a,b,x[i+7],16,-155497632);b=md5_hh(b,c,d,a,x[i+10],23,-1094730640);a=md5_hh(a,b,c,d,x[i+13],4,681279174);d=md5_hh(d,a,b,c,x[i+0],11,-358537222);c=md5_hh(c,d,a,b,x[i+3],16,-722521979);b=md5_hh(b,c,d,a,x[i+6],23,76029189);a=md5_hh(a,b,c,d,x[i+9],4,-640364487);d=md5_hh(d,a,b,c,x[i+12],11,-421815835);c=md5_hh(c,d,a,b,x[i+15],16,530742520);b=md5_hh(b,c,d,a,x[i+2],23,-995338651);a=md5_ii(a,b,c,d,x[i+0],6,-198630844);d=md5_ii(d,a,b,c,x[i+7],10,1126891415);c=md5_ii(c,d,a,b,x[i+14],15,-1416354905);b=md5_ii(b,c,d,a,x[i+5],21,-57434055);a=md5_ii(a,b,c,d,x[i+12],6,1700485571);d=md5_ii(d,a,b,c,x[i+3],10,-1894986606);c=md5_ii(c,d,a,b,x[i+10],15,-1051523);b=md5_ii(b,c,d,a,x[i+1],21,-2054922799);a=md5_ii(a,b,c,d,x[i+8],6,1873313359);d=md5_ii(d,a,b,c,x[i+15],10,-30611744);c=md5_ii(c,d,a,b,x[i+6],15,-1560198380);b=md5_ii(b,c,d,a,x[i+13],21,1309151649);a=md5_ii(a,b,c,d,x[i+4],6,-145523070);d=md5_ii(d,a,b,c,x[i+11],10,-1120210379);c=md5_ii(c,d,a,b,x[i+2],15,718787259);b=md5_ii(b,c,d,a,x[i+9],21,-343485551);a=safe_add(a,olda);b=safe_add(b,oldb);c=safe_add(c,oldc);d=safe_add(d,oldd)}if(mode==16){return Array(b,c)}else{return Array(a,b,c,d)}}function md5_cmn(q,a,b,x,s,t){return safe_add(bit_rol(safe_add(safe_add(a,q),safe_add(x,t)),s),b)}function safe_add(x,y){var lsw=(x&65535)+(y&65535);var msw=(x>>16)+(y>>16)+(lsw>>16);return (msw<<16)|(lsw&65535)}function md5_ff(a,b,c,d,x,s,t){return md5_cmn((b&c)|((~b)&d),a,b,x,s,t)}function md5_gg(a,b,c,d,x,s,t){return md5_cmn((b&d)|(c&(~d)),a,b,x,s,t)}function md5_hh(a,b,c,d,x,s,t){return md5_cmn(b^c^d,a,b,x,s,t)}function md5_ii(a,b,c,d,x,s,t){return md5_cmn(c^(b|(~d)),a,b,x,s,t)}return md5(psd).toLowerCase();}

function get_TabsId(){
	if(typeof parent.window.tab_tid =="undefined" ) { 
		return false ; 
	}else{
		return parent.window.tab_tid;
	}
}
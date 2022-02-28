var setting1 = {
	check: {
		enable: true,
		chkboxType: {"Y":"ps", "N":"ps"}
	},
	view: {
		dblClickExpand: false,
		showIcon: false
	},
	data: {
		simpleData: {
			enable: true
		}
	},
	callback: {
		beforeClick: beforeClicktree,
		onCheck: onChecktree
	}
};

var zNodestree = null;

function beforeClicktree(treeId, treeNode) {
	var zTree = $.fn.zTree.getZTreeObj("treeDemoTree");
	zTree.checkNode(treeNode, !treeNode.checked, null, true);
	return false;
}

function onChecktree(e, treeId, treeNode) {
	var zTree = $.fn.zTree.getZTreeObj("treeDemoTree"),
	nodes = zTree.getCheckedNodes(true),
	v = "";
	ids = "";
	for (var i=0, l=nodes.length; i<l; i++) {
		v += nodes[i].name + ",";
		ids += nodes[i].id +",";
	}
	if (v.length > 0 ) {
		v = v.substring(0, v.length-1);
		ids = ids.substring(0, ids.length-1);
	}
	var cityObj = $("#treesname");
	cityObj.attr("value", v);
	$("#trees").attr("value",ids);
}

function showMenutree() {
	var cityObj = $("#treesname");
	var cityOffset = $("#treesname").offset();
	$("#menuContentTree").css({left:cityOffset.left + "px", top:cityOffset.top + cityObj.outerHeight() + "px"}).slideDown("fast");

	$("body").bind("mousedown", onBodyDownTree);
}
function hideMenutree() {
	$("#menuContentTree").fadeOut("fast");
	$("body").unbind("mousedown", onBodyDownTree);
}
function onBodyDownTree(event) {
	if (!(event.target.id == "menuBtn" || event.target.id == "treesname" || event.target.id == "menuContentTree" || $(event.target).parents("#menuContentTree").length>0)) {
		hideMenutree();
	}
}

function loadDateTree(flag, url) {
	if(flag){
		$.ajax( {
				url : url,
				type : "post",
				dataType : "json",
				success : function(data) {
			        alert(data.data);
					zNodestree = JSON.parse(data.data);
					$.fn.zTree.init($("#treeDemoTree"), setting1,zNodestree);
					$("#trees").val(data.ids);
					$("#treesname").val(data.names);
				},
				error : function(e) {
					alert("数据异常");
				}
			})
	}else{
		if (zNodestree != null) {
			$.fn.zTree.init($("#treeDemoTree"), setting1, zNodestree);
		} else {
			$.ajax({
				url : url,
				type : "post",
				dataType : "json",
				success : function(data) {
				        alert(data.data);
					zNodestree = JSON.parse(data.data);
					$.fn.zTree.init($("#treeDemoTree"), setting1,zNodestree);
					$("#trees").val(data.ids);
					$("#treesname").val(data.names);
				},
				error : function(e) {
					alert("数据异常");
				}
			});
		}
	}
}

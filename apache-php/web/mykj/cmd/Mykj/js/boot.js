__CreateJSPath = function (js) {
    var scripts = document.getElementsByTagName("script");
    var path = "";
    for (var i = 0, l = scripts.length; i < l; i++) {
        var src = scripts[i].src;
        if (src.indexOf(js) != -1) {
            var ss = src.split(js);
            path = ss[0];
            break;
        }
    }
    var href = location.href;
    href = href.split("#")[0];
    href = href.split("?")[0];
    var ss = href.split("/");
    ss.length = ss.length - 1;
    href = ss.join("/");
    if (path.indexOf("https:") == -1 && path.indexOf("http:") == -1 && path.indexOf("file:") == -1 && path.indexOf("\/") != 0) {
        path = href + "/" + path;
    }
    return path;
}

var bootPATH = __CreateJSPath("boot.js");

mini_debugger = true;   

document.write('<script src=' + bootPATH + 'jquery-1.7.2.min.js type="text/javascript" ></script>');
document.write('<script src=' + bootPATH + 'miniui/miniui.js type="text/javascript" ></script>');
document.write('<script src=' + bootPATH + 'public.js type="text/javascript" ></script>');
document.write('<script src=' + bootPATH + 'CheckModel.js type="text/javascript" ></script>');
document.write('<link href=' + bootPATH + 'miniui/themes/default/miniui.css rel="stylesheet" type="text/css" />');
document.write('<link href=' + bootPATH + 'miniui/themes/icons.css rel="stylesheet" type="text/css" />');

var skin = 'bootstrap';
if (skin) {
    document.write('<link href="' + bootPATH + 'miniui/themes/' + skin + '/skin.css" rel="stylesheet" type="text/css" />');
}
document.write('<link href=' + bootPATH + '../css/public.css rel="stylesheet" type="text/css" />');

////////////////////////////////////////////////////////////////////////////////////////
function getCookie(sName) {
    var aCookie = document.cookie.split("; ");
    var lastMatch = null;
    for (var i = 0; i < aCookie.length; i++) {
        var aCrumb = aCookie[i].split("=");
        if (sName == aCrumb[0]) {
            lastMatch = aCrumb;
        }
    }
    if (lastMatch) {
        var v = lastMatch[1];
        if (v === undefined) return v;
        return unescape(v);
    }
    return null;
}
var TZSystem = {NS:
function(ns) {
  if (!ns || !ns.length) {
     return null;
  } 
  var levels = ns.split(".");
  var nsobj = TZSystem;
	  
  for (var i=(levels[0] == "TZSystem") ? 1:0; i<levels.length; ++i) {	 
     nsobj[levels[i]] = nsobj[levels[i]] || {};
     nsobj = nsobj[levels[i]];
  }
  return nsobj;
}
} 
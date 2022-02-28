(function() {
    function b(f) {
        var e = new RegExp("(?:^|;+|\\s+)" + f + "=([^;]*)"), a = document.cookie.match(e);
		
		return (!a ? "" : a[1])
    }
    jQuery && jQuery.ajaxSetup && jQuery.ajaxSetup({data: {_bqq_csrf: b("_bqq_csrf")}})
})();

EAC = window.EAC || {};
EAC.header = {init: function() {
    },zoomDetect: {init: function() {
            EAC.header.zoomDetect.listenZoom();
            $$(document).bind("keydown", function(c) {
                var d = c;
                if (c.keyCode == 189 && c.ctrlKey || c.keyCode == 187 && c.ctrlKey || c.keyCode == 107 && c.ctrlKey || c.keyCode == 109 && c.ctrlKey) {
                    EAC.header.zoomDetect.listenZoom(d);
                    window.scrollTo(0, 0);
                }
            });
        },listenZoom: function(c) {
            if ($$.browser.msie) {
                if (window.screen.deviceYDPI != window.screen.logicalYDPI) {
                    if (window.screen.deviceYDPI > window.screen.logicalYDPI) {
                        EAC.header.zoomDetect.showDetect("zoom")
                    } else {
                        EAC.header.zoomDetect.showDetect("narrow")
                    }
                } else {
                    EAC.header.zoomDetect.hideDetect()
                }
            } else {
               
                var d = function() {
                   
                  
                };
                if (!c) {
                    d();
                    return
                }
                setTimeout(d, 32)
            }
        },showDetect: function(g) {
            if (EAC.cookie.get("zoomDetect") != 1) {
                var e = "";
                if (g == "zoom") {
                    e = "放大"
                } else {
                    if (g == "narrow") {
                        e = "缩小"
                    } else {
                        e = "缩放"
                    }
                }
                if ($$("#gb-hintbar").length == 0) {
                    var h = "", f = [];
                    f.push('<div class="gb-hintbar" id="gb-hintbar">');
                    f.push('	<div class="inner">');
                    f.push('		<div class="hintbar-txt">您的浏览器目前处于<span id="hintbar-txt">' + e + '</span>状态，会导致页面显示不正常，您可以键盘按"ctrl+数字0"组合键恢复初始状态。<a href="javascript:;" onclick="EAC.header.zoomDetect.closeDetect(); return false;">不再提示</a></div>');
                    f.push("	</div>");
                    f.push('	<a title="点击退出" class="text-close" href="javascript:;" onclick="EAC.header.zoomDetect.hideDetect(); return false;">×</a>');
                    f.push("</div>");
                    h = f.join("");
                    $$(h).insertBefore(".head")[0]
                } else {
                    $$("#hintbar-txt").text(e);
                    $$("#gb-hintbar").removeClass("dis")
                }
            }
        },closeDetect: function() {
            EAC.cookie.set("zoomDetect", 1, "id.b.qq.com", "/", 720);
            $$("#gb-hintbar").remove()
        },hideDetect: function() {
            if ($$("#gb-hintbar").length > 0) {
                $$("#gb-hintbar").addClass("dis")
            } else {
                return
            }
        }},login: function() {
    },logout: function() {
    }};
EAC.common = {doTimeout: function(d) {
        if (d && d != "undefined") {
            try {
                $$.UI.Confirm.init({title: "出错了",content: '<div class="ui_confirm_content_box">登录超时，请重新登录</div>',width: 300,height: 150,type: 0,ok: function() {
                        window.location = d
                    }})
            } catch (c) {
                window.location = "/"
            }
        } else {
            window.location = "/"
        }
    }};

EAC.lang = {trim: function(h, i) {
        var f, g = 0, j = 0;
        h += "";
        if (!i) {
            f = " \n\r\t\f\x0b\xa0\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200a\u200b\u2028\u2029\u3000"
        } else {
            i += "";
            f = i.replace(/([\[\]\(\)\.\?\/\*\{\}\+\$$\^\:])/g, "$$1")
        }
        g = h.length;
        for (j = 0; j < g; j++) {
            if (f.indexOf(h.charAt(j)) === -1) {
                h = h.substring(j);
                break
            }
        }
        g = h.length;
        for (j = g - 1; j >= 0; j--) {
            if (f.indexOf(h.charAt(j)) === -1) {
                h = h.substring(0, j + 1);
                break
            }
        }
        return f.indexOf(h.charAt(0)) === -1 ? h : ""
    },encodeHTML: function(b) {
        b = b.replace(/&/g, "&amp;");
        b = b.replace(/</g, "&lt;");
        b = b.replace(/>/g, "&gt;");
        b = b.replace(/'/g, "&#039;");
        b = b.replace(/"/g, "&quot;");
        return b
    },getUrlParam: function(j) {
        var h = [];
        str = window.location.href, arr = str.substr(str.indexOf("?") + 1, str.length).split("&");
        for (var i = 1, g = arr.length; i < g - 1; i++) {
            var f = [];
            f = arr[i].split("=");
            h[f[0]] = decodeURLValue(f[1])
        }
        return h
    },getStrLength: function(c) {
        var d = c.match(/[^\x00-\xff]/ig);
        return c.length + (d == null ? 0 : d.length)
    },getStrLength3: function(c) {
        var d = c.match(/[^\x00-\xff]/ig);
        return c.length + c.length + (d == null ? 0 : d.length)
    },getStrLengthn: function(d, f) {
        var e = d.match(/[^\x00-\xff]/ig);
        return d.length + (e == null ? 0 : e.length * (f - 1))
    }};
EAC.cookie = {set: function(l, j, k, i, h) {//键值,域名,"/",小时
        if (h) {
            var g = new Date();
            g.setTime(g.getTime() + 3600000 * h)
        }
        document.cookie = l + "=" + j + "; " + (h ? ("expires=" + g.toGMTString() + "; ") : "") + (i ? ("path=" + i + "; ") : "path=/; ") + (k ? ("domain=" + k + ";") : ("domain=" + k + ";"));
        return true
    },get: function(d) {
        var f = new RegExp("(?:^|;+|\\s+)" + d + "=([^;]*)"), e = document.cookie.match(f);
        return (!e ? "" : e[1])
    },del: function(e, d, f) {
        document.cookie = e + "=; expires=Mon, 26 Jul 1997 05:00:00 GMT; " + (f ? ("path=" + f + "; ") : "path=/; ") + (d ? ("domain=" + d + ";") : ("domain=" + d + ";"))
    }};
function onPtlogin2success() {
    $$.ajax({url: "/Sign.html",type: "POST",success: function(b) {
            $$("#user").html("欢迎您，" + b + ' <a id="logout" href="#">[退出]</a>');
            BZ.params.userNick = b;
            BZ.header.logout();
            dialog_login.destroy()
        },dataType: "json"})
}
function ptlogin2_onResize(f, e) {
    var d = document.getElementById("login_div");
    if (d) {
        d.style.width = f + "px";
        d.style.height = e + "px";
        d.style.visibility = "hidden";
        d.style.visibility = "visible"
    }
}
function ptlogin2_onLogin() {
    return true
}
function ptlogin2_onClose() {
}
;

if (typeof window.postMessage !== "undefined") {
    window.onmessage = function(e) {
        var f = e || window.event;
        var d;
        if (typeof JSON !== "undefined") {
            d = JSON.parse(f.data)
        } else {
            d = str2JSON(f.data)
        }
        switch (d.action) {
            case "close":
                ptlogin2_onClose();
                break;
            case "resize":
                ptlogin2_onResize(d.width, d.height);
                break;
            default:
                break
        }
    }
}
function str2JSON(str) {
    eval("var __pt_json=" + str);
    return __pt_json
}
;
function hotclick(a) {
    this.t = a
}
hotclick.prototype = {sendHeat: function(a) {
        var d = "string" == typeof this.t ? this.t : this.t.url.join(""), d = d.replace(/r2=([^&]*)/, function(a, c) {
            return "r2=h" + c
        }).replace(/r3=([^&]*)/, function() {
            return "r3=" + Math.max(document.body.scrollHeight, document.documentElement.scrollHeight)
        }) + "&x=" + a.x + "&y=" + a.y;
        (new Image).src = d
    },linkHeat: function(a) {
        try {
            var d = !0, b = "", c;
            c = window.event ? window.event.srcElement : a.target;
            switch (c.tagName) {
                case "A":
                    b = "<A href=" + c.href + ">" + c.innerHTML + "</a>";
                    break;
                case "IMG":
                    b = "<IMG src=" + 
                    c.src + ">";
                    break;
                case "INPUT":
                    b = "<INPUT type=" + c.type + " value=" + c.value + ">";
                    break;
                case "BUTTON":
                    b = "<BUTTON>" + c.innerText + "</BUTTON>";
                    break;
                case "SELECT":
                    b = "SELECT";
                    break;
                default:
                    d = !1
            }
            if (d) {
                var e = this.getElementPos(c);
                if (_params.coordinateId) {
                    var f = t.getElementPos(document.getElementById(_params.coordinateId));
                    e.x -= f.x
                }
                this.sendHeat(e, b)
            }
        } catch (g) {
        }
    },getPos: function(a, d, b, c) {
        var b = b || 0, c = c || 0, d = d || document, e = a || window.event, a = {}, a = e.pageX || e.pageY ? {x: e.pageX,y: e.pageY} : {x: e.clientX + Math.max(d.documentElement.scrollLeft, 
            d.body.scrollLeft) - d.body.clientLeft,y: e.clientY + Math.max(d.documentElement.scrollTop, d.body.scrollTop) - d.body.clientTop};
        a.x += b;
        a.y += c;
        d = Math.max(Math.max(document.body.clientWidth, document.body.offsetWidth), Math.max(document.body.scrollWidth, document.documentElement.scrollWidth)) / 2;
        a.x = a.x - d + window.screen.width / 2 - (Math.max(document.body.scrollHeight, document.documentElement.scrollHeight) > ("undefined" == typeof window.innerHeight ? document.documentElement.clientHeight : window.innerHeight) ? 8.5 : 0);
        return a;
    },
    clickHeat: function(a) {
        this.sendHeat(this.getPos(a))
    },watchClick: function(a) {
        var d = function(a, b, c) {
            var d = function(a) {
                a = window.event || a;
                target = a.srcElement || a.target;
                c(a, target)
            };
            a.attachEvent ? a.attachEvent("on" + b, d) : a.addEventListener(b, d, !1)
        }, b = this;
        if (a)
            b.clickHeat(evt);
        else {
            a = document;
            d(a, "click", function(a) {
                b.sendHeat(b.getPos(a))
            });
            for (var c = a.getElementsByTagName("iframe"), e = 0, a = c.length; e < a; e++)
                try {
                    (function() {
                        var a = c[e], f = a.contentWindow.document;
                        d(f, "click", function(c) {
                            var d = b.getElementPos(a);
                            b.sendHeat(b.getPos(c, f, d.x, d.y))
                        })
                    })()
                } catch (f) {
                }
        }
    },getElementPos: function(a) {
        if (null === a.parentNode || "none" == a.style.display)
            return !1;
        var d = navigator.userAgent.toLowerCase(), b = null, c = [];
        if (a.getBoundingClientRect)
            return d = a.getBoundingClientRect(), a = Math.max(document.documentElement.scrollTop, document.body.scrollTop), b = Math.max(document.documentElement.scrollLeft, document.body.scrollLeft), {x: d.left + b - document.body.clientLeft,y: d.top + a - document.body.clientTop};
        if (document.getBoxObjectFor)
            d = document.getBoxObjectFor(a), 
            c = [d.x - (a.style.borderLeftWidth ? Math.floor(a.style.borderLeftWidth) : 0), d.y - (a.style.borderTopWidth ? Math.floor(a.style.borderTopWidth) : 0)];
        else {
            c = [a.offsetLeft, a.offsetTop];
            b = a.offsetParent;
            if (b != a)
                for (; b; )
                    c[0] += b.offsetLeft, c[1] += b.offsetTop, b = b.offsetParent;
            if (-1 < d.indexOf("opera") || -1 < d.indexOf("safari") && "absolute" == a.style.position)
                c[0] -= document.body.offsetLeft, c[1] -= document.body.offsetTop
        }
        for (b = a.parentNode ? a.parentNode : null; b && "BODY" != b.tagName && "HTML" != b.tagName; )
            c[0] -= b.scrollLeft, c[1] -= 
            b.scrollTop, b = b.parentNode ? b.parentNode : null;
        return {x: c[0],y: c[1]}
    }};
/*  |xGv00|3803f2ca925ff57bb6ef2c2684e7f9a6 */
;



(function() {
    window.onerror = function(e, b, a) {
        if (location.protocol == "https:") {
            return
        }
        var c = document.createElement("img");
        var d = encodeURIComponent(e + "|_|" + b + "|_|" + a + "|_|" + window.navigator.userAgent);
        c.src = "http://badjs.qq.com/cgi-bin/js_report?bid=110&mid=195279&msg=" + d + "&v=" + Math.random();
        c = null
    }
})();
var g_cdn_js_fail = false;
var pt = {};
pt.str = {no_uin: "您还没有输入帐号！",no_pwd: "您还没有输入密码！",no_vcode: "您还没有输入验证码！",inv_uin: "请输入正确的帐号！",inv_vcode: "请输入完整的验证码！",qlogin_expire: "您所选择号码对应的已经失效，请检查该号码对应的CC是否已经被关闭。",other_login: "帐号登录",h_pt_login: "帐号密码登录",otherqq_login: "其它CC号登录"};
pt.ptui = {s_url: "https\x3A\x2F\x2Fid.b.qq.com\x2Flogin\x2Fsuccess",proxy_url: "https\x3A\x2F\x2Fid.b.qq.com\x2Fproxy.html",jumpname: encodeURIComponent(""),mibao_css: encodeURIComponent(""),defaultUin: "",href: "https\x3A\x2F\x2Fxui.ptlogin2.qq.com\x2Fcgi-bin\x2Fxlogin\x3Fappid\x3D717016508\x26s_url\x3Dhttps\x3A\x2F\x2Fid.b.qq.com\x2Flogin\x2Fsuccess\x26style\x3D19\x26proxy_url\x3Dhttps\x3A\x2F\x2Fid.b.qq.com\x2Fproxy.html\x26border_radius\x3D1\x26daid\x3D160\x26enable_qlogin\x3D0",login_sig: "Udy81L9U6izfV*4PejBj8vbOVm6BArxAZXmqL*eAZDyBrKMFrJXrG-PBENUJJADR",clientip: "03057f000001d04e",serverip: "",version: "201405270930",ptui_version: encodeURIComponent("10080"),isHttps: false,cssPath: "https://ui.ptlogin2.qq.com/style.ssl/19",domain: encodeURIComponent("qq.com"),pt_3rd_aid: encodeURIComponent("0"),appid: encodeURIComponent("717016508"),lang: encodeURIComponent("2052"),style: encodeURIComponent("19"),low_login: encodeURIComponent("0"),daid: encodeURIComponent("160"),regmaster: encodeURIComponent(""),enable_qlogin: "0",noAuth: "0",target: encodeURIComponent("1"),csimc: encodeURIComponent("0"),csnum: encodeURIComponent("0"),authid: encodeURIComponent("0"),auth_mode: encodeURIComponent("0"),pt_qzone_sig: "0",pt_light: "0",pt_vcode_v1: "0",pt_ver_md5: "0123456789012345"};


function cleanCache(f) {
    var t = document.createElement("iframe");
    if (f.split("#").length == 3)
        f = f.substring(0, f.lastIndexOf("#"));
    t.src = f;
    t.style.display = "none";
    document.body.appendChild(t);
}
;
function loadScript(src, callback) {
    var tag = document.createElement("script");
    tag.onload = tag.onreadystatechange = function() {
        if (!this.readyState || this.readyState === "loaded" || this.readyState === "complete") {
            if (typeof callback == "function") {
                callback();
            }
            tag.onload = tag.onreadystatechange = null;
        }
    };
    tag.onerror = function() {
        tag.onerror = null;
        callback();
    }
    tag.src = src;
    document.getElementsByTagName("head")[0].appendChild(tag);
}
;
//海伦娜 js拉取失败,重试一次，重试失败就把提交按钮disable
if (typeof (ptuiCB) == "undefined") {
    window.g_cdn_js_fail = true;
    var imgAttr2 = new Image();
    imgAttr2.src = location.protocol + "//ui.ptlogin2.qq.com/cgi-bin/report?id=242325&union=256043";
    var serverJsPath = "../js/" + pt.ptui.ptui_version + "/c_login_2.js?max_age=604800&ptui_identifier=0123456789012345";
    loadScript(serverJsPath, function() {
        if (typeof (ptuiCB) == "undefined") {
            var button = document.getElementById("login_button");
            button && (button.disabled = true);
            imgAttr2.src = location.protocol + "//ui.ptlogin2.qq.com/cgi-bin/report?id=280504";
        }
    });
}
function ptuiV(v) {
    if (v != pt.ptui.ptui_version) {
        cleanCache("/clearcache.html#" + location.href);
    }
}
/*function checkVersion() {
    var t = document.createElement("script");
    t.src = "/ptui_ver.js?v=" + Math.random() + "&ptui_identifier=" + pt.ptui.pt_ver_md5;
    document.body.appendChild(t);
}
setTimeout(checkVersion, 1500);*/
var $$ = window.Simple = function(a) {
    return typeof (a) == "string" ? document.getElementById(a) : a
};
$$.cookie = {get: function(b) {
        var a = document.cookie.match(new RegExp("(^| )" + b + "=([^;]*)(;|$$)"));
        return !a ? "" : decodeURIComponent(a[2])
    },getOrigin: function(b) {
        var a = document.cookie.match(new RegExp("(^| )" + b + "=([^;]*)(;|$$)"));
        return !a ? "" : (a[2])
    },set: function(c, f, d, g, a) {
        var b = new Date();
        if (a) {
            b.setTime(b.getTime() + 3600000 * a);
            document.cookie = c + "=" + f + "; expires=" + b.toGMTString() + "; path=" + (g ? g : "/") + "; " + (d ? ("domain=" + d + ";") : "")
        } else {
            document.cookie = c + "=" + f + "; path=" + (g ? g : "/") + "; " + (d ? ("domain=" + d + ";") : "")
        }
    },del: function(a, b, c) {
        document.cookie = a + "=; expires=Mon, 26 Jul 1997 05:00:00 GMT; path=" + (c ? c : "/") + "; " + (b ? ("domain=" + b + ";") : "")
    },uin: function() {
        var a = $$.cookie.get("uin");
        return !a ? null : parseInt(a.substring(1, a.length), 10)
    }};
$$.http = {getXHR: function() {
        return window.ActiveXObject ? new ActiveXObject("Microsoft.XMLHTTP") : new XMLHttpRequest()
    },ajax: function(url, para, cb, method, type) {
        var xhr = $$.http.getXHR();
        xhr.open(method, url);
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4) {
                if ((xhr.status >= 200 && xhr.status < 300) || xhr.status === 304 || xhr.status === 1223 || xhr.status === 0) {
                    if (typeof (type) == "undefined" && xhr.responseText) {
                        cb(eval("(" + xhr.responseText + ")"))
                    } else {
                        cb(xhr.responseText);
                        if ((!xhr.responseText) && $$.badjs._smid) {
                            $$.badjs("HTTP Empty[xhr.status]:" + xhr.status, url, 0, $$.badjs._smid)
                        }
                    }
                } else {
                    if ($$.badjs._smid) {
                        $$.badjs("HTTP Error[xhr.status]:" + xhr.status, url, 0, $$.badjs._smid)
                    }
                }
                xhr = null
            }
        };
        xhr.send(para);
        return xhr
    },post: function(c, b, a, g) {
        var f = "";
        for (var d in b) {
            f += "&" + d + "=" + b[d]
        }
        return $$.http.ajax(c, f, a, "POST", g)
    },get: function(c, b, a, f) {
        var g = [];
        for (var d in b) {
            g.push(d + "=" + b[d])
        }
        if (c.indexOf("?") == -1) {
            c += "?"
        }
        c += g.join("&");
        return $$.http.ajax(c, null, a, "GET", f)
    },jsonp: function(a) {
        var b = document.createElement("script");
        b.src = a;
        document.getElementsByTagName("head")[0].appendChild(b)
    },loadScript: function(c, d, b) {
        var a = document.createElement("script");
        a.onload = a.onreadystatechange = function() {
            if (!this.readyState || this.readyState === "loaded" || this.readyState === "complete") {
                if (typeof d == "function") {
                    d()
                }
                a.onload = a.onreadystatechange = null;
                if (a.parentNode) {
                    a.parentNode.removeChild(a)
                }
            }
        };
        a.src = c;
        document.getElementsByTagName("head")[0].appendChild(a)
    },preload: function(a) {
        var b = document.createElement("img");
        b.src = a;
        b = null
    }};
$$.get = $$.http.get;
$$.post = $$.http.post;
$$.jsonp = $$.http.jsonp;
$$.browser = function(b) {
    if (typeof $$.browser.info == "undefined") {
        var a = {type: ""};
        var c = navigator.userAgent.toLowerCase();
        if (/webkit/.test(c)) {
            a = {type: "webkit",version: /webkit[\/ ]([\w.]+)/}
        } else {
            if (/opera/.test(c)) {
                a = {type: "opera",version: /version/.test(c) ? /version[\/ ]([\w.]+)/ : /opera[\/ ]([\w.]+)/}
            } else {
                if (/msie/.test(c)) {
                    a = {type: "msie",version: /msie ([\w.]+)/}
                } else {
                    if (/mozilla/.test(c) && !/compatible/.test(c)) {
                        a = {type: "ff",version: /rv:([\w.]+)/}
                    }
                }
            }
        }
        a.version = (a.version && a.version.exec(c) || [0, "0"])[1];
        $$.browser.info = a
    }
    return $$.browser.info[b]
};
$$.e = {_counter: 0,_uid: function() {
        return "h" + $$.e._counter++
    },add: function(c, b, g) {
       
    	if (typeof c != "object") {
            c = $$(c);
            
        }
        if (document.addEventListener) {
            c.addEventListener(b, g, false)
        } else {
            if (document.attachEvent) {
                if ($$.e._find(c, b, g) != -1) {
                    return
                }
                var j = function(h) {
                    if (!h) {
                        h = window.event
                    }
                    var d = {_event: h,type: h.type,target: h.srcElement,currentTarget: c,relatedTarget: h.fromElement ? h.fromElement : h.toElement,eventPhase: (h.srcElement == c) ? 2 : 3,clientX: h.clientX,clientY: h.clientY,screenX: h.screenX,screenY: h.screenY,altKey: h.altKey,ctrlKey: h.ctrlKey,shiftKey: h.shiftKey,keyCode: h.keyCode,data: h.data,origin: h.origin,stopPropagation: function() {
                            this._event.cancelBubble = true
                        },preventDefault: function() {
                            this._event.returnValue = false
                        }};
                    if (Function.prototype.call) {
                        g.call(c, d)
                    } else {
                        c._currentHandler = g;
                        c._currentHandler(d);
                        c._currentHandler = null
                    }
                };
                c.attachEvent("on" + b, j);
                var f = {element: c,eventType: b,handler: g,wrappedHandler: j};
                var k = c.document || c;
                var a = k.parentWindow;
                var l = $$.e._uid();
                if (!a._allHandlers) {
                    a._allHandlers = {}
                }
                a._allHandlers[l] = f;
                if (!c._handlers) {
                    c._handlers = []
                }
                c._handlers.push(l);
                if (!a._onunloadHandlerRegistered) {
                    a._onunloadHandlerRegistered = true;
                    a.attachEvent("onunload", $$.e._removeAllHandlers)
                }
            }
        }
    },remove: function(f, c, j) {
        if (document.addEventListener) {
            f.removeEventListener(c, j, false)
        } else {
            if (document.attachEvent) {
                var b = $$.e._find(f, c, j);
                if (b == -1) {
                    return
                }
                var l = f.document || f;
                var a = l.parentWindow;
                var k = f._handlers[b];
                var g = a._allHandlers[k];
                f.detachEvent("on" + c, g.wrappedHandler);
                f._handlers.splice(b, 1);
                delete a._allHandlers[k]
            }
        }
    },_find: function(f, a, m) {
        var b = f._handlers;
        if (!b) {
            return -1
        }
        var k = f.document || f;
        var l = k.parentWindow;
        for (var g = b.length - 1; g >= 0; g--) {
            var c = b[g];
            var j = l._allHandlers[c];
            if (j.eventType == a && j.handler == m) {
                return g
            }
        }
        return -1
    },_removeAllHandlers: function() {
        var a = this;
        for (id in a._allHandlers) {
            var b = a._allHandlers[id];
            b.element.detachEvent("on" + b.eventType, b.wrappedHandler);
            delete a._allHandlers[id]
        }
    },src: function(a) {
        return a ? a.target : event.srcElement
    },stopPropagation: function(a) {
        a ? a.stopPropagation() : event.cancelBubble = true
    },trigger: function(c, b) {
        var f = {HTMLEvents: "abort,blur,change,error,focus,load,reset,resize,scroll,select,submit,unload",UIEevents: "keydown,keypress,keyup",MouseEvents: "click,mousedown,mousemove,mouseout,mouseover,mouseup"};
        if (document.createEvent) {
            var d = "";
            (b == "mouseleave") && (b = "mouseout");
            (b == "mouseenter") && (b = "mouseover");
            for (var g in f) {
                if (f[g].indexOf(b)) {
                    d = g;
                    break
                }
            }
            var a = document.createEvent(d);
            a.initEvent(b, true, false);
            c.dispatchEvent(a)
        } else {
            if (document.createEventObject) {
                c.fireEvent("on" + b)
            }
        }
    }};
$$.bom = {query: function(b) {
        var a = window.location.search.match(new RegExp("(\\?|&)" + b + "=([^&]*)(&|$$)"));
        return !a ? "" : decodeURIComponent(a[2])
    },getHash: function(b) {
        var a = window.location.hash.match(new RegExp("(#|&)" + b + "=([^&]*)(&|$$)"));
        return !a ? "" : decodeURIComponent(a[2])
    }};
$$.winName = {set: function(c, a) {
        var b = window.name || "";
        if (b.match(new RegExp(";" + c + "=([^;]*)(;|$$)"))) {
            window.name = b.replace(new RegExp(";" + c + "=([^;]*)"), ";" + c + "=" + a)
        } else {
            window.name = b + ";" + c + "=" + a
        }
    },get: function(c) {
        var b = window.name || "";
        var a = b.match(new RegExp(";" + c + "=([^;]*)(;|$$)"));
        return a ? a[1] : ""
    },clear: function(b) {
        var a = window.name || "";
        window.name = a.replace(new RegExp(";" + b + "=([^;]*)"), "")
    }};
	
$$.localData = function() {
    var a = "ptlogin2.qq.com";
    var d = /^[0-9A-Za-z_-]*$$/;
    var b;
    function c() {
        var h = document.createElement("link");
        h.style.display = "none";
        h.id = a;
        document.getElementsByTagName("head")[0].appendChild(h);
        h.addBehavior("#default#userdata");
        return h
    }
    function f() {
        if (typeof b == "undefined") {
            if (window.localStorage) {
                b = localStorage
            } else {
                try {
                    b = c();
                    b.load(a)
                } catch (h) {
                    b = false;
                    return false
                }
            }
        }
        return true
    }
    function g(h) {
        if (typeof h != "string") {
            return false
        }
        return d.test(h)
    }
    return {set: function(h, j) {
            var l = false;
            if (g(h) && f()) {
                try {
                    j += "";
                    if (window.localStorage) {
                        b.setItem(h, j);
                        l = true
                    } else {
                        b.setAttribute(h, j);
                        b.save(a);
                        l = b.getAttribute(h) === j
                    }
                } catch (k) {
                }
            }
            return l
        },get: function(h) {
            if (g(h) && f()) {
                try {
                    return window.localStorage ? b.getItem(h) : b.getAttribute(h)
                } catch (j) {
                }
            }
            return null
        },remove: function(h) {
            if (g(h) && f()) {
                try {
                    window.localStorage ? b.removeItem(h) : b.removeAttribute(h);
                    return true
                } catch (j) {
                }
            }
            return false
        }}
}();
$$.str = (function() {
    var htmlDecodeDict = {quot: '"',lt: "<",gt: ">",amp: "&",nbsp: " ","#34": '"',"#60": "<","#62": ">","#38": "&","#160": " "};
    var htmlEncodeDict = {'"': "#34","<": "#60",">": "#62","&": "#38"," ": "#160"};
    return {decodeHtml: function(s) {
            s += "";
            return s.replace(/&(quot|lt|gt|amp|nbsp);/ig, function(all, key) {
                return htmlDecodeDict[key]
            }).replace(/&#u([a-f\d]{4});/ig, function(all, hex) {
                return String.fromCharCode(parseInt("0x" + hex))
            }).replace(/&#(\d+);/ig, function(all, number) {
                return String.fromCharCode(+number)
            })
        },encodeHtml: function(s) {
            s += "";
            return s.replace(/["<>& ]/g, function(all) {
                return "&" + htmlEncodeDict[all] + ";"
            })
        },trim: function(str) {
            str += "";
            var str = str.replace(/^\s+/, ""), ws = /\s/, end = str.length;
            while (ws.test(str.charAt(--end))) {
            }
            return str.slice(0, end + 1)
        },uin2hex: function(str) {
            var maxLength = 16;
            str = parseInt(str);
            var hex = str.toString(16);
            var len = hex.length;
            for (var i = len; i < maxLength; i++) {
                hex = "0" + hex
            }
            var arr = [];
            for (var j = 0; j < maxLength; j += 2) {
                arr.push("\\x" + hex.substr(j, 2))
            }
            var result = arr.join("");
            eval('result="' + result + '"');
            return result
        },bin2String: function(a) {
            var arr = [];
            for (var i = 0, len = a.length; i < len; i++) {
                var temp = a.charCodeAt(i).toString(16);
                if (temp.length == 1) {
                    temp = "0" + temp
                }
                arr.push(temp)
            }
            arr = "0x" + arr.join("");
            arr = parseInt(arr, 16);
            return arr
        },utf8ToUincode: function(s) {
            var result = "";
            try {
                var length = s.length;
                var arr = [];
                for (i = 0; i < length; i += 2) {
                    arr.push("%" + s.substr(i, 2))
                }
                result = decodeURIComponent(arr.join(""));
                result = $$.str.decodeHtml(result)
            } catch (e) {
                result = ""
            }
            return result
        },json2str: function(obj) {
            var result = "";
            if (typeof JSON != "undefined") {
                result = JSON.stringify(obj)
            } else {
                var arr = [];
                for (var i in obj) {
                    arr.push('"' + i + '":"' + obj[i] + '"')
                }
                result = "{" + arr.join(",") + "}"
            }
            return result
        },time33: function(str) {
            var hash = 0;
            for (var i = 0, length = str.length; i < length; i++) {
                hash = hash * 33 + str.charCodeAt(i)
            }
            return hash % 4294967296
        }}
})();
$$.css = function() {
    var a = document.documentElement;
    return {getPageScrollTop: function() {
            return window.pageYOffset || a.scrollTop || document.body.scrollTop || 0
        },getPageScrollLeft: function() {
            return window.pageXOffset || a.scrollLeft || document.body.scrollLeft || 0
        },getOffsetPosition: function(c) {
            c = $$(c);
            var f = 0, d = 0;
            if (a.getBoundingClientRect && c.getBoundingClientRect) {
                var b = c.getBoundingClientRect();
                var h = a.clientTop || document.body.clientTop || 0;
                var g = a.clientLeft || document.body.clientLeft || 0;
                f = b.top + this.getPageScrollTop() - h, d = b.left + this.getPageScrollLeft() - g
            } else {
                do {
                    f += c.offsetTop || 0;
                    d += c.offsetLeft || 0;
                    c = c.offsetParent
                } while (c)
            }
            return {left: d,top: f}
        },getWidth: function(b) {
            return $$(b).offsetWidth
        },getHeight: function(b) {
            return $$(b).offsetHeight
        },show: function(b) {
			if(b)
				b.style.display = "block"
        },hide: function(b) {
            if(b)b.style.display = "none"
        },hasClass: function(f, g) {
            if (!f.className) {
                return false
            }
            var c = f.className.split(" ");
            for (var d = 0, b = c.length; d < b; d++) {
                if (g == c[d]) {
                    return true
                }
            }
            return false
        },addClass: function(b, c) {
            $$.css.updateClass(b, c, false)
        },removeClass: function(b, c) {
            $$.css.updateClass(b, false, c)
        },updateClass: function(f, m, o) {
            var b = f.className.split(" ");
            var j = {}, g = 0, l = b.length;
            for (; g < l; g++) {
                b[g] && (j[b[g]] = true)
            }
            if (m) {
                var h = m.split(" ");
                for (g = 0, l = h.length; g < l; g++) {
                    h[g] && (j[h[g]] = true)
                }
            }
            if (o) {
                var c = o.split(" ");
                for (g = 0, l = c.length; g < l; g++) {
                    c[g] && (delete j[c[g]])
                }
            }
            var n = [];
            for (var d in j) {
                n.push(d)
            }
            f.className = n.join(" ")
        },setClass: function(c, b) {
            c.className = b
        }}
}();
$$.animate = {fade: function(d, j, b, f, n) {
        d = $$(d);
        if (!d) {
            return
        }
        if (!d.effect) {
            d.effect = {}
        }
        var g = Object.prototype.toString.call(j);
        var c = 100;
        if (!isNaN(j)) {
            c = j
        } else {
            if (g == "[object Object]") {
                if (j) {
                    if (j.to) {
                        if (!isNaN(j.to)) {
                            c = j.to
                        }
                        if (!isNaN(j.from)) {
                            d.style.opacity = j.from / 100;
                            d.style.filter = "alpha(opacity=" + j.from + ")"
                        }
                    }
                }
            }
        }
        if (typeof (d.effect.fade) == "undefined") {
            d.effect.fade = 0
        }
        window.clearInterval(d.effect.fade);
        var b = b || 1, f = f || 20, h = window.navigator.userAgent.toLowerCase(), m = function(o) {
            var q;
            if (h.indexOf("msie") != -1) {
                var p = (o.currentStyle || {}).filter || "";
                q = p.indexOf("opacity") >= 0 ? (parseFloat(p.match(/opacity=([^)]*)/)[1])) + "" : "100"
            } else {
                var r = o.ownerDocument.defaultView;
                r = r && r.getComputedStyle;
                q = 100 * (r && r(o, null)["opacity"] || 1)
            }
            return parseFloat(q)
        }, a = m(d), k = a < c ? 1 : -1;
        if (h.indexOf("msie") != -1) {
            if (f < 15) {
                b = Math.floor((b * 15) / f);
                f = 15
            }
        }
        var l = function() {
            a = a + b * k;
            if ((Math.round(a) - c) * k >= 0) {
                d.style.opacity = c / 100;
                d.style.filter = "alpha(opacity=" + c + ")";
                window.clearInterval(d.effect.fade);
                if (typeof (n) == "function") {
                    n(d)
                }
            } else {
                d.style.opacity = a / 100;
                d.style.filter = "alpha(opacity=" + a + ")"
            }
        };
        d.effect.fade = window.setInterval(l, f)
    },animate: function(b, c, j, t, h) {
        b = $$(b);
        if (!b) {
            return
        }
        if (!b.effect) {
            b.effect = {}
        }
        if (typeof (b.effect.animate) == "undefined") {
            b.effect.animate = 0
        }
        for (var o in c) {
            c[o] = parseInt(c[o]) || 0
        }
        window.clearInterval(b.effect.animate);
        var j = j || 10, t = t || 20, k = function(x) {
            var w = {left: x.offsetLeft,top: x.offsetTop};
            return w
        }, v = k(b), g = {width: b.clientWidth,height: b.clientHeight,left: v.left,top: v.top}, d = [], s = window.navigator.userAgent.toLowerCase();
        if (!(s.indexOf("msie") != -1 && document.compatMode == "BackCompat")) {
            var m = document.defaultView ? document.defaultView.getComputedStyle(b, null) : b.currentStyle;
            var f = c.width || c.width == 0 ? parseInt(c.width) : null, u = c.height || c.height == 0 ? parseInt(c.height) : null;
            if (typeof (f) == "number") {
                d.push("width");
                c.width = f - m.paddingLeft.replace(/\D/g, "") - m.paddingRight.replace(/\D/g, "")
            }
            if (typeof (u) == "number") {
                d.push("height");
                c.height = u - m.paddingTop.replace(/\D/g, "") - m.paddingBottom.replace(/\D/g, "")
            }
            if (t < 15) {
                j = Math.floor((j * 15) / t);
                t = 15
            }
        }
        var r = c.left || c.left == 0 ? parseInt(c.left) : null, n = c.top || c.top == 0 ? parseInt(c.top) : null;
        if (typeof (r) == "number") {
            d.push("left");
            b.style.position = "absolute"
        }
        if (typeof (n) == "number") {
            d.push("top");
            b.style.position = "absolute"
        }
        var l = [], q = d.length;
        for (var o = 0; o < q; o++) {
            l[d[o]] = g[d[o]] < c[d[o]] ? 1 : -1
        }
        var p = b.style;
        var a = function() {
            var w = true;
            for (var x = 0; x < q; x++) {
                g[d[x]] = g[d[x]] + l[d[x]] * Math.abs(c[d[x]] - g[d[x]]) * j / 100;
                if ((Math.round(g[d[x]]) - c[d[x]]) * l[d[x]] >= 0) {
                    w = w && true;
                    p[d[x]] = c[d[x]] + "px"
                } else {
                    w = w && false;
                    p[d[x]] = g[d[x]] + "px"
                }
            }
            if (w) {
                window.clearInterval(b.effect.animate);
                if (typeof (h) == "function") {
                    h(b)
                }
            }
        };
        b.effect.animate = window.setInterval(a, t)
    }};
$$.check = {isHttps: function() {
        return document.location.protocol == "https:"
    },isSsl: function() {
        var a = document.location.host;
        return /^ssl./i.test(a)
    },isIpad: function() {
        var a = navigator.userAgent.toLowerCase();
        return /ipad/i.test(a)
    },isQQ: function(a) {
        return /^[1-9]{1}\d{4,9}$$/.test(a)
    },isQQMail: function(a) {
        return /^[1-9]{1}\d{4,9}@qq\.com$$/.test(a)
    },isNullQQ: function(a) {
        return /^\d{4,8}$$/.test(a)
    },isNick: function(a) {
        return /^[a-zA-Z]{1}([a-zA-Z0-9]|[-_]){0,19}$$/.test(a)
    },isName: function(a) {
        return /[\u4E00-\u9FA5]{1,8}/.test(a)
    },isPhone: function(a) {
        return /^(?:86|886|)1\d{10}\s*$$/.test(a)
    },isDXPhone: function(a) {
        return /^(?:86|886|)1(?:33|53|80|81|89)\d{8}$$/.test(a)
    },isSeaPhone: function(a) {
        return /^(00)?(?:852|853|886(0)?\d{1})\d{8}$$/.test(a)
    },isMail: function(a) {
        return /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$$/.test(a)
    },isQiyeQQ800: function(a) {
        return /^(800)\d{7}$$/.test(a)
    },isPassword: function(a) {
        return a && a.length >= 16
    },isForeignPhone: function(a) {
        return /^00\d{7,}/.test(a)
    },needVip: function(f) {
        var a = ["21001601", "21000110", "21000121", "46000101", "716027609", "716027610", "549000912"];
        var b = true;
        for (var c = 0, d = a.length; c < d; c++) {
            if (a[c] == f) {
                b = false;
                break
            }
        }
        return b
    },isPaipai: function() {
        return /paipai.com$$/.test(window.location.hostname)
    },is_weibo_appid: function(a) {
        if (a == 46000101 || a == 607000101 || a == 558032501) {
            return true
        }
        return false
    }};
$$.report = {monitor: function(c, b) {
        if (Math.random() > (b || 1)) {
            return
        }
        var a = location.protocol + "//ui.ptlogin2.qq.com/cgi-bin/report?id=" + c;
        $$.http.preload(a)
    },nlog: function(f, b) {
        var a = "http://badjs.qq.com/cgi-bin/js_report?";
        if ($$.check.isHttps()) {
            a = "https://ssl.qq.com//badjs/cgi-bin/js_report?"
        }
        var c = location.href;
        var d = encodeURIComponent(f + "|_|" + c + "|_|" + window.navigator.userAgent);
        a += ("bid=110&level=2&mid=" + b + "&msg=" + d + "&v=" + Math.random());
        $$.http.preload(a)
    },simpleIsdSpeed: function(a, c) {
        if (Math.random() < (c || 1)) {
            var b = "http://isdspeed.qq.com/cgi-bin/r.cgi?";
            if ($$.check.isHttps()) {
                b = "https://login.qq.com/cgi-bin/r.cgi?"
            }
            b += a;
            $$.http.preload(b)
        }
    },isdSpeed: function(a, g) {
        var b = false;
        var d = "http://isdspeed.qq.com/cgi-bin/r.cgi?";
        if ($$.check.isHttps()) {
            d = "https://login.qq.com/cgi-bin/r.cgi?"
        }
        d += a;
        if (Math.random() < (g || 1)) {
            var c = $$.report.getSpeedPoints(a);
            for (var f in c) {
                if (c[f] && c[f] < 30000) {
                    d += ("&" + f + "=" + c[f]);
                    b = true
                }
            }
            d += "&v=" + Math.random();
            if (b) {
                $$.http.preload(d)
            }
        }
        $$.report.setSpeedPoint(a)
    },speedPoints: {},basePoint: {},setBasePoint: function(a, b) {
        $$.report.basePoint[a] = b
    },setSpeedPoint: function(a, b, c) {
        if (!b) {
            $$.report.speedPoints[a] = {}
        } else {
            if (!$$.report.speedPoints[a]) {
                $$.report.speedPoints[a] = {}
            }
            $$.report.speedPoints[a][b] = c - $$.report.basePoint[a]
        }
    },setSpeedPoints: function(a, b) {
        $$.report.speedPoints[a] = b
    },getSpeedPoints: function(a) {
        return $$.report.speedPoints[a]
    }};
$$.sso_ver = 0;
$$.sso_state = 0;
$$.plugin_isd_flag = "";
$$.nptxsso = null;
$$.activetxsso = null;
$$.sso_loadComplete = true;
$$.np_clock = 0;
$$.loginQQnum = 0;
$$.suportActive = function() {
    var a = true;
    try {
        if (window.ActiveXObject || window.ActiveXObject.prototype) {
            a = true;
            if (window.ActiveXObject.prototype && !window.ActiveXObject) {
                $$.report.nlog("activeobject 判断有问题")
            }
        } else {
            a = false
        }
    } catch (b) {
        a = false
    }
    return a
};
$$.getLoginQQNum = function() {
    try {
        var f = 0;
        if ($$.suportActive()) {
            $$.plugin_isd_flag = "flag1=7808&flag2=1&flag3=20";
            $$.report.setBasePoint($$.plugin_isd_flag, new Date());
            var l = new ActiveXObject("SSOAxCtrlForPTLogin.SSOForPTLogin2");
            $$.activetxsso = l;
            var b = l.CreateTXSSOData();
            l.InitSSOFPTCtrl(0, b);
            var a = l.DoOperation(2, b);
            var d = a.GetArray("PTALIST");
            f = d.GetSize();
            try {
                var c = l.QuerySSOInfo(1);
                $$.sso_ver = c.GetInt("nSSOVersion")
            } catch (g) {
                $$.sso_ver = 0
            }
        } else {
            if (navigator.mimeTypes["application/nptxsso"]) {
                $$.plugin_isd_flag = "flag1=7808&flag2=1&flag3=21";
                $$.report.setBasePoint($$.plugin_isd_flag, (new Date()).getTime());
                if (!$$.nptxsso) {
                    $$.nptxsso = document.createElement("embed");
                    $$.nptxsso.type = "application/nptxsso";
                    $$.nptxsso.style.width = "0px";
                    $$.nptxsso.style.height = "0px";
                    document.body.appendChild($$.nptxsso)
                }
                if (typeof $$.nptxsso.InitPVANoST != "function") {
                    $$.sso_loadComplete = false;
                    $$.report.nlog("没有找到插件的InitPVANoST方法", 269929)
                } else {
                    var j = $$.nptxsso.InitPVANoST();
                    if (j) {
                        f = $$.nptxsso.GetPVACount();
                        $$.sso_loadComplete = true
                    }
                    try {
                        $$.sso_ver = $$.nptxsso.GetSSOVersion()
                    } catch (g) {
                        $$.sso_ver = 0
                    }
                }
            } else {
                $$.report.nlog("插件没有注册成功", 263744);
                $$.sso_state = 2
            }
        }
    } catch (g) {
        var k = null;
        try {
            k = $$.http.getXHR()
        } catch (g) {
            return 0
        }
        var h = g.message || g;
        if (/^pt_windows_sso/.test(h)) {
            if (/^pt_windows_sso_\d+_3/.test(h)) {
                $$.report.nlog("QQ插件不支持该url" + g.message, 326044)
            } else {
                $$.report.nlog("QQ插件抛出内部错误" + g.message, 325361)
            }
            $$.sso_state = 1
        } else {
            if (k) {
                $$.report.nlog("可能没有安装QQ" + g.message, 322340);
                $$.sso_state = 2
            } else {
                $$.report.nlog("获取登录QQ号码出错" + g.message, 263745);
                if (window.ActiveXObject) {
                    $$.sso_state = 1
                }
            }
        }
        return 0
    }
    $$.loginQQnum = f;
    return f
};

$$.guanjiaPlugin = null;
$$.initGuanjiaPlugin = function() {
    try {
        if (window.ActiveXObject) {
            $$.guanjiaPlugin = new ActiveXObject("npQMExtensionsIE.Basic")
        } else {
            if (navigator.mimeTypes["application/qqpcmgr-extensions-mozilla"]) {
                $$.guanjiaPlugin = document.createElement("embed");
                $$.guanjiaPlugin.type = "application/qqpcmgr-extensions-mozilla";
                $$.guanjiaPlugin.style.width = "0px";
                $$.guanjiaPlugin.style.height = "0px";
                document.body.appendChild($$.guanjiaPlugin)
            }
        }
        var a = $$.guanjiaPlugin.QMGetVersion().split(".");
        if (a.length == 4 && a[2] >= 9319) {
        } else {
            $$.guanjiaPlugin = null
        }
    } catch (b) {
        $$.guanjiaPlugin = null
    }
};
function pluginBegin() {
    if (!$$.sso_loadComplete) {
        try {
            $$.checkNPPlugin()
        } catch (a) {
        }
    }
    $$.sso_loadComplete = true;
    $$.report.setSpeedPoint($$.plugin_isd_flag, 1, (new Date()).getTime());
    window.setTimeout(function(b) {
        $$.report.isdSpeed($$.plugin_isd_flag, 0.05)
    }, 2000)
}
$$.Encryption = function() {
    var hexcase = 1;
    var b64pad = "";
    var chrsz = 8;
    var mode = 32;
    function md5(s) {
        return hex_md5(s)
    }
    function hex_md5(s) {
        return binl2hex(core_md5(str2binl(s), s.length * chrsz))
    }
    function str_md5(s) {
        return binl2str(core_md5(str2binl(s), s.length * chrsz))
    }
    function hex_hmac_md5(key, data) {
        return binl2hex(core_hmac_md5(key, data))
    }
    function b64_hmac_md5(key, data) {
        return binl2b64(core_hmac_md5(key, data))
    }
    function str_hmac_md5(key, data) {
        return binl2str(core_hmac_md5(key, data))
    }
    function core_md5(x, len) {
        x[len >> 5] |= 128 << ((len) % 32);
        x[(((len + 64) >>> 9) << 4) + 14] = len;
        var a = 1732584193;
        var b = -271733879;
        var c = -1732584194;
        var d = 271733878;
        for (var i = 0; i < x.length; i += 16) {
            var olda = a;
            var oldb = b;
            var oldc = c;
            var oldd = d;
            a = md5_ff(a, b, c, d, x[i + 0], 7, -680876936);
            d = md5_ff(d, a, b, c, x[i + 1], 12, -389564586);
            c = md5_ff(c, d, a, b, x[i + 2], 17, 606105819);
            b = md5_ff(b, c, d, a, x[i + 3], 22, -1044525330);
            a = md5_ff(a, b, c, d, x[i + 4], 7, -176418897);
            d = md5_ff(d, a, b, c, x[i + 5], 12, 1200080426);
            c = md5_ff(c, d, a, b, x[i + 6], 17, -1473231341);
            b = md5_ff(b, c, d, a, x[i + 7], 22, -45705983);
            a = md5_ff(a, b, c, d, x[i + 8], 7, 1770035416);
            d = md5_ff(d, a, b, c, x[i + 9], 12, -1958414417);
            c = md5_ff(c, d, a, b, x[i + 10], 17, -42063);
            b = md5_ff(b, c, d, a, x[i + 11], 22, -1990404162);
            a = md5_ff(a, b, c, d, x[i + 12], 7, 1804603682);
            d = md5_ff(d, a, b, c, x[i + 13], 12, -40341101);
            c = md5_ff(c, d, a, b, x[i + 14], 17, -1502002290);
            b = md5_ff(b, c, d, a, x[i + 15], 22, 1236535329);
            a = md5_gg(a, b, c, d, x[i + 1], 5, -165796510);
            d = md5_gg(d, a, b, c, x[i + 6], 9, -1069501632);
            c = md5_gg(c, d, a, b, x[i + 11], 14, 643717713);
            b = md5_gg(b, c, d, a, x[i + 0], 20, -373897302);
            a = md5_gg(a, b, c, d, x[i + 5], 5, -701558691);
            d = md5_gg(d, a, b, c, x[i + 10], 9, 38016083);
            c = md5_gg(c, d, a, b, x[i + 15], 14, -660478335);
            b = md5_gg(b, c, d, a, x[i + 4], 20, -405537848);
            a = md5_gg(a, b, c, d, x[i + 9], 5, 568446438);
            d = md5_gg(d, a, b, c, x[i + 14], 9, -1019803690);
            c = md5_gg(c, d, a, b, x[i + 3], 14, -187363961);
            b = md5_gg(b, c, d, a, x[i + 8], 20, 1163531501);
            a = md5_gg(a, b, c, d, x[i + 13], 5, -1444681467);
            d = md5_gg(d, a, b, c, x[i + 2], 9, -51403784);
            c = md5_gg(c, d, a, b, x[i + 7], 14, 1735328473);
            b = md5_gg(b, c, d, a, x[i + 12], 20, -1926607734);
            a = md5_hh(a, b, c, d, x[i + 5], 4, -378558);
            d = md5_hh(d, a, b, c, x[i + 8], 11, -2022574463);
            c = md5_hh(c, d, a, b, x[i + 11], 16, 1839030562);
            b = md5_hh(b, c, d, a, x[i + 14], 23, -35309556);
            a = md5_hh(a, b, c, d, x[i + 1], 4, -1530992060);
            d = md5_hh(d, a, b, c, x[i + 4], 11, 1272893353);
            c = md5_hh(c, d, a, b, x[i + 7], 16, -155497632);
            b = md5_hh(b, c, d, a, x[i + 10], 23, -1094730640);
            a = md5_hh(a, b, c, d, x[i + 13], 4, 681279174);
            d = md5_hh(d, a, b, c, x[i + 0], 11, -358537222);
            c = md5_hh(c, d, a, b, x[i + 3], 16, -722521979);
            b = md5_hh(b, c, d, a, x[i + 6], 23, 76029189);
            a = md5_hh(a, b, c, d, x[i + 9], 4, -640364487);
            d = md5_hh(d, a, b, c, x[i + 12], 11, -421815835);
            c = md5_hh(c, d, a, b, x[i + 15], 16, 530742520);
            b = md5_hh(b, c, d, a, x[i + 2], 23, -995338651);
            a = md5_ii(a, b, c, d, x[i + 0], 6, -198630844);
            d = md5_ii(d, a, b, c, x[i + 7], 10, 1126891415);
            c = md5_ii(c, d, a, b, x[i + 14], 15, -1416354905);
            b = md5_ii(b, c, d, a, x[i + 5], 21, -57434055);
            a = md5_ii(a, b, c, d, x[i + 12], 6, 1700485571);
            d = md5_ii(d, a, b, c, x[i + 3], 10, -1894986606);
            c = md5_ii(c, d, a, b, x[i + 10], 15, -1051523);
            b = md5_ii(b, c, d, a, x[i + 1], 21, -2054922799);
            a = md5_ii(a, b, c, d, x[i + 8], 6, 1873313359);
            d = md5_ii(d, a, b, c, x[i + 15], 10, -30611744);
            c = md5_ii(c, d, a, b, x[i + 6], 15, -1560198380);
            b = md5_ii(b, c, d, a, x[i + 13], 21, 1309151649);
            a = md5_ii(a, b, c, d, x[i + 4], 6, -145523070);
            d = md5_ii(d, a, b, c, x[i + 11], 10, -1120210379);
            c = md5_ii(c, d, a, b, x[i + 2], 15, 718787259);
            b = md5_ii(b, c, d, a, x[i + 9], 21, -343485551);
            a = safe_add(a, olda);
            b = safe_add(b, oldb);
            c = safe_add(c, oldc);
            d = safe_add(d, oldd)
        }
        if (mode == 16) {
            return Array(b, c)
        } else {
            return Array(a, b, c, d)
        }
    }
    function md5_cmn(q, a, b, x, s, t) {
        return safe_add(bit_rol(safe_add(safe_add(a, q), safe_add(x, t)), s), b)
    }
    function md5_ff(a, b, c, d, x, s, t) {
        return md5_cmn((b & c) | ((~b) & d), a, b, x, s, t)
    }
    function md5_gg(a, b, c, d, x, s, t) {
        return md5_cmn((b & d) | (c & (~d)), a, b, x, s, t)
    }
    function md5_hh(a, b, c, d, x, s, t) {
        return md5_cmn(b ^ c ^ d, a, b, x, s, t)
    }
    function md5_ii(a, b, c, d, x, s, t) {
        return md5_cmn(c ^ (b | (~d)), a, b, x, s, t)
    }
    function core_hmac_md5(key, data) {
        var bkey = str2binl(key);
        if (bkey.length > 16) {
            bkey = core_md5(bkey, key.length * chrsz)
        }
        var ipad = Array(16), opad = Array(16);
        for (var i = 0; i < 16; i++) {
            ipad[i] = bkey[i] ^ 909522486;
            opad[i] = bkey[i] ^ 1549556828
        }
        var hash = core_md5(ipad.concat(str2binl(data)), 512 + data.length * chrsz);
        return core_md5(opad.concat(hash), 512 + 128)
    }
    function safe_add(x, y) {
        var lsw = (x & 65535) + (y & 65535);
        var msw = (x >> 16) + (y >> 16) + (lsw >> 16);
        return (msw << 16) | (lsw & 65535)
    }
    function bit_rol(num, cnt) {
        return (num << cnt) | (num >>> (32 - cnt))
    }
    function str2binl(str) {
        var bin = Array();
        var mask = (1 << chrsz) - 1;
        for (var i = 0; i < str.length * chrsz; i += chrsz) {
            bin[i >> 5] |= (str.charCodeAt(i / chrsz) & mask) << (i % 32)
        }
        return bin
    }
    function binl2str(bin) {
        var str = "";
        var mask = (1 << chrsz) - 1;
        for (var i = 0; i < bin.length * 32; i += chrsz) {
            str += String.fromCharCode((bin[i >> 5] >>> (i % 32)) & mask)
        }
        return str
    }
    function binl2hex(binarray) {
        var hex_tab = hexcase ? "0123456789ABCDEF" : "0123456789abcdef";
        var str = "";
        for (var i = 0; i < binarray.length * 4; i++) {
            str += hex_tab.charAt((binarray[i >> 2] >> ((i % 4) * 8 + 4)) & 15) + hex_tab.charAt((binarray[i >> 2] >> ((i % 4) * 8)) & 15)
        }
        return str
    }
    function binl2b64(binarray) {
        var tab = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";
        var str = "";
        for (var i = 0; i < binarray.length * 4; i += 3) {
            var triplet = (((binarray[i >> 2] >> 8 * (i % 4)) & 255) << 16) | (((binarray[i + 1 >> 2] >> 8 * ((i + 1) % 4)) & 255) << 8) | ((binarray[i + 2 >> 2] >> 8 * ((i + 2) % 4)) & 255);
            for (var j = 0; j < 4; j++) {
                if (i * 8 + j * 6 > binarray.length * 32) {
                    str += b64pad
                } else {
                    str += tab.charAt((triplet >> 6 * (3 - j)) & 63)
                }
            }
        }
        return str
    }
    function hexchar2bin(str) {
        var arr = [];
        for (var i = 0; i < str.length; i = i + 2) {
            arr.push("\\x" + str.substr(i, 2))
        }
        arr = arr.join("");
        eval("var temp = '" + arr + "'");
        return temp
    }
    function getEncryption(password, uin, vcode) {
        //var str1 = hexchar2bin(md5(password));
       // var str2 = md5(str1 + uin);
        //var str3 = md5(str2 + vcode.toUpperCase());
        return md5(password).toLowerCase();
    }
    function getRSAEncryption(password, vcode) {
        var str1 = md5(password);
        var str2 = str1 + vcode.toUpperCase();
        var str3 = $$.RSA.rsa_encrypt(str2);
        return str3
    }
    return {getEncryption: getEncryption,getRSAEncryption: getRSAEncryption}
}();
pt.setHeader = function(a) {
    for (var b in a) {
        if (b != "") {
            if ($$("img_" + b)) {
                if (a[b] && a[b].indexOf("sys.getface.qq.com") > -1) {
                    $$("img_" + b).src = pt.plogin.dftImg
                } else {
                    $$("img_" + b).src = a[b] || pt.plogin.dftImg
                }
            } else {
                if (a[b] && a[b].indexOf("sys.getface.qq.com") > -1) {
                    $$("auth_face").src = pt.plogin.dftImg
                } else {
                    $$("auth_face").src = a[b] || pt.plogin.dftImg
                }
            }
        }
    }
};
pt.qlogin = function() {
    var I = {"19": 3,"20": 2,"21": 3,"22": 3,"23": 3,"25": 3,"32": 3,"33": 3,"34": 3};
    var r = {"19": 300,"20": 240,"21": 360,"22": 360,"23": 300,"25": 300,"32": 360,"33": 300,"34": 300};
    var A = [];
    var p = [];
    var B = 9;
    var O = '<a hidefocus=true draggable=false href="javascript:void(0);" tabindex="#tabindex#" uin="#uin#" type="#type#" onclick="pt.qlogin.imgClick(this);return false;" onfocus="pt.qlogin.imgFocus(this);" onblur="pt.qlogin.imgBlur(this);" onmouseover="pt.qlogin.imgMouseover(this);" onmousedown="pt.qlogin.imgMouseDowm(this)" onmouseup="pt.qlogin.imgMouseUp(this)" onmouseout="pt.qlogin.imgMouseUp(this)" class="face"  >          <img  id="img_#uin#" uin="#uin#" type="#type#" src="#src#"    onerror="pt.qlogin.imgErr(this);" />           <span id="mengban_#uin#"></span>          <span class="uin_menban"></span>          <span class="uin">#uin#</span>          <span id="img_out_#uin#" uin="#uin#" type="#type#"  class="img_out"  ></span>          <span id="nick_#uin#" class="#nick_class#">#nick#</span>          <span  class="#vip_logo#"></span>      </a>';
    var t = '<span  uin="#uin#" type="#type#"  class="#qr_class#"  >          <span class="qr_safe_tips">安全登录，防止盗号</span>          <img   id="qrlogin_img" uin="#uin#" type="#type#" src="#src#" class="qrImg"  />           <span id="nick_#uin#"  class="qr_app_name">            <a class="qr_short_tips"  href="http://im.qq.com/mobileqq/#from=login" target="_blank">#nick#</a>            <span class="qr_safe_login">安全登录</span>            <a hidefocus=true draggable=false class="qr_info_link"  href="http://im.qq.com/mobileqq/#from=login" target="_blank">使用QQ手机版扫描二维码</a>          </span>          <span  class="qrlogin_img_out"  onmouseover="pt.plogin.showQrTips();" onmouseout="pt.plogin.hideQrTips();"></span>          <span id="qr_invalid" class="qr_invalid" onclick="pt.plogin.begin_qrlogin();" onmouseover="pt.plogin.showQrTips();" onmouseout="pt.plogin.hideQrTips();">            <span id="qr_mengban" class="qr_mengban"></span>            <span id="qr_invalid_tips" class="qr_invalid_tips">二维码失效<br/>请点击刷新</span>          </span>       </span>';
    var F = false;
    var l = 1;
    var y = I[pt.ptui.style];
    var v = r[pt.ptui.style];
    var s = 1;
    var J = 5;
    var f = null;
    var H = true;
    var L = 0;
    var a = function(W) {
        if ((W == 1 && s <= 1) || (W == 2 && s >= l)) {
            return
        }
        var S = 0;
        var V = 1;
        var U = $$("qlogin_show").offsetWidth || v;
        var P = 10;
        var T = Math.ceil(U / P);
        var R = 0;
        if (W == 1) {
            s--;
            if (s <= 1) {
                $$.css.hide($$("prePage"));
                $$.css.show($$("nextPage"))
            } else {
                $$.css.show($$("nextPage"));
                $$.css.show($$("prePage"))
            }
        } else {
            s++;
            if (s >= l) {
                $$.css.hide($$("nextPage"));
                $$.css.show($$("prePage"))
            } else {
                $$.css.show($$("nextPage"));
                $$.css.show($$("prePage"))
            }
        }
        function Q() {
            if (W == 1) {
                $$("qlogin_list").style.left = (R * P - s * U) + "px"
            } else {
                $$("qlogin_list").style.left = ((2 - s) * U - R * P) + "px"
            }
            R++;
            if (R > T) {
                window.clearInterval(S)
            }
        }
        S = window.setInterval(Q, V)
    };
    var K = function() {
        p.length = 0;
        if ($$.suportActive()) {
            try {
                var au = $$.activetxsso;
                var W = au.CreateTXSSOData();
                var aq = au.DoOperation(1, W);
                if (null == aq) {
                    return
                }
                var al = aq.GetArray("PTALIST");
                var aw = al.GetSize();
                var ap = "";
                for (var ax = 0; ax < aw; ax++) {
                    var U = al.GetData(ax);
                    var at = U.GetDWord("dwSSO_Account_dwAccountUin");
                    var af = U.GetDWord("dwSSO_Account_dwAccountUin");
                    var Z = "";
                    var ae = U.GetByte("cSSO_Account_cAccountType");
                    var av = at;
                    if (ae == 1) {
                        try {
                            Z = U.GetArray("SSO_Account_AccountValueList");
                            av = Z.GetStr(0)
                        } catch (ar) {
                        }
                    }
                    var ai = 0;
                    try {
                        ai = U.GetWord("wSSO_Account_wFaceIndex")
                    } catch (ar) {
                        ai = 0
                    }
                    var ak = "";
                    try {
                        ak = U.GetStr("strSSO_Account_strNickName")
                    } catch (ar) {
                        ak = ""
                    }
                    var V = U.GetBuf("bufGTKey_PTLOGIN");
                    var X = U.GetBuf("bufST_PTLOGIN");
                    var ad = "";
                    var P = X.GetSize();
                    for (var ao = 0; ao < P; ao++) {
                        var Q = X.GetAt(ao).toString("16");
                        if (Q.length == 1) {
                            Q = "0" + Q
                        }
                        ad += Q
                    }
                    var ah = U.GetDWord("dwSSO_Account_dwUinFlag");
                    var ac = {uin: at,name: av,uinString: af,type: ae,face: ai,nick: ak,flag: ah,key: ad,loginType: 2};
                    p.push(ac)
                }
            } catch (ar) {
                $$.report.nlog("IE获取快速登录信息失败：" + ar.message, "391626")
            }
        } else {
            try {
                var R = $$.nptxsso;
                var ab = R.InitPVA();
                if (ab != false) {
                    var Y = R.GetPVACount();
                    for (var ao = 0; ao < Y; ao++) {
                        var S = R.GetUin(ao);
                        var T = R.GetAccountName(ao);
                        var af = R.GetUinString(ao);
                        var aa = R.GetFaceIndex(ao);
                        var am = R.GetNickname(ao);
                        var ag = R.GetGender(ao);
                        var an = R.GetUinFlag(ao);
                        var ay = R.GetGTKey(ao);
                        var aj = R.GetST(ao);
                        var ac = {uin: S,name: T,uinString: af,type: 0,face: aa,nick: am,flag: an,key: aj,loginType: 2};
                        p.push(ac)
                    }
                    if (typeof (R.GetKeyIndex) == "function") {
                        B = R.GetKeyIndex()
                    }
                }
            } catch (ar) {
                $$.report.nlog("非IE获取快速登录信息失败：" + (ar.message || ar), "391627")
            }
        }
    };
    var m = function(R) {
        for (var Q = 0, P = p.length; Q < P; Q++) {
            var S = p[Q];
            if (S.uinString == R) {
                return S
            }
        }
        return null
    };
    var C = function() {
        K();
        var T = [];
        var R = p.length;
        if (pt.plogin.isNewQr) {
            var S = {};
            S.loginType = 3;
            T.push(S)
        }
        if (pt.plogin.authUin && pt.ptui.auth_mode == "0") {
            var S = {};
            S.name = pt.plogin.authUin;
            S.uinString = pt.plogin.authUin;
            S.nick = $$.str.utf8ToUincode($$.cookie.get("ptuserinfo")) || pt.plogin.authUin;
            S.loginType = 1;
            T.push(S)
        }
        for (var P = 0; P < R; P++) {
            var Q = p[P];
            if (pt.plogin.authUin && (pt.plogin.authUin == Q.name || pt.plogin.authUin == Q.uinString)) {
                continue
            } else {
                T.push(Q)
            }
            if (T.length == 5) {
                break
            }
        }
        A = T;
        return T
    };
    var M = function() {
        var aa = "";
        var ac = 0;
        var Z = C();
        var ad = $$("qlogin_list");
        if (null == ad) {
            return
        }
        var W = Z.length > J ? J : Z.length;
        if (W == 0) {
            pt.plogin.switchpage(1, true);
            return
        }
        if (pt.plogin.isNewQr) {
            if (W == 1 && pt.plogin.isNewQr) {
                $$("qlogin_tips") && $$.css.hide($$("qlogin_tips"));
                $$("qlogin_show").style.top = "25px"
            } else {
                $$("qlogin_tips") && $$.css.show($$("qlogin_tips"));
                $$("qlogin_show").style.top = ""
            }
        }
        l = Math.ceil(W / y);
        if (l >= 2) {
            $$.css.show($$("nextPage"))
        }
        for (var U = 0; U < W; U++) {
            var V = Z[U];
            var S = $$.str.encodeHtml(V.uinString + "");
            var Q = $$.str.encodeHtml(V.nick);
            if ($$.str.trim(V.nick) == "") {
                Q = S
            }
            var ab = V.flag;
            var Y = ((ab & 4) == 4);
            var P = pt.plogin.dftImg;
            if (V.loginType == 3) {
                var T = $$("qr_area");
                if (W == 1) {
                    if (T) {
                        $$("qr_area").className = "qr_0"
                    }
                    if (pt.ptui.lang == "1033") {
                        $$("qlogin_show").style.height = ($$("qlogin_show").offsetHeight + 10) + "px"
                    }
                } else {
                    if (T) {
                        $$("qr_area").className = "qr_1"
                    }
                }
            } else {
                aa += O.replace(/#uin#/g, S).replace(/#nick#/g, function() {
                    return Q
                }).replace(/#nick_class#/, Y ? "nick red" : "nick").replace(/#vip_logo#/, Y ? "vip_logo" : "").replace(/#type#/g, V.loginType).replace(/#src#/g, P).replace(/#tabindex#/, U + 1).replace(/#class#/g, V.loginType == 1 ? "auth" : "hide")
            }
        }
        aa = ad.innerHTML + aa;
        ad.innerHTML = aa;
        var X = $$("qlogin_show").offsetWidth || v;
        var R = (l == 1 ? X : X / y * W);
        ad.style.width = R + "px";
        if (pt.plogin.isNewQr) {
            ad.style.width = (R + 4) + "px"
        }
        F = true;
        N();
        E()
    };
    var u = function(Q) {
        if (Q) {
            K();
            var P = m(Q);
            if (P == null) {
                pt.plogin.show_err(pt.str.qlogin_expire);
                $$.report.monitor(231544, 1);
                return
            } else {
                var R = h(P);
                if (H) {
                    $$.http.loadScript(R)
                } else {
                    pt.plogin.redirect(pt.ptui.target, R)
                }
                if (pt.ptui.style == 20) {
                    pt.plogin.showLoading(35)
                } else {
                    pt.plogin.showLoading(10)
                }
                window.clearTimeout(pt.qlogin.qloginClock);
                pt.qlogin.qloginClock = window.setTimeout("pt.plogin.hideLoading();pt.plogin.showAssistant(0);", 10000)
            }
        }
    };
    var n = function(S, R, T) {
        var P = "";
        var U = S.split("#");
        var Q = U[0].indexOf("?") > 0 ? "&" : "?";
        if (U[0].substr(U[0].length - 1, 1) == "?") {
            Q = ""
        }
        if (U[1]) {
            U[1] = "#" + U[1]
        } else {
            U[1] = ""
        }
        P = U[0] + Q + R + "=" + T + U[1];
        return P
    };
    var G = function(Q) {
        var P = pt.ptui.s_url;
        if (pt.ptui.low_login == 1 && pt.plogin.low_login_enable && pt.plogin.isMailLogin()) {
            P = n(P, "ss", 1)
        }
        if (pt.plogin.isMailLogin() && Q) {
            P = n(P, "account", encodeURIComponent(Q))
        }
        return P
    };
    var h = function(P) {
        var Q = (pt.ptui.isHttps ? "https://ssl.ptlogin2." : "http://ptlogin2.") + pt.ptui.domain + "/" + (pt.ptui.jumpname || "jump") + "?";
        if (pt.ptui.regmaster == 2) {
            Q = "http://ptlogin2.function.qq.com/jump?regmaster=2&"
        } else {
            if (pt.ptui.regmaster == 3) {
                Q = "http://ptlogin2.crm2.qq.com/jump?regmaster=3&"
            }
        }
        Q += "clientuin=" + P.uin + "&clientkey=" + P.key + "&keyindex=" + B + "&pt_aid=" + pt.ptui.appid + (pt.ptui.daid ? "&daid=" + pt.ptui.daid : "") + "&u1=" + encodeURIComponent(G());
        if (pt.ptui.low_login == 1 && pt.plogin.low_login_enable && !pt.plogin.isMailLogin()) {
            Q += "&low_login_enable=1&low_login_hour=" + pt.plogin.low_login_hour
        }
        if (pt.ptui.csimc != "0" && pt.ptui.csimc) {
            Q += "&csimc=" + pt.ptui.csimc + "&csnum=" + pt.ptui.csnum + "&authid=" + pt.ptui.authid
        }
        if (pt.ptui.pt_qzone_sig == "1") {
            Q += "&pt_qzone_sig=1"
        }
        if (pt.ptui.pt_light == "1") {
            Q += "&pt_light=1"
        }
        if (H) {
            Q += "&ptopt=1"
        }
        return Q
    };
    var x = function() {
        var P = o();
        pt.plogin.redirect(pt.ptui.target, P);
        if (pt.ptui.style == 20) {
            pt.plogin.showLoading(35)
        } else {
            pt.plogin.showLoading(10)
        }
    };
    var o = function() {
        var P = pt.plogin.authSubmitUrl;
        P += "&regmaster=" + pt.ptui.regmaster + "&aid=" + pt.ptui.appid + "&s_url=" + encodeURIComponent(G());
        if (pt.ptui.low_login == 1 && pt.plogin.low_login_enable) {
            P += "&low_login_enable=1&low_login_hour=" + pt.plogin.low_login_hour
        }
        if (pt.ptui.pt_light == "1") {
            P += "&pt_light=1"
        }
        return P
    };
    var k = function(P) {
        P.onerror = null;
        if (P.src != pt.plogin.dftImg) {
            P.src = pt.plogin.dftImg
        }
        return false
    };
    var b = function(P) {
        var R = P.getAttribute("type");
        var Q = P.getAttribute("uin");
        switch (R) {
            case "1":
                x();
                break;
            case "2":
                u(Q);
                break
        }
    };
    var g = function(P) {
        if (!P) {
            return
        }
        var Q = P.getAttribute("uin");
        if (Q) {
            $$("img_out_" + Q).className = "img_out_focus"
        }
    };
    var w = function(P) {
        if (!P) {
            return
        }
        var Q = P.getAttribute("uin");
        if (Q) {
            $$("img_out_" + Q).className = "img_out"
        }
    };
    var D = function(P) {
        if (!P) {
            return
        }
        if (f != P) {
            w(f);
            f = P
        }
        g(P)
    };
    var d = function(P) {
        if (!P) {
            return
        }
        var Q = P.getAttribute("uin");
        var R = $$("mengban_" + Q);
        R && (R.className = "face_mengban")
    };
    var q = function(P) {
        if (!P) {
            return
        }
        var Q = P.getAttribute("uin");
        var R = $$("mengban_" + Q);
        R && (R.className = "")
    };
    var N = function() {
        var Q = $$("qlogin_list");
        var P = Q.getElementsByTagName("a");
        if (P.length > 0) {
            f = P[0]
        }
    };
    var E = function() {
        try {
            f.focus()
        } catch (P) {
        }
    };
    var z = function() {
        var Q = $$("prePage");
        var P = $$("nextPage");
        if (Q) {
            $$.e.add(Q, "click", function(R) {
                a(1)
            })
        }
        if (P) {
            $$.e.add(P, "click", function(R) {
                a(2)
            })
        }
    };
    var c = function() {
        var Q = A.length;
        for (var P = 0; P < Q; P++) {
            if (A[P].uinString) {
                $$.http.loadScript((pt.ptui.isHttps ? "https://ssl.ptlogin2." : "http://ptlogin2.") + pt.ptui.domain + "/getface?appid=" + pt.ptui.appid + "&imgtype=3&encrytype=0&devtype=0&keytpye=0&uin=" + A[P].uinString + "&r=" + Math.random())
            }
        }
    };
    var j = function() {
        z()
    };
    j();
    return {qloginInit: j,hasBuildQlogin: F,buildQloginList: M,imgClick: b,imgFocus: g,imgBlur: w,imgMouseover: D,imgMouseDowm: d,imgMouseUp: q,imgErr: k,focusHeader: E,initFace: c,authLoginSubmit: x,qloginClock: L,getSurl: G}
}();
function ptui_qlogin_CB(b, a, c) {
    window.clearTimeout(pt.qlogin.qloginClock);
    switch (b) {
        case "0":
            pt.plogin.redirect(pt.ptui.target, a);
            break;
        default:
            pt.plogin.switchpage(1);
            pt.plogin.show_err(c, true)
    }
}
pt.plogin = {accout: "",at_accout: "",uin: "",saltUin: "",hasCheck: false,lastCheckAccout: "",needVc: false,vcFlag: false,ckNum: {},action: [0, 0],passwordErrorNum: 1,isIpad: false,t_appid: 46000101,seller_id: 703010802,checkUrl: "",loginUrl: "login.action",verifycodeUrl: "",newVerifycodeUrl: "",needShowNewVc: false,pt_verifysession: "",checkClock: 0,isCheckTimeout: false,checkTime: 0,submitTime: 0,errclock: 0,loginClock: 0,login_param: pt.ptui.href.substring(pt.ptui.href.indexOf("?") + 1),err_m: $$("err_m"),low_login_enable: true,low_login_hour: 720,low_login_isshow: false,list_index: [-1, 2],keyCode: {UP: 38,DOWN: 40,LEFT: 37,RIGHT: 39,ENTER: 13,TAB: 9,BACK: 8,DEL: 46,F5: 116},knownEmail: (pt.ptui.style == 25 ? ["qq.com", "vip.qq.com", "foxmail.com"] : ["qq.com", "foxmail.com", "gmail.com", "hotmail.com", "yahoo.com", "sina.com", "163.com", "126.com", "vip.qq.com", "vip.sina.com", "sina.cn", "sohu.com", "yahoo.cn", "yahoo.com.cn", "139.com", "wo.com.cn", "189.cn", "live.com", "msn.com", "live.hk", "live.cn", "hotmail.com.cn", "hinet.net", "msa.hinet.net", "cm1.hinet.net", "umail.hinet.net", "xuite.net", "yam.com", "pchome.com.tw", "netvigator.com", "seed.net.tw", "anet.net.tw"]),qrlogin_clock: 0,qrlogin_timeout: 0,qrlogin_timeout_time: 100000,isQrLogin: false,qr_uin: "",qr_nick: "",dftImg: "",need_hide_operate_tips: true,js_type: 1,xuiState: 1,delayTime: 5000,delayMonitorId: "294059",hasSubmit: false,isdTime: {},authUin: "",authSubmitUrl: "",loginState: 1,RSAKey: false,aqScanLink: "<a href='javascript:void(0)'; onclick='pt.plogin.switch_qrlogin()'>" + (pt.ptui.lang == "2052" ? "立即扫描" : (pt.ptui.lang == "1028" ? "立即掃描" : "Scan now")) + "</a>",isNewQr: false,hasNoQlogin: false,checkRet: -1,cap_cd: 0,checkErr: {"2052": "网络繁忙，请稍后重试。","1028": "網絡繁忙，請稍後重試。","1033": "The network is busy, please try again later."},isTenpay: pt.ptui.style == 34,isMailLogin: function() {
        return pt.ptui.style == 25
    },domFocus: function(b) {
        try {
            b.focus()
        } catch (a) {
        }
    },formFocus: function() {
        var b = document.loginform;
        try {
            var a = b.u;
            var d = b.p;
            var f = b.verifycode;
            if (a.value == "") {
                a.focus();
                return
            }
            if (d.value == "") {
                d.focus();
                return
            }
            if (f.value == "") {
                f.focus()
            }
        } catch (c) {
        }
    },getAuthUrl: function() {
        var b = (pt.ptui.isHttps ? "https://ssl." : "http://") + "ptlogin2." + pt.ptui.domain + "/pt4_auth?daid=" + pt.ptui.daid + "&appid=" + pt.ptui.appid + "&auth_token=" + $$.str.time33($$.cookie.get("supertoken"));
        var a = pt.ptui.s_url;
        if (/^https/.test(a)) {
            b += "&pt4_shttps=1"
        }
        if (pt.ptui.pt_qzone_sig == "1") {
            b += "&pt_qzone_sig=1"
        }
        return b
    },auth: function() {
  
            pt.plogin.init()
        
    },initAuthInfo: function(a) {
        var b = $$.cookie.get("uin").replace(/^o0*/, "");
        var c = $$.str.utf8ToUincode($$.cookie.get("ptuserinfo")) || b;
        $$("auth_uin").innerHTML = $$.str.encodeHtml(b);
        $$("auth_nick").innerHTML = $$.str.encodeHtml(c);
        $$("auth_area").setAttribute("authUrl", $$.str.encodeHtml(a));
        $$.http.loadScript((pt.ptui.isHttps ? "https://ssl.ptlogin2." : "http://ptlogin2.") + pt.ptui.domain + "/getface?appid=" + pt.ptui.appid + "&imgtype=3&encrytype=0&devtype=0&keytpye=0&uin=" + b + "&r=" + Math.random())
    },showAuth: function(c, b) {
        if (c == 2) {
            $$.css.hide($$("cancleAuthOuter"))
        }
        pt.plogin.initAuthInfo(b);
        var a = pt.ptui.style;
        if (a == 22 || a == 23) {
            $$.css.hide($$("header"));
            $$.css.hide($$("authHeader"))
        }
        $$("authLogin").style.height = $$("Template.login").offsetHeight - (a == 11 ? 2 : 4) + "px";
        $$.css.show($$("authLogin"));
        pt.plogin.ptui_notifySize("Template.login")
    },cancleAuth: function() {
        var a = pt.ptui.style;
        if (a == 22 || a == 23) {
            $$.css.show($$("header"));
            $$.css.show($$("authHeader"))
        }
        $$.css.hide($$("authLogin"));
        pt.plogin.ptui_notifySize("Template.login")
    },authLogin: function() {
        pt.qlogin.authLoginSubmit()
    },authMouseDowm: function(a) {
        var b = $$("auth_mengban");
        b && (b.className = "face_mengban")
    },authMouseUp: function(a) {
        var b = $$("auth_mengban");
        b && (b.className = "")
    },onQloginSwitch: function(a) {
        a.preventDefault();
        pt.plogin.switchpage(2);
        $$.report.monitor("331284", 0.05)
    },initQlogin: function(c) {
        var d = 0;
        var a = false;
        if (c && pt.ptui.auth_mode == 0) {
            a = true
        }
        if (pt.ptui.enable_qlogin != 0 && $$.cookie.get("pt_qlogincode") != 5) {
            d = $$.getLoginQQNum()
        }
        d += a ? 1 : 0;
        if (d == 0) {
            pt.plogin.hasNoQlogin = true
        }
        if (d > 0 || pt.plogin.isNewQr) {
            $$("Template.login").className = "Template.login";
            $$("switcher_plogin").innerHTML = pt.str.h_pt_login;
            if (pt.ptui.style == 34) {
                $$("switcher_plogin").innerHTML = pt.str.otherqq_login
            }
            if (pt.plogin.isMailLogin() && d == 0) {
                pt.plogin.switchpage(1)
            } else {
                pt.plogin.switchpage(2, true)
            }
            if (!pt.qlogin.hasBuildQlogin) {
                pt.qlogin.buildQloginList()
            }
        } else {
            pt.plogin.switchpage(1, true);
            $$("Template.login").className = "login_no_qlogin";
            $$("switcher_plogin").innerHTML = pt.str.other_login;
            if (pt.plogin.isTenpay) {
                $$("switcher_plogin").innerHTML = pt.str.otherqq_login
            }
            if ($$("u").value && pt.ptui.auth_mode == 0) {
                pt.plogin.check()
            }
        }
        var b = pt.plogin.isTenpay && pt.ptui.defaultUin;
        if (b) {
            $$.e.remove($$("switcher_qlogin"), "click", pt.plogin.onQloginSwitch);
            pt.plogin.switchpage(1, true)
        }
        if (pt.ptui.auth_mode != 0 && c) {
            pt.plogin.showAuth(pt.ptui.auth_mode, c)
        }
    },switchpage: function(a, d) {
        var f, c;
        pt.plogin.loginState = a;
        pt.plogin.hide_err();
        switch (a) {
            case 1:
                if (d) {
                }
                $$.css.hide($$("bottom_qlogin"));
                $$.css.hide($$("qlogin"));
                $$.css.show($$("web_qr_login"));
                $$("qrswitch") && $$.css.show($$("qrswitch"));
                $$("switcher_plogin").className = "switch_btn_focus";
                $$("switcher_qlogin").className = "switch_btn";
                c = $$("switcher_plogin").offsetWidth;
                f = $$("switcher_plogin").parentNode.offsetWidth - c;
                if ($$.browser("type") != "ff") {
                    pt.plogin.formFocus()
                }
                if (pt.plogin.isNewQr) {
                    pt.plogin.set_qrlogin_invalid()
                }
                if (pt.plogin.isTenpay && pt.ptui.defaultUin) {
                    $$("u").readOnly = true;
                    var h = $$("uinArea");
                    var b = h.className;
                    if (b.indexOf("default") < 0) {
                        b += " default"
                    }
                    h.className = b;
                    var g = $$("uin_del");
                    g && g.parentNode.removeChild(g);
                    $$("switcher_qlogin").className = "switch_btn_disabled";
                    $$("p").focus()
                }
                break;
            case 2:
                $$.css.hide($$("web_qr_login"));
                $$.css.show($$("qlogin"));
                $$("switcher_plogin").className = "switch_btn";
                $$("switcher_qlogin").className = "switch_btn_focus";
                $$("qrswitch") && $$.css.hide($$("qrswitch"));
                $$.css.show($$("bottom_qlogin"));
                pt.qlogin.focusHeader();
                f = 0;
                c = $$("switcher_qlogin").offsetWidth;
                if (pt.plogin.isNewQr && !d) {
                    pt.plogin.begin_qrlogin()
                }
                break
        }
        window.setTimeout(function() {
            try {
                $$.animate.animate("switch_bottom", {left: f,width: c}, 80, 20)
            } catch (j) {
                $$("switch_bottom").style.left = f + "px";
                $$("switch_bottom").style.width = c + "px"
            }
        }, 100);
        pt.plogin.ptui_notifySize("Template.login")
    },detectCapsLock: function(c) {
        var b = c.keyCode || c.which;
        var a = c.shiftKey || (b == 16) || false;
        if (((b >= 65 && b <= 90) && !a) || ((b >= 97 && b <= 122) && a)) {
            return true
        } else {
            return false
        }
    },generateEmailTips: function(f) {
        var k = f.indexOf("@");
        var h = "";
        if (k == -1) {
            h = f
        } else {
            h = f.substring(0, k)
        }
        var b = [];
        for (var d = 0, a = pt.plogin.knownEmail.length; d < a; d++) {
            b.push(h + "@" + pt.plogin.knownEmail[d])
        }
        var g = [];
        for (var c = 0, a = b.length; c < a; c++) {
            if (b[c].indexOf(f) > -1) {
                g.push($$.str.encodeHtml(b[c]))
            }
        }
        if (pt.ptui.style == 19) {
            g = []
        }
        return g
    },createEmailTips: function(f) {
        var a = pt.plogin.generateEmailTips(f);
        var h = a.length;
        var g = [];
        var d = "";
        var c = 4;
        h = Math.min(h, c);
        if (h == 0) {
            pt.plogin.list_index[0] = -1;
            pt.plogin.hideEmailTips();
            return
        }
        for (var b = 0; b < h; b++) {
            if (f == a[b]) {
                pt.plogin.hideEmailTips();
                return
            }
            d = "emailTips_" + b;
            if (0 == b) {
                g.push("<li id=" + d + " class='hover' >" + a[b] + "</li>")
            } else {
                g.push("<li id=" + d + ">" + a[b] + "</li>")
            }
        }
        $$("email_list").innerHTML = g.join(" ");
        pt.plogin.list_index[0] = 0
    },showEmailTips: function() {
        $$.css.show($$("email_list"))
    },hideEmailTips: function() {
        $$.css.hide($$("email_list"))
    },setUrl: function() {
        var a = pt.ptui.domain;
        var b = $$.check.isHttps() && $$.check.isSsl();
        pt.plogin.checkUrl = (pt.ptui.isHttps ? "https://ssl." : "http://check.") + "ptlogin2." + a + "/check";
        pt.plogin.loginUrl = (pt.ptui.isHttps ? "https://ssl." : "http://") + "ptlogin2." + a + "/";
        pt.plogin.verifycodeUrl = (pt.ptui.isHttps ? "https://ssl." : "http://") + "captcha." + a + "/getimage";
        pt.plogin.newVerifycodeUrl = (pt.ptui.isHttps ? "https://ssl." : "http://") + "captcha.qq.com/cap_union_show?clientype=2";
        if (b && a != "qq.com" && a != "tenpay.com") {
            pt.plogin.verifycodeUrl = "https://ssl.ptlogin2." + a + "/ptgetimage"
        }
        if (pt.ptui.regmaster == 2) {
            pt.plogin.checkUrl = "http://check.ptlogin2.function.qq.com/check?regmaster=2&";
            pt.plogin.loginUrl = "http://ptlogin2.function.qq.com/"
        } else {
            if (pt.ptui.regmaster == 3) {
                pt.plogin.checkUrl = (pt.ptui.isHttps ? "https://ssl." : "http://") + "check.ptlogin2.crm2.qq.com/check?regmaster=3&";
                pt.plogin.loginUrl = (pt.ptui.isHttps ? "https://ssl." : "http://") + "ptlogin2.crm2.qq.com/"
            }
        }
        pt.plogin.dftImg = pt.ptui.isHttps ? "https://ui.ptlogin2.qq.com/style/0/images/1.gif" : "http://imgcache.qq.com/ptlogin/v4/style/0/images/1.gif"
    },init: function(a) {
       
        pt.plogin.bindEvent();
       
    },aq_patch: function() {
        if (Math.random() < 0.05 && !pt.ptui.isHttps) {
            $$.http.loadScript("http://mat1.gtimg.com/www/js/common_v2.js", function() {
                if (typeof checkNonTxDomain == "function") {
                    try {
                        checkNonTxDomain(1, 5)
                    } catch (a) {
                    }
                }
            })
        }
    },hideVipLink: function() {
        var b = $$("vip_link2");
        var a = $$("vip_dot");
        if ((b && a) && (!$$.check.needVip(pt.ptui.appid) || pt.ptui.lang != "2052")) {
            $$.css.addClass(b, "hide");
            $$.css.addClass(a, "hide")
        }
    },set_default_uin: function(a) {
        if (a) {
        } else {
            a = unescape($$.cookie.getOrigin("ptui_loginuin"));
            if (pt.ptui.appid != pt.plogin.t_appid && ($$.check.isNick(a) || $$.check.isName(a))) {
                a = $$.cookie.get("pt2gguin").replace(/^o/, "") - 0;
                a = a == 0 ? "" : a
            }
        }
        $$("u").value = a;
        if (a) {
            $$.css.hide($$("uin_tips"));
            $$("uin_del") && $$.css.show($$("uin_del"));
            pt.plogin.set_accout()
        }
    },set_accout: function() {
        var a = $$.str.trim($$("u").value);
        var b = pt.ptui.appid;
        pt.plogin.accout = a;
        pt.plogin.at_accout = a;
        if ($$.check.isQiyeQQ800(a)) {
            pt.plogin.at_accout = "@" + a;
            return true
        }
        if ($$.check.is_weibo_appid(b)) {
            if ($$.check.isQQ(a) || $$.check.isMail(a)) {
                return true
            } else {
                if ($$.check.isNick(a) || $$.check.isName(a)) {
                    pt.plogin.at_accout = "@" + a;
                    return true
                } else {
                    if ($$.check.isPhone(a)) {
                        pt.plogin.at_accout = "@" + a.replace(/^(86|886)/, "");
                        return true
                    } else {
                        if ($$.check.isSeaPhone(a)) {
                            pt.plogin.at_accout = "@00" + a.replace(/^(00)/, "");
                            if (/^(@0088609)/.test(pt.plogin.at_accout)) {
                                pt.plogin.at_accout = pt.plogin.at_accout.replace(/^(@0088609)/, "@008869")
                            }
                            return true
                        }
                    }
                }
            }
        } else {
            if ($$.check.isQQ(a) || $$.check.isMail(a)) {
                return true
            }
            if ($$.check.isPhone(a)) {
                pt.plogin.at_accout = "@" + a.replace(/^(86|886)/, "");
                return true
            }
            if ($$.check.isNick(a)) {
                $$("u").value = a ;
                pt.plogin.accout = a ;
                pt.plogin.at_accout = a ;
                return false
            }
        }
        if ($$.check.isForeignPhone(a)) {
            pt.plogin.at_accout = "@" + a
        }
        return true
    },show_err: function(b, a) {
        pt.plogin.hideLoading();
        $$.css.show($$("error_tips"));
        pt.plogin.err_m.innerHTML = b;
        clearTimeout(pt.plogin.errclock);
        if (!a) {
            pt.plogin.errclock = setTimeout("pt.plogin.hide_err()", 5000)
        }
    },hide_err: function() {
        $$.css.hide($$("error_tips"));
        pt.plogin.err_m.innerHTML = ""
    },showAssistant: function(a) {
        if (pt.ptui.lang != "2052") {
            return
        }
        pt.plogin.hideLoading();
        $$.css.show($$("error_tips"));
        switch (a) {
            case 0:
                pt.plogin.err_m.innerHTML = "快速登录异常，试试<a class='tips_link' style='color: #29B1F1' href='/assistant/troubleshooter.html' target='_blank'>登录助手</a>修复";
                $$.report.monitor("315785");
                break;
            case 1:
                pt.plogin.err_m.innerHTML = "快速登录异常，试试<a class='tips_link' style='color: #29B1F1' href='/assistant/troubleshooter.html' target='_blank'>登录助手</a>修复";
                $$.report.monitor("315786");
                break;
            case 2:
                pt.plogin.err_m.innerHTML = "登录异常，试试<a class='tips_link' style='color: #29B1F1' href='/assistant/troubleshooter.html' target='_blank'>登录助手</a>修复";
                $$.report.monitor("315787");
                break;
            case 3:
                pt.plogin.err_m.innerHTML = "快速登录异常，试试<a class='tips_link' style='color: #29B1F1' href='http://im.qq.com/qq/2013/' target='_blank' onclick='$$.report.monitor(326049);'>升级QQ</a>修复";
                $$.report.monitor("326046");
                break
        }
    },showGuanjiaTips: function() {
        $$.initGuanjiaPlugin();
        if ($$.guanjiaPlugin) {
            $$.guanjiaPlugin.QMStartUp(16, '/traytip=3 /tipProblemid=1401 /tipSource=18 /tipType=0 /tipIdParam=0 /tipIconUrl="http://dldir2.qq.com/invc/xfspeed/qqpcmgr/clinic/image/tipsicon_qq.png" /tipTitle="QQ快速登录异常?" /tipDesc="不能用已登录的QQ号快速登录，只能手动输入账号密码，建议用电脑诊所一键修复。"');
            $$.report.monitor("316548")
        } else {
            $$.report.monitor("316549")
        }
    },showLoading: function(a) {
        pt.plogin.hide_err();
        $$("loading_tips").style.top = a + "px";
        $$.css.show($$("loading_tips"))
    },hideLoading: function() {
        $$.css.hide($$("loading_tips"))
    },showLowList: function() {
        var a = $$("combox_list");
        if (a) {
            $$.css.show(a);
            pt.plogin.low_login_isshow = true
        }
    },hideLowList: function() {
        var a = $$("combox_list");
        if (a) {
            $$.css.hide(a);
            pt.plogin.low_login_isshow = false
        }
    },u_focus: function() {
        if ($$("u").value == "") {
            $$.css.show($$("uin_tips"));
            $$("uin_tips").className = "input_tips_focus"
        }
        $$("u").parentNode.className = "inputOuter_focus"
    },u_blur: function() {
    	
      if ($$("u").value == "") {
            $$.css.show($$("uin_tips"));
            $$("uin_tips").className = "input_tips"
        } else {
           
            pt.plogin.check()
        }
        $$("u").parentNode.className = "inputOuter"
    },u_mouseover: function() {
        var a = $$("u").parentNode;
        if (a.className == "inputOuter_focus") {
        } else {
            $$("u").parentNode.className = "inputOuter_hover"
        }
    },u_mouseout: function() {
        var a = $$("u").parentNode;
        if (a.className == "inputOuter_focus") {
        } else {
            $$("u").parentNode.className = "inputOuter"
        }
    },window_blur: function() {
        pt.plogin.lastCheckAccout = ""
    },u_change: function() {
        pt.plogin.set_accout();
        pt.plogin.passwordErrorNum = 1;
        pt.plogin.hasCheck = false;
        pt.plogin.hasSubmit = false
    },list_keydown: function(j, g) {
        var f = $$("email_list");
        var d = $$("u");
        if (g == 1) {
            var f = $$("combox_list")
        }
        var h = f.getElementsByTagName("li");
        var b = h.length;
        var a = j.keyCode;
        switch (a) {
            case pt.plogin.keyCode.UP:
                h[pt.plogin.list_index[g]].className = "";
                pt.plogin.list_index[g] = (pt.plogin.list_index[g] - 1 + b) % b;
                h[pt.plogin.list_index[g]].className = "hover";
                break;
            case pt.plogin.keyCode.DOWN:
                h[pt.plogin.list_index[g]].className = "";
                pt.plogin.list_index[g] = (pt.plogin.list_index[g] + 1) % b;
                h[pt.plogin.list_index[g]].className = "hover";
                break;
            case pt.plogin.keyCode.ENTER:
                var c = h[pt.plogin.list_index[g]].innerHTML;
                if (g == 0) {
                    $$("u").value = $$.str.decodeHtml(c)
                }
                pt.plogin.hideEmailTips();
                pt.plogin.hideLowList();
                j.preventDefault();
                break;
            case pt.plogin.keyCode.TAB:
                pt.plogin.hideEmailTips();
                pt.plogin.hideLowList();
                break;
            default:
                break
        }
        if (g == 1) {
            $$("combox_box").innerHTML = h[pt.plogin.list_index[g]].innerHTML;
            $$("low_login_hour").value = h[pt.plogin.list_index[g]].getAttribute("value")
        }
    },u_keydown: function(a) {
        $$.css.hide($$("uin_tips"));
        if (pt.plogin.list_index[0] == -1) {
            return
        }
        pt.plogin.list_keydown(a, 0)
    },u_keyup: function(b) {
        var c = this.value;
        if (c == "") {
            $$.css.show($$("uin_tips"));
            $$("uin_tips").className = "input_tips_focus";
            $$("uin_del") && $$.css.hide($$("uin_del"))
        } else {
            $$("uin_del") && $$.css.show($$("uin_del"))
        }
        var a = b.keyCode;
        if (a != pt.plogin.keyCode.UP && a != pt.plogin.keyCode.DOWN && a != pt.plogin.keyCode.ENTER && a != pt.plogin.keyCode.TAB && a != pt.plogin.keyCode.F5) {
            if ($$("u").value.indexOf("@") > -1) {
                pt.plogin.showEmailTips();
                pt.plogin.createEmailTips($$("u").value)
            } else {
                pt.plogin.hideEmailTips()
            }
        }
    },email_mousemove: function(c) {
        var b = c.target;
        if (b.tagName.toLowerCase() != "li") {
            return
        }
        var a = $$("emailTips_" + pt.plogin.list_index[0]);
        if (a) {
            a.className = ""
        }
        b.className = "hover";
        pt.plogin.list_index[0] = parseInt(b.getAttribute("id").substring(10));
        c.stopPropagation()
    },email_click: function(c) {
        var b = c.target;
        if (b.tagName.toLowerCase() != "li") {
            return
        }
        var a = $$("emailTips_" + pt.plogin.list_index[0]);
        if (a) {
            $$("u").value = $$.str.decodeHtml(a.innerHTML);
            pt.plogin.set_accout();
            pt.plogin.check()
        }
        pt.plogin.hideEmailTips();
        c.stopPropagation()
    },p_focus: function() {
        if (this.value == "") {
            $$.css.show($$("pwd_tips"));
            $$("pwd_tips").className = "input_tips_focus"
        }
        this.parentNode.className = "inputOuter_focus";
        pt.plogin.check()
    },p_blur: function() {
        if (this.value == "") {
            $$.css.show($$("pwd_tips"));
            $$("pwd_tips").className = "input_tips"
        }
        $$.css.hide($$("caps_lock_tips"));
        this.parentNode.className = "inputOuter"
    },p_mouseover: function() {
        var a = $$("p").parentNode;
        if (a.className == "inputOuter_focus") {
        } else {
            $$("p").parentNode.className = "inputOuter_hover"
        }
    },p_mouseout: function() {
        var a = $$("p").parentNode;
        if (a.className == "inputOuter_focus") {
        } else {
            $$("p").parentNode.className = "inputOuter"
        }
    },p_keydown: function(a) {
        $$.css.hide($$("pwd_tips"))
    },p_keyup: function() {
        if (this.value == "") {
            $$.css.show($$("pwd_tips"))
        }
    },p_keypress: function(a) {
        if (pt.plogin.detectCapsLock(a)) {
            $$.css.show($$("caps_lock_tips"))
        } else {
            $$.css.hide($$("caps_lock_tips"))
        }
    },vc_focus: function() {
        if (this.value == "") {
            $$.css.show($$("vc_tips"));
            $$("vc_tips").className = "input_tips_focus"
        }
        this.parentNode.className = "inputOuter_focus"
    },vc_blur: function() {
        if (this.value == "") {
            $$.css.show($$("vc_tips"));
            $$("vc_tips").className = "input_tips"
        }
        this.parentNode.className = "inputOuter"
    },vc_keydown: function() {
        $$.css.hide($$("vc_tips"))
    },vc_keyup: function() {
        if (this.value == "") {
            $$.css.show($$("vc_tips"))
        }
    },document_click: function() {
        pt.plogin.action[0]++;
        pt.plogin.hideEmailTips();
        pt.plogin.hideLowList()
    },document_keydown: function() {
        pt.plogin.action[1]++
    },setLowloginCheckbox: function() {
        if (pt.plogin.isMailLogin()) {
            pt.plogin.low_login_enable = false
        }
        if (pt.ptui.low_login == 1) {
            if (pt.plogin.low_login_enable) {
                $$("q_low_login_enable").className = "checked";
                $$("p_low_login_enable").className = "checked";
                $$("auth_low_login_enable").className = "checked"
            } else {
                $$("q_low_login_enable").className = "uncheck";
                $$("p_low_login_enable").className = "uncheck";
                $$("auth_low_login_enable").className = "uncheck"
            }
        }
    },checkbox_click: function() {
        if (!pt.plogin.low_login_enable) {
            $$("q_low_login_enable").className = "checked";
            $$("p_low_login_enable").className = "checked";
            $$("auth_low_login_enable").className = "checked"
        } else {
            $$("q_low_login_enable").className = "uncheck";
            $$("p_low_login_enable").className = "uncheck";
            $$("auth_low_login_enable").className = "uncheck"
        }
        pt.plogin.low_login_enable = !pt.plogin.low_login_enable
    },feedback: function(d) {
        var c = d ? d.target : null;
        var a = c ? c.id + "-" : "";
        var b = "http://support.qq.com/write.shtml?guest=1&fid=713&SSTAG=hailunna-" + a + $$.str.encodeHtml(pt.plogin.accout);
        window.open(b)
    },bind_account: function() {
        $$.css.hide($$("operate_tips"));
        pt.plogin.need_hide_operate_tips = true;
        window.open("http://id.qq.com/member.html#account");
        $$.report.monitor("234964")
    },combox_click: function(a) {
        if (pt.plogin.low_login_isshow) {
            pt.plogin.hideLowList();
        } else {
            pt.plogin.showLowList();
        }
        a.stopPropagation()
    },delUin: function(a) {
        a && $$.css.hide(a.target);
        $$("u").value = "";
        pt.plogin.domFocus($$("u"))
    },check_cdn_img: function() {
        if (!window.g_cdn_js_fail || pt.ptui.isHttps) {
            return
        }
        var a = new Image();
        a.onload = function() {
            a.onload = a.onerror = null
        };
        a.onerror = function() {
            a.onload = a.onerror = null;
            var d = $$("main_css").innerHTML;
            var b = "http://imgcache.qq.com/ptlogin/v4/style/";
            var c = "http://ui.ptlogin2.qq.com/style/";
            d = d.replace(new RegExp(b, "g"), c);
            pt.plogin.insertInlineCss(d);
            $$.report.monitor(312520)
        };
        a.src = "http://imgcache.qq.com/ptlogin/v4/style/20/images/c_icon_1.png"
    },insertInlineCss: function(a) {
        if (document.createStyleSheet) {
            var c = document.createStyleSheet("");
            c.cssText = a
        } else {
            var b = document.createElement("style");
            b.type = "text/css";
            b.textContent = a;
            document.getElementsByTagName("head")[0].appendChild(b)
        }
    },createLink: function(a) {
        var b = document.createElement("link");
        b.setAttribute("type", "text/css");
        b.setAttribute("rel", "stylesheet");
        b.setAttribute("href", a);
        document.getElementsByTagName("head")[0].appendChild(b)
    },checkInputLable: function() {
        try {
            if ($$("u").value) {
                $$.css.hide($$("uin_tips"))
            }
            window.setTimeout(function() {
                if ($$("p").value) {
                    $$.css.hide($$("pwd_tips"))
                }
            }, 1000)
        } catch (a) {
        }
    },domLoad: function(b) {
        if (pt.plogin.hasDomLoad) {
            return
        } else {
            pt.plogin.hasDomLoad = true
        }
        if (pt.plogin.isNewQr && pt.plogin.loginState == 2) {
            if (b) {
                pt.plogin.begin_qrlogin()
            } else {
                window.setTimeout(function() {
                    pt.plogin.begin_qrlogin()
                }, 3000)
            }
        }
        pt.plogin.checkInputLable();
        pt.plogin.checkNPLoad();
        pt.qlogin.initFace();
        pt.plogin.loadQrTipsPic();
        var a = $$("loading_img");
        if (a) {
            a.setAttribute("src", a.getAttribute("place_src"))
        }
        pt.plogin.check_cdn_img();
        pt.plogin.ptui_notifySize("Template.login");
        $$.report.monitor("373507&union=256042", 0.05);
        if (!navigator.cookieEnabled) {
            $$.report.monitor(408084);
            if ($$.cookie.get("ptcz")) {
                $$.report.monitor(408085)
            }
        }
        pt.plogin.webLoginReport();
        pt.plogin.monitorQQNum();
        pt.plogin.aq_patch()
    },checkNPLoad: function() {
        if (navigator.mimeTypes["application/nptxsso"] && !$$.sso_loadComplete) {
            $$.checkNPPlugin()
        }
    },monitorQQNum: function() {
        var a = $$.loginQQnum;
        switch (a) {
            case 0:
                $$.report.monitor("330314", 0.05);
                break;
            case 1:
                $$.report.monitor("330315", 0.05);
                break;
            case 2:
                $$.report.monitor("330316", 0.05);
                break;
            case 3:
                $$.report.monitor("330317", 0.05);
                break;
            case 4:
                $$.report.monitor("330318", 0.05);
                break;
            default:
                $$.report.monitor("330319", 0.05);
                break
        }
    },noscript_err: function() {
        $$.report.nlog("noscript_err", 316648);
        $$("noscript_area").style.display = "none"
    },bindEvent: function() {
        var domU = $$("u");
        var domP = $$("p");
        var domVerifycode = $$("verifycode");
        var domVC = $$("verifyimgArea");
        var domBtn = $$("login_button");
        var domCheckBox_p = $$("p_low_login_box");
        var domCheckBox_q = $$("q_low_login_box");
        var domCheckBox_auth = $$("auth_low_login_box");
        var domEmailList = $$("email_list");
        var domFeedback_web = $$("feedback_web");
        var domFeedback_qr = $$("feedback_qr");
        var domFeedback_qlogin = $$("feedback_qlogin");
        var domClose = $$("close");
        var domQloginSwitch = $$("switcher_qlogin");
        var domLoginSwitch = $$("switcher_plogin");
        var domDelUin = $$("uin_del");
        var domBindAccount = $$("bind_account");
        var domCancleAuth = $$("cancleAuth");
        var domAuthClose = $$("authClose");
        var domAuthArea = $$("auth_area");
        var domAuthCheckBox = $$("auth_low_login_enable");
        var domQr_invalid = $$("qr_invalid");
        var domGoback = $$("goBack");
        var domQr_img_box = $$("qr_img_box");
        var domQr_img = $$("qrlogin_img");
        var domQr_info_link = $$("qr_info_link");
        var domQrswitch = $$("qrswitch_logo");
      
        if (domBindAccount) {
            $$.e.add(domBindAccount, "click", pt.plogin.bind_account);
            $$.e.add(domBindAccount, "mouseover", function(e) {
                pt.plogin.need_hide_operate_tips = false;
            });
            $$.e.add(domBindAccount, "mouseout", function(e) {
                pt.plogin.need_hide_operate_tips = true;
            })
        }
        if (domClose) {
            $$.e.add(domClose, "click", pt.plogin.ptui_notifyClose)
        }
        if (pt.ptui.low_login == 1 && domCheckBox_p && domCheckBox_q) {
            $$.e.add(domCheckBox_p, "click", pt.plogin.checkbox_click);
            $$.e.add(domCheckBox_q, "click", pt.plogin.checkbox_click)
        }
        if (pt.ptui.low_login == 1 && domCheckBox_auth) {
            $$.e.add(domCheckBox_auth, "click", pt.plogin.checkbox_click)
        }
        $$.e.add(domU, "focus", pt.plogin.u_focus);
        $$.e.add(domU, "blur", pt.plogin.u_blur);
        $$.e.add(domU, "change", pt.plogin.u_change);
        $$.e.add(domU, "keydown", pt.plogin.u_keydown);
        $$.e.add(domU, "keyup", pt.plogin.u_keyup);
        $$.e.add(domDelUin, "click", pt.plogin.delUin);
        $$.e.add(domP, "focus", pt.plogin.p_focus);
        $$.e.add(domP, "blur", pt.plogin.p_blur);
        $$.e.add(domP, "keydown", pt.plogin.p_keydown);
        $$.e.add(domP, "keyup", pt.plogin.p_keyup);
        $$.e.add(domP, "keypress", pt.plogin.p_keypress);
        $$.e.add(domBtn, "click", function(e) {
            e && e.preventDefault();
            if (pt.plogin.needShowNewVc == true) {
                pt.plogin.showVC();
            } else {
                pt.plogin.submit(e);
            }
        });
        $$.e.add(domVC, "click", pt.plogin.changeVC);
        $$.e.add(domEmailList, "mousemove", pt.plogin.email_mousemove);
        $$.e.add(domEmailList, "click", pt.plogin.email_click);
        $$.e.add(document, "click", pt.plogin.document_click);
        $$.e.add(document, "keydown", pt.plogin.document_keydown);
        $$.e.add(domVerifycode, "focus", pt.plogin.vc_focus);
        $$.e.add(domVerifycode, "blur", pt.plogin.vc_blur);
        $$.e.add(domVerifycode, "keydown", pt.plogin.vc_keydown);
        $$.e.add(domVerifycode, "keyup", pt.plogin.vc_keyup);
        $$.e.add(window, "load", pt.plogin.domLoad);
        $$.e.add(window, "message", function(e) {
            var origin = e.origin;
            if (origin == (pt.ptui.isHttps ? "https://ssl." : "http://") + "captcha.qq.com") {
                var data = e.data;
                if (window.JSON) {
                    data = JSON.parse(data);
                } else {
                    data = eval("(" + data + ")");
                }
                var type = data.type;
                switch (type + "") {
                    case "1":
                        pt.plogin.vcodeMessage(data);
                        break;
                    case "2":
                        pt.plogin.hideVC();
                        break;
                }
            }
        });
		$$.report.nlog("vcode postMessage error：" );
        var noscript_img = $$("noscript_img");
        if (noscript_img) {
            $$.e.add(noscript_img, "load", pt.plogin.noscript_err);
            $$.e.add(noscript_img, "error", pt.plogin.noscript_err);
        }
    },vcodeMessage: function(a) {
        if (!a.randstr || !a.sig) {
            $$.report.nlog("vcode postMessage error：" + e.data)
        }
        $$("verifycode").value = a.randstr;
        pt.plogin.pt_verifysession = a.sig;
        pt.plogin.hideVC();
        pt.plogin.submit()
    },showNewVC: function() {
        var a = pt.plogin.getNewVCUrl();
        var b = $$("newVcodeArea");
        b.style.height = $$("Template.login").offsetHeight - (pt.ptui.style == 21 ? 2 : 4) + "px";
        b.innerHTML = '<iframe name="vcode" allowtransparency="true" scrolling="no" frameborder="0" width="100%" height="100%" src="' + a + '">';
        $$.css.show(b)
    },hideNewVC: function() {
        $$.css.hide($$("newVcodeArea"))
    },changeNewVC: function() {
        pt.plogin.showNewVC()
    },showVC: function() {
        pt.plogin.vcFlag = true;
        if (pt.ptui.pt_vcode_v1 == "1") {
            pt.plogin.showNewVC()
        } else {
            $$.css.show($$("verifyArea"));
            $$("verifycode").value = "";
            var a = $$("verifyimg");
            var b = pt.plogin.getVCUrl();
            a.src = b
        }
        pt.plogin.ptui_notifySize("Template.login")
    },hideVC: function() {
        pt.plogin.vcflag = false;
        if (pt.ptui.pt_vcode_v1 == "1") {
            pt.plogin.hideNewVC()
        } else {
            $$.css.hide($$("verifyArea"))
        }
        pt.plogin.ptui_notifySize("Template.login")
    },changeVC: function(b) {
      
		document.getElementById("imgId").src="loginInfoAction.do?method=getRanValidateCode&a="+Math.random();
        b && $$.report.monitor("330322", 0.05)
    },getVCUrl: function() {
        var d = pt.plogin.at_accout;
        var c = pt.ptui.domain;
        var b = pt.ptui.appid;
        var a = pt.plogin.verifycodeUrl + "?uin=" + d + "&aid=" + b + "&cap_cd=" + pt.plogin.cap_cd + "&" + Math.random();
		
        return a
    },getNewVCUrl: function() {
        var d = pt.plogin.at_accout;
        var c = pt.ptui.domain;
        var b = pt.ptui.appid;
        var a = pt.plogin.newVerifycodeUrl + "&uin=" + d + "&aid=" + b + "&cap_cd=" + pt.plogin.cap_cd + "&" + Math.random();
        return a
    },checkValidate: function(b) {
        try {
            var a = b.u;
            var d = b.p;
            var f = b.verifycode;
            if ($$.str.trim(a.value) == "") {
                pt.plogin.show_err(pt.str.no_uin);
                pt.plogin.domFocus(a);
                return false
            }
        
            if (d.value == "") {
                pt.plogin.show_err(pt.str.no_pwd);
                pt.plogin.domFocus(d);
                return false
            }
            if (f.value == "") {
                if (!pt.plogin.needVc && !pt.plogin.vcFlag) {
                    pt.plogin.checkResultReport(14);
                    clearTimeout(pt.plogin.checkClock);
                    pt.plogin.showVC()
                } else {
                    pt.plogin.show_err(pt.str.no_vcode);
                    pt.plogin.domFocus(f)
                }
                return false
            }
            if (f.value.length < 4) {
                pt.plogin.show_err(pt.str.inv_vcode);
                pt.plogin.domFocus(f);
                f.select();
                return false
            }
        } catch (c) {
        }
        return true
    },checkTimeout: function() {
        var a = $$.str.trim($$("u").value);
        if ($$.check.isQQ(a)) {
            pt.plogin.cap_cd = 0;
            pt.plogin.saltUin = $$.str.uin2hex(a.replace("@qq.com", ""));
            pt.plogin.needVc = true;
            pt.plogin.needShowNewVc = true;
            pt.plogin.showVC();
            pt.plogin.isCheckTimeout = true;
            pt.plogin.checkRet = 1
        }
    },loginTimeout: function() {
        pt.plogin.showAssistant(2);
        var a = "flag1=7808&flag2=7&flag3=1&1=1000";
        $$.report.simpleIsdSpeed(a)
    },check: function() {
        
     
        
    },getCheckUrl: function(b, c) {
        var a = pt.plogin.checkUrl + "?regmaster=" + pt.ptui.regmaster + "&";
        a += "uin=" + b + "&appid=" + c + "&js_ver=" + pt.ptui.ptui_version + "&js_type=" + pt.plogin.js_type + "&login_sig=" + pt.ptui.login_sig + "&u1=" + encodeURIComponent(pt.ptui.s_url) + "&r=" + Math.random();
        return a
    },getSubmitUrl: function(b) {
        var a = "loginInfoAction.do?method=LoginCheck&";
        var d = {};
        if (b == "Template.login") {
            d.u = encodeURIComponent(pt.plogin.at_accout);
            d.verifycode = $$("verifycode").value;
            if (pt.plogin.needShowNewVc && pt.plogin.pt_verifysession) {
                d.pt_vcode_v1 = 1;
                d.pt_verifysession_v1 = pt.plogin.pt_verifysession
            }
            if (pt.plogin.RSAKey) {
                d.p = $$.Encryption.getRSAEncryption($$("p").value, d.verifycode);
            } else {
              //  d.p = $$.Encryption.getEncryption($$("p").value, pt.plogin.saltUin, d.verifycode);
             	d.p=$$("p").value;
            }
        }
		var param1={
		  	username:  d.u,
		  	method:0,
		  	verifyCode:d.verifycode,
		 	 password: d.p
	    }
			$.ajax({
	  	    cache:false,
		    url:'loginInfoAction.do?method=LoginCheck',
			type:'post',
			datatype:'json',
			data:{
			  	param:$.toJSON(param1)
			},
			success:function(okstr){
				 
			   if(okstr=="1"){
			       window.location="member.html"
			   }else if(okstr=="2"){
				    pt.plogin.show_err("验证码错误!");
					$("#imgId").trigger("click");
			   }else if(okstr=="0"){
				    pt.plogin.show_err("登陆失败,用户名密码不匹配!!");
			   }else if(okstr=="3"){
				    pt.plogin.show_err("网络连接异常,登陆失败!!");
			   }else{
				    pt.plogin.show_err("登陆失败!");
			   }
		   }
	});
	return ;
    },submit: function(a) {
        pt.plogin.submitTime = new Date().getTime();
        a && a.preventDefault();
        if (!pt.plogin.ptui_onLogin(document.loginform)) {
            return false
        }
        var b = pt.plogin.getSubmitUrl("Template.login");
        $$.winName.set("login_href", encodeURIComponent(pt.ptui.href));
        pt.plogin.showLoading(20);
        if (pt.plogin.isVCSessionTimeOut() && !pt.plogin.needVc) {
            pt.plogin.lastCheckAccout = "";
            pt.plogin.check();
            window.setTimeout(function() {
                pt.plogin.submit()
            }, 1000)
        } else { 
         //   $$.http.loadScript(b);
            pt.plogin.isdTime["7808-7-2-0"] = new Date().getTime()
        }
        return false
    },isVCSessionTimeOut: function() {
        pt.plogin.checkTime = pt.plogin.checkTime || new Date().getTime();
        if (pt.plogin.submitTime - pt.plogin.checkTime > 1200000) {
            $$.report.monitor(330323, 0.05);
            return true
        } else {
            return false
        }
    },webLoginReport: function() {
        window.setTimeout(function() {
            try {
                var d = ["navigationStart", "unloadEventStart", "unloadEventEnd", "redirectStart", "redirectEnd", "fetchStart", "domainLookupStart", "domainLookupEnd", "connectStart", "connectEnd", "requestStart", "responseStart", "responseEnd", "domLoading", "domInteractive", "domContentLoadedEventStart", "domContentLoadedEventEnd", "domComplete", "loadEventStart", "loadEventEnd"];
                var g = {};
                var c = window.performance ? window.performance.timing : null;
                if (c) {
                    for (var b = 1, a = d.length; b < a; b++) {
                        if (c[d[b]]) {
                            g[b] = c[d[b]] - c[d[0]]
                        }
                    }
                    if ((c.domContentLoadedEventEnd - c.navigationStart > pt.plogin.delayTime) && c.navigationStart > 0) {
                        $$.report.nlog("访问ui延时超过" + pt.plogin.delayTime / 1000 + "s:delay=" + (c.domContentLoadedEventEnd - c.navigationStart) + ";domContentLoadedEventEnd=" + c.domContentLoadedEventEnd + ";navigationStart=" + c.navigationStart + ";clientip=" + pt.ptui.clientip + ";serverip=" + pt.ptui.serverip, pt.plogin.delayMonitorId, 1)
                    }
                    if (c.connectStart <= c.connectEnd && c.responseStart <= c.responseEnd) {
                        pt.plogin.ptui_speedReport(g)
                    }
                }
            } catch (f) {
            }
        }, 1000)
    },ptui_speedReport: function(d) {
        if ($$.browser("type") != "msie" && $$.browser("type") != "webkit") {
            return
        }
        var b = "http://isdspeed.qq.com/cgi-bin/r.cgi?flag1=7808&flag2=5&flag3=1";
        if (pt.ptui.isHttps) {
            if (Math.random() > 1) {
                return
            }
            if ($$.browser("type") == "msie") {
                if ($$.check.isSsl()) {
                    b = "https://login.qq.com/cgi-bin/r.cgi?flag1=7808&flag2=5&flag3=3"
                } else {
                    b = "https://login.qq.com/cgi-bin/r.cgi?flag1=7808&flag2=5&flag3=2"
                }
            } else {
                if ($$.check.isSsl()) {
                    b = "https://login.qq.com/cgi-bin/r.cgi?flag1=7808&flag2=5&flag3=6"
                } else {
                    b = "https://login.qq.com/cgi-bin/r.cgi?flag1=7808&flag2=5&flag3=5"
                }
            }
        } else {
            if (Math.random() > 0.2) {
                return
            }
            if ($$.browser("type") == "msie") {
                b = "http://isdspeed.qq.com/cgi-bin/r.cgi?flag1=7808&flag2=5&flag3=1"
            } else {
                b = "http://isdspeed.qq.com/cgi-bin/r.cgi?flag1=7808&flag2=5&flag3=4"
            }
        }
        for (var c in d) {
            if (d[c] > 15000 || d[c] < 0) {
                continue
            }
            b += "&" + c + "=" + d[c] || 1
        }
        var a = new Image();
        a.src = b
    },resultReport: function(b, a, f) {
        var d = "http://isdspeed.qq.com/cgi-bin/v.cgi?flag1=" + b + "&flag2=" + a + "&flag3=" + f;
        var c = new Image();
        c.src = d
    },crossMessage: function(d) {
        if (typeof window.postMessage != "undefined") {
            var b = $$.str.json2str(d);
            window.parent.postMessage(b, "*")
        } else {
            if (!pt.ptui.proxy_url) {
                try {
                    navigator.ptlogin_callback($$.str.json2str(d))
                } catch (c) {
                    $$.report.nlog(c.message)
                }
            } else {
                var f = pt.ptui.proxy_url + "#";
                for (var a in d) {
                    f += (a + "=" + d[a] + "&")
                }
                $$("proxy") && ($$("proxy").innerHTML = '<iframe src="' + encodeURI(f) + '"></iframe>')
            }
        }
    },ptui_notifyClose: function(a) {
        a && a.preventDefault();
        var b = {};
        b.action = "close";
        pt.plogin.crossMessage(b);
        pt.plogin.cancle_qrlogin()
    },ptui_notifySize: function(c) {
        if (pt.plogin.loginState == 1) {
            $$("bottom_web") && $$.css.hide($$("bottom_web"));
            pt.plogin.adjustLoginsize();
            $$("bottom_web") && $$.css.show($$("bottom_web"))
        }
        var a = $$(c);
        var b = {};
        b.action = "resize";
        b.width = a.offsetWidth || 1;
        b.height = a.offsetHeight || 1;
        pt.plogin.crossMessage(b)
    },ptui_onLogin: function(b) {
        var a = true;
        a = pt.plogin.checkValidate(b);
        return a
    },ptui_uin: function(a) {
    },is_mibao: function(a) {
        return /^http(s)?:\/\/ui.ptlogin2.(\S)+\/cgi-bin\/mibao_vry/.test(a)
    },get_qrlogin_pic: function() {
        var b = "ptqrshow";
        var a = (pt.ptui.isHttps ? "https://ssl." : "http://") + "ptlogin2." + pt.ptui.domain + "/" + b + "?";
        if (pt.ptui.regmaster == 2) {
            a = "http://ptlogin2.function.qq.com/" + b + "?regmaster=2&"
        } else {
            if (pt.ptui.regmaster == 3) {
                a = "http://ptlogin2.crm2.qq.com/" + b + "?regmaster=3&"
            }
        }
        a += "appid=" + pt.ptui.appid + "&e=2&l=M&s=3&d=72&v=4&t=" + Math.random();
        return a
    },go_qrlogin_step: function(a) {
        switch (a) {
            case 1:
                pt.plogin.begin_qrlogin();
                if (pt.plogin.isNewQr) {
                    pt.plogin.begin_qrlogin();
                    $$.css.hide($$("qrlogin_step2"))
                } else {
                    $$.css.show($$("qrlogin_step1"));
                    $$.css.hide($$("qrlogin_step2"))
                }
                break;
            case 2:
                if (pt.plogin.isNewQr) {
                    $$("qrlogin_step2").style.height = ($$("Template.login").offsetHeight - 8) + "px";
                    $$.css.show($$("qrlogin_step2"))
                } else {
                    $$.css.show($$("qrlogin_step2"));
                    $$.css.hide($$("qrlogin_step1"))
                }
                break;
            default:
                break
        }
    },begin_qrlogin: function() {
        if (pt.plogin.isTenpay && pt.ptui.defaultUin) {
            return
        }
        pt.plogin.cancle_qrlogin();
        $$("qr_invalid") && $$.css.hide($$("qr_invalid"));
        $$("qrlogin_img") && ($$("qrlogin_img").src = pt.plogin.get_qrlogin_pic());
        pt.plogin.qrlogin_clock = window.setInterval("pt.plogin.qrlogin_submit();", 3000);
        pt.plogin.qrlogin_timeout = window.setTimeout(function() {
            pt.plogin.set_qrlogin_invalid()
        }, pt.plogin.qrlogin_timeout_time)
    },cancle_qrlogin: function() {
        window.clearInterval(pt.plogin.qrlogin_clock);
        window.clearTimeout(pt.plogin.qrlogin_timeout)
    },set_qrlogin_invalid: function() {
        pt.plogin.cancle_qrlogin();
        pt.plogin.switch_qrlogin();
        $$("qr_invalid") && $$.css.show($$("qr_invalid"));
        pt.plogin.hideQrTips()
    },createLink: function(a) {
        var b = document.createElement("link");
        b.setAttribute("type", "text/css");
        b.setAttribute("rel", "stylesheet");
        b.setAttribute("href", a);
        document.getElementsByTagName("head")[0].appendChild(b)
    },loadQrTipsPic: function() {
        if (pt.plogin.isNewQr) {
            var b = $$("qr_tips_pic");
            var d = "chs";
            switch (pt.ptui.lang + "") {
                case "2052":
                    d = "chs";
                    break;
                case "1033":
                    d = "en";
                    break;
                case "1028":
                    d = "cht";
                    break
            }
            $$.css.addClass(b, "qr_tips_pic_" + d)
        } else {
            var a = pt.ptui.cssPath + "/c_qr_login.css";
            $$("qrswitch_logo") && pt.plogin.createLink(a)
        }
    },showQrTips: function() {
        var a = {}, f, d;
        d = $$.css.getOffsetPosition("qrlogin_img");
        f = $$.css.getOffsetPosition("Template.login");
        a.left = d.left - f.left;
        a.right = $$("Template.login").offsetWidth - $$("qrlogin_img").offsetWidth - a.left;
        if (pt.plogin.hasNoQlogin) {
        } else {
            a.left = a.left + $$.css.getWidth("qrlogin_img") + 10;
            $$("qr_tips").style.left = a.left + "px"
        }
        $$.css.show($$("qr_tips"));
        $$("qr_tips_pic").style.opacity = 0;
        $$("qr_tips_pic").style.filter = "alpha(opacity=0)";
        $$("qr_tips_menban").className = "qr_tips_menban";
        if (pt.plogin.hasNoQlogin) {
            $$.animate.fade("qr_tips_pic", 100, 2, 20, function() {
            });
            if (pt.plogin.isMailLogin()) {
                var b = 160;
                var c = a.right - 160 + 12;
                $$.animate.animate("qrlogin_img", {left: c}, 10, 10)
            } else {
                $$.animate.animate("qrlogin_img", {left: -30}, 10, 10)
            }
        } else {
            $$.animate.fade("qr_tips_pic", 100, 2, 20)
        }
        pt.plogin.hideQrTipsClock = window.setTimeout("pt.plogin.hideQrTips()", 5000);
        $$.report.monitor("331286", 0.05)
    },hideQrTips: function() {
        if (!pt.plogin.isNewQr) {
            return
        }
        window.clearTimeout(pt.plogin.hideQrTipsClock);
        $$("qr_tips_menban").className = "";
        $$.animate.fade("qr_tips_pic", 0, 5, 20, function() {
            if (pt.plogin.hasNoQlogin) {
                $$.animate.animate("qrlogin_img", {left: 12}, 10, 10)
            }
            $$.css.hide($$("qr_tips"))
        })
    },qr_load: function(a) {
    },qr_error: function(a) {
        pt.plogin.set_qrlogin_invalid()
    },switch_qrlogin_animate: function() {
        var b = pt.plogin.isQrLogin;
        var a = $$("web_qr_login_show");
        var c = 0;
        if (b) {
            c = -$$("web_login").offsetHeight;
            $$("web_qr_login").style.height = ($$("qrlogin").offsetHeight || 265) + "px";
            $$("qrlogin").style.visibility = "";
            $$("web_login").style.visibility = "hidden"
        } else {
            c = 0;
            $$("web_qr_login").style.height = $$("web_login").offsetHeight + "px";
            $$("web_login").style.visibility = "";
            $$("qrlogin").style.visibility = "hidden"
        }
        $$.animate.animate(a, {top: c}, 30, 20)
    },switch_qrlogin: function(a) {
        if (pt.plogin.isNewQr) {
            return
        }
        a && a.preventDefault();
        pt.plogin.hide_err();
        if (!pt.plogin.isQrLogin) {
            pt.plogin.go_qrlogin_step(1);
            $$("qrswitch_logo").title = "返回";
            $$("qrswitch_logo").className = "qrswitch_logo_qr";
            pt.plogin.begin_qrlogin();
            $$.report.monitor("273367", 0.05)
        } else {
            pt.plogin.cancle_qrlogin();
            $$("qrswitch_logo").title = "二维码登录";
            $$("qrswitch_logo").className = "qrswitch_logo";
            $$.report.monitor("273368", 0.05)
        }
        pt.plogin.isQrLogin = !pt.plogin.isQrLogin;
        pt.plogin.switch_qrlogin_animate();
        pt.plogin.ptui_notifySize("Template.login")
    },adjustLoginsize: function() {
        var a = pt.plogin.isQrLogin;
        if (a) {
            $$("web_qr_login").style.height = ($$("qrlogin").offsetHeight || 265) + "px"
        } else {
            $$("web_qr_login").style.height = $$("web_login").offsetHeight + "px"
        }
    },qrlogin_submit: function() {
        var a = pt.plogin.getSubmitUrl("ptqrlogin");
        $$.winName.set("login_href", encodeURIComponent(pt.ptui.href));
        $$.http.loadScript(a);
        return
    },force_qrlogin: function() {
    },no_force_qrlogin: function() {
    },redirect: function(b, a) {
        switch (b + "") {
            case "0":
                location.href = a;
                break;
            case "1":
                top.location.href = a;
                break;
            default:
                top.location.href = a
        }
    }};
pt.plogin.auth();
function ptuiCB(k, n, b, h, c, a) {
    var m = pt.plogin.at_accout && $$("p").value;
    clearTimeout(pt.plogin.loginClock);
    function d() {
        if (pt.plogin.is_mibao(b)) {
            b += ("&style=" + pt.ptui.style + "&proxy_url=" + encodeURIComponent(pt.ptui.proxy_url))
        }
        pt.plogin.redirect(h, b)
    }
    if (m) {
        pt.plogin.lastCheckAccout = ""
    }
    pt.plogin.hasSubmit = true;
    switch (k) {
        case "0":
            if (!m && !pt.plogin.is_mibao(b)) {
                window.clearInterval(pt.plogin.qrlogin_clock);
                d()
            } else {
                d()
            }
            break;
        case "3":
            $$("p").value = "";
            pt.plogin.domFocus($$("p"));
            pt.plogin.passwordErrorNum++;
            if (n == "101" || n == "102" || n == "103") {
                pt.plogin.showVC()
            }
            pt.plogin.check();
            break;
        case "4":
            if (pt.plogin.vcFlag) {
                pt.plogin.changeVC()
            } else {
                pt.plogin.showVC()
            }
            try {
                $$("verifycode").focus();
                $$("verifycode").select()
            } catch (j) {
            }
            break;
        case "65":
            pt.plogin.set_qrlogin_invalid();
            return;
        case "66":
            return;
        case "67":
            pt.plogin.go_qrlogin_step(2);
            return;
        case "10005":
            pt.plogin.force_qrlogin();
            break;
        default:
            if (pt.plogin.needVc) {
                pt.plogin.changeVC()
            } else {
                pt.plogin.check()
            }
            break
    }
    if (k == "10005" || k == "12" || k == "51") {
        pt.plogin.show_err(c, true)
    } else {
        if (k != 0 && m) {
            pt.plogin.show_err(c)
        }
    }
    if (!pt.plogin.hasCheck && m) {
       // pt.plogin.showVC();
        //$$("verifycode").focus();
       // $$("verifycode").select()
    }
    if (Math.random() < 0.2) {
        pt.plogin.isdTime["7808-7-2-1"] = new Date().getTime();
        var g = 1;
        if (pt.ptui.isHttps) {
            g = 2
        }
        var l = "flag1=7808&flag2=7&flag3=2&" + g + "=" + (pt.plogin.isdTime["7808-7-2-1"] - pt.plogin.isdTime["7808-7-2-0"]);
        $$.report.simpleIsdSpeed(l)
    }
}
function jump(url){
	window.location.href=url;
}
function ptui_checkVC(a, c, b) {
    clearTimeout(pt.plogin.checkClock);
    pt.plogin.saltUin = b;
    pt.plogin.checkRet = a;
    if (!b) {
        pt.plogin.RSAKey = true
    } else {
        pt.plogin.RSAKey = false
    }
    if (a == "2") {
        pt.plogin.show_err(pt.str.inv_uin)
    } else {
        if (a == "3") {
        } else {
            if (!pt.plogin.hasSubmit) {
                pt.plogin.hide_err()
            }
        }
    }
    switch (a + "") {
        case "0":
        case "2":
        case "3":
            if (pt.ptui.pt_vcode_v1 == "1") {
                pt.plogin.needShowNewVc = false
            }
            pt.plogin.hideVC();
            $$("verifycode").value = c || "abcd";
            pt.plogin.needVc = false;
            $$.report.monitor("330321", 0.05);
            break;
        case "1":
            pt.plogin.cap_cd = c;
            if (pt.ptui.pt_vcode_v1 == "1") {
                pt.plogin.needShowNewVc = true
            } else {
                pt.plogin.showVC();
                $$.css.show($$("vc_tips"))
            }
            pt.plogin.needVc = true;
            $$.report.monitor("330320", 0.05);
            break;
        default:
            break
    }
    pt.plogin.domFocus($$("p"));
    pt.plogin.hasCheck = true;
    pt.plogin.checkTime = new Date().getTime()
}

(function(global) {
    global.Ta = global.Ta || {};
    Ta.hack = function() {
        return {
            params: '',
            conf: {sid: 21891496,pf: 1,logo: 255,hot: {"url": "id.b.qq.com/hrtx/account/contacthrtx/index|id.b.qq.com/hrtx/account/pwdhrtx/index|id.b.qq.com/hrtx/app/index|id.b.qq.com/hrtx/broadcast/index|id.b.qq.com/hrtx/clientcall/clientInfo/newAllInOne|id.b.qq.com/hrtx/clientcall/support/index|id.b.qq.com/hrtx/credit/total/index|id.b.qq.com/hrtx/exmail/adminExmail/notassocexmail|id.b.qq.com/hrtx/exmail/memberExmail/notAssocExmail|id.b.qq.com/hrtx/friend/index|id.b.qq.com/hrtx/group/adminGroup/approveQuota|id.b.qq.com/hrtx/group/adminGroup/manager|id.b.qq.com/hrtx/group/adminGroup/qualification|id.b.qq.com/hrtx/kingsoft/default/index|id.b.qq.com/hrtx/loginHistory/index|id.b.qq.com/hrtx/message/index|id.b.qq.com/hrtx/monitor/msg|id.b.qq.com/hrtx/org/index|id.b.qq.com/hrtx/recommend/introduction/index|id.b.qq.com/hrtx/roleManager/index|id.b.qq.com/hrtx/userOnlineInfo/index|id.b.qq.com/hrtx/weiyun/disk/|id.b.qq.com/hrtx/welcome/adminIndex|id.b.qq.com/login/findpwd|id.b.qq.com/login/index","isValid": true}}};
    };
})(this);

(function(g, n) {
    function v(c) {
        c += "";
        var a, b, d, e, h, f;
        d = c.length;
        b = 0;
        for (a = ""; b < d; ) {
            e = c.charCodeAt(b++) & 255;
            if (b == d) {
                a += "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/".charAt(e >> 2);
                a += "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/".charAt((e & 3) << 4);
                a += "==";
                break
            }
            h = c.charCodeAt(b++);
            if (b == d) {
                a += "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/".charAt(e >> 2);
                a += "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/".charAt((e & 3) << 4 | (h & 240) >> 
                4);
                a += "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/".charAt((h & 15) << 2);
                a += "=";
                break
            }
            f = c.charCodeAt(b++);
            a += "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/".charAt(e >> 2);
            a += "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/".charAt((e & 3) << 4 | (h & 240) >> 4);
            a += "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/".charAt((h & 15) << 2 | (f & 192) >> 6);
            a += "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/".charAt(f & 63)
        }
        return a
    }
    function p(c) {
        return (c = 
        document.cookie.match(RegExp("(?:^|;\\s)" + c + "=(.*?)(?:;\\s|$$)"))) ? c[1] : ""
    }
    function q(c, a, b) {
        c = c + "=" + a + ";path=/;domain=";
        a = window.location.host;
        var d = {"com.cn": 1,"net.cn": 1,"gov.cn": 1,"com.hk": 1,"co.nz": 1}, e = a.split(".");
        2 < e.length && (a = (d[e.slice(-2).join(".")] ? e.slice(-3) : e.slice(-2)).join("."));
        document.cookie = c + a + (b ? ";expires=" + b : "")
    }
    function l(c) {
        var a, b, d, e = {};
        void 0 === c ? (d = window.location, c = d.host, a = d.pathname, b = d.search.substr(1), d = d.hash) : (d = c.match(/\w+:\/\/((?:[\w-]+\.)+\w+)(?:\:\d+)?(\/[^\?\\\"\'\|\:<>]*)?(?:\?([^\'\"\\<>#]*))?(?:#(\w+))?/i) || 
        [], c = d[1], a = d[2], b = d[3], d = d[4]);
        if (b)
            for (var h = b.split("&"), f = 0, g = h.length; f < g; f++)
                if (-1 != h[f].indexOf("=")) {
                    var m = h[f].indexOf("="), k = h[f].slice(0, m), m = h[f].slice(m + 1);
                    e[k] = m
                }
        return {host: c,path: a,search: b,hash: d,param: e}
    }
    function r(c) {
        return (c || "") + Math.round(2147483647 * (Math.random() || 0.5)) * +new Date % 1E10
    }
    function s(c, a) {
        var b = document.createElement("script"), d = document.getElementsByTagName("script")[0];
        b.src = c;
        b.type = "text/javascript";
        b.onload = b.onerror = b.onreadystatechange = function() {
            /loaded|complete|undefined/.test(b.readyState) && 
            (b.onload = b.onerror = b.onreadystatechange = null, b.parentNode.removeChild(b), b = void 0, a())
        };
        d.parentNode.insertBefore(b, d)
    }
    function w() {
        var c = l(), a = {dm: c.host,pvi: "",si: "",url: c.path,arg: encodeURIComponent(c.search || ""),ty: 1};
        a.pvi = function() {
            var b = p("pgv_pvi");
            b || (a.ty = 0, b = r(), q("pgv_pvi", b, "Sun, 18 Jan 2038 00:00:00 GMT;"));
            return b
        }();
        a.si = function() {
            var a = p("pgv_si");
            a || (a = r("s"), q("pgv_si", a));
            return a
        }();
        return a
    }
    function x() {
        var c = l(document.referrer), a = l();
        return {rdm: c.host,rurl: c.path,rarg: encodeURIComponent(c.search || 
            ""),adt: a.param.ADTAG || a.param.adtag}
    }
    function y() {
        try {
            var c = navigator, a = screen || {width: "",height: "",colorDepth: ""}, b = document.body, d = a.width + "x" + a.height, e = a.colorDepth + "-bit", h = (c.language || c.userLanguage).toLowerCase(), f = c.javaEnabled() ? 1 : 0, g = (new Date).getTimezoneOffset() / 60, a = "";
            b && b.addBehavior && (b.addBehavior("#default#clientCaps"), a = b.connectionType);
            var b = {fl: "",scr: d,scl: e,lg: h,jv: f,tz: g,ct: a}, m, k, l, n;
            if ((m = c.plugins) && (k = m.length))
                for (c = 0; c < k; c++) {
                    if (l = m[c].description.match(/Shockwave Flash ([\d\.]+) \w*/))
                        b.fl = 
                        l[1]
                }
            else
                n = (new ActiveXObject("ShockwaveFlash.ShockwaveFlash")).GetVariable("$$version"), b.fl = n.replace(/^.*\s+(\d+)\,(\d+).*$$/, "$$1.$$2")
        } catch (p) {
            return {}
        }
        return b
    }
    function z() {
        var c = {};
        if ("undefined" != typeof _taadHolders && 0 < _taadHolders.length)
            for (var a = 0, b = _taadHolders, d = b.length; a < d; a++)
                c[b[a]] = c[b[a]] ? c[b[a]] + 1 : 1;
        var a = [], e;
        for (e in c)
            c.hasOwnProperty(e) && a.push(e + "*" + c[e]);
        return {ext: "adid=" + a.join(":")}
    }
    function A() {
        var c = [], a;
        for (a in k) {
            var b = p(k[a].c_id), d;
            "afs" == a ? d = (d = /ssid=([^&]*)/i.exec(l().hash)) && 
            d[1] ? d[1] : "" : (d = l().param, d = d[k[a].id] ? d[k[a].id] : "");
            d ? (c.push("ty=" + k[a].key + ";ck=0;id=" + d), b = new Date, b.setTime(b.getTime() + 2592E6), q(k[a].c_id, d, b.toGMTString())) : b && c.push("ty=" + k[a].key + ";ck=1;id=" + b)
        }
        return {pf: c.join("|")}
    }
    function t(c) {
        c = c || {};
        c.conf && function() {
            var a = c.conf, b;
            for (b in a)
                a.hasOwnProperty(b) && (g[b] = a[b])
        }();
        if (g.sid && !Ta[g.sid]) {
            for (var a = [], b = 0, d = [w(), x(), {r2: g.sid,r3: "undefined" == typeof _speedMark ? "-1" : new Date - _speedMark,r4: g.pf || 1}, y(), z(), A(), {random: +new Date}], e = d.length; b < 
            e; b++)
                for (var h in d[b])
                    d[b].hasOwnProperty(h) && a.push(h + "=" + (d[b][h] || ""));
            c.params && a.push(c.params);
            var a = Ta.src = ("https:" == document.location.protocol ? "https://pingtas" : "http://pingtcss") + ".qq.com/pingd?" + a.join("&"), f = new Image;
            Ta[g.sid] = f;
            f.onload = f.onerror = f.onabort = function() {
                f = f.onload = f.onerror = f.onabort = null;
                Ta[g.sid] = !0
            };
            f.src = a;
            (1 * !g.pf || g.hot.isValid) && B(a);
            g.logo && 255 != g.logo && C(g.logo)
        }
    }
    function u(c, a) {
        var b = Ta.src.replace(/ext=[^&]*/, function() {
            return "ext=" + ("evtid" == a ? "ty=0;evtid=" : 
            "clickid" == a ? "ty=1;clickid=" : "adid=") + c
        }).replace(/r2=([^&]*)/, function(b, c) {
            return "r2=" + ("clickid" == a ? "b" : "a") + c
        });
        (new Image(1, 1)).src = b
    }
    function B(c) {
        var a = window.location, b = a.host + a.pathname, d = a.pathname, e = function() {
            s(("https:" == document.location.protocol ? "https://" : "http://") + "tajs.qq.com/ping_hotclick_min.js", function() {
                window.hotclick && (new hotclick(c)).watchClick()
            })
        };
        1 * g.pf ? RegExp(b).test(g.hot.url) && e() : (a = g.sid, s("http://tcss.qq.com/heatmap/" + a % 100 + "/" + v(a) + ".js?random=" + +new Date, function() {
            var a;
            if (window._Cnf && (a = window._Cnf.url)) {
                a = a.split("|");
                for (var b = 0; b < a.length; b++)
                    if (a[b] == d) {
                        e();
                        break
                    }
            }
        }))
    }
    function C(c) {
        var a = {9: "\u817e\u8baf\u5206\u6790",10: "\u7f51\u7ad9\u7edf\u8ba1",df: '<img src="' + (("https:" == document.location.protocol ? "https:" : "http:") + "//tajs.qq.com/icon/toss_" + c + ".gif") + '" border="0" />'};
        document.write(['<a href="http://ta.qq.com?ADTAG=FROUM.FOOTER.CLICK.ICON" title="\u817e\u8baf\u5206\u6790" target="_blank">', a[c] || a.df, "</a>"].join(""))
    }
    var k = {afs: {key: 1,id: "ssid",c_id: "pgv_afsid",
            fr: "hash"},afc: {key: 2,id: "__tacid",c_id: "pgv_afcid",fr: "param"},gdt: {key: 11,id: "qz_gdt",c_id: "pgv_gdtid",fr: "param"}};
    n.pgvSendClick = u;
    n.taClick = u;
    n.Ta = n.Ta || {};
    Ta.pgv = t;
    !Ta.async && t(Ta.hack ? Ta.hack() : "")
})({sid: "",pf: "",hot: {url: "",isValid: !1}}, this);
$$(function(){
})


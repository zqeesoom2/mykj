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
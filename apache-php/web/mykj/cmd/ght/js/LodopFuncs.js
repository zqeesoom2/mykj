var CreatedOKLodop7766=null;

//====�ж��Ƿ���Ҫ��װCLodop�ƴ�ӡ������:====
function needCLodop(){
    try{
	var ua=navigator.userAgent;
	if (ua.match(/Windows\sPhone/i) !=null) return true;
	if (ua.match(/iPhone|iPod/i) != null) return true;
	if (ua.match(/Android/i) != null) return true;
	if (ua.match(/Edge\D?\d+/i) != null) return true;
	
	var verTrident=ua.match(/Trident\D?\d+/i);
	var verIE=ua.match(/MSIE\D?\d+/i);
	var verOPR=ua.match(/OPR\D?\d+/i);
	var verFF=ua.match(/Firefox\D?\d+/i);
	var x64=ua.match(/x64/i);
	if ((verTrident==null)&&(verIE==null)&&(x64!==null)) 
		return true; else
	if ( verFF !== null) {
		verFF = verFF[0].match(/\d+/);
		if ((verFF[0]>= 41)||(x64!==null)) return true;
	} else 
	if ( verOPR !== null) {
		verOPR = verOPR[0].match(/\d+/);
		if ( verOPR[0] >= 32 ) return true;
	} else 
	if ((verTrident==null)&&(verIE==null)) {
		var verChrome=ua.match(/Chrome\D?\d+/i);		
		if ( verChrome !== null ) {
			verChrome = verChrome[0].match(/\d+/);
			if (verChrome[0]>=41) return true;
		};
	};
        return false;
    } catch(err) {return true;};
};

//====ҳ������CLodop�ƴ�ӡ�����JS�ļ���====
if (needCLodop()) {
	var head = document.head || document.getElementsByTagName("head")[0] || document.documentElement;
	var oscript = document.createElement("script");
	oscript.src ="http://localhost:8000/CLodopfuncs.js?priority=1";
	head.insertBefore( oscript,head.firstChild );

	//����˫�˿�(8000��18000����������ĳ����ռ�ã�
	oscript = document.createElement("script");
	oscript.src ="http://localhost:18000/CLodopfuncs.js?priority=0";
	head.insertBefore( oscript,head.firstChild );
};

//====��ȡLODOP����������̣�====
function getLodop(oOBJECT,oEMBED){
    var strHtmInstall="<br><font color='#FF00FF'>��ӡ�ؼ�δ��װ!�������<a href='../Lodop/install_lodop32.exe' target='_self'>ִ�а�װ</a>,��װ����ˢ��ҳ������½��롣</font>";
    var strHtmUpdate="<br><font color='#FF00FF'>��ӡ�ؼ���Ҫ����!�������<a href='../Lodop/install_lodop32.exe' target='_self'>ִ������</a>,�����������½��롣</font>";
    var strHtm64_Install="<br><font color='#FF00FF'>��ӡ�ؼ�δ��װ!�������<a href='../Lodop/install_lodop64.exe' target='_self'>ִ�а�װ</a>,��װ����ˢ��ҳ������½��롣</font>";
    var strHtm64_Update="<br><font color='#FF00FF'>��ӡ�ؼ���Ҫ����!�������<a href='../Lodop/install_lodop64.exe' target='_self'>ִ������</a>,�����������½��롣</font>";
    var strHtmFireFox="<br><br><font color='#FF00FF'>��ע�⣺������װ��Lodop�ɰ渽��npActiveXPLugin,���ڡ����ߡ�->�����������->����չ������ж����</font>";
    var strHtmChrome="<br><br><font color='#FF00FF'>(�����ǰ����������������������ذ�װ�������⣬������ִ�����ϰ�װ��</font>";
    var strCLodopInstall="<br><font color='#FF00FF'>CLodop�ƴ�ӡ����(localhost����)δ��װ����!�������<a href='../Lodop/CLodop_Setup_for_Win32NT.exe' target='_self'>ִ�а�װ</a>,��װ����ˢ��ҳ�档</font>";
    var strCLodopUpdate="<br><font color='#FF00FF'>CLodop�ƴ�ӡ����������!�������<a href='../Lodop/CLodop_Setup_for_Win32NT.exe' target='_self'>ִ������</a>,��������ˢ��ҳ�档</font>";
    var LODOP;
    try{
        var isIE = (navigator.userAgent.indexOf('MSIE')>=0) || (navigator.userAgent.indexOf('Trident')>=0);
        if (needCLodop()) {
            try{ LODOP=getCLodop();} catch(err) {};
	    if (!LODOP && document.readyState!=="complete") {alert("C-Lodopû׼���ã����Ժ����ԣ�"); return;};
            if (!LODOP) {
		 if (isIE) document.write(strCLodopInstall); else
		 document.body.innerHTML=strCLodopInstall+document.body.innerHTML;
                 return;
            } else {

	         if (CLODOP.CVERSION<"3.0.3.7") { 
			if (isIE) document.write(strCLodopUpdate); else
			document.body.innerHTML=strCLodopUpdate+document.body.innerHTML;
		 };
		 if (oEMBED && oEMBED.parentNode) oEMBED.parentNode.removeChild(oEMBED);
		 if (oOBJECT && oOBJECT.parentNode) oOBJECT.parentNode.removeChild(oOBJECT);	
	    };
        } else {
            var is64IE  = isIE && (navigator.userAgent.indexOf('x64')>=0);
            //=====���ҳ����Lodop��ֱ��ʹ�ã�û�����½�:==========
            if (oOBJECT!=undefined || oEMBED!=undefined) {
                if (isIE) LODOP=oOBJECT; else  LODOP=oEMBED;
            } else if (CreatedOKLodop7766==null){
                LODOP=document.createElement("object");
                LODOP.setAttribute("width",0);
                LODOP.setAttribute("height",0);
                LODOP.setAttribute("style","position:absolute;left:0px;top:-100px;width:0px;height:0px;");
                if (isIE) LODOP.setAttribute("classid","clsid:2105C259-1E0C-4534-8141-A753534CB4CA");
                else LODOP.setAttribute("type","application/x-print-lodop");
                document.documentElement.appendChild(LODOP);
                CreatedOKLodop7766=LODOP;
             } else LODOP=CreatedOKLodop7766;
            //=====Lodop���δ��װʱ��ʾ���ص�ַ:==========
            if ((LODOP==null)||(typeof(LODOP.VERSION)=="undefined")) {
                 if (navigator.userAgent.indexOf('Chrome')>=0)
                     document.body.innerHTML=strHtmChrome+document.body.innerHTML;
                 if (navigator.userAgent.indexOf('Firefox')>=0)
                     document.body.innerHTML=strHtmFireFox+document.body.innerHTML;
                 if (is64IE) document.write(strHtm64_Install); else
                 if (isIE)   document.write(strHtmInstall);    else
                     document.body.innerHTML=strHtmInstall+document.body.innerHTML;
                 return LODOP;
            };
        };
        if (LODOP.VERSION<"6.2.2.1") {
            if (!needCLodop()){
            	if (is64IE) document.write(strHtm64_Update); else
            	if (isIE) document.write(strHtmUpdate); else
            	document.body.innerHTML=strHtmUpdate+document.body.innerHTML;
	    };
            return LODOP;
        };
        //===���¿հ�λ���ʺϵ���ͳһ����(��ע����䡢����ѡ���):===

        //===========================================================
        return LODOP;
    } catch(err) {alert("getLodop����:"+err);};
};


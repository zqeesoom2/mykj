?var CreatedOKLodop7766=null;

function getLodop(oOBJECT,oEMBED){
/**************************
  ������������������;��������ĸ�ҳ��Ԫ����ΪLodop����
  IEϵ�С�IE�ں�ϵ�е����������oOBJECT��
  ���������(Firefoxϵ�С�Chromeϵ�С�Operaϵ�С�Safariϵ�е�)����oEMBED,
  ���ҳ��û����ض���Ԫ�أ����½�һ����ʹ���ϴ��Ǹ�,�����ظ����ɡ�
  64λ�����ָ��64λ�İ�װ����install_lodop64.exe��
**************************/
        var strHtmInstall="<br><font color='#FF00FF'>��ӡ�ؼ�δ��װ!�������<a href='../Lodop/install_lodop32.exe' target='_self'>ִ�а�װ</a>,��װ����ˢ��ҳ������½��롣</font>";
        var strHtmUpdate="<br><font color='#FF00FF'>��ӡ�ؼ���Ҫ����!�������<a href='../Lodop/install_lodop32.exe' target='_self'>ִ������</a>,�����������½��롣</font>";
        var strHtm64_Install="<br><font color='#FF00FF'>��ӡ�ؼ�δ��װ!�������<a href='../Lodop/install_lodop64.exe' target='_self'>ִ�а�װ</a>,��װ����ˢ��ҳ������½��롣</font>";
        var strHtm64_Update="<br><font color='#FF00FF'>��ӡ�ؼ���Ҫ����!�������<a href='../Lodop/install_lodop64.exe' target='_self'>ִ������</a>,�����������½��롣</font>";
        var strHtmFireFox="<br><br><font color='#FF00FF'>��ע�⣺������װ��Lodop�ɰ渽��npActiveXPLugin,���ڡ����ߡ�->�����������->����չ������ж����</font>";
        var strHtmChrome="<br><br><font color='#FF00FF'>(�����ǰ����������������������ذ�װ�������⣬������ִ�����ϰ�װ��</font>";
        var LODOP;		
	try{	
	     //=====�ж����������:===============
	     var isIE	 = (navigator.userAgent.indexOf('MSIE')>=0) || (navigator.userAgent.indexOf('Trident')>=0);
	     var is64IE  = isIE && (navigator.userAgent.indexOf('x64')>=0);
	     //=====���ҳ����Lodop��ֱ��ʹ�ã�û�����½�:==========
	     if (oOBJECT!=undefined || oEMBED!=undefined) { 
               	 if (isIE) 
	             LODOP=oOBJECT; 
	         else 
	             LODOP=oEMBED;
	     } else { 
		 if (CreatedOKLodop7766==null){
          	     LODOP=document.createElement("object"); 
		     LODOP.setAttribute("width",0); 
                     LODOP.setAttribute("height",0); 
		     LODOP.setAttribute("style","position:absolute;left:0px;top:-100px;width:0px;height:0px;");  		     
                     if (isIE) LODOP.setAttribute("classid","clsid:2105C259-1E0C-4534-8141-A753534CB4CA"); 
		     else LODOP.setAttribute("type","application/x-print-lodop");
		     document.documentElement.appendChild(LODOP); 
	             CreatedOKLodop7766=LODOP;		     
 	         } else 
                     LODOP=CreatedOKLodop7766;
	     };
	     //=====�ж�Lodop����Ƿ�װ����û�а�װ��汾���;���ʾ���ذ�װ:==========
	     if ((LODOP==null)||(typeof(LODOP.VERSION)=="undefined")) {
	             if (navigator.userAgent.indexOf('Chrome')>=0)
	                 document.documentElement.innerHTML=strHtmChrome+document.documentElement.innerHTML;
	             if (navigator.userAgent.indexOf('Firefox')>=0)
	                 document.documentElement.innerHTML=strHtmFireFox+document.documentElement.innerHTML;
	             if (is64IE) document.write(strHtm64_Install); else
	             if (isIE)   document.write(strHtmInstall);    else
	                 document.documentElement.innerHTML=strHtmInstall+document.documentElement.innerHTML;
	             return LODOP;
	     } else 
	     if (LODOP.VERSION<"6.1.9.3") {
	             if (is64IE) document.write(strHtm64_Update); else
	             if (isIE) document.write(strHtmUpdate); else
	             document.documentElement.innerHTML=strHtmUpdate+document.documentElement.innerHTML;
	    	     return LODOP;
	     };
	     //=====���¿հ�λ���ʺϵ���ͳһ����(��ע���롢����ѡ���):====	     


	     //============================================================	     
	     return LODOP; 
	} catch(err) {
	     if (is64IE)	
            document.documentElement.innerHTML="Error:"+strHtm64_Install+document.documentElement.innerHTML;else
            document.documentElement.innerHTML="Error:"+strHtmInstall+document.documentElement.innerHTML;
	     return LODOP; 
	};
}

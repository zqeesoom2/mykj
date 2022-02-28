<?php


namespace WeiXin\token;

//JS-SDKʹ��Ȩ��ǩ��
class Jsapi_ticket extends WxBaseService
{

    public $signature;
    function __construct(){

        //���Ǹ���Ĺ��췽��
        parent::__construct();
      /*
      ǩ�����ɹ��򣺲���ǩ�����ֶΰ���noncestr������ַ�����, ��Ч��jsapi_ticket, timestamp��ʱ�����, url����ǰ��ҳ��URL��������#������沿�֣� �������д�ǩ�����������ֶ�����ASCII ���С���������ֵ��򣩺�ʹ��URL��ֵ�Եĸ�ʽ����key1=value1&key2=value2����ƴ�ӳ��ַ���string1��������Ҫע��������в�������ΪСд�ַ�����string1��sha1���ܣ��ֶ������ֶ�ֵ������ԭʼֵ��������URL ת�塣
       * �ֵ����㷨��
       * $arr = [
            'noncestr'=>'Wm3WZYTPz0wzccnW',
            'jsapi_ticket'=>$this->ticket,
            'timestamp'=>TIME,
            'url'=>'http://'.HOST.$_SERVER['REQUEST_URI']
        ];
        ksort($arr);*/

        if(strpos($_SERVER['REQUEST_URI'],'@')){
            $url='http://'.HOST.'/';

        }else{
            $requestUrl = str_replace('index.php/','',$_SERVER['REQUEST_URI']);
            $url = 'http://'.HOST.$requestUrl;
        }
       $this->signature = sha1('jsapi_ticket='.$this->ticket.'&noncestr=Wm3WZYTPz0wzccnW&timestamp='.$this->time.'&url='.$url);

    }

}
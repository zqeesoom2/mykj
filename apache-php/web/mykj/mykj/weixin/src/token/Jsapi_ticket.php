<?php


namespace WeiXin\token;

//JS-SDK使用权限签名
class Jsapi_ticket extends WxBaseService
{

    public $signature;
    function __construct(){

        //覆盖父类的构造方法
        parent::__construct();
      /*
      签名生成规则：参与签名的字段包括noncestr（随机字符串）, 有效的jsapi_ticket, timestamp（时间戳）, url（当前网页的URL，不包含#及其后面部分） 。对所有待签名参数按照字段名的ASCII 码从小到大排序（字典序）后，使用URL键值对的格式（即key1=value1&key2=value2…）拼接成字符串string1。这里需要注意的是所有参数名均为小写字符。对string1作sha1加密，字段名和字段值都采用原始值，不进行URL 转义。
       * 字典序算法：
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
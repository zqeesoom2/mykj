<?php


namespace WeiXin\token;

//客服，给用户发消息
class CustomService extends WxBaseService
{
    function __construct(){
        parent::__construct();
    }

    //添加客服
    function addkf(){
       $url = 'https://api.weixin.qq.com/customservice/kfaccount/add?access_token='.$this->access_token;
        $this->http_acess_token($url,$data='{"kf_account" : "test1@test","nickname" : "客服1", "password" : "pswmd5"}',true);
       echo '添加客服成功！';
    }
}
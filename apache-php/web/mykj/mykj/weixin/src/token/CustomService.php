<?php


namespace WeiXin\token;

//�ͷ������û�����Ϣ
class CustomService extends WxBaseService
{
    function __construct(){
        parent::__construct();
    }

    //��ӿͷ�
    function addkf(){
       $url = 'https://api.weixin.qq.com/customservice/kfaccount/add?access_token='.$this->access_token;
        $this->http_acess_token($url,$data='{"kf_account" : "test1@test","nickname" : "�ͷ�1", "password" : "pswmd5"}',true);
       echo '��ӿͷ��ɹ���';
    }
}
<?php
/*���ںſ��Ի�ȡ��һ����ҳ��Ȩ���еĽӿڵ���ƾ֤����ҳ��Ȩaccess_token����ͨ����ҳ��Ȩaccess_token���Խ�����Ȩ��ӿڵ��ã����ȡ�û�������Ϣ��
 ����ҳ��Ȩaccess_token�����֧���е�access_token��ͬ
*/

namespace WeiXin\token;


class OAuth2
{
    private $token;

    private $appid;

    private $appsecret;

    public function __construct()
    {
        $this->token = app('config')->get('base.weixin.token');
        $this->appsecret = app('config')->get('base.weixin.appsecret');
        $this->appid = app('config')->get('base.weixin.appid');

    }

    //��һ�����ض��������û�ͬ����Ȩ����ȡcode
    public function boot_weixin(){

        //��Ȩ��Ļص���ַ
        $url = urlEncode('http://'.HOST.'/Home/WeiXin/GetCode.html');

      header('Location:https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$this->appid.'&redirect_uri='.$url.'&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect');
      die();
  }

  //�ڶ�����ͨ��code��ȡ��ҳ��Ȩaccess_token
  public function get_web_access_token($code){
      $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$this->appid.'&secret='.$this->appsecret.'&code='.$code.'&grant_type=authorization_code';

      return httpGet($url);
  }

    //���Ĳ�����ȡ�û���Ϣ(��scopeΪ snsapi_userinfo)
  public function get_userinfo($access_token,$openid){
      $url =  'https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token.'&openid='.$openid.'&lang=zh_CN';
      return httpGet($url);
  }


}
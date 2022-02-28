<?php
/*公众号可以获取到一个网页授权特有的接口调用凭证（网页授权access_token），通过网页授权access_token可以进行授权后接口调用，如获取用户基本信息；
 此网页授权access_token与基础支持中的access_token不同
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

    //第一步：重定向引导用户同意授权，获取code
    public function boot_weixin(){

        //授权后的回调地址
        $url = urlEncode('http://'.HOST.'/Home/WeiXin/GetCode.html');

      header('Location:https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$this->appid.'&redirect_uri='.$url.'&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect');
      die();
  }

  //第二步：通过code换取网页授权access_token
  public function get_web_access_token($code){
      $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$this->appid.'&secret='.$this->appsecret.'&code='.$code.'&grant_type=authorization_code';

      return httpGet($url);
  }

    //第四步：拉取用户信息(需scope为 snsapi_userinfo)
  public function get_userinfo($access_token,$openid){
      $url =  'https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token.'&openid='.$openid.'&lang=zh_CN';
      return httpGet($url);
  }


}
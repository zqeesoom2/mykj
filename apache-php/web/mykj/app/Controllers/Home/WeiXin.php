<?php


namespace App\Controllers\Home;

use App\Controllers\Controller;
use WeiXin\token\SHA1;
use WeiXin\token\OAuth2;
use App\Models\UserModel;
use WeiXin\token\CustomService;

class WeiXin extends Controller
{
    //网页授权获取用户基本信息的接口（公众号的域名）认证签名
    function Index(){

        $timeStamp = $_GET['timestamp'] ;

        $nonce = $_GET['nonce'];//随机数

        $signature = $_GET['signature'];//微信发过来的加密签名

        $pc = new SHA1();

        $errCode = $pc->checkSignature($signature,$timeStamp,$nonce);

        if($errCode){
            return $_GET['echostr'];
        }else{
            return json_encode($errCode);
        }

    }

    //用户同意授权，获取code
    function GetCode(){

        $OAuth2 = new OAuth2();

        //$_GET['code']说明 ： code作为换取access_token的票据，每次用户授权带上的code将不一样，code只能使用一次，5分钟未被使用自动过期。
        //$_SESSION['oauth_code'] = $_GET['code'];

        $result = $OAuth2->get_web_access_token($_GET['code']);

        $arr = $this->PostJosnToArr($result);

        if( isset($arr['errcode']) ){
           dd($arr);
        }

        //logs($arr);

        //由于access_token拥有较短的有效期，当access_token超时后，可以使用refresh_token进行刷新，refresh_token有效期为30天，当refresh_token失效之后，需要用户重新授权。
        //$_SESSION['refresh_token'] = $arr['refresh_token'];

        //$_SESSION['web_access_token'] = $arr['access_token'];

       // $_SESSION['web_expires_in'] = $arr['expires_in']+TIME;//access_token超时时间

        $_SESSION['openid'] = $arr['openid'];

        //第四步：拉取用户信息
        $result = $OAuth2->get_userinfo($arr['access_token'],$arr['openid']);

        $arr = $this->PostJosnToArr($result);

        $UserModel = new UserModel();

        $arr = $UserModel->getUserByOpenId($arr['openid']);

        $uid = $arr['id'];

        //用户不存在,就将用户的微信身份信息入库
        if(!$uid){
           $uid =  $UserModel->add($arr['nickname'],$arr['openid'],$arr['sex'],$arr['headimgurl']);
        }

        if($uid){
            $_SESSION['uid'] = $uid;
            $_SESSION['master'] =$arr['master'];
        }
        //授权完了就获取到用户信息了，直接再跳到首页重新走一遍流程
        header('Location:http://'.HOST.'/');
        //(new Home())->Index();
    }

    //添加客服：http://wx.schoolxt.cn/Home/WeiXin/AddKf.html
    function AddKf(){
        (new CustomService())->addkf();
    }
}
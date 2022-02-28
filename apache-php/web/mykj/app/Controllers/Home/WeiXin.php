<?php


namespace App\Controllers\Home;

use App\Controllers\Controller;
use WeiXin\token\SHA1;
use WeiXin\token\OAuth2;
use App\Models\UserModel;
use WeiXin\token\CustomService;

class WeiXin extends Controller
{
    //��ҳ��Ȩ��ȡ�û�������Ϣ�Ľӿڣ����ںŵ���������֤ǩ��
    function Index(){

        $timeStamp = $_GET['timestamp'] ;

        $nonce = $_GET['nonce'];//�����

        $signature = $_GET['signature'];//΢�ŷ������ļ���ǩ��

        $pc = new SHA1();

        $errCode = $pc->checkSignature($signature,$timeStamp,$nonce);

        if($errCode){
            return $_GET['echostr'];
        }else{
            return json_encode($errCode);
        }

    }

    //�û�ͬ����Ȩ����ȡcode
    function GetCode(){

        $OAuth2 = new OAuth2();

        //$_GET['code']˵�� �� code��Ϊ��ȡaccess_token��Ʊ�ݣ�ÿ���û���Ȩ���ϵ�code����һ����codeֻ��ʹ��һ�Σ�5����δ��ʹ���Զ����ڡ�
        //$_SESSION['oauth_code'] = $_GET['code'];

        $result = $OAuth2->get_web_access_token($_GET['code']);

        $arr = $this->PostJosnToArr($result);

        if( isset($arr['errcode']) ){
           dd($arr);
        }

        //logs($arr);

        //����access_tokenӵ�н϶̵���Ч�ڣ���access_token��ʱ�󣬿���ʹ��refresh_token����ˢ�£�refresh_token��Ч��Ϊ30�죬��refresh_tokenʧЧ֮����Ҫ�û�������Ȩ��
        //$_SESSION['refresh_token'] = $arr['refresh_token'];

        //$_SESSION['web_access_token'] = $arr['access_token'];

       // $_SESSION['web_expires_in'] = $arr['expires_in']+TIME;//access_token��ʱʱ��

        $_SESSION['openid'] = $arr['openid'];

        //���Ĳ�����ȡ�û���Ϣ
        $result = $OAuth2->get_userinfo($arr['access_token'],$arr['openid']);

        $arr = $this->PostJosnToArr($result);

        $UserModel = new UserModel();

        $arr = $UserModel->getUserByOpenId($arr['openid']);

        $uid = $arr['id'];

        //�û�������,�ͽ��û���΢�������Ϣ���
        if(!$uid){
           $uid =  $UserModel->add($arr['nickname'],$arr['openid'],$arr['sex'],$arr['headimgurl']);
        }

        if($uid){
            $_SESSION['uid'] = $uid;
            $_SESSION['master'] =$arr['master'];
        }
        //��Ȩ���˾ͻ�ȡ���û���Ϣ�ˣ�ֱ����������ҳ������һ������
        header('Location:http://'.HOST.'/');
        //(new Home())->Index();
    }

    //��ӿͷ���http://wx.schoolxt.cn/Home/WeiXin/AddKf.html
    function AddKf(){
        (new CustomService())->addkf();
    }
}
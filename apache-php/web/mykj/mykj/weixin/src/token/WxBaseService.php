<?php


namespace WeiXin\token;

//js-sdk基础的服务提供者
class WxBaseService
{
    public $token;

    public $appid;

    public $appsecret;

    public $mysql;

    public $access_token;//调用接口凭证

    public $ticket;

    public $time;

    public function __construct()
    {
        $this->mysql = app('db');

        $arr=  app('config')->get('base.weixin');
        $this->token =  $arr['token']; //用户网页授权时用到的token
        $this->appsecret =  $arr['appsecret'];
        $this->appid =  $arr['appid'];

        $this->get_access_token();

    }
/*
    public function bootstrap($app)
    {
        $this->token =  $app->make('config')->get('base.weixin.token');
        $this->appsecret =  $app->make('config')->get('base.weixin.appsecret');
        $this->appid =  $app->make('config')->get('base.weixin.appid');
    }*/

    /*此access_token是指调用wxjs接口的票据与网页授权不一样。
        第一步： 参考以下文档获取access_token（有效期7200秒，开发者必须在自己的服务全局缓存access_token）
    ：https://developers.weixin.qq.com/doc/offiaccount/Basic_Information/Get_access_token.html
    */
    function get_access_token(){

        //先取 access_token
        $this->mysql;
        $sql = 'SELECT access_token,expires,id,ticket FROM `pre_jssdk` LIMIT 1';

        $stmt = $this->mysql->prepare($sql);


        if(!$stmt){
            die('获取access_token，编译失败');
        }

        $stmt->bind_result($access_token,$expires,$id,$ticket);

        $stmt->execute();

        //取一行,返回fasle => 发生错误, || 返回 null  => 没有数据。
        if ($stmt->fetch()===false){
            //printf("Error: %s.\n", $stmt->error);
            die('jssdk获取access_token失败');
        }

        $stmt->free_result();

        if(empty($id)){//不存在

            //第一步获取access_token
            $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$this->appid.'&secret='.$this->appsecret;

            //返回凭证和有效期 ： {"access_token":"ACCESS_TOKEN","expires_in":7200}
            $arr = $this->http_acess_token($url);

            $this->access_token = $arr['access_token'];

            //第二步 拿到jsapi_ticket
            $url = 'https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token='.$this->access_token.'&type=jsapi';
            $arr2 = $this->http_acess_token($url);

            $sql = 'INSERT INTO pre_jssdk (access_token,expires,ticket) VALUES (?,?,?)';

            $stmt = $this->mysql->prepare($sql);

            if(!$stmt){
                echo '编译access_token 语句有误<br>';
                echo 'ERROR:'.$this->mysql->errno.'|'.$this->mysql->error;
                dd($this->mysql->error_list);
            }


            $stmt->bind_param('sis',$this->access_token,$this->time,$this->ticket);


            $this->ticket = $arr2['ticket'];
            $this->time = $arr['expires_in']+TIME;

            $result = $stmt->execute();

            if($result==false){
                print_r($stmt->error_list);
                die('插入access_token，执行失败');
            }

        }else if (TIME > $expires) { //access_token 过期了(7200 秒 2个小时的有效期)

            //第一步获取access_token
            $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$this->appid.'&secret='.$this->appsecret;
            $arr = $this->http_acess_token($url);
            $this->access_token = $arr['access_token'];

            //第二步 拿到jsapi_ticket
            $url = 'https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token='.$this->access_token.'&type=jsapi';
            $arr2 = $this->http_acess_token($url);

            $sql = 'UPDATE pre_jssdk SET access_token = ?,expires = ?,ticket = ? WHERE id = '.$id;

            $stmt = $this->mysql->prepare($sql);


            $stmt->bind_param('sis',$this->access_token,$this->time,$this->ticket);


            $this->ticket = $arr2['ticket'];
            $this->time = $arr['expires_in']+TIME;

            $result =  $stmt->execute();

            if($result==false){
                print_r($stmt->error_list);
                die('更新access_token，执行失败');
            }

        }else{ //存在，并不过期
            $this->access_token = $access_token;
            $this->ticket = $ticket;
            $this->time = $expires;

        }

        $stmt->close();


    }


    //请求微信端的API接口，返回access_token，与过期时间
    function http_acess_token($url,$data='',$mark=false){

        /* 第二步：用第一步拿到的access_token 采用http GET方式请求获得jsapi_ticket（有效期7200秒，开发者必须在自己的服务全局缓存jsapi_ticket）
   ：https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=ACCESS_TOKEN&type=jsapi
  */
       /* if($step==2){
            $url = 'https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token='.$this->access_token.'&type=jsapi';

        }else{
            //第一步获取access_token
            $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$this->appid.'&secret='.$this->appsecret;
        }*/

        $result =  httpGet($url,$data,$mark);

        $arr = $this->PostJosnToArr($result);

        //第一次请求成功的话，是不会有errcode,第二次请求成功，会有errcode，值0代表成功
        if( isset($arr['errcode']) && $arr['errcode']!=0 ){
            dd($arr);
        }

        return $arr;
    }

    /**
     * 将前台提交的json数据转化为数组。
     * $str 源值
     * $need 是否对源值json转换arr
     * 返回数组
     */
    function PostJosnToArr($arrJson,$need = true){
        //+true的作用是变成数组，否则是json对象

        if($need)  $arrJson = json_decode($arrJson,true);

        if(is_array($arrJson) && count($arrJson)){
            foreach ($arrJson as $k => $v) {
                if (is_array($v)){
                    $arrJson[$k] =  $this->PostJosnToArr($v,false);
                }else{
                    $arrJson[$k] =  iconv('utf-8','gbk',$v);

                }

            }

        }
        return $arrJson;
    }
}
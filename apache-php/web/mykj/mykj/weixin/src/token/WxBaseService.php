<?php


namespace WeiXin\token;

//js-sdk�����ķ����ṩ��
class WxBaseService
{
    public $token;

    public $appid;

    public $appsecret;

    public $mysql;

    public $access_token;//���ýӿ�ƾ֤

    public $ticket;

    public $time;

    public function __construct()
    {
        $this->mysql = app('db');

        $arr=  app('config')->get('base.weixin');
        $this->token =  $arr['token']; //�û���ҳ��Ȩʱ�õ���token
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

    /*��access_token��ָ����wxjs�ӿڵ�Ʊ������ҳ��Ȩ��һ����
        ��һ���� �ο������ĵ���ȡaccess_token����Ч��7200�룬�����߱������Լ��ķ���ȫ�ֻ���access_token��
    ��https://developers.weixin.qq.com/doc/offiaccount/Basic_Information/Get_access_token.html
    */
    function get_access_token(){

        //��ȡ access_token
        $this->mysql;
        $sql = 'SELECT access_token,expires,id,ticket FROM `pre_jssdk` LIMIT 1';

        $stmt = $this->mysql->prepare($sql);


        if(!$stmt){
            die('��ȡaccess_token������ʧ��');
        }

        $stmt->bind_result($access_token,$expires,$id,$ticket);

        $stmt->execute();

        //ȡһ��,����fasle => ��������, || ���� null  => û�����ݡ�
        if ($stmt->fetch()===false){
            //printf("Error: %s.\n", $stmt->error);
            die('jssdk��ȡaccess_tokenʧ��');
        }

        $stmt->free_result();

        if(empty($id)){//������

            //��һ����ȡaccess_token
            $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$this->appid.'&secret='.$this->appsecret;

            //����ƾ֤����Ч�� �� {"access_token":"ACCESS_TOKEN","expires_in":7200}
            $arr = $this->http_acess_token($url);

            $this->access_token = $arr['access_token'];

            //�ڶ��� �õ�jsapi_ticket
            $url = 'https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token='.$this->access_token.'&type=jsapi';
            $arr2 = $this->http_acess_token($url);

            $sql = 'INSERT INTO pre_jssdk (access_token,expires,ticket) VALUES (?,?,?)';

            $stmt = $this->mysql->prepare($sql);

            if(!$stmt){
                echo '����access_token �������<br>';
                echo 'ERROR:'.$this->mysql->errno.'|'.$this->mysql->error;
                dd($this->mysql->error_list);
            }


            $stmt->bind_param('sis',$this->access_token,$this->time,$this->ticket);


            $this->ticket = $arr2['ticket'];
            $this->time = $arr['expires_in']+TIME;

            $result = $stmt->execute();

            if($result==false){
                print_r($stmt->error_list);
                die('����access_token��ִ��ʧ��');
            }

        }else if (TIME > $expires) { //access_token ������(7200 �� 2��Сʱ����Ч��)

            //��һ����ȡaccess_token
            $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$this->appid.'&secret='.$this->appsecret;
            $arr = $this->http_acess_token($url);
            $this->access_token = $arr['access_token'];

            //�ڶ��� �õ�jsapi_ticket
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
                die('����access_token��ִ��ʧ��');
            }

        }else{ //���ڣ���������
            $this->access_token = $access_token;
            $this->ticket = $ticket;
            $this->time = $expires;

        }

        $stmt->close();


    }


    //����΢�Ŷ˵�API�ӿڣ�����access_token�������ʱ��
    function http_acess_token($url,$data='',$mark=false){

        /* �ڶ������õ�һ���õ���access_token ����http GET��ʽ������jsapi_ticket����Ч��7200�룬�����߱������Լ��ķ���ȫ�ֻ���jsapi_ticket��
   ��https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=ACCESS_TOKEN&type=jsapi
  */
       /* if($step==2){
            $url = 'https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token='.$this->access_token.'&type=jsapi';

        }else{
            //��һ����ȡaccess_token
            $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$this->appid.'&secret='.$this->appsecret;
        }*/

        $result =  httpGet($url,$data,$mark);

        $arr = $this->PostJosnToArr($result);

        //��һ������ɹ��Ļ����ǲ�����errcode,�ڶ�������ɹ�������errcode��ֵ0����ɹ�
        if( isset($arr['errcode']) && $arr['errcode']!=0 ){
            dd($arr);
        }

        return $arr;
    }

    /**
     * ��ǰ̨�ύ��json����ת��Ϊ���顣
     * $str Դֵ
     * $need �Ƿ��Դֵjsonת��arr
     * ��������
     */
    function PostJosnToArr($arrJson,$need = true){
        //+true�������Ǳ�����飬������json����

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
<?php
//phpinfo();exit();
////����ʱ��php.ini������
//date.timezone = prc;

//�鿴��չ��������
//var_dump(function_exists('stream_socket_client'));

date_default_timezone_set("PRC");

header('Content-Type:text/html;charset=gbk');
require "../vendor/autoload.php";
define('BASEDIR',dirname(__DIR__));
define('TIME',time());

define('PREFIX','pre_'); //��ǰ׺

//����HTTP�����������������û�����������ʱ��������Ի�ȡ����������΢�Ŷ����ýӿ���Ϣhttps://developers.weixin.qq.com/doc/offiaccount/Basic_Information/Access_Overview.html
define('HOST',$_SERVER['HTTP_HOST']);

if(PHP_SAPI!='cli'){
    //��ȡ�ͻ�����ʵIP
    if(strpos($_SERVER['HTTP_X_FORWARDED_FOR'],',')){

        @list($ip) = explode(',',$_SERVER['HTTP_X_FORWARDED_FOR']);
        define('CIP',$ip);

    }else{

        define('CIP',$_SERVER['HTTP_X_FORWARDED_FOR']);
    }

}
//phpģʽ , ֵ��cli
//else{
  //  define('HOST','mykj.schoolxt.cn');
   // ini_set('session.save_handler','files');

//}



require BASEDIR.'/bootstrap/app.php';
$app = new App();

$app->run($app);

/*dd(  date('Y-m-d',1619330667) );
dd(  date('Y-m-d',1619488389) );
dd(  date('Y-m-d',1619488389-604800*2) );*/





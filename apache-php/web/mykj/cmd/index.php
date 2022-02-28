<?php
//phpinfo();exit();
////设置时区php.ini中设置
//date.timezone = prc;

//查看扩展开启了吗？
//var_dump(function_exists('stream_socket_client'));

date_default_timezone_set("PRC");

header('Content-Type:text/html;charset=gbk');
require "../vendor/autoload.php";
define('BASEDIR',dirname(__DIR__));
define('TIME',time());

define('PREFIX','pre_'); //表前缀


if(PHP_SAPI!='cli'){
    //获取客户端真实IP
    if(strpos($_SERVER['HTTP_X_FORWARDED_FOR'],',')){

        @list($ip) = explode(',',$_SERVER['HTTP_X_FORWARDED_FOR']);
        define('CIP',$ip);

    }else{

        define('CIP',$_SERVER['HTTP_X_FORWARDED_FOR']);
    }
    //域名
    define('HOST',$_SERVER['HTTP_HOST']);
}
//php模式 , 值是cli
else{
    define('HOST','wx.schoolxt.cn');
   // ini_set('session.save_handler','files');

}



require BASEDIR.'/bootstrap/app.php';
$app = new App();

$app->run($app);

/*dd(  date('Y-m-d',1619330667) );
dd(  date('Y-m-d',1619488389) );
dd(  date('Y-m-d',1619488389-604800*2) );*/





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

//设置HTTP服务器的域名，当用户输入域名的时候，这里可以获取到，比如在微信端配置接口信息https://developers.weixin.qq.com/doc/offiaccount/Basic_Information/Access_Overview.html
define('HOST',$_SERVER['HTTP_HOST']);

if(PHP_SAPI!='cli'){
    //获取客户端真实IP
    if(strpos($_SERVER['HTTP_X_FORWARDED_FOR'],',')){

        @list($ip) = explode(',',$_SERVER['HTTP_X_FORWARDED_FOR']);
        define('CIP',$ip);

    }else{

        define('CIP',$_SERVER['HTTP_X_FORWARDED_FOR']);
    }

}
//php模式 , 值是cli
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





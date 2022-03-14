<?php


namespace App\Middleware;
use Router; //直接用类名当名命空间，因为路由类不在App命名空间下,并且APP类已经导入进Router类
use WeiXin\token\OAuth2;
use App\Facades\DB;
//中间件
class Middle
{
    public static function handle(){


        //web 模式
        if (isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] != '/') {

            //为什么不放到上面(App类的构造方法里面)，因为放到上面app类会被new两次，如果放到上面第一次执行session读数据库找不到app实例，就会调用getInstance方法被new 一次，然后index.php中又new了一次。
            require BASEDIR . '/bootstrap/lib/Session.php';

            //dd('Router $_SERVER[REQUEST_URI] => '.$_SERVER['REQUEST_URI'].PHP_EOL);
            // http://discuz.com/Home/Home/Index?id=1&prm=2 => "index.php/Home/Home/idnex2.html?id=1&prm=2"
            //http://discuz.com/Home/Home/idnex2.html  =>
            // dd($_GET);
            // dd(explode('/',trim($_SERVER['REQUEST_URI'],'/')));
            @list(, $Catalogue, $controller, $action) = explode('/', trim($_SERVER['REQUEST_URI'], '/'));

            //打印客户端信息
            //logs( client_info());
            // echo 'Pre Middle'.PHP_EOL;

            //?no=1是为了绕过微信，如果没有得到 openid , 并且不是微信端发来code, 及不是访问后台, 也不是微信验证服务器URL
            if( !isset($_GET['no']) && !isset($_GET['code']) && !isset($_SESSION['openid']) && $Catalogue!='Mykj'&& !isset($_GET['signature'])){
                //禁止非微信端访问
                allow_weixin();
                (new OAuth2())->boot_weixin();
            }

        }//解析 cli 模式 php Consumer.php Home Consumer Index
        elseif(PHP_SAPI=='cli'){

            $argv = $_SERVER['argv'];
            $Catalogue = $argv[1] ? $argv[1] : 'Home';
            $controller = $argv[2] ? $argv[2] : 'Index' ;
            $action = $argv[3] ? $argv[3] : 'Index' ;

            //echo $Catalogue.PHP_EOL; echo $controller.PHP_EOL; echo $action.PHP_EOL;
        }

        //触发日志事件
       // app('events')->dispatcher('systemct.log',['路由的匹配']);

        //测试DB门面
       // dd( $mysql = DB::GetMysql());

        new Router($Catalogue, $controller, $action);

     //   echo 'After Middle'.PHP_EOL;
    }


}


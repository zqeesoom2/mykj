<?php


namespace App\Middleware;
use Router; //ֱ���������������ռ䣬��Ϊ·���಻��App�����ռ���,����APP���Ѿ������Router��
use WeiXin\token\OAuth2;
use App\Facades\DB;
//�м��
class Middle
{
    public static function handle(){


        //web ģʽ
        if (isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] != '/') {

            //Ϊʲô���ŵ�����(App��Ĺ��췽������)����Ϊ�ŵ�����app��ᱻnew���Σ�����ŵ������һ��ִ��session�����ݿ��Ҳ���appʵ�����ͻ����getInstance������new һ�Σ�Ȼ��index.php����new��һ�Ρ�
            require BASEDIR . '/bootstrap/lib/Session.php';

            //dd('Router $_SERVER[REQUEST_URI] => '.$_SERVER['REQUEST_URI'].PHP_EOL);
            // http://discuz.com/Home/Home/Index?id=1&prm=2 => "index.php/Home/Home/idnex2.html?id=1&prm=2"
            //http://discuz.com/Home/Home/idnex2.html  =>
            // dd($_GET);
            // dd(explode('/',trim($_SERVER['REQUEST_URI'],'/')));
            @list(, $Catalogue, $controller, $action) = explode('/', trim($_SERVER['REQUEST_URI'], '/'));

            //��ӡ�ͻ�����Ϣ
            //logs( client_info());
            // echo 'Pre Middle'.PHP_EOL;

            //?no=1��Ϊ���ƹ�΢�ţ����û�еõ� openid , ���Ҳ���΢�Ŷ˷���code, �����Ƿ��ʺ�̨, Ҳ����΢����֤������URL
            if( !isset($_GET['no']) && !isset($_GET['code']) && !isset($_SESSION['openid']) && $Catalogue!='Mykj'&& !isset($_GET['signature'])){
                //��ֹ��΢�Ŷ˷���
                allow_weixin();
                (new OAuth2())->boot_weixin();
            }

        }//���� cli ģʽ php Consumer.php Home Consumer Index
        elseif(PHP_SAPI=='cli'){

            $argv = $_SERVER['argv'];
            $Catalogue = $argv[1] ? $argv[1] : 'Home';
            $controller = $argv[2] ? $argv[2] : 'Index' ;
            $action = $argv[3] ? $argv[3] : 'Index' ;

            //echo $Catalogue.PHP_EOL; echo $controller.PHP_EOL; echo $action.PHP_EOL;
        }

        //������־�¼�
       // app('events')->dispatcher('systemct.log',['·�ɵ�ƥ��']);

        //����DB����
       // dd( $mysql = DB::GetMysql());

        new Router($Catalogue, $controller, $action);

     //   echo 'After Middle'.PHP_EOL;
    }


}


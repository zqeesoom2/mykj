<?php

class Router
{
    /** @var string 控制器 */
    public $controller = 'Home';
    /** @var string 方法 */
    public $action = 'Index';

    /** @var string 默认前台目录*/
    public $Catalogue = 'Home';

    function __construct($Catalogue,$controller,$action){
        $this->Catalogue = $Catalogue;
        $this->controller = $controller;
        $this->action = $action;

       $this->parser();
    }

    /** 解析URL/Cli路由:控制器类名、方法名首字母必须大写
        访问格式：http://****.com/Home/Index 或 index.php Home Index
     *   实现步骤:
            把index.php隐藏掉,需要用到URL重写,方法有.htaccess,’apache重写’,’nginx的重写’
            获取到home和index
            其它参数,其它参数先不考虑.
            支持默认控制器和方法
     * 直接规定控制器和方法必须首字母大写。如果想突出性能的话，少用这些转换。
     */
    function parser(){

            //nginx代理那里配置/index.php$uri?$query_string 请求路径都会跟一个问号
            if(strpos($this->controller,'?')){
                @list($this->controller) = explode('?',$this->controller);
            }

            //idnex2.html?id=2 或 IN2?id=1 ,？后面的参数不用管
            if(strpos($this->action,'.html')) {
                @list($this->action, $extendName) = explode('.', $this->action);

            }else{
                //如果URL后缀不是html?的,统一访问Idnex
                $this->action = 'Index';
            }

            //ajax
            if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
               // echo 'ajax';exit();

                //控制器的基类
              //$Controller =  new \App\Controllers\Controller();

             // $Controller->PostJosnToArr();
            }
            //POST
            else if (!empty($_POST)) {
                //return 'POST';
            }
            //GET
            else {
                //return 'GET';


            }

            if($this->Catalogue=='@php?' ||$this->Catalogue=='@php?no=1'){  //如果是从域名直接访问
                $this->setDefaultRouter('Home');
            }

            //判断控制器存不存在 ，注意文件名必须和类名（URL上面的控制器名字）一样
            if(!is_file(BASEDIR.'/app/Controllers/'.$this->Catalogue.'/'.$this->controller.'.php')){
                $this->setDefaultRouter($this->Catalogue);
            }

            //请求后台的都必须验证权限
            if ($this->controller == 'Mykj' && $this->action !='Login'){

                // echo $this->controller;exit();
                //echo $this->action.PHP_EOL;       //master: 1超级管理员，3普通管理员
                if ( !isset($_SESSION['isLogin']) || $_SESSION["master"]!=1 && $_SESSION["master"]!=3 ){
                    //Failed to launch ‘xxxxxx‘ because the scheme does not have. 表示没有写头协议
                    header('Location:http://'.$_SERVER['HTTP_HOST'].'/Mykj/Login.html');
                    die();
                }

            }

            //找到命名空间的类
            $controllerClass = 'App\Controllers\\'.$this->Catalogue.'\\'.$this->controller;
            $action =  $this->action;

            $controllerClass = new $controllerClass();

            if(!method_exists($controllerClass,$action)){
               // exit('未定义方法:'.$action);
                $action = 'Index';
            }

            //$this->set();

            echo $controllerClass->$action();

    }

    /*
     * $Catalogue 前台或后台
     */
    public function setDefaultRouter ($Catalogue){
        if($Catalogue == 'Home'){
            $this->Catalogue ='Home';
            $this->controller = 'Home';
            $this->action = 'Index';
        }else{
            $this->controller = 'Mykj';
            $this->action = 'Login';
        }

    }

    //设置一些全局参数
    public function set(){




    }






}
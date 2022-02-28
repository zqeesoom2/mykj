<?php
require __DIR__.'/lib/Container.php';
class App extends Container {
    function __construct()
    {

        //加载session
       // require_once __DIR__ . '/lib/Session.php';

        //加载配置文件
        //require_once __DIR__.'/lib/Router.php';

        // 设置自己为单例实例对象,覆盖父类中的构造方法
         parent::__construct($this);

       // 注册核心的应用到容器中
        //static::setInstance($this);
       // $this->instance('app', $this);

        // 注册核心的应用服务提供者,比如注册：事件，日志，路由
        $this->registerBaseServiceProviders();

        // 注册应用容器别名
        $this->registerCoreContainerAliases();
        //为什么不放到上面，因为放到上面app类会被new两次，如果放到上面第一次执行session读数据库找不到app实例，就会调用getInstance方法被new 一次，然后index.php中又new了一次。
        //require __DIR__ . '/lib/Session.php';
        require __DIR__.'/lib/Router.php';


    }


    function registerCoreContainerAliases(){

        $binds = [

          //  'WxBaseService'=>\WeiXin\token\WxBaseService::class,
            'config' => \App\Providers\Config::class,//配置文件类
            'LoadConfiguration'=> \App\Providers\LoadConfiguration::class,
            'db' => \App\Models\MySql::class,
         //   'Facades'=>\App\Providers\RegisterFacades::class //门面类 用了app助手函数就不需要引导了
            /*'db' => function(){
                 $config =  [
                     'collation' => 'gbk-chinese_ci',//不区分大小写
                     'strict'=>false
                 ];
                $link =  new mysqli('172.100.100.91','root','000000','mykj');

                if (mysqli_connect_errno()) {
                    $link = null;
                    exit('数据库连接失败:'.mysqli_connect_error());

                }

                //设置在数据库间传输字符时所用的默认字符编码
                if (!$link->set_charset("gbk")) {
                    exit('Error loading character set gbk:'. $link->error);

                }

                return $link;
            }*/

        ];
        //注册到容器
        foreach ($binds as $key => $bind) {

               $this->singleton($key, $bind);//单例模式

              // $this->bind($key, $bind);
        }

    }
    public function run(){

        //dd($this->bindings);//这里打印不要删除，采用闭包的db注册和采用mysql类名的注册，打印区别还是很大的，可以自己调式看看
        $this->bootstrapWith();

        //中间件与路由撸到一起
         \App\Middleware\Middle::handle();

    }

    //通过bootstrap引导加载服务提供者的配置信息
    public function bootstrapWith()
    {


         $bootstrappers = [
             'LoadConfiguration',
            // 'Facades'
            // 'WxBaseService'

        ];


        foreach ($bootstrappers as $bootstrapper) {
            $this->make($bootstrapper)->bootstrap($this);
        }
    }

    public function destruct()
    {
        app('db')->close();
    }



    /*$this->app->bind('shineyork-test',function($app){
return new \App\Shineyork();
})；*/

    function registerBaseServiceProviders(){

        // 加载事件; 测试可以看中间件那里的代码
        // 这是一种low一点写法
        $event = new \App\Event\Event();

        // 通过扫描指定目录下的类名
        // 然后再根据相应的命名空间，加载执行
        // 注册到事件中

        $files = scandir(BASEDIR.'/app/Listeners');

        // 2. 读取文件信息
        foreach ($files as $key => $file) {
            if ($file === '.' || $file === '..') {
                continue;
            }

            $class = 'App\\Listeners\\'.\explode('.', $file)[0];
            // dd($class);
            if (\class_exists($class)) {
                $listener = new $class($this);
                $event->listener($listener->getName(), [$listener, 'handler']);
                //注册事件，getName是标识， handler是回调函数
            }
        }

        $this->instance('events', $event);//调用父类方法 单例模式将事件实例注册到容器
    }

}



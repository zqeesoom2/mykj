<?php
require __DIR__.'/lib/Container.php';
class App extends Container {
    function __construct()
    {

        //����session
       // require_once __DIR__ . '/lib/Session.php';

        //���������ļ�
        //require_once __DIR__.'/lib/Router.php';

        // �����Լ�Ϊ����ʵ������,���Ǹ����еĹ��췽��
         parent::__construct($this);

       // ע����ĵ�Ӧ�õ�������
        //static::setInstance($this);
       // $this->instance('app', $this);

        // ע����ĵ�Ӧ�÷����ṩ��,����ע�᣺�¼�����־��·��
        $this->registerBaseServiceProviders();

        // ע��Ӧ����������
        $this->registerCoreContainerAliases();
        //Ϊʲô���ŵ����棬��Ϊ�ŵ�����app��ᱻnew���Σ�����ŵ������һ��ִ��session�����ݿ��Ҳ���appʵ�����ͻ����getInstance������new һ�Σ�Ȼ��index.php����new��һ�Ρ�
        //require __DIR__ . '/lib/Session.php';
        require __DIR__.'/lib/Router.php';


    }


    function registerCoreContainerAliases(){

        $binds = [

          //  'WxBaseService'=>\WeiXin\token\WxBaseService::class,
            'config' => \App\Providers\Config::class,//�����ļ���
            'LoadConfiguration'=> \App\Providers\LoadConfiguration::class,
            'db' => \App\Models\MySql::class,
         //   'Facades'=>\App\Providers\RegisterFacades::class //������ ����app���ֺ����Ͳ���Ҫ������
            /*'db' => function(){
                 $config =  [
                     'collation' => 'gbk-chinese_ci',//�����ִ�Сд
                     'strict'=>false
                 ];
                $link =  new mysqli('172.100.100.91','root','000000','mykj');

                if (mysqli_connect_errno()) {
                    $link = null;
                    exit('���ݿ�����ʧ��:'.mysqli_connect_error());

                }

                //���������ݿ�䴫���ַ�ʱ���õ�Ĭ���ַ�����
                if (!$link->set_charset("gbk")) {
                    exit('Error loading character set gbk:'. $link->error);

                }

                return $link;
            }*/

        ];
        //ע�ᵽ����
        foreach ($binds as $key => $bind) {

               $this->singleton($key, $bind);//����ģʽ

              // $this->bind($key, $bind);
        }

    }
    public function run(){

        //dd($this->bindings);//�����ӡ��Ҫɾ�������ñհ���dbע��Ͳ���mysql������ע�ᣬ��ӡ�����Ǻܴ�ģ������Լ���ʽ����
        $this->bootstrapWith();

        //�м����·��ߣ��һ��
         \App\Middleware\Middle::handle();

    }

    //ͨ��bootstrap�������ط����ṩ�ߵ�������Ϣ
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
})��*/

    function registerBaseServiceProviders(){

        // �����¼�; ���Կ��Կ��м������Ĵ���
        // ����һ��lowһ��д��
        $event = new \App\Event\Event();

        // ͨ��ɨ��ָ��Ŀ¼�µ�����
        // Ȼ���ٸ�����Ӧ�������ռ䣬����ִ��
        // ע�ᵽ�¼���

        $files = scandir(BASEDIR.'/app/Listeners');

        // 2. ��ȡ�ļ���Ϣ
        foreach ($files as $key => $file) {
            if ($file === '.' || $file === '..') {
                continue;
            }

            $class = 'App\\Listeners\\'.\explode('.', $file)[0];
            // dd($class);
            if (\class_exists($class)) {
                $listener = new $class($this);
                $event->listener($listener->getName(), [$listener, 'handler']);
                //ע���¼���getName�Ǳ�ʶ�� handler�ǻص�����
            }
        }

        $this->instance('events', $event);//���ø��෽�� ����ģʽ���¼�ʵ��ע�ᵽ����
    }

}



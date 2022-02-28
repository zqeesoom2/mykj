<?php
class Container
{
    // 单例，laravel的application应用类继承了容器类，并再把自己通过$this代表当前application实例，再传给容器用$instance保存起来。
    protected  static $instance;

    protected $bindings = [];//存储对象

    /**
     * 共享容器 -》 对容器进行单例的创建和运用
     * @var object[]
     */
    protected $instances = [];

    /**
     * @param $abstract 标识
     *
     * @param $concrete 实例对象/或者对象地址/或者闭包
     *
     * $shared = false 代表 不单例，true代表单例
     * @param bool $shared
     */
    public function bind($abstract,$concrete = null ,$shared = false){
        $this->bindings[$abstract]['concrete'] = $concrete;
        $this->bindings[$abstract]['shared'] = $shared;
    }

    //单例模式
    public function singleton($abstract, $concrete = null, $shared = true)
    {
        $this->bind($abstract, $concrete, $shared);
    }

    public  function __construct($app){

           static::setInstance($app);
    }


    public function make($abstract,$parameters= []){

        if(!$this->has($abstract))
        {

            checkException("解析的对象不存在" . $abstract);
        }

        // 判断是否之前创建过实例，主要是为了性能，当在两处地方，使用同一个对象，不必实例多次，所以还要删除一次bind绑定的对像，并把该 对象放到共享instances变量中
        if (isset($this->instances[$abstract])) {

            return $this->instances[$abstract];
        }

        //这里存储的是还没有实例化的对象, 相当于对象源码文件地址,
        // 从容器中获取
        $object = $this->bindings[$abstract]['concrete'];

        if(!isset($object)){

          checkException("解析的对象不存在" . $abstract);
            //die('解析的对象不存在=>'.$abstract);
        }


        if($object instanceof  Closure)
        {
            //$object = $object(); //这种写法有个问题，如果返回不是DB资源，是数组之类的，下面可能会单例保存起来。
            //dd($object);
            //注意，在程序的最后一句加app('db')->close(); 如果每个代码地方都加上了，连接就断了，存在$instances就没有意义了，因为对象不同了

            return $object();
        }

        if(!is_object($object)) {

            $object = new $object(...$parameters);
        }

        // 采用单例 保存
        if ($this->has($abstract) && $this->bindings[$abstract]['shared']) {
            $this->instances[$abstract] = $object;
        }



        return $object ;


    }

    public function has($abstract)
    {
        return isset($this->bindings[$abstract]['concrete']) || isset($this->instances[$abstract]);
    }

    //单例主要是为了性能，当在两处地方，使用同一个对象，不必实例多次
    public static function setInstance(Container $container = null){
        return static::$instance = $container;
    }

    //助手函数用到
    public static function getInstance(){
        if(is_null(static::$instance)){
            static::$instance = new static;
        }
        return static::$instance;
    }

    /**
     * 设置指定对象为共享实例[可能这个实例并没有绑定在容器中，因此就额外的设置]
     * @param  string $abstract 标识
     * @param  object $instance 实例对象
     */
    public function instance($abstract, $instance)
    {
        // 1. 从容器中移除
        $this->removeBindings($abstract);
        $this->instances[$abstract] = $instance;
    }
    public function removeBindings($abstract)
    {
        if (!isset($this->bindings[$abstract])) {
            return;
        }
        unset($this->bindings[$abstract]);
    }


}


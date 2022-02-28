<?php
class Container
{
    // ������laravel��applicationӦ����̳��������࣬���ٰ��Լ�ͨ��$this����ǰapplicationʵ�����ٴ���������$instance����������
    protected  static $instance;

    protected $bindings = [];//�洢����

    /**
     * �������� -�� ���������е����Ĵ���������
     * @var object[]
     */
    protected $instances = [];

    /**
     * @param $abstract ��ʶ
     *
     * @param $concrete ʵ������/���߶����ַ/���߱հ�
     *
     * $shared = false ���� ��������true������
     * @param bool $shared
     */
    public function bind($abstract,$concrete = null ,$shared = false){
        $this->bindings[$abstract]['concrete'] = $concrete;
        $this->bindings[$abstract]['shared'] = $shared;
    }

    //����ģʽ
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

            checkException("�����Ķ��󲻴���" . $abstract);
        }

        // �ж��Ƿ�֮ǰ������ʵ������Ҫ��Ϊ�����ܣ����������ط���ʹ��ͬһ�����󣬲���ʵ����Σ����Ի�Ҫɾ��һ��bind�󶨵Ķ��񣬲��Ѹ� ����ŵ�����instances������
        if (isset($this->instances[$abstract])) {

            return $this->instances[$abstract];
        }

        //����洢���ǻ�û��ʵ�����Ķ���, �൱�ڶ���Դ���ļ���ַ,
        // �������л�ȡ
        $object = $this->bindings[$abstract]['concrete'];

        if(!isset($object)){

          checkException("�����Ķ��󲻴���" . $abstract);
            //die('�����Ķ��󲻴���=>'.$abstract);
        }


        if($object instanceof  Closure)
        {
            //$object = $object(); //����д���и����⣬������ز���DB��Դ��������֮��ģ�������ܻᵥ������������
            //dd($object);
            //ע�⣬�ڳ�������һ���app('db')->close(); ���ÿ������ط��������ˣ����ӾͶ��ˣ�����$instances��û�������ˣ���Ϊ����ͬ��

            return $object();
        }

        if(!is_object($object)) {

            $object = new $object(...$parameters);
        }

        // ���õ��� ����
        if ($this->has($abstract) && $this->bindings[$abstract]['shared']) {
            $this->instances[$abstract] = $object;
        }



        return $object ;


    }

    public function has($abstract)
    {
        return isset($this->bindings[$abstract]['concrete']) || isset($this->instances[$abstract]);
    }

    //������Ҫ��Ϊ�����ܣ����������ط���ʹ��ͬһ�����󣬲���ʵ�����
    public static function setInstance(Container $container = null){
        return static::$instance = $container;
    }

    //���ֺ����õ�
    public static function getInstance(){
        if(is_null(static::$instance)){
            static::$instance = new static;
        }
        return static::$instance;
    }

    /**
     * ����ָ������Ϊ����ʵ��[�������ʵ����û�а��������У���˾Ͷ��������]
     * @param  string $abstract ��ʶ
     * @param  object $instance ʵ������
     */
    public function instance($abstract, $instance)
    {
        // 1. ���������Ƴ�
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


<?php


namespace App\Event;

//事件处理 ,中间件有测试使用
class Event
{
    // protected $app;

    protected $events = [];

     /*public function __construct(Application $app = null)
     {
         $this->mysql = app('db');
     }*/

    /**
     * 事件注册监听
     * @param  string $event    事件标识
     * @param  Closure $callback 事件回调函数 数组格式存放类的实例和方法，可以([0=>实例，1=>方法])(...$parm) 代表执行实例的第一个方法
     */
    public function listener($listener, $callback)
    {
        $listener = \strtolower($listener);
        $this->events[$listener] = ['callback' => $callback];
    }
    /**
     * 事件的触发函数
     * @param  string $listener 事件标识
     * @param  array  $param 事件参数 格式数组类型
     */
    public function dispatcher($listener, $param = [])
    {
        $listener = \strtolower($listener);

        if (isset($this->events[$listener])) {
            //callback存的值是：类的实例和方法 被调用
            ($this->events[$listener]['callback'])(...$param);
            return true;
        }
    }

    public function getEvents($listener = null)
    {
        return empty($listener) ? $this->events : $this->events[$listener];
    }
}
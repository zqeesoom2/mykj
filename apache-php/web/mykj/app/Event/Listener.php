<?php


namespace App\Event;

//事件的契约
abstract class Listener
{
    protected $name = 'listener';

    protected $app ;

    //触发事件时，执行的回调函数
    public abstract function handler();

    /*public function __construct(Application $app )
    {
        $this->app = $app;
    }*/

    public function getName()
    {
        return $this->name;
    }
}
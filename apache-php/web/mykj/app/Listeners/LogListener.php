<?php


namespace App\Listeners;

use App\Event\Listener;

//日志事件
class LogListener extends Listener
{
    protected $name = 'systemct.log';//标识

    protected $app ;

    public function handler($log = null){
        // echo "this is log listener handler log : ".$log."<br>";

        echo "项目执行流程功能：".$log."<br>";
    }
}
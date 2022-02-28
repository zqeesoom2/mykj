<?php


namespace App\Event;

use Pheanstalk\Pheanstalk;//引用那个命名空间的类，Pheanstalk::create调用时依赖这个类

//php 默认一般是 60s，假如您没有在代码里面设置，采用默认的话（60s），60s 之内如果没有 job 产生，脚本就会报 socket 错误，我写的是 半 天超时，您可以根据业务去调整，记住一定要配置
//file_get_contents函数的超时控制（default_socket_timeout）
//ini_set('default_socket_timeout',43200); 可以用linux任务来消费
//ini_set('memory_limit','256M');
//队列操作
class Beanstalkd
{
    public $ph;
    public function __construct(){
        //连接beanstalkd

        $this->ph = Pheanstalk::create(app('config')->get('base.beanstalkd.host'));

    }
}
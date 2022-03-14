<?php


namespace App\Event\Supplement;

use App\Event\Beanstalkd;

//观察者的动作
class SupplementObserver extends Beanstalkd
{
    function __construct()
    {
        parent::__construct();
    }

    //将补充的问题，存入队列，实现给顾问们发送通知
    public function update($subject)
    {
        //向notifySupplement管道放入任务
        $channel = $this->ph->useTube('notifySupplement');

        foreach ($subject->toUsers as $toUser) {
            //$type 根据类型，查找类型表
            $channel->put( json_encode(['uid'=>$subject->uid,'toUserId'=>$toUser['id'],'msgid'=>$subject->msgId,'type'=>$subject->type]) );
        }



        // logs(['name'=>'存入队列','uId'=>$subject->uid,'toUsers'=>$subject->toUsers,'msgId'=>$subject->msgId]);
        // $subject-> setCount(10);

    }
}
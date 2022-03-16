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
        $result = null;
        foreach ($subject->toUsers as $toUser) {
            //$type 根据类型，查找类型表
             $result = $channel->put( json_encode(['uid'=>$subject->uid,'toUserId'=>$toUser['id'],'msgid'=>$subject->msgId,'type'=>$subject->type]) );
        }

        if($result==null);
         $result = $channel->put( json_encode(['uid'=>0,'toUserId'=>0,'msgid'=>0,'type'=>0]) );

         logs($result);

        // logs(['name'=>'存入队列','uId'=>$subject->uid,'toUsers'=>$subject->toUsers,'msgId'=>$subject->msgId]);
        // $subject-> setCount(10);

    }
}
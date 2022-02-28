<?php


namespace App\Event\Questing;

//追问观察者,的动作
use App\Event\Beanstalkd;

class QuestingObserver extends Beanstalkd
{
    function __construct()
    {
        parent::__construct();
    }

    //将追问的问题，存入队列，实现给某一顾问发送通知
    public function update($subject)
    {
        $channel = $this->ph->useTube('notifyQuesting');

        $channel->put( json_encode(['uid'=>$subject->uid,'toUserId'=>$subject->toUserId,'msgid'=>$subject->msgId]) );

        //logs(['name'=>'存入队列','lawyerId'=>$subject->uid,'toUserId'=>$subject->toUserId,'msgId'=>$subject->msgId]);
        // $subject-> setCount(10);

    }
}
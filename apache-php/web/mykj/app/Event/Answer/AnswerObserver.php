<?php

namespace App\Event\Answer;

//观察，回答问题动作，实现给用户发送通知
use App\Event\Beanstalkd;

class AnswerObserver extends Beanstalkd
{
    function __construct()
    {
        parent::__construct();
    }

    //将回复的通知，存入队列
    public function update($subject)
    {

        $channel = $this->ph->useTube('notifyAnswer');

        $channel->put( json_encode(['uid'=>$subject->uid,'toUserId'=>$subject->toUserId,'msgid'=>$subject->msgId]) );

        //logs(['name'=>'存入队列','lawyerId'=>$subject->uid,'toUserId'=>$subject->toUserId,'msgId'=>$subject->msgId]);
       // $subject-> setCount(10);

    }


}
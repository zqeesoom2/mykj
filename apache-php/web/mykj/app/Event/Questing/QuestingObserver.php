<?php


namespace App\Event\Questing;

//׷�ʹ۲���,�Ķ���
use App\Event\Beanstalkd;

class QuestingObserver extends Beanstalkd
{
    function __construct()
    {
        parent::__construct();
    }

    //��׷�ʵ����⣬������У�ʵ�ָ�ĳһ���ʷ���֪ͨ
    public function update($subject)
    {
        $channel = $this->ph->useTube('notifyQuesting');

        $channel->put( json_encode(['uid'=>$subject->uid,'toUserId'=>$subject->toUserId,'msgid'=>$subject->msgId]) );

        //logs(['name'=>'�������','lawyerId'=>$subject->uid,'toUserId'=>$subject->toUserId,'msgId'=>$subject->msgId]);
        // $subject-> setCount(10);

    }
}
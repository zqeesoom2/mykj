<?php

namespace App\Event\Answer;

//�۲죬�ش����⶯����ʵ�ָ��û�����֪ͨ
use App\Event\Beanstalkd;

class AnswerObserver extends Beanstalkd
{
    function __construct()
    {
        parent::__construct();
    }

    //���ظ���֪ͨ���������
    public function update($subject)
    {

        $channel = $this->ph->useTube('notifyAnswer');

        $channel->put( json_encode(['uid'=>$subject->uid,'toUserId'=>$subject->toUserId,'msgid'=>$subject->msgId]) );

        //logs(['name'=>'�������','lawyerId'=>$subject->uid,'toUserId'=>$subject->toUserId,'msgId'=>$subject->msgId]);
       // $subject-> setCount(10);

    }


}
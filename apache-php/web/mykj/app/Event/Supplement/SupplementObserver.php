<?php


namespace App\Event\Supplement;

use App\Event\Beanstalkd;

//�۲��ߵĶ���
class SupplementObserver extends Beanstalkd
{
    function __construct()
    {
        parent::__construct();
    }

    //����������⣬������У�ʵ�ָ������Ƿ���֪ͨ
    public function update($subject)
    {
        //��notifySupplement�ܵ���������
        $channel = $this->ph->useTube('notifySupplement');

        foreach ($subject->toUsers as $toUser) {
            //$type �������ͣ��������ͱ�
            $channel->put( json_encode(['uid'=>$subject->uid,'toUserId'=>$toUser['id'],'msgid'=>$subject->msgId,'type'=>$subject->type]) );
        }



        // logs(['name'=>'�������','uId'=>$subject->uid,'toUsers'=>$subject->toUsers,'msgId'=>$subject->msgId]);
        // $subject-> setCount(10);

    }
}
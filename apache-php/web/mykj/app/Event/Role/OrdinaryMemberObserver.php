<?php


namespace App\Event\Role;

//��ͨ��Ա
class OrdinaryMemberObserver implements  SplObserver //�۲��߶���ʵ�ֽӿ�
{
    public function getRole($subject)
    {
        $subject-> setIntegral(10);
    }

}
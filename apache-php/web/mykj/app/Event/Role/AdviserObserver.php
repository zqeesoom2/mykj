<?php


namespace App\Event\Role;

//��ʦ����
class AdviserObserver implements  SplObserver //�۲��߶���ʵ�ֽӿ�
{
    public function getRole($subject)
    {
        $subject-> setIntegral(10);
    }

}
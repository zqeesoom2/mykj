<?php


namespace App\Event;

//�۲���Ϊ��������Ա
class SuperAdminObserver implements  SplObserver //�۲��߶���ʵ�ֽӿ�
{
    public function getRole($subject)
    {
        $subject-> setIntegral(10);
    }

}


<?php


namespace App\Event\Role;

//��ͨ����Ա
class GeneralAdminObserver implements  SplObserver
{
    public function getRole($subject)
    {
        $subject-> setIntegral(10);
    }
}
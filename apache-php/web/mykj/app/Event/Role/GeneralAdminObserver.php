<?php


namespace App\Event\Role;

//普通管理员
class GeneralAdminObserver implements  SplObserver
{
    public function getRole($subject)
    {
        $subject-> setIntegral(10);
    }
}
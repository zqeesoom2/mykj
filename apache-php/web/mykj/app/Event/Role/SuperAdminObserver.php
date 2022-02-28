<?php


namespace App\Event;

//观察者为超级管理员
class SuperAdminObserver implements  SplObserver //观察者对象实现接口
{
    public function getRole($subject)
    {
        $subject-> setIntegral(10);
    }

}


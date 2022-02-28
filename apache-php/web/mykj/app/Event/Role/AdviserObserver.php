<?php


namespace App\Event\Role;

//律师顾问
class AdviserObserver implements  SplObserver //观察者对象实现接口
{
    public function getRole($subject)
    {
        $subject-> setIntegral(10);
    }

}
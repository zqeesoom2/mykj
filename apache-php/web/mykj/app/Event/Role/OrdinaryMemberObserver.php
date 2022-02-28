<?php


namespace App\Event\Role;

//普通会员
class OrdinaryMemberObserver implements  SplObserver //观察者对象实现接口
{
    public function getRole($subject)
    {
        $subject-> setIntegral(10);
    }

}
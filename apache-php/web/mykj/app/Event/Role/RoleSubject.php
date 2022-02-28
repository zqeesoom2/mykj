<?php


namespace App\Event;

//角色被观察
class RoleSubject implements SplSubject //主题类实现被观察者接口
{
    private $observers;
    public function attach(SplObserver $observer)
    {
        if (!in_array($observer, $this->observers)) {
            $this->observers[] = $observer;
        }
    }
    public function detach(SplObserver $observer)
    {
        if (false != ($index = array_search($observer, $this->observers))) {
            unset($this->observers[$index]);
        }
    }
    //获取角色的时候，下发通知给观察者
    public function getRole()
    {

        $this->notify();
    }
    private function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->getRole($this);
        }
    }
    public function setCount($count)
    {
        echo "数据量加" . $count;
    }
    public function setIntegral($integral)
    {
        echo "积分量加" . $integral;
    }
}
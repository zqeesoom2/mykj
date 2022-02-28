<?php


namespace App\Event;

//��ɫ���۲�
class RoleSubject implements SplSubject //������ʵ�ֱ��۲��߽ӿ�
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
    //��ȡ��ɫ��ʱ���·�֪ͨ���۲���
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
        echo "��������" . $count;
    }
    public function setIntegral($integral)
    {
        echo "��������" . $integral;
    }
}
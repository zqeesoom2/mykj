<?php


namespace App\Event\Supplement;

//补充问题被观察
class SupplementSubject
{
    private $observers;
    public $supplementModel,$uid,$toUsers,$msgId,$type;
    public function __construct($supplementModel){
        $this->supplementModel = $supplementModel;
        $this->observers=array();
    }
    public function attach($observer)
    {
        if (!in_array($observer, $this->observers)) {
            $this->observers[] = $observer;
        }
    }
    public function detach($observer)
    {
        if (false != ($index = array_search($observer, $this->observers))) {
            unset($this->observers[$index]);
        }
    }

    /**用户补充问题或咨询问题的时候，下发通知给观察者
     * @param $uid 那个用户的补充
     * @param $msgId 消息ID  补充表的ID or quiz表的ID
     * @param $type 类型：补充还是提问
     */
    public function SupplementNotify($uid,$msgId,$type='supplement')
    {
        $this->uid = $uid;

        $UserModel =  new \App\Models\MemberModel();

        $arrToUsers = $UserModel->getList('','',' AND `master`=? ',3);

        $this->toUsers = $arrToUsers;

        $this->msgId = $msgId;
        $this->type = $type;
        $this->notify();
    }
    private function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }
    public function setCount($count)
    {
        echo "数据量加" . $count;
    }

}
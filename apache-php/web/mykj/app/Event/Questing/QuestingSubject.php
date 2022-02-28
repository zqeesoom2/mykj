<?php


namespace App\Event\Questing;

//追问，问题被观察
class QuestingSubject
{
    private $observers;
    public $questingModel,$uid,$toUserId,$msgId;
    public function __construct($questingModel){
        $this->questingModel = $questingModel;
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

    /**用户追问，问题的时候，下发通知给观察者
     * @param $uid 那个用户的追问
     * @param $toUserId 向谁发送通知
     * @param $msgId 消息ID  追问表的ID
     */
    public function QuestingNotify($uid,$toUserId,$msgId)
    {
        $this->uid = $uid;
        $this->toUserId = $toUserId;
        $this->msgId = $msgId;
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
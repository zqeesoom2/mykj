<?php


namespace App\Event\Answer;

//回答问题被观察
class AnswerSubject  //主题类实现被观察者接口
{
    private $observers;
    public $answerModel,$uid,$toUserId,$msgId;
    public function __construct($answerModel){
        $this->answerModel = $answerModel;
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

    /**顾问回答问题的时候，下发通知给观察者
     * @param $uid 那个律师问答的
     * @param $toUserId 向谁回答
     * @param $msgId 消息ID
     */
    public function AnswerNotify($uid,$toUserId,$msgId)
    {
        $this->uid = $uid;//回复的用户
        $this->toUserId = $toUserId; //向用户发消息
        $this->msgId = $msgId; //回答表的ID
         $this->notify();
    }
    private function notify()
    {
        foreach ($this->observers as $observer) {
              $observer->update($this);//回复的通知
        }
    }
    public function setCount($count)
    {
        echo "数据量加" . $count;
    }

}
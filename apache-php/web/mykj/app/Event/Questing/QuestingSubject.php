<?php


namespace App\Event\Questing;

//׷�ʣ����ⱻ�۲�
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

    /**�û�׷�ʣ������ʱ���·�֪ͨ���۲���
     * @param $uid �Ǹ��û���׷��
     * @param $toUserId ��˭����֪ͨ
     * @param $msgId ��ϢID  ׷�ʱ��ID
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
        echo "��������" . $count;
    }
}
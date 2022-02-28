<?php


namespace App\Event\Answer;

//�ش����ⱻ�۲�
class AnswerSubject  //������ʵ�ֱ��۲��߽ӿ�
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

    /**���ʻش������ʱ���·�֪ͨ���۲���
     * @param $uid �Ǹ���ʦ�ʴ��
     * @param $toUserId ��˭�ش�
     * @param $msgId ��ϢID
     */
    public function AnswerNotify($uid,$toUserId,$msgId)
    {
        $this->uid = $uid;//�ظ����û�
        $this->toUserId = $toUserId; //���û�����Ϣ
        $this->msgId = $msgId; //�ش���ID
         $this->notify();
    }
    private function notify()
    {
        foreach ($this->observers as $observer) {
              $observer->update($this);//�ظ���֪ͨ
        }
    }
    public function setCount($count)
    {
        echo "��������" . $count;
    }

}
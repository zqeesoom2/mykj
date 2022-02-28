<?php


namespace App\Event\Supplement;

//�������ⱻ�۲�
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

    /**�û������������ѯ�����ʱ���·�֪ͨ���۲���
     * @param $uid �Ǹ��û��Ĳ���
     * @param $msgId ��ϢID  ������ID or quiz���ID
     * @param $type ���ͣ����仹������
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
        echo "��������" . $count;
    }

}
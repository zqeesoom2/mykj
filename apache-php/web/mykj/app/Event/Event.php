<?php


namespace App\Event;

//�¼����� ,�м���в���ʹ��
class Event
{
    // protected $app;

    protected $events = [];

     /*public function __construct(Application $app = null)
     {
         $this->mysql = app('db');
     }*/

    /**
     * �¼�ע�����
     * @param  string $event    �¼���ʶ
     * @param  Closure $callback �¼��ص����� �����ʽ������ʵ���ͷ���������([0=>ʵ����1=>����])(...$parm) ����ִ��ʵ���ĵ�һ������
     */
    public function listener($listener, $callback)
    {
        $listener = \strtolower($listener);
        $this->events[$listener] = ['callback' => $callback];
    }
    /**
     * �¼��Ĵ�������
     * @param  string $listener �¼���ʶ
     * @param  array  $param �¼����� ��ʽ��������
     */
    public function dispatcher($listener, $param = [])
    {
        $listener = \strtolower($listener);

        if (isset($this->events[$listener])) {
            //callback���ֵ�ǣ����ʵ���ͷ��� ������
            ($this->events[$listener]['callback'])(...$param);
            return true;
        }
    }

    public function getEvents($listener = null)
    {
        return empty($listener) ? $this->events : $this->events[$listener];
    }
}
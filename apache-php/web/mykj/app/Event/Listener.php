<?php


namespace App\Event;

//�¼�����Լ
abstract class Listener
{
    protected $name = 'listener';

    protected $app ;

    //�����¼�ʱ��ִ�еĻص�����
    public abstract function handler();

    /*public function __construct(Application $app )
    {
        $this->app = $app;
    }*/

    public function getName()
    {
        return $this->name;
    }
}
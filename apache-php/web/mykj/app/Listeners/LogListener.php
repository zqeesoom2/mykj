<?php


namespace App\Listeners;

use App\Event\Listener;

//��־�¼�
class LogListener extends Listener
{
    protected $name = 'systemct.log';//��ʶ

    protected $app ;

    public function handler($log = null){
        // echo "this is log listener handler log : ".$log."<br>";

        echo "��Ŀִ�����̹��ܣ�".$log."<br>";
    }
}
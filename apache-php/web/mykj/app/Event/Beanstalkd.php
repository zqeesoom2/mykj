<?php


namespace App\Event;

use Pheanstalk\Pheanstalk;//�����Ǹ������ռ���࣬Pheanstalk::create����ʱ���������

//php Ĭ��һ���� 60s��������û���ڴ����������ã�����Ĭ�ϵĻ���60s����60s ֮�����û�� job �������ű��ͻᱨ socket ������д���� �� �쳬ʱ�������Ը���ҵ��ȥ��������סһ��Ҫ����
//file_get_contents�����ĳ�ʱ���ƣ�default_socket_timeout��
//ini_set('default_socket_timeout',43200); ������linux����������
//ini_set('memory_limit','256M');
//���в���
class Beanstalkd
{
    public $ph;
    public function __construct(){
        //����beanstalkd

        $this->ph = Pheanstalk::create(app('config')->get('base.beanstalkd.host'));

    }
}
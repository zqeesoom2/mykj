<?php


namespace App\Providers;


class LoadConfiguration
{
    public function bootstrap($app)
    {
        //config��new applicationʱ���ѽ���ע����ˣ�����ʵ��ȡ����
        $config = $app->make('config')->phpParser(BASEDIR.'/Config');//�Ӹ�Ŀ ¼�е�configĿ¼�µ������е�����
        //$app->instance('config', $config);
    }
}
<?php


namespace App\Providers;

//��������ķ����ṩ��
class RegisterFacades
{

    public function bootstrap(\App $app)//APPռ��λ�ô���Լ������
    {
        \App\Facades\Facade::setFacadeApplication($app);//��appע�����������

    }

}
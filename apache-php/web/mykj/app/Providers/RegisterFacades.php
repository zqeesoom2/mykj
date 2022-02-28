<?php


namespace App\Providers;

//驱动门面的服务提供者
class RegisterFacades
{

    public function bootstrap(\App $app)//APP占的位置代表约束类型
    {
        \App\Facades\Facade::setFacadeApplication($app);//把app注册进入门面类

    }

}
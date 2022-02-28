<?php


namespace App\Providers;


class LoadConfiguration
{
    public function bootstrap($app)
    {
        //config在new application时就已进被注册过了，这里实例取出来
        $config = $app->make('config')->phpParser(BASEDIR.'/Config');//从根目 录中的config目录下导入所有的配置
        //$app->instance('config', $config);
    }
}
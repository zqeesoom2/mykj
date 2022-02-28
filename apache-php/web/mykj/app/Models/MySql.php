<?php
namespace App\Models;

class MySql
{
    protected static $link;

    function __construct()
    {


        if(is_null(MySql::$link)){

            $arr=  app('config')->get('base.mysql');

            //注意调用PHP组件类，命名空间要从根访问
            $link =  new \mysqli($arr['ip'],$arr['username'],$arr['password'],$arr['dbname']);

            if (mysqli_connect_errno()) {
                $link = null;
                exit('数据库连接失败:'.mysqli_connect_error());

            }

            //设置在数据库间传输字符时所用的默认字符编码
            if (!$link->set_charset("gbk")) {
                exit('Error loading character set gbk:'. $link->error);

            }

            MySql::$link =  $link;
        }


    }

    public static function GetMysql()
    {
        return MySql::$link;
    }

    public function __call($method, $arguments)
    {
        return  MySql::$link->$method(...$arguments);
    }

    public static function __callStatic($method, $params)
    {

        return  MySql::$link->$method(...$params);

    }


}
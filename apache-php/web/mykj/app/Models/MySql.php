<?php
namespace App\Models;

class MySql
{
    protected static $link;

    function __construct()
    {


        if(is_null(MySql::$link)){

            $arr=  app('config')->get('base.mysql');

            //ע�����PHP����࣬�����ռ�Ҫ�Ӹ�����
            $link =  new \mysqli($arr['ip'],$arr['username'],$arr['password'],$arr['dbname']);

            if (mysqli_connect_errno()) {
                $link = null;
                exit('���ݿ�����ʧ��:'.mysqli_connect_error());

            }

            //���������ݿ�䴫���ַ�ʱ���õ�Ĭ���ַ�����
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
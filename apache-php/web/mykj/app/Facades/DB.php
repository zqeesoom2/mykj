<?php


namespace App\Facades;

//����ͬ�������ռ���Բ��� use ���� ,�м���в���ʹ��
class DB extends Facade
{

    protected static function getFacadeAccessor()
    {
        return "db";
        //return \LaravelStar\Databases\MySql::class;
        // return new \LaravelStar\Databases\MySql;

        //require BASEDIR.'/bootstrap/lib/MySql::class';
    }
}
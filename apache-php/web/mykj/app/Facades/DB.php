<?php


namespace App\Facades;

//在相同的名命空间可以不用 use 引用 ,中间件有测试使用
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
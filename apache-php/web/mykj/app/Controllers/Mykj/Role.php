<?php


namespace App\Controllers\Mykj;

//角色
class Role extends ColumnTree
{

    public function __construct(){
        parent::__construct('role');//操作数据库role表
    }

}
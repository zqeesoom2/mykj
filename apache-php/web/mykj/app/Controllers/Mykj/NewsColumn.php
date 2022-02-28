<?php


namespace App\Controllers\Mykj;

//新闻栏目
class NewsColumn extends ColumnTree
{

    public function __construct(){
        parent::__construct('newscolumn');//操作数据库role表
    }

}

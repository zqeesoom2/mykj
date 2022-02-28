<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2021/6/12 0012
 * Time: 下午 7:49
 */

namespace App\Models;

//评价表
class ValuationModel3 extends Model
{
    public $mysql;
    public $table = PREFIX.'valuation';

    function __construct(){
        $this->mysql = app('db');
    }

    function Add($title,$source,$author,$column,$newstime,$attr,$cover,$content){

        $sql = 'INSERT INTO pre_news (title,source,author,`column`,newstime,attr,cover,content) VALUES (?,?,?,?,?,?,?,?) ';
        $smt = $this->mysql->prepare($sql);
        if(!$smt){
            dd($smt);
            die('新闻编译失败');
        }

        $smt->bind_param('sssiisss',$title,$source,$author,$column,$newstime,$attr,$cover,$content);

        $result = $smt->execute();

        if(!$result){
            print_r($smt->error_list);
            die('新增新闻失败');
        }

        $id = $smt->insert_id;


        $smt->close();
        return $id;

    }



    //后台获取新闻列表
    function getList($whereStatus ,$whereTitle,$whereColumn,$sortOrder,$limit){

        $title = $column = '';

        if(!empty($whereTitle)){
            $title = ' AND title LIKE ? ';
        }

        if(!empty($whereColumn)){
            $column = ' AND `column`=? ';
        }

       $sql = 'SELECT id,title,source,author,`column`,newstime,`status` FROM pre_news WHERE '.$whereStatus.$column.'AND softDelete=0 '.$title.' ORDER BY id '.$sortOrder.' '.$limit ;

        $stm = $this->mysql->prepare($sql);
        if(!$stm){

            echo $sql;
            die('编译查询新闻失败');
        }

        if(!empty($whereTitle)){
            $whereTitle .= '%';
             $stm->bind_param('s',$whereTitle);
        }

        if(!empty($whereColumn)){
            $stm->bind_param('i',$whereColumn);
        }

         $stm->bind_result($id,$title,$source,$author,$column,$newstime,$status);


         $stm->execute();


        $arr = $temp =[];

        while($stm->fetch()){

            $temp['id'] = $id;
            $temp['title'] = $title;
            $temp['source'] = $source;
            $temp['author'] = $author;
            $temp['newstime'] = date('Y-m-d',$newstime);


            $temp['column'] = $this->TransformColumn($column);

          //  dd(eval("return \$str;"));
            $temp['status'] = $this->TransformStatus($status);

            $arr[] = $temp;

        }

        $stm->free_result();

        $stm->close();
        return $arr;

    }

    function  TransformStatus($status){
        if($status == 1){
            $status = '通过';
        }elseif($status == 0){
            $status  = '不通过';
        }elseif($status == 2){
            $status  = '待审核';
        }
        return  $status ;
    }

    function TransformColumn($column){
        include BASEDIR.'/cmd/Mykj/News/column.php';
        foreach ($nav as $val){
            if($val['id']==$column){
                return $val['text'];
            }
        }
    }
    function TransformAttr($attr){
        if(strpos($attr,',')){

            return explode($attr,',');

        }
        return $attr;
    }

    //根据ID获取一条信息。
    function getById($id){
        $sql = 'SELECT id,uid,byuid,star,valuation,newstime,win,`like` FROM pre_valuation WHERE quizId = ?';
        $smt = $this->mysql->prepare($sql);
        if(!$smt){
            die('编译查询ID出错');
        }
        $smt->bind_param('i',$id);

        $smt->bind_result($id,$uid,$byuid,$star,$valuation,$newstime,$win,$like);

        $smt->execute();

        $temp =[];

        if($smt->fetch()){

            $temp['id'] = $id;
            $temp['uid'] = $uid;
            $temp['byuid'] = $byuid;
            $temp['star'] = $star;
            $temp['valuation'] = $valuation;
            $temp['newstime'] = $newstime;
            $temp['win'] = $win;
            $temp['like'] = $like;
        }

        $smt->free_result();
        $smt->close();
        return $temp;
    }

}
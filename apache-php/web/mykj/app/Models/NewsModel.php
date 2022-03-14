<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2021/6/12 0012
 * Time: 下午 7:49
 */

namespace App\Models;

//新闻表
class NewsModel extends Model
{
    public $mysql;
    public $table = PREFIX.'news';

    function __construct(){
        $this->mysql = app('db');

    }

    function Add($title,$source,$author,$column,$newstime,$attr,$cover,$url){

        $sql = 'INSERT INTO pre_news (title,source,author,`column`,newstime,attr,cover,url) VALUES (?,?,?,?,?,?,?,?)';
        $smt = $this->mysql->prepare($sql);
        if(!$smt){
            dd($this->mysql->error);
            die('新闻编译失败');
        }

        $smt->bind_param('sssiisss',$title,$source,$author,$column,$newstime,$attr,$cover,$url);

        $result = $smt->execute();

        if(!$result){
            print_r($smt->error_list);
            die('新增新闻失败');
        }

        $id = $smt->insert_id;

        $smt->close();
        return (int)$id;

    }

    function AddContent($nid,$content){

        $sql = 'INSERT INTO pre_contents (nid,content) VALUES (?,?) ';
        $smt = $this->mysql->prepare($sql);
        if(!$smt){
            dd($this->mysql->error);
            die('新闻编译失败');
        }

        $smt->bind_param('is',$nid,$content);

        $result = $smt->execute();

        if(!$result){
            print_r($smt->error_list);
            die('新增新闻失败');
        }

        $id = $smt->insert_id;
        if($id>0){
            $this->mysql->commit();  //提交事务。
        }else{
            $this->mysql->rollback(); //回滚
        }

        //恢复默认的自动提交
        $this->mysql->autocommit(1);

        $smt->close();
        return $id;

    }



    //后台获取新闻列表
    function getList($whereStatus ,$whereTitle,$whereColumn,$sortOrder,$limit){

        //先获取所有的栏目,用来转换新闻栏目类型
        $NewsColumn = new \App\Models\TreeModel('newscolumn');
        $arrColumn = $NewsColumn->GetNodeList();

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


            $temp['column'] = $this->TransformColumn($column,$arrColumn);

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

    //把栏目ID与文本相对应起来
    function TransformColumn($column,$arrColumn){

        foreach ($arrColumn as $val){
            if($val['id']==$column){
                return $val['text'];
            }

        }
        //原来栏目是用文本记录，现在是用数据库
         /* include BASEDIR.'/cmd/Mykj/News/column.php';
        foreach ($nav as $val){
            if($val['id']==$column){
                return $val['text'];
            }
            if (isset($val['children'])){
                foreach ($val['children'] as $item){
                    if($item['id']==$column){
                        return $item['text'];
                    }
                }
            }
        }*/
    }
    function TransformAttr($attr){
        if(strpos($attr,',')){

            return explode($attr,',');

        }
        return $attr;
    }

    //根据ID获取一条信息。
    function getById($id){
        $sql = 'SELECT id,title,source,author,`column`,newstime,status,cover,attr,url FROM pre_news WHERE id = ?';
        $smt = $this->mysql->prepare($sql);
        if(!$smt){
            echo $sql;
            dd($this->mysql->error);
            die('编译查询ID出错');
        }
        $smt->bind_param('i',$id);

        $smt->bind_result($id,$title,$source,$author,$column,$newstime,$status,$cover,$attr,$url);

        $smt->execute();

        $temp =[];

        if($smt->fetch()){

            $temp['id'] = $id;

            $temp['title'] = $title;

            $temp['source'] = $source;

            $temp['author'] = $author;

            $temp['url'] = $url;

            $temp['newstime'] = date('Y-m-d',$newstime);

            $temp['cover'] = $cover;

            $temp['attr'] = $attr;

            $temp['column'] = $column;

            $temp['status'] = $status;

        }

        $smt->free_result();
        $smt->close();

        //获取新闻内容
        $content = $this->getContentById($temp['id']);
        if(isset($content['content'])){
            $temp['content'] = $content['content'] ;
        }else{
            $temp['content'] = '' ;
        }

        return $temp;
    }

    //根据ID获取一条信息。
    function getContentById($id){
        $sql = 'SELECT id,content FROM pre_contents WHERE nid = ?';
        $smt = $this->mysql->prepare($sql);
        if(!$smt){
            die('编译查询ID出错');
        }
        $smt->bind_param('i',$id);

        $smt->bind_result($id,$content);

        $smt->execute();

        $temp =[];

        if($smt->fetch()){

            $temp['id'] = $id;
            $temp['content'] = $content;

        }

        $smt->free_result();
        $smt->close();
        return $temp;
    }

}
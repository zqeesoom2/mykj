<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2021/6/12 0012
 * Time: 下午 7:31
 */

namespace App\Controllers\Mykj;
use App\Controllers\Controller;
use App\Models\NewsModel;
//新闻表
class News extends Controller
{
    public $News;
    function __construct(){
        parent::__construct();
        $this->News = new NewsModel();
    }

    function AddNews(){

        $msg = ['error'=>1];

        $newstime = strtotime($this->arrPost['newstime']);

        //开启事物，禁止自动提交
        $this->News->mysql->autocommit(0);

        $id = $this->News->Add($this->arrPost['title'],$this->arrPost['source'],$this->arrPost['author'],$this->arrPost['column'],$newstime,$this->arrPost['attr'],$this->arrPost['cover'],$this->arrPost['url']);

       if($id>0){

           $id = $this->News->AddContent($id,$this->arrPost['content']);
           if($id>0){
               $msg = ['error'=>0];
           }else{
               $msg = ['error'=>1];
           }

       }
        return json_encode($msg);

    }

    //获取分页的新闻,默认获取20条
    function List(){

      /*  $power = 1;//0会员，1超级管理员, 2普通管理员
        if($power==1){
            $whereStatus = '1';
        }elseif ($power==2){

        }*/
      //栏目类型

        $whereColumn = !empty($_POST['column'])?$_POST['column']: '';


        $sortOrder = !empty($_POST['sortOrder'])?$_POST['sortOrder']:'DESC';

        //标题
        $whereTitle = !empty($_POST['key'])? iconv('utf-8','gbk',$_POST['key']) : '';

        $column = $title = '';
        if(!empty($whereTitle)){
            $title = ' AND title LIKE ? ';
        }

        if(!empty($whereColumn)){
            $column = ' AND `column`=? ';
        }

        $status = isset($_POST['status'])?$_POST['status']: '';

        if($status == 1){//status = 1 通过
            $whereStatus = 'status = 1 ';
        }elseif($status == '0'){// 1 不通过

            $whereStatus = 'status = 0 ';
        }elseif($status == 2){//待审核
            $whereStatus = 'status = 2 ';
        }else{
            $whereStatus = '1=1 ' ;
        }


        //当前页数
        $page=!empty($_POST["pageIndex"]) ? $_POST["pageIndex"] : 1;

        $pageSize = !empty($_POST['pageSize'])?$_POST['pageSize']:10;

        //总计录数
        $total = $this->News->getCount($whereStatus,$whereColumn,$whereTitle,$title,$column);

        //总共多少页
        //$pageNum=ceil($total/$pageSize);

        $step = ($page-1)*$pageSize;

        $limit = 'Limit '.$step.','.$pageSize;

        $result = $this->News->getList($whereStatus,$whereTitle,$whereColumn,$sortOrder,$limit);

        $arr = $this->ArrToUtf8($result);

        return json_encode(['total'=>$total,'data'=>$arr]);

    }

    function Edit(){

        if(!isset($_GET['id'])){
         return 'not fount news ';
        }

        if( isset($_POST['submit']) && $_POST['submit'] == 'POST'){

            //开启事物，禁止自动提交
            $this->News->mysql->autocommit(0);

            //$title,$source,$author,$column,$newstime,$status,$centent,$cover,$attr,$id
            $sql = 'UPDATE pre_news SET title = ?,source=?,author=?,`column`=?,newstime=?,status=?,cover=?,attr=? ,url=? WHERE id = ?';
            $types = 'sssiiisssi';
            $newstime = strtotime($this->arrPost['newstime']);

            $id = (int)$_GET['id'];

            $result = $this->News->SqlPrepareAndExecute($sql,$types,$this->arrPost['title'],$this->arrPost['source'],$this->arrPost['author'],(int)$this->arrPost['column'],$newstime,(int)$this->arrPost['status'],$this->arrPost['cover'],$this->arrPost['attr'],$this->arrPost['url'],$id);

            if(!$result['error']){
                $sql = 'UPDATE pre_contents SET content=? WHERE nid = ?';
                $result = $this->News->SqlPrepareAndExecute($sql,'si',$this->arrPost['content'],$id);

                if($result['error']){
                    $this->News->mysql->rollback();
                }else{
                    $this->News->mysql->commit();
                    $this->News->mysql->autocommit(1);
                }
            }


            return $result['error'];
        }else{
            $news = $this->News->getById($_GET['id']);
            include BASEDIR.'/cmd/Mykj/News/edit.html';
        }

    }

    function Delete(){
        if(!isset($_GET['id'])){
            return 'not fount news ';
        }

        return $this->News->delete($_GET['id']);
    }

    //一键通过
    function OneClickThrough(){
        $id = $_GET['id'];
        $arr = explode(',',$id);
        foreach ($arr as $v){
           if(!is_numeric($v)){
               return 1;
           }
        }
        if(isset($id)){
            $sql = 'UPDATE pre_news SET `status` = 1 WHERE id IN('.$id.')';
            return $this->News->queryNOResult($sql);
        }
    }
}
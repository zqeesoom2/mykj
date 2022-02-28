<?php


namespace App\Controllers\Mykj;
use App\Controllers\Controller;
use App\Models\TreeModel;
//功能栏目
class ColumnTree extends Controller
{

    //操作栏目表的对象
    public $objectTree;

     function __construct($table = 'column')
    {
        parent::__construct();
        $this->objectTree =  new TreeModel($table);
    }

    //保存\修改ajax提交过来的节点数据
    function Save(){
        //基类转换了 $_POST['param'] 转换的变量为：$this->arrPost;
       // $arrPost = $this->PostJosnToArr($_POST['param']);
        $arrPost =  $this->arrPost;


        /* $arrPost元数据  dd($arrPost);
 array(2) {
 [0]=>
 array(8) {
   ["_pid"]=>
   string(2) "-1"
   ["_id"]=>
   string(1) "2"
   ["_uid"]=>
   string(1) "2"
   ["_level"]=>
   string(1) "0"
   ["_state"]=>
   string(5) "added"
   ["expanded"]=>
   string(1) "1"
   ["text"]=>
   string(9) "顶级栏目2"
   ["children"]=>
   array(1) {
     [0]=>
     array(7) {
       ["_pid"]=>
       string(1) "2"
       ["_id"]=>
       string(1) "3"
       ["_uid"]=>
       string(1) "3"
       ["_level"]=>
       string(1) "1"
       ["_state"]=>
       string(5) "added"
       ["text"]=>
       string(7) "子栏目1"
       ["children"]=>
       array(1) {
         [0]=>
         array(6) {
           ["_pid"]=>
           string(1) "3"
           ["_id"]=>
           string(1) "4"
           ["_uid"]=>
           string(1) "4"
           ["_level"]=>
           string(1) "2"
           ["_state"]=>
           string(5) "added"
           ["text"]=>
           string(9) "三级栏目3"
         }
       }
     }
   }
 }
 [1]=>
 array(6) {
   ["_pid"]=>
   string(2) "-1"
   ["_id"]=>
   string(1) "1"
   ["_uid"]=>
   string(1) "1"
   ["_level"]=>
   string(1) "0"
   ["_state"]=>
   string(5) "added"
   ["text"]=>
   string(9) "顶级栏目1"
 }
}

       */
         if(is_array($arrPost) && count($arrPost)){
            $arr = $this->Handle($arrPost);

            return json_encode($arr);

         }

    }

    //删除tree节点
    function RemoveSave( ){
        $result = ['error'=>1]; //失败
        $arrPost = $this->PostJosnToArr($_POST['param']);


        $result =  $this->Handle2($arrPost);



        return  json_encode($result);
    }

    //把多维数组里的一维数组拿出来处理
    function Handle2($arr){
        $result = '';

        //如果是一维数组
        if (count($arr) == count($arr, 1)) {
          if(isset($arr['id']))  $result = $this->objectTree->RemoveNode($arr['id']);
        }else{
            foreach ($arr as $val) {

                if (is_array($val)){

                    if (count($val) == count($val, 1)) {
                        if(isset($val['id']))     $result = $this->objectTree->RemoveNode($val['id']);
                    }else{
                        $result = $this->Handle2($val);
                    }
                }else {

                    if($val=='removed'){
                        if(isset($arr['id']))  $result = $this->objectTree->RemoveNode( $arr['id']);

                    }

                }


            }
        }

        return $result;
    }

    //告诉数据模型怎么处理提交过来的数据
    function Handle($arr){
        $json = ['error'=>0];

        foreach ($arr as $row ) {

                //根据记录状态，进行不同的增加、删除、修改操作
                $state = isset($row['_state']) ? $row['_state'] : '';
                if($state == 'added')
                {
                    $json =  $this->objectTree->InsertNode($row['_id'],$row['text'],$row['_pid'],$row['_level']);
                }
                else if ($state == 'modified')
                {
                    if ( isset($row['text']) )
                        $json =  $this->objectTree->UpdateNode($row['id'],$row['text'],$row['pid'],$row['_level']);

                    if ( isset($row['url']) )
                        $json =  $this->objectTree->UpdateUrl($row['url'],$row['id'])  ;

                    //设置栏目图标
                    if ( isset($row['img']) )
                        $json =  $this->objectTree->UpdateImg($row['img'],$row['id'])  ;

                    //设置重权
                    if ( isset($row['weight']) )
                        $json =  $this->objectTree->UpdateWeight($row['weight'],$row['id'])  ;

                }


                if(isset($row['children'])){
                    $json =  $this->handle($row['children']);
                }
            }



        return $json;
    }

    /**
     * 获取所有的节点
     */
    function GetColumn(){
        //以children的结构组合,使用这个方法，后台模板tree标签，属性须设置：resultAsTree="true"
       // $arr =  $this->objectTree->GetNodeAll();

        //有这个性能好点
        $arr =  $this->objectTree->GetNodeList();

       $arr = $this->ArrToUtf8($arr);
       //[{"text":"\u9876\u7ea7\u680f\u76ee"}]
       return json_encode($arr);

    }

    /** 获取单个节点
     * @return false|string
     * 注意返回的 json_encode 编码要转义UTF8一下。
     */
    function GetOne(){

        if (isset($_POST['id'])){
            $arr =  $this->objectTree->GetNodeById((int)$_POST['id']);

            return json_encode(['data'=>[$arr],'total'=>1]);
        }else{
            exit('id不存在');
        }

    }
}
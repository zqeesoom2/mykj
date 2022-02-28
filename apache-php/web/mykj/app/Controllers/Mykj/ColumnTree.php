<?php


namespace App\Controllers\Mykj;
use App\Controllers\Controller;
use App\Models\TreeModel;
//������Ŀ
class ColumnTree extends Controller
{

    //������Ŀ��Ķ���
    public $objectTree;

     function __construct($table = 'column')
    {
        parent::__construct();
        $this->objectTree =  new TreeModel($table);
    }

    //����\�޸�ajax�ύ�����Ľڵ�����
    function Save(){
        //����ת���� $_POST['param'] ת���ı���Ϊ��$this->arrPost;
       // $arrPost = $this->PostJosnToArr($_POST['param']);
        $arrPost =  $this->arrPost;


        /* $arrPostԪ����  dd($arrPost);
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
   string(9) "������Ŀ2"
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
       string(7) "����Ŀ1"
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
           string(9) "������Ŀ3"
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
   string(9) "������Ŀ1"
 }
}

       */
         if(is_array($arrPost) && count($arrPost)){
            $arr = $this->Handle($arrPost);

            return json_encode($arr);

         }

    }

    //ɾ��tree�ڵ�
    function RemoveSave( ){
        $result = ['error'=>1]; //ʧ��
        $arrPost = $this->PostJosnToArr($_POST['param']);


        $result =  $this->Handle2($arrPost);



        return  json_encode($result);
    }

    //�Ѷ�ά�������һά�����ó�������
    function Handle2($arr){
        $result = '';

        //�����һά����
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

    //��������ģ����ô�����ύ����������
    function Handle($arr){
        $json = ['error'=>0];

        foreach ($arr as $row ) {

                //���ݼ�¼״̬�����в�ͬ�����ӡ�ɾ�����޸Ĳ���
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

                    //������Ŀͼ��
                    if ( isset($row['img']) )
                        $json =  $this->objectTree->UpdateImg($row['img'],$row['id'])  ;

                    //������Ȩ
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
     * ��ȡ���еĽڵ�
     */
    function GetColumn(){
        //��children�Ľṹ���,ʹ�������������̨ģ��tree��ǩ�����������ã�resultAsTree="true"
       // $arr =  $this->objectTree->GetNodeAll();

        //��������ܺõ�
        $arr =  $this->objectTree->GetNodeList();

       $arr = $this->ArrToUtf8($arr);
       //[{"text":"\u9876\u7ea7\u680f\u76ee"}]
       return json_encode($arr);

    }

    /** ��ȡ�����ڵ�
     * @return false|string
     * ע�ⷵ�ص� json_encode ����Ҫת��UTF8һ�¡�
     */
    function GetOne(){

        if (isset($_POST['id'])){
            $arr =  $this->objectTree->GetNodeById((int)$_POST['id']);

            return json_encode(['data'=>[$arr],'total'=>1]);
        }else{
            exit('id������');
        }

    }
}
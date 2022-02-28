<?php
//��̨
namespace App\Controllers\Mykj;
use App\Models\UserModel;
use App\Controllers\Controller;
use App\Models\MemberModel;

/** ����������������������ĸ�����д */
class Mykj extends Controller
{

    function Index(){
        echo 'Mykj_Index'.PHP_EOL;
    }

    //��̨��½
    function Login(){

        //������֤��
        if( isset($_GET['checkCode']) ){
           return verifyCode();
        }

        //ajax����
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            //��ǰ̨POST��json����ת��ΪArr

            $arrPost = $this->PostJosnToArr($_POST['param']);

            $ObjectUser = new UserModel();

            //ע�������ַ���URL����
            $rsArr =  $ObjectUser->getUserByName(urldecode($arrPost['username']));


            //ֱ��ǿ����nginx�ľ�̬�ļ���Ҫ��֤��û�к�̨��Ȩ�ޣ���Ȩ�޷���1
            if ( isset($arrPost['islogin']) && $arrPost['islogin'] == 1 ){
                return  ($rsArr['master']==1 || $rsArr['master']==3) && isset($_SESSION["isLogin"]) && $_SESSION["isLogin"]==1  ? $rsArr['master'] : 0;
            }

            //dd($arrPost);

            if (isset($_SESSION['code'])&&$_SESSION['code'] == $arrPost['verifyCode']) {
                if ( $rsArr['password'] == $arrPost['password'] ) {
                    $_SESSION["isLogin"]=1;
                    $_SESSION["uid"]=$rsArr['id'];
                    $_SESSION["master"]=$rsArr['master'];
                    return 1;
                }else{
                    return 0;
                }

            }else{
                return 2; //��֤���
            }
        }
        //  echo 'Mykj_Login'.PHP_EOL;
        include BASEDIR . '/cmd/Mykj/login.html';

    }

    //�˳���½
    function OutLogin(){
        $_SESSION = array();
        if( isset($_COOKIE[session_name()]) ) {
            setcookie(session_name(),'',TIME-3600,'/');
        }
        session_destroy();
        header('Location:http://'.$_SERVER['HTTP_HOST'].'/Mykj/Login.html');

    }

    //������ţ��������ͼ
    function UploadSingleImg(){
        return json_encode(['path'=>upFile('file')]);

    }

    //��ȡ�û���̨Ȩ�޲˵�
    function MenuTree(){
        /*if(!isset($_SESSION["isLogin"]) && ($_SESSION["master"]==1 || $_SESSION["master"]==3) ){
            return 'û��Ȩ��';
        }*/

        $ColumnTree = (new ColumnTree());
        //��������Ա
        if($_SESSION["master"]==1){

            $arr =  $ColumnTree->objectTree->GetNodeList();
            $arr = $ColumnTree->ArrToUtf8($arr);
            return 'var _arr = '.json_encode($arr);

        }

        //��ȡ��ɫID
        $Member = new MemberModel();
        $powerid=  $Member->getRole($_SESSION["uid"]);

        if(!empty($powerid)){
            //ͨ����ɫID�õ�Ȩ��ID
          $arrIds = explode(',',$powerid);
          $Role =  new Role();
          $powerIds = $Role->objectTree->GetNodeByIn($arrIds);

          //ͨ��Ȩ��ID�õ�Ȩ��
            $columnIds = '';
           foreach ($powerIds as $key => $row){

                   $columnIds .= $row['url'].',';


           }

           if ($columnIds){

               $arr = $ColumnTree->objectTree->GetNodeByIn($columnIds);

               $arr = $ColumnTree->ArrToUtf8($arr);

               return 'var _arr = '.json_encode($arr);
           }

        }
    }
}
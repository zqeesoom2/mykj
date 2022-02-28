<?php
//后台
namespace App\Controllers\Mykj;
use App\Models\UserModel;
use App\Controllers\Controller;
use App\Models\MemberModel;

/** 控制器类名、方法名首字母必须大写 */
class Mykj extends Controller
{

    function Index(){
        echo 'Mykj_Index'.PHP_EOL;
    }

    //后台登陆
    function Login(){

        //请求验证码
        if( isset($_GET['checkCode']) ){
           return verifyCode();
        }

        //ajax请求
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            //将前台POST的json对象，转化为Arr

            $arrPost = $this->PostJosnToArr($_POST['param']);

            $ObjectUser = new UserModel();

            //注意中文字符的URL解码
            $rsArr =  $ObjectUser->getUserByName(urldecode($arrPost['username']));


            //直接强制走nginx的静态文件，要验证有没有后台的权限，有权限反回1
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
                return 2; //验证码错
            }
        }
        //  echo 'Mykj_Login'.PHP_EOL;
        include BASEDIR . '/cmd/Mykj/login.html';

    }

    //退出登陆
    function OutLogin(){
        $_SESSION = array();
        if( isset($_COOKIE[session_name()]) ) {
            setcookie(session_name(),'',TIME-3600,'/');
        }
        session_destroy();
        header('Location:http://'.$_SERVER['HTTP_HOST'].'/Mykj/Login.html');

    }

    //添加新闻，处理封面图
    function UploadSingleImg(){
        return json_encode(['path'=>upFile('file')]);

    }

    //获取用户后台权限菜单
    function MenuTree(){
        /*if(!isset($_SESSION["isLogin"]) && ($_SESSION["master"]==1 || $_SESSION["master"]==3) ){
            return '没有权限';
        }*/

        $ColumnTree = (new ColumnTree());
        //超级管理员
        if($_SESSION["master"]==1){

            $arr =  $ColumnTree->objectTree->GetNodeList();
            $arr = $ColumnTree->ArrToUtf8($arr);
            return 'var _arr = '.json_encode($arr);

        }

        //获取角色ID
        $Member = new MemberModel();
        $powerid=  $Member->getRole($_SESSION["uid"]);

        if(!empty($powerid)){
            //通过角色ID拿到权限ID
          $arrIds = explode(',',$powerid);
          $Role =  new Role();
          $powerIds = $Role->objectTree->GetNodeByIn($arrIds);

          //通过权限ID拿到权限
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
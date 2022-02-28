<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2021/6/14 0014
 * Time: 下午 4:32
 */

namespace App\Controllers\Mykj;

use App\Controllers\Controller;
use App\Models\MemberModel;

class Member extends Controller
{
    public $Member;

    function __construct()
    {
        $this->Member = new MemberModel();
    }

    //列出会员
    function ListMember(){

        //会员类型
        $Type = isset($_POST['type'])?$_POST['type']: '';

        //用户名
        $Username= !empty($_POST['username'])? iconv('utf-8','gbk',$_POST['username']) : '';

        $sortOrder = !empty($_POST['sortOrder'])?$_POST['sortOrder']:'DESC';

        //当前页数
        $page=!empty($_POST["pageIndex"]) ? $_POST["pageIndex"] : 1;

        $pageSize = !empty($_POST['pageSize'])?$_POST['pageSize']:10;

        $WhereMaster = $WhereUsername  ='';
        if(!empty($Username)){
            $WhereUsername = ' AND username LIKE ? ';

        }

        if(!empty($Type) || $Type=='0'){
            $WhereMaster = ' AND `master`=? ';
        }

        //总计录数
        $total = $this->Member->getCount('1=1',$Type,$Username,$WhereUsername,$WhereMaster);

        //总共多少页
        //$pageNum=ceil($total/$pageSize);

        $step = ($page-1)*$pageSize;

        $limit = 'Limit '.$step.','.$pageSize;

        $result = $this->Member->getList($WhereUsername,$Username,$WhereMaster,$Type,$sortOrder,$limit);

        foreach ($result as &$row){

            //查用户权限
            $row['powerid'] =  $this->Member->getRole( $row['id']);
        }

        $arr = $this->ArrToUtf8($result);

        return json_encode(['total'=>$total,'data'=>$arr]);

    }

    //给会员添加角色
    function AddRoleToMember(){

        if(isset($_POST['role']) && $_POST['uid']){

            return $this->Member->addRole($_POST['role'],$_POST['uid']);
        }
    }


    function SetPassword(){
        $arr = json_decode($_GET['data'],true);
       $uid = $arr[0]['uid'];
       $password=  $arr[0]['password'];
       return $this->Member->setPassword($password,$uid);

    }

    //修改账号类型
    function SetMaster(){
        $arr = json_decode($_GET['data'],true);
        $uid = $arr[0]['uid'];
        $master=  $arr[0]['master'];
        return $this->Member->setMaster($master,$uid);
    }
}
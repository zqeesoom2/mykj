<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2021/6/14 0014
 * Time: ���� 4:32
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

    //�г���Ա
    function ListMember(){

        //��Ա����
        $Type = isset($_POST['type'])?$_POST['type']: '';

        //�û���
        $Username= !empty($_POST['username'])? iconv('utf-8','gbk',$_POST['username']) : '';

        $sortOrder = !empty($_POST['sortOrder'])?$_POST['sortOrder']:'DESC';

        //��ǰҳ��
        $page=!empty($_POST["pageIndex"]) ? $_POST["pageIndex"] : 1;

        $pageSize = !empty($_POST['pageSize'])?$_POST['pageSize']:10;

        $WhereMaster = $WhereUsername  ='';
        if(!empty($Username)){
            $WhereUsername = ' AND username LIKE ? ';

        }

        if(!empty($Type) || $Type=='0'){
            $WhereMaster = ' AND `master`=? ';
        }

        //�ܼ�¼��
        $total = $this->Member->getCount('1=1',$Type,$Username,$WhereUsername,$WhereMaster);

        //�ܹ�����ҳ
        //$pageNum=ceil($total/$pageSize);

        $step = ($page-1)*$pageSize;

        $limit = 'Limit '.$step.','.$pageSize;

        $result = $this->Member->getList($WhereUsername,$Username,$WhereMaster,$Type,$sortOrder,$limit);

        foreach ($result as &$row){

            //���û�Ȩ��
            $row['powerid'] =  $this->Member->getRole( $row['id']);
        }

        $arr = $this->ArrToUtf8($result);

        return json_encode(['total'=>$total,'data'=>$arr]);

    }

    //����Ա��ӽ�ɫ
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

    //�޸��˺�����
    function SetMaster(){
        $arr = json_decode($_GET['data'],true);
        $uid = $arr[0]['uid'];
        $master=  $arr[0]['master'];
        return $this->Member->setMaster($master,$uid);
    }
}
<?php


namespace App\Models;

//操作角色和用户
class MemberModel extends Model
{
    public $mysql;
    public $table = PREFIX.'member';
    function __construct(){
        $this->mysql = app('db');
    }

    //$WhereUserName 代表语句，$username是$WhereUserName 代表语句中的值; 他们都是相对应的。
    function getList($WhereUserName,$username,$WhereMaster,$master,$sortOrder = 'asc',$limit=''){


        $sql = 'SELECT id,username,`master` FROM pre_member WHERE 1=1'.$WhereUserName.$WhereMaster.' ORDER BY id '.$sortOrder.' '.$limit ;

        $stm = $this->mysql->prepare($sql);
        if(!$stm){

            dd($this->mysql->error);
            die('编译查询会员失败');
        }

        if(!empty($username)){
            $username .= '%';
            $stm->bind_param('s',$username);
        }



        if(is_numeric($master)){

            $stm->bind_param('i',$master);
        }

        $stm->bind_result($id,$username,$master);




        $stm->execute();


        $arr = $temp =[];

        while($stm->fetch()){

            $temp['id'] = $id;
            $temp['username'] = $username;

            $temp['master'] = $this->TransformMaster($master);



            $arr[] = $temp;

        }

        $stm->free_result();
        $stm->close();

        return $arr;

    }

    function TransformMaster($master){
        if($master == 1){
            $master = '超级管理员';
        }elseif($master == 3){
            $master  = '普通管理员';
        }elseif($master == 2){
            $master  = '律师顾问';
        }else{
            $master  = '普通会员';
        }
        return  $master ;

    }

    //获取角色
    function getRole($id){

        $sql = 'SELECT `power` FROM pre_power WHERE uid = ?';

        $smt = $this->mysql->prepare($sql);

        if(!$smt){
            echo $sql;
            dd('角色编译出错');
        }

        $smt->bind_param('i',$id);
        $smt->bind_result($power);
        if($smt->execute()){

            $smt->fetch();
            $smt->free_result();
            $smt->close();
            return $power;
        }

     /* $sql = 'SELECT `power` FROM pre_power WHERE uid = '.$id;

      $arr =  $this->query($sql,1);

      return $arr['power'];*/
    }

    //添加角色
    function addRole($power,$uid){

        $sql = 'REPLACE INTO pre_power (`power`,uid) VALUES (?,?)';
        $smt = $this->mysql->prepare($sql);
        if(!$smt){
            //echo $sql;
            dd('添加角色编译出错');
        }

        $smt->bind_param('si',$power,$uid);

        if ($smt->execute()){
            return 0;
        }

        $smt->close();

        return 1;
    }

    function setPassword($password,$uid){

        $sql ='UPDATE pre_member SET password = ? WHERE id = ?';

       return  $this->SqlPrepareAndExecute($sql,'si',$password,$uid);

    }

    function setMaster($Master,$uid){
        $sql ='UPDATE pre_member SET master = ? WHERE id = ?';

        return  $this->SqlPrepareAndExecute($sql,'ii',$Master,$uid);
    }
}
<?php


namespace App\Models;

//������ɫ���û�
class MemberModel extends Model
{
    public $mysql;
    public $table = PREFIX.'member';
    function __construct(){
        $this->mysql = app('db');
    }

    //$WhereUserName ������䣬$username��$WhereUserName ��������е�ֵ; ���Ƕ������Ӧ�ġ�
    function getList($WhereUserName,$username,$WhereMaster,$master,$sortOrder = 'asc',$limit=''){


        $sql = 'SELECT id,username,`master` FROM pre_member WHERE 1=1'.$WhereUserName.$WhereMaster.' ORDER BY id '.$sortOrder.' '.$limit ;

        $stm = $this->mysql->prepare($sql);
        if(!$stm){

            dd($this->mysql->error);
            die('�����ѯ��Աʧ��');
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
            $master = '��������Ա';
        }elseif($master == 3){
            $master  = '��ͨ����Ա';
        }elseif($master == 2){
            $master  = '��ʦ����';
        }else{
            $master  = '��ͨ��Ա';
        }
        return  $master ;

    }

    //��ȡ��ɫ
    function getRole($id){

        $sql = 'SELECT `power` FROM pre_power WHERE uid = ?';

        $smt = $this->mysql->prepare($sql);

        if(!$smt){
            echo $sql;
            dd('��ɫ�������');
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

    //��ӽ�ɫ
    function addRole($power,$uid){

        $sql = 'REPLACE INTO pre_power (`power`,uid) VALUES (?,?)';
        $smt = $this->mysql->prepare($sql);
        if(!$smt){
            //echo $sql;
            dd('��ӽ�ɫ�������');
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
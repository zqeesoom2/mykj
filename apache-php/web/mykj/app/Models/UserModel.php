<?php
namespace App\Models;

//跟MemberModel模型都是处理的用户表的功能
class UserModel extends Model
{
    protected $mysql;
    public function __construct(){
        $this->mysql = app('db');
    }

    function getUserByName($username){

        $sql = 'SELECT id,password,master FROM pre_member WHERE username = ?';
        $stmt = $this->mysql->prepare($sql);
        $stmt->bind_param('s',$username);
        $stmt->bind_result($id,$password,$master);
        $stmt->execute();

        if(!$stmt->fetch())
            return 0;

        $stmt->free_result();
        $stmt->close();
        return ['password'=>$password,'master'=>$master,'id'=>$id];
    }

    function getUserById($id){

        $sql = 'SELECT username,sex,headimgurl,`master`,contact,address,company FROM pre_member WHERE id = ?';
        $stmt = $this->mysql->prepare($sql);
        $stmt->bind_param('s',$id);
        $stmt->bind_result($username,$sex,$headimgurl,$master,$contact,$address,$company);
        $stmt->execute();

        if(!$stmt->fetch())
            return 0;

        $stmt->free_result();
        $stmt->close();
        return ['uid'=>$id,'username'=>$username,'sex'=>$sex,'avatar'=>$headimgurl,'master'=>$master,'contact'=>$contact,'address'=>$address,'company'=>$company];
    }

    function getUserByOpenId($openid){

        $sql = 'SELECT id,`master` FROM pre_member WHERE openid = ?';
        $stmt = $this->mysql->prepare($sql);
        $stmt->bind_param('s',$openid);
        $stmt->bind_result($id,$master);
        $stmt->execute();

        if(!$stmt->fetch())
            return 0;

        $stmt->free_result();
        $stmt->close();
        return ['id'=>$id,'master'=>$master];
    }

    //存在用户就更新，不存在就插入
    function add($username,$openid,$sex,$headimgurl){

        $sql = 'insert into pre_member (username,openid,sex,headimgurl) VALUES(?,?,?,?)';

        $stmt = $this->mysql->prepare($sql);

        $stmt->bind_param('ssis',$username,$openid,$sex,$headimgurl);

        $result = $stmt->execute();

        if($result==false){
            print_r($stmt->error_list);
            die('sql插入会员执行失败');
        }

        //$aff_rows = $stmt->affected_rows;
        $uid =$stmt->insert_id;

        $stmt->close();

        return $uid;

    }

    function setUserInfo($contact,$address,$username,$id){


        $sql ='UPDATE pre_member SET contact = ?,address=?,username=? WHERE id = ?';

        return  $this->SqlPrepareAndExecute($sql,'sssi',$contact,$address,$username,$id);
    }


}
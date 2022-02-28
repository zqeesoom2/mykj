<?php


namespace App\Models;

use App\Event\Supplement\SupplementObserver;
use App\Event\Supplement\SupplementSubject;

//提的问题表
class QuizModel
{
    public $mysql;
    public $Subject;

    function __construct(){
        $this->mysql = app('db');
        $this->Subject = new SupplementSubject($this);
        $this->Subject->attach( new SupplementObserver() );
    }


    //传过来的数据$quzi,$mobile,$newstime,$imgs,$uid，接收为数组
    function add($quzi,$mobile,$newstime,$imgs,$uid) {

        $sql = 'INSERT INTO pre_quiz (quiz,mobile,newstime,imgs,uid) VALUES (?,?,?,?,?)';

        $smtm = $this->mysql->prepare($sql);

        if(!$smtm){
            echo '插入问题，编译出错';
            dd( $this->mysql->error);
        }

        $smtm->bind_param('siisi',$quzi,$mobile,$newstime,$imgs,$uid);

        $result = $smtm->execute();

        if(!$result){
            dd($smtm->error_list);
        }

        $id = $smtm->insert_id;

        $smtm->close();
        return $id;
    }

    //
    function getQuziByUid($uid){

        $sql = 'SELECT id,quiz,newstime FROM pre_quiz WHERE uid=?';
        $stmt = $this->mysql->prepare($sql);
        if(!$stmt){
            echo '查询，编译出错';
            dd( $this->mysql->error);
        }
        $stmt->bind_param('i',$uid);
        $stmt->bind_result($id,$quiz,$newstime);
        $stmt->execute();

        $rows = [];
        while($stmt->fetch()){

            array_push($rows, ['id'=>$id,'quiz'=>$quiz,'newstime'=>$newstime]);
        }

        $stmt->free_result();
        $stmt->close();
        return $rows;
    }

    function getQuziById($uid){

        $sql = 'SELECT id,quiz,newstime,uid,imgs FROM pre_quiz WHERE id=?';
        $stmt = $this->mysql->prepare($sql);
        if(!$stmt){
            echo '查询，编译出错';
            dd( $this->mysql->error);
        }
        $stmt->bind_param('i',$uid);
        $stmt->bind_result($id,$quiz,$newstime,$uid,$imgs);
        $stmt->execute();

        $row = [];
        while($stmt->fetch()){

            $row = ['id'=>$id,'quiz'=>$quiz,'newstime'=>$newstime,'uid'=>$uid,'imgs'=>$imgs];
        }

        $stmt->free_result();
        $stmt->close();
        return $row;
    }

    function getQuziByStatus($status = 0){

        $sql = 'SELECT id,quiz,newstime FROM pre_quiz WHERE status=?';
        $stmt = $this->mysql->prepare($sql);
        if(!$stmt){
            echo '查询，编译出错';
            dd( $this->mysql->error);
        }
        $stmt->bind_param('i',$status);
        $stmt->bind_result($id,$quiz,$newstime);
        $stmt->execute();

        $rows = [];
        while($stmt->fetch()){

            array_push($rows, ['id'=>$id,'quiz'=>$quiz,'newstime'=>$newstime]);
        }

        $stmt->free_result();
        $stmt->close();
        return $rows;
    }
}